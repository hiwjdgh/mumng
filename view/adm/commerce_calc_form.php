<?php
$calc_id = pave_input_sanitize($calc_id);

$sql = array();
$sql_common = array();
$sql_where = array();
$sql_group = "";
$sql_order = "";
$sql_limit = "";

$sql_common[] = "SELECT calc.*, user.user_nick, user.user_code FROM pave_commerce_calc AS calc";
$sql_common[] = "LEFT JOIN pave_user AS user ON calc.user_id = user.user_id";

$sql_where[] = "WHERE calc_id = '{$calc_id}'";


$sql_common = pave_implode($sql_common, " ");
$sql_where = pave_implode($sql_where, " AND ");
$sql[] = $sql_common;
$sql[] = $sql_where;
$sql[] = $sql_group;
$sql[] = $sql_order;
$sql[] = $sql_limit;

$sql = pave_implode($sql, " ");
$calc = pave_fetch($sql);

if(!$calc["calc_id"]){
    $action_url = get_url(PAVE_ADM_URL,"commerce/calc/create");
    $submit_text = "추가";
    $adm_title = "정산내역 생성";
}else{
    $action_url = get_url(PAVE_ADM_URL,"commerce/calc/update");
    $submit_text = "수정";
    $adm_title = "정산내역 수정";
}



//헤더 불러오기
get_header("정산내역 | 커머스 - 관리자");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/commerce_calc_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/adm/commerce_calc_form.view.php");
}

//푸터 불러오기
get_footer();
?>