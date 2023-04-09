<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

$user_share = pave_input_sanitize($user_share);

//공유 URL 검사
if($msg = sanitize_reg_user_share($user_share, true, "", true)){
    die(return_json(null, "fail", $msg));
}

$update = array(
    "user_share"                  => $user_share
);

$result = pave_update("pave_user", $update, "user_no = '{$pave_user["user_no"]}'");

if(!$result){
    die(return_json(null, "fail", "공유 URL 수정에 실패 했습니다."));
}

die(return_json(null, "success"));
?>