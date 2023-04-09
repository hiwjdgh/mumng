<?php
if(!$is_user){
    die(return_json(null, "-100", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}
?>