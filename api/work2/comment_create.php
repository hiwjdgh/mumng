<?php
$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);
$comment_parent_no = pave_input_sanitize($comment_parent_no);
$comment_content = pave_input_sanitize($comment_content);
$comment_metion = pave_input_sanitize($comment_metion);


$work_obj = new Work();
$work = $work_obj->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)->get_work();
if(!$work["work_id"]){
    die(return_json(null, "fail", "의견 등록에 실패했습니다."));
}

$epsd_obj = new Epsd();
$epsd_obj->set_work_id($work["work_id"])
->set_epsd_id($epsd_id)
->set_epsd_cate(array("epsd", "notice"));
if($work["work_user"]["user_commerce"]){
    $epsd_obj->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj->set_epsd_state("success");
}
$epsd = $epsd_obj->get_epsd();
if(!$epsd["epsd_id"]){
    die(return_json(null, "fail", "의견 등록에 실패했습니다."));
}


if($comment_parent_no){
    $comment_obj = new Comment();
    $comment_parent = $comment_obj->set_work_id($work["work_id"])
    ->set_epsd_id($epsd["epsd_id"])
    ->set_comment_display(1)
    ->set_comment_no($comment_parent_no)
    ->get_comment();
}

if($comment_parent_no && !$comment_parent["comment_no"]){
    die(return_json(null, "fail", "삭제된 의견입니다."));
}

//의견 내용 검사
if($msg = sanitize_comment_content($comment_content, true)){
    die(return_json(null, "fail", $msg));
}


$create = array(
    "user_no"               => $pave_user["user_no"],
    "work_id"               => $work["work_id"],
    "epsd_id"               => $epsd["epsd_id"],
    "comment_parent_no"     => $comment_parent["comment_no"],
    "comment_content"       => $comment_content,
    "comment_insert_dt"     => PAVE_TIME_YMDHIS,
    "comment_insert_ip"     => PAVE_USER_IP,
    "comment_update_dt"     => PAVE_TIME_YMDHIS,
    "comment_update_ip"     => PAVE_USER_IP
);

$result = pave_insert("pave_comment", $create);

if(!$result){
    die(return_json(null, "fail", "의견등록에 실패했습니다."));
}

//언급일 경우 의견 리플수 수정
if($comment_parent_no && $comment_parent["comment_no"]){
    pave_query("UPDATE pave_comment SET comment_reply = comment_reply + 1 WHERE comment_no = '{$comment_parent["comment_no"]}'");
}


//회차 의견 수 수정
pave_query("UPDATE pave_epsd SET epsd_cmt = epsd_cmt + 1 WHERE epsd_id = '{$epsd["epsd_id"]}'");

/* //의견 작성 알림
if($pave_user["user_no"] != $work["work_user"]["user_no"]){
    $notify_obj = new Notify();
    $notify_obj->send_notify($pave_user["user_id"], $work["work_user"]["user_id"], "notify_user_comment", array(
        "work_id" => $work["work_id"],
        "epsd_id" => $epsd["epsd_id"]
    ));
}

//언급 작성 알림
if($comment_parent_no && $comment_parent["comment_no"]){
    if($pave_user["user_id"] != $cmt_parent["cmt_user"]["user_id"]){
        $notify_obj = new Notify();
        $notify_obj->send_notify($pave_user["user_id"], $cmt_parent["cmt_user"]["user_id"], "notify_user_mention", array(
            "work_id" => $work["work_id"],
            "epsd_id" => $epsd["epsd_id"],
            "cmt_id" => $cmt_parent["cmt_id"],
        ));
    }
}
 */
die(return_json(null, "success"));
?>