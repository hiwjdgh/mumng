<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

if($is_user){
    die(return_json(null, "fail","", get_url(PAVE_URL)));
}

$user_obj = new User();

$user_id    = pave_input_sanitize($user_id);
$user_pwd   = pave_input_sanitize($user_pwd);
$user_auto_login   = pave_input_sanitize($user_auto_login);

if(!$user_id || !$user_pwd){
    die(return_json(null, "fail", "아이디 또는 비밀번호를 확인해주세요."));
}

$user = $user_obj->set_user_id($user_id)->get_user();

//비밀번호 검사
if(!User::is_user_pwd($user_pwd, $user["user_hash"], $user["user_salt"])){
    die(return_json(null, "fail", "아이디 또는 비밀번호를 확인해주세요."));
}


//탈퇴 회원
if($user["user_leave_state"]){
    die(return_json(null, "fail", "탈퇴한 회원입니다."));
}

//차단 회원
if($user["user_block_state"]){
    die(return_json(null, "fail", "차단된 회원입니다."));
}


//로그인 기록
User::insert_user_login($user);

//회원 세션 생성
set_session("user_no", $user["user_no"]);

//자동 로그인 설정(31일)
if($user_auto_login){
    set_cookie("user_no", $user["user_no"], 86400 * 31);
    set_cookie("user_auto_login", User::generate_auto_login_key(), 86400 * 31);
}else{
    set_cookie("user_auto_login", "", -3600);
    set_cookie("user_no", "", -3600); 
}

die(return_json(null, "success","", $url?:get_url(PAVE_URL)));
/* //다른 기기 로그인 검사
if(User::is_other_device_login($user)){
    Notification::send_notify_with_email($pave_config["pave_adm"], $user, "notify_other_device");
}

//비밀변경 만료 검사
if(User::is_pwd_expired($user)){
    Notification::send_notify_with_email($pave_config["pave_adm"], $user, "notify_pwd_expire");
}
 */

//본인인증 만료 알림
if(User::is_cert_expired($user)){
    Notification::send_notify_with_email($pave_config["pave_adm"], $user["user_id"], "notify_cert_expire");
    pave_update("pave_user", array("user_cert_state" => "0"), "user_no = '{$user["user_no"]}'");
}
 
die(return_json(null, "success","", $url?:get_url(PAVE_URL)));
?>