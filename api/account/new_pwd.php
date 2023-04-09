<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail","비정상적인 접근입니다.", get_url(PAVE_URL)));
}

$user_no = get_session("find_user_no");
$user_pwd = pave_input_sanitize($user_pwd);
$user_pwd_re = pave_input_sanitize($user_pwd_re);

if(!$user_no){
    die(return_json(null, "fail","비정상적인 접근입니다.", get_url(PAVE_URL)));
}

//비밀번호 검사
if($msg = sanitize_reg_user_pwd($user_pwd)){
    die(return_json(null, "fail", $msg));
}

//비밀번호 재입력 검사
if($msg = sanitize_reg_user_pwd_re($user_pwd, $user_pwd_re)){
    die(return_json(null, "fail", $msg));
}

$user_obj = new User();
$user = $user_obj->set_user_no($user_no)
->set_user_leave(0)
->set_user_block(0)
->get_user();

$update = array(
    "user_hash"                 => password_hash($user["user_salt"].$user_pwd, PASSWORD_DEFAULT),
    "user_update_dt"            => PAVE_TIME_YMDHIS,
    "user_update_ip"            => PAVE_USER_IP
);
pave_update("pave_user", $update, "user_no = '{$user["user_no"]}'");

session_unset();
session_destroy();

die(return_json(null, "success", "새로운 비밀번호가 설정 되었습니다.", get_url(PAVE_ACCOUNT_URL, "login")));
?>