<?php
if(!$pave_user["user_commerce"]){
    url_move(get_url(PAVE_COMMERCE_URL, "home"));
}

//보유 EXP 현황
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT IFNULL(SUM(profit.profit_exp), 0) AS total_exp, IFNULL(SUM(profit.profit_exp - profit.profit_use_exp), 0) AS hold_exp FROM pave_commerce_profit AS profit")
->set_sql_where("profit.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("profit.profit_status = 'success'");
$profit_overview = pave_fetch($obj->generate_sql());

//정산 현황
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT IFNULL(SUM(calc.calc_real_price), 0) AS total_calc FROM pave_commerce_calc AS calc")
->set_sql_where("calc.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("calc.calc_status = 'calc_complete'");
$calc_overview = pave_fetch($obj->generate_sql());


//정산현황
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT calc.* FROM pave_commerce_calc AS calc")
->set_sql_where("calc.user_no = '{$pave_user["user_no"]}'");

$result = pave_query($obj->generate_sql());
$calc_list = array();
for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
    if($row["calc_status"] == "calc_ready"){
        $row["calc_status_text"] = "신청대기";
    }else if($row["calc_status"] == "calc_wait"){
        $row["calc_status_text"] = "정산대기";
    }else if($row["calc_status"] == "calc_complete"){
        $row["calc_status_text"] = "정산완료";
    }else if($row["calc_status"] == "calc_cancel"){
        $row["calc_status_text"] = "신청취소";
    }
    $calc_list[] = $row;
}

//헤더 불러오기
get_header("커머스 정산");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/calc.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/commerce/calc.view.php");
}

//푸터 불러오기
get_footer();
?>