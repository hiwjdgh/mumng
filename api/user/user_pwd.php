<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

$user_pwd = pave_input_sanitize($user_pwd);
$user_pwd_re = pave_input_sanitize($user_pwd_re);

if($msg = sanitize_reg_user_pwd($user_pwd)){
    die(return_json(null, "fail", $msg));
}

if($msg = sanitize_reg_user_pwd_re($user_pwd, $user_pwd_re)){
    die(return_json(null, "fail", $msg));
}

$update = array(
    "user_hash" => password_hash($pave_user["user_salt"].$user_pwd, PASSWORD_DEFAULT),
    "user_pwd_dt" => Converter::display_time("+ {$user_config["user_pwd_expire_day_no"]} {$user_config["user_pwd_expire_day_unit"]}", "Y-m-d H:i:s"),
);

$result = pave_update("pave_user", $update, "user_no = '{$pave_user["user_no"]}'");

if(!$result){
    die(return_json(null, "fail", "비밀번호 변경에 실패했습니다."));
}

session_unset();
session_destroy();

set_cookie("user_auto_login", '', -3600);
set_cookie("user_no", '', -3600);

die(return_json(null, "success", "비밀번호가 변경되었습니다.", get_url(PAVE_ACCOUNT_URL, "login")));
?>