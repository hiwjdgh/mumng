<?php
$work_id = pave_input_sanitize($work_id);

$work_obj = new Work();

$work = $work_obj->set_work_id($work_id)->get_work();

if($subscribe_no = Work::is_work_subscribe($pave_user, $work)){
    pave_delete("pave_subscribe", array("subscribe_no" => $subscribe_no));
}else{
    $subscribe = array(
        "user_no"               => $pave_user["user_no"],
        "work_id"               => $work["work_id"],
        "subscribe_insert_dt"   => PAVE_TIME_YMDHIS,
        "subscribe_insert_ip"   => PAVE_USER_IP
    );

    pave_insert("pave_subscribe", $subscribe);
/* 
    //구독 알림(notification)
    if($pave_user["user_no"] != $work["work_user"]["user_no"]){
        $notify_rel = array(
            "work_id" => $work["work_id"]
        );

        $notify_obj = new Notify();
        $notify_obj->send_notify($pave_user["user_no"], $work["work_user"]["user_no"], "notify_work_subscribe", $notify_rel);
    } */
}
die(return_json(null, "success"));
?>