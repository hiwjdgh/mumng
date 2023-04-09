<?php 
$calendar_start = pave_input_sanitize($calendar_start);
$calendar_end = pave_input_sanitize($calendar_end);

$calendar_start = date("Y-m-d", $calendar_start);
$calendar_end = date("Y-m-d", $calendar_end);
 
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT * FROM pave_upload_calendar")
->set_sql_where("user_no = '{$pave_user["user_no"]}'")
->set_sql_where("(calendar_date >= '{$calendar_start}' AND calendar_date < ('{$calendar_end}' + INTERVAL 1 DAY))");
$memo_list = array();
$result = pave_query($obj->generate_sql());
for ($i=0; $row = pave_fetch_assoc($result); $i++) {

    $memo_list[] = $row;
}

die(return_json($memo_list, "success"));
?>