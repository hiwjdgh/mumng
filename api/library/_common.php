<?php
$pave_theme = get_theme("library");

if(!$is_user){
    die(return_json(null, "-100", "로그인 후 이용해주세요.", get_url(PAVE_ACCOUNT_URL, "login")));
}
?>