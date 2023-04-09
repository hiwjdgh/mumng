<?php
if(!$is_user){
    die(return_json(null, "fail", "로그인 후 이용해주세요.", get_url(PAVE_ACCOUNT_URL, "login")));
}

$notify_obj = new Notification();
?>
