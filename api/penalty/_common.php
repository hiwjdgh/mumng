<?php
$pave_theme = get_theme("penalty");

if(!$is_user){
    die(return_json(null, "-100", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

//신고 라이브러리
require_once(PAVE_LIB_PENALTY_PATH.'/penalty.lib.php');
$penalty_cf = Penalty::get_penalty_cf();
$penalty_obj = new Penalty();
?>