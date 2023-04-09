<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

$calc_exp = pave_input_sanitize($calc_exp);
$calc_bank_name = pave_input_sanitize($calc_bank_name);
$calc_bank_owner = pave_input_sanitize($calc_bank_owner);
$calc_bank_number = pave_input_sanitize($calc_bank_number);
$calc_bsns_state = pave_input_sanitize($calc_bsns_state);
$calc_bsns_owner = pave_input_sanitize($calc_bsns_owner);
$calc_bsns_name = pave_input_sanitize($calc_bsns_name);
$calc_bsns_number = pave_input_sanitize($calc_bsns_number);
$commerce_agree = pave_input_sanitize($commerce_agree);


//정산신청 기간 검사
if(!Commerce::is_calc_day()){
    die(return_json(null, "fail", "정산신청 기간이 아닙니다."));
}


//정산신청 여부 검사
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT calc.* FROM pave_commerce_calc AS calc")
->set_sql_where("calc.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("date_format(calc.calc_insert_dt, '%Y-%m') = '".PAVE_TIME_YM."'")
->set_sql_where("calc.calc_status IN ('calc_ready', 'calc_wait', 'calc_complete')");

$calc = pave_fetch($obj->generate_sql());

if($calc["calc_no"]){
    if($calc["calc_status"] == "calc_ready"){
        $msg = "상태: 신청대기 \n신청일자: ".Converter::display_time($calc["calc_ready_dt"]);
        die(return_json(null, "fail", $msg));
    }else if($calc["calc_status"] == "calc_wait"){
        $msg = "상태: 정산대기 \n신청일자: ".Converter::display_time($calc["calc_ready_dt"]."\n신청완료일자: ".Converter::display_time($calc["calc_wait_dt"]));
        die(return_json(null, "fail", $msg));
    }else if($calc["calc_status"] == "calc_complete"){
        $msg = "상태: 정산완료 \n신청일자: ".Converter::display_time($calc["calc_ready_dt"]."\n신청완료일자: ".Converter::display_time($calc["calc_wait_dt"]))."\정산완료일자:".Converter::display_time($calc["calc_complete_dt"]);
        die(return_json(null, "fail", $msg));
    }
}

//보유 EXP 현황
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT IFNULL(SUM(profit.profit_exp - profit.profit_use_exp), 0) AS hold_exp FROM pave_commerce_profit AS profit")
->set_sql_where("profit.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("profit.profit_status = 'success'");
$profit_overview = pave_fetch($obj->generate_sql());


if($profit_overview["hold_exp"] < 10000){
    die(return_json(null, "fail", "정산신청은 보유중인 EXP가 10,000 EXP 이상부터 가능합니다."));
}

if($calc_exp > $profit_overview["hold_exp"]){
    die(return_json(null, "fail", "보유중인 EXP 보다 많이 정산 신청 할 수 없습니다."));
}

//정산은행 검사
if($msg = sanitize_reg_user_bank_name($calc_bank_name, true)){
    die(return_json(null, "fail", $msg));
}

//정산은행 계좌번호 검사
if($msg = sanitize_reg_user_bank_number($calc_bank_number, true)){
    die(return_json(null, "fail", $msg));
}

//정산은행 예금주 검사
if($msg = sanitize_reg_user_bank_owner($calc_bank_owner, true)){
    die(return_json(null, "fail", $msg));
}

//사업자 검사
if($calc_bsns_state){
    //대표자명 검사
    if($msg = sanitize_reg_bsns_owner($calc_bsns_owner, true)){
        die(return_json(null, "fail", $msg));
    }

    //상호명 검사
    if($msg = sanitize_reg_bsns_name($calc_bsns_name, true)){
        die(return_json(null, "fail", $msg));
    }

    //사업자번호 검사
    if($msg = sanitize_reg_user_bsns_num($calc_bsns_number, true, "", false)){
        die(return_json(null, "fail", $msg));
    }
}else{
    $calc_bsns_owner = "";
    $calc_bsns_name = "";
    $calc_bsns_number = "";
}

//커머스 동의 검사
if($msg = sanitize_reg_user_commerce_agree($commerce_agree, true)){
    die(return_json(null, "fail", $msg));
}


$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT profit.*, commerce.commerce_fee FROM pave_commerce_profit AS profit")
->set_sql_common("LEFT JOIN pave_cf_commerce AS commerce ON (profit.profit_commerce = commerce.commerce_id)")
->set_sql_where("profit.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("(profit.profit_exp - profit.profit_use_exp) > 0")
->set_sql_where("profit.profit_status = 'success'")
->set_sql_ORDER("ORDER BY profit.profit_no ASC");

$result = pave_query($obj->generate_sql());
$profit_list = array();
$exp = $calc_exp;
$calc_fee_price = 0;
$calc_vat_price = 0;
$calc_real_price = 0;
for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
    $reamin_exp = $row["profit_exp"] - $row["profit_use_exp"];
    if($reamin_exp > $exp){
        $profit_fee = ($exp * $row["commerce_fee"]) / 100;
        $profit_vat = $profit_fee / 10;

        $calc_fee_price += $profit_fee;
        $calc_vat_price += $profit_vat;
        $calc_real_price += $exp - $profit_fee - $profit_vat;
        pave_query("UPDATE pave_commerce_profit SET profit_use_exp = profit_use_exp + {$exp} WHERE profit_no = '{$row["profit_no"]}'");
        break;
    }else{
        $profit_fee = ($reamin_exp * $row["commerce_fee"]) / 100;
        $profit_vat = $profit_fee / 10;

        $calc_fee_price += $profit_fee;
        $calc_vat_price += $profit_vat;
        $calc_real_price += $reamin_exp - $profit_fee - $profit_vat;
        pave_query("UPDATE pave_commerce_profit SET profit_use_exp = profit_use_exp + {$reamin_exp} WHERE profit_no = '{$row["profit_no"]}'");
        $exp -= $reamin_exp;
    }
}

$commerce_calc = array(
    "user_no" => $pave_user["user_no"],
    "calc_exp" => $calc_exp,
    "calc_real_price" => $calc_real_price,
    "calc_fee_price" => $calc_fee_price,
    "calc_vat_price" => $calc_vat_price,
    "calc_bank_name" => $calc_bank_name,
    "calc_bank_number" => $calc_bank_number,
    "calc_bank_owner" => $calc_bank_owner,
    "calc_bsns_state" => $calc_bsns_state,
    "calc_bsns_owner" => $calc_bsns_owner,
    "calc_bsns_name" => $calc_bsns_name,
    "calc_bsns_number" => $calc_bsns_number,
    "calc_ready_dt" => PAVE_TIME_YMDHIS,
    "calc_insert_dt" => PAVE_TIME_YMDHIS,
    "calc_insert_ip" => PAVE_USER_IP,
);

pave_insert("pave_commerce_calc", $commerce_calc);

$notify_obj = new Notification();
$notify_obj->send_notify("mumng", $pave_user["user_id"], "notify_commerce_calc_request");

die(return_json(null, "success", get_url(PAVE_COMMERCE_URL, "calc")));
?>