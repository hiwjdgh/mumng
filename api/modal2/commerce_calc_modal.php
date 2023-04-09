<?php
$pave_theme = get_theme("commerce");

if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

$user_config = $config_obj->get_user_config();

$return = array(
    "title"     => $modal_title
);

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
->set_sql_common("SELECT IFNULL(SUM(profit.profit_exp), 0) AS total_exp, IFNULL(SUM(profit.profit_exp - profit.profit_use_exp), 0) AS hold_exp FROM pave_commerce_profit AS profit")
->set_sql_where("profit.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("profit.profit_status = 'success'");
$profit_overview = pave_fetch($obj->generate_sql());


if($profit_overview["hold_exp"] < 10000){
    die(return_json(null, "fail", "정산신청은 보유중인 EXP가 10,000 EXP 이상부터 가능합니다."));
}

$theme_path = $pave_theme["thm_path"]."/modal/commerce_calc_form.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>