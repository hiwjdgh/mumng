<?php
$total_exp = $commerce_obj->get_total_exp();
$hold_exp = $commerce_obj->get_hold_exp();
$latest_calc = $commerce_obj->get_latest_calc();



$calc_list = $commerce_obj->get_commerce_calc_list();

if($request[2]){
    $profit_list = $commerce_obj->get_commerce_calc_profit_list($request[2]);
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