<?php
$search_field = pave_input_sanitize($search_field)?:"user_id";
$search_keyword = pave_input_sanitize($search_keyword);
$calc_status = pave_input_sanitize($calc_status);
$calc_insert_dt_from = pave_input_sanitize($calc_insert_dt_from);
$calc_insert_dt_to = pave_input_sanitize($calc_insert_dt_to);
$page = pave_input_sanitize($request[4])?:1;

$sql = array();
$sql_common = array();
$sql_where = array();
$sql_group = "";
$sql_order = "";
$sql_limit = "";

$sql_common[] = "SELECT calc.*, user.user_nick, user.user_code FROM pave_commerce_calc AS calc";
$sql_common[] = "LEFT JOIN pave_user AS user ON calc.user_id = user.user_id";

$sql_where[] = "WHERE 1=1";

//분류
if($search_field && $search_keyword){
    $sql_where[] = "{$search_field} = '{$search_keyword}'";
}

//정산상태
if(pave_is_array($calc_status)){
    $sql_where[] = "calc.calc_status IN ('".pave_implode($calc_status, "','")."')";
}

//정산신청일
if($calc_insert_dt_from && $calc_insert_dt_to){
    $sql_where[] = "(date_format(calc.calc_insert_dt, '%Y-%m-%d') >= '{$calc_insert_dt_from}' AND '{$calc_insert_dt_from}' <= date_format(calc.calc_insert_dt, '%Y-%m-%d'))";
}else{
    if($calc_insert_dt_from){
        $sql_where[] = "date_format(calc.calc_insert_dt, '%Y-%m-%d') >= '{$calc_insert_dt_from}'";
    }
    if($calc_insert_dt_to){
        $sql_where[] = "'{$calc_insert_dt_from}' <= date_format(calc.calc_insert_dt, '%Y-%m-%d')";
    }
}

//페이지
$from = ($page - 1) * 10;
$to = 10;
$sql_limit = "LIMIT {$from}, {$to}";


$sql_common = pave_implode($sql_common, " ");
$sql_where = pave_implode($sql_where, " AND ");
$sql[] = $sql_common;
$sql[] = $sql_where;
$sql[] = $sql_group;
$sql[] = $sql_order;
$sql[] = $sql_limit;

$sql = pave_implode($sql, " ");
$result = pave_query($sql);

$calc_list = array();
for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
    $row["calc_ready_dt_text"] = date("Y-m-d", strtotime($row["calc_ready_dt"]));
    switch ($row["calc_status"]) {
        case "calc_ready":
            $row["calc_status_text"] = "신청대기";
            break;
        case "calc_wait":
            $row["calc_status_text"] = "신청완료";
            break;
        case "calc_complete":
            $row["calc_status_text"] = "입금완료";
            break;
        case "calc_cancel":
            $row["calc_status_text"] = "신청취소";
            break;
    } 
    $calc_list[] = $row;
}

$adm_title = "정산내역";

//헤더 불러오기
get_header("정산내역 | 커머스 - 관리자");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/commerce_calc_list.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/adm/commerce_calc_list.view.php");
}

//푸터 불러오기
get_footer();
?>