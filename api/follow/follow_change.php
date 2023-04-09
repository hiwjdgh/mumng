<?php
if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login?url=".urlencode(PAVE_USER_REFERER))));
}

$user_no = pave_input_sanitize($user_no);
$user = $user_obj->set_user_no($user_no)->set_user_leave(0)->set_user_block(0)->get_user();

if(!$user["user_no"]){
    die(return_json(null, "fail", "작가님을 찾을 수 없습니다."));
}

if($user_follow_no = User::is_follow_user($pave_user, $user)){
    pave_delete("pave_user_follow", array("user_follow_no" => $user_follow_no));
}else{
    $follow = array(
        "user_follow_from"          => $pave_user["user_no"],
        "user_follow_to"            => $user["user_no"],
        "user_follow_insert_dt"     => PAVE_TIME_YMDHIS,
        "user_follow_insert_ip"     => PAVE_USER_IP
    );

    pave_insert("pave_user_follow", $follow);

    
    /* //팔로우 알림(notification)
    $notify_obj = new Notify();
    $notify_obj->send_notify($pave_user["user_id"], $following["user_id"], "notify_user_follow"); */

}
die(return_json(null, "success"));
?>