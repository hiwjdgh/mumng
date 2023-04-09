<?php
$user_pwd   = pave_input_sanitize($user_pwd);

//비밀번호 검사
if(!User::is_user_pwd($user_pwd, $pave_user["user_hash"], $pave_user["user_salt"])){
    die(return_json(null, "fail", "비밀번호를 확인해주세요."));
}

die(return_json(null, "success",""));
?>