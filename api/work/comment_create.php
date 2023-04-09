<?php
$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);
$cmt_parent_id = pave_input_sanitize($cmt_parent_id);
$cmt_content = pave_input_sanitize($cmt_content);
$cmt_metion = pave_input_sanitize($cmt_metion);


$work_obj = new W();
$work = $work_obj->get_work($work_id);

if(!$work["work_id"]){
    die(return_json(null, "200", "의견등록에 실패했습니다."));
}

$epsd_obj = new Epsds();
$epsd = $epsd_obj->get_epsd($epsd_id);

if(!$epsd["epsd_id"]){
    die(return_json(null, "200", "의견등록에 실패했습니다."));
}


$cmt_obj = new Cmts();
$cmt_obj->set_work_id($work["work_id"]);
$cmt_obj->set_epsd_id($epsd["epsd_id"]);
$cmt_parent = $cmt_obj->get_cmt($cmt_parent_id);

if($cmt_parent_id && !$cmt_parent["cmt_id"]){
    die(return_json(null, "200", "삭제된 의견입니다."));
}


if($msg = sanitize_cmt_content($cmt_content)){
    die(return_json(null, "200", $msg));
}


$cmt = array(
    "user_id"           => $pave_user["user_id"],
    "work_id"           => $work["work_id"],
    "epsd_id"           => $epsd["epsd_id"],
    "cmt_parent_id"     => $cmt_parent["cmt_id"],
    "cmt_content"       => $cmt_content,
    "cmt_insert_dt"     => PAVE_TIME_YMDHIS,
    "cmt_insert_ip"     => PAVE_USER_IP,
    "cmt_update_dt"     => PAVE_TIME_YMDHIS,
    "cmt_update_ip"     => PAVE_USER_IP
);

$result = pave_insert("pave_epsd_cmt", $cmt);

if(!$result){
    die(return_json(null," 200", "의견등록에 실패했습니다."));
}

//언급일 경우 의견 리플수 수정
if($cmt_parent_id && $cmt_parent["cmt_id"]){
    pave_query("UPDATE pave_epsd_cmt SET cmt_reply = cmt_reply + 1 WHERE cmt_id = '{$cmt_parent["cmt_id"]}'");
}

//회차 의견 수 수정
pave_query("UPDATE pave_epsd SET epsd_cmt = epsd_cmt + 1 WHERE epsd_id = '{$epsd["epsd_id"]}'");

//의견 작성 알림
if($pave_user["user_id"] != $work["work_user"]["user_id"]){
    $notify_obj = new Notify();
    $notify_obj->send_notify($pave_user["user_id"], $work["work_user"]["user_id"], "notify_user_comment", array(
        "work_id" => $work["work_id"],
        "epsd_id" => $epsd["epsd_id"]
    ));
}

//언급 작성 알림
if($cmt_parent_id && $cmt_parent["cmt_id"]){
    if($pave_user["user_id"] != $cmt_parent["cmt_user"]["user_id"]){
        $notify_obj = new Notify();
        $notify_obj->send_notify($pave_user["user_id"], $cmt_parent["cmt_user"]["user_id"], "notify_user_mention", array(
            "work_id" => $work["work_id"],
            "epsd_id" => $epsd["epsd_id"],
            "cmt_id" => $cmt_parent["cmt_id"],
        ));
    }
}

die(return_json());
?>