<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.");
}

$calc_exp = pave_input_sanitize($calc_exp);
$calc_bank = pave_input_sanitize($calc_bank);
$calc_bank_owner = pave_input_sanitize($calc_bank_owner);
$calc_bank_number = pave_input_sanitize($calc_bank_number);
$calc_bsns = pave_input_sanitize($calc_bsns);
$calc_bsns_owner = pave_input_sanitize($calc_bsns_owner);
$calc_bsns_name = pave_input_sanitize($calc_bsns_name);
$calc_bsns_number = pave_input_sanitize($calc_bsns_number);


//정산신청 기간 검사
if(!$commerce_obj->is_calc_day()){
    alert("정산신청 기간이 아닙니다.");
}

//정산신청 여부 검사
$last_calc = $commerce_obj->get_last_calc();
if($last_calc["calc_id"]){
    alert("{$last_calc["calc_ready_dt"]}에 신청하셨습니다.");
}


//정산 EXP 검사
if($msg = sanitize_reg_user_calc_exp($calc_exp)){
    alert($msg);
}

//정산은행 검사
if($msg = sanitize_reg_user_bank_name($calc_bank)){
    alert($msg);
}

//정산은행 계좌번호 검사
if($msg = sanitize_reg_user_bank_number($calc_bank_number)){
    alert($msg);
}

//정산은행 예금주 검사
if($msg = sanitize_reg_user_bank_owner($calc_bank_owner)){
    alert($msg);
}

//사업자 검사
if($calc_bsns){
    //대표자명 검사
    if($msg = sanitize_reg_bsns_owner($calc_bsns_owner)){
        alert($msg);
    }

    //상호명 검사
    if($msg = sanitize_reg_bsns_name($calc_bsns_name)){
        alert($msg);
    }

    //사업자번호 검사
    if($msg = sanitize_reg_user_bsns_num($calc_bsns_number, false)){
        alert($msg);
    }

}else{
    $calc_bsns_owner = "";
    $calc_bsns_name = "";
    $calc_bsns_number = "";
}


$commerce_calc = array(
    "user_id" => $pave_user["user_id"],
    "calc_exp" => $calc_exp,
    "calc_bank" => $calc_bank,
    "calc_bank_number" => $calc_bank_number,
    "calc_bank_owner" => $calc_bank_owner,
    "calc_bsns" => $calc_bsns,
    "calc_bsns_owner" => $calc_bsns_owner,
    "calc_bsns_name" => $calc_bsns_name,
    "calc_bsns_number" => $calc_bsns_number,
    "calc_ready_dt" => PAVE_TIME_YMDHIS,
    "calc_insert_dt" => PAVE_TIME_YMDHIS,
    "calc_insert_ip" => PAVE_USER_IP,
);

pave_insert("pave_commerce_calc", $commerce_calc);

$notify_obj = new Notify();
$notify_obj->send_notify("mumng", $pave_user["user_id"], "notify_commerce_calc_request");

alert("정산신청이 완료되었습니다.", get_url(PAVE_COMMERCE_URL, "calc"));
?>
