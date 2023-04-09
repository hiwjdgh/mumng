<?php
$calendar_date = pave_input_sanitize($calendar_date);
$calendar_memo = pave_input_sanitize($calendar_memo);



if(mb_strlen($calendar_memo, "UTF-8") > 500){
    $calendar_memo = mb_substr($calendar_memo,0, 500, "UTF-8");
}

$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT * FROM pave_upload_calendar")
->set_sql_where("user_no = '{$pave_user["user_no"]}'")
->set_sql_where("calendar_date = '{$calendar_date}'");
$calendar = pave_fetch($obj->generate_sql());


if($calendar["calendar_no"]){
    if($calendar_memo){
        $update = array(
            "calendar_memo"          => $calendar_memo,
            "calendar_update_dt"     => PAVE_TIME_YMDHIS,
            "calendar_update_ip"     => PAVE_USER_IP
        );
        $result = pave_update("pave_upload_calendar", $update, "calendar_no = '{$calendar["calendar_no"]}'");
    }else{
        $result = pave_delete("pave_upload_calendar", array("calendar_no" => $calendar["calendar_no"]));
    }
}else{
    $calendar = array(
        "user_no"               => $pave_user["user_no"],
        "calendar_date"         => $calendar_date,
        "calendar_memo"         => $calendar_memo,
        "calendar_insert_dt"    => PAVE_TIME_YMDHIS,
        "calendar_insert_ip"    => PAVE_USER_IP,
        "calendar_update_dt"    => PAVE_TIME_YMDHIS,
        "calendar_update_ip"    => PAVE_USER_IP
    );
    $result = pave_insert("pave_upload_calendar", $calendar);
}

die(return_json(null, "success"));
?>