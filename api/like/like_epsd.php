<?php
$epsd_id = pave_input_sanitize($epsd_id);

$epsd_obj = new Epsd();
$epsd = $epsd_obj->set_epsd_id($epsd_id)->get_epsd();

if(!$epsd["epsd_id"]){
    die(return_json(null, "fail", "회차를 찾을 수 없습니다."));
}
if($like_no = Epsd::is_epsd_like($pave_user, $epsd)){
    pave_delete("pave_like", array("like_no" => $like_no));
    pave_query("UPDATE pave_epsd SET epsd_like = epsd_like - 1 WHERE epsd_id = '{$epsd["epsd_id"]}'");
}else{
    $like = array(
        "user_no"          => $pave_user["user_no"],
        "work_id"          => $epsd["work_id"],
        "epsd_id"          => $epsd["epsd_id"],
        "like_insert_dt"   => PAVE_TIME_YMDHIS,
        "like_insert_ip"   => PAVE_USER_IP
    );

    pave_insert("pave_like", $like);

    //좋아요 수 조정
    pave_query("UPDATE pave_epsd SET epsd_like = epsd_like + 1 WHERE epsd_id = '{$epsd["epsd_id"]}'");

  /*   //좋아요 알림(notification)
    $notify_obj = new Notify();
    $notify_obj->send_notify($pave_user["user_no"], $epsd["user_no"], "notify_user_like", array(
        "work_id" => $epsd["work_id"],
        "epsd_id" => $epsd["epsd_id"]
    )); */
}
die(return_json(null, "success"));
?>