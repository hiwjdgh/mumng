<?php
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("cert");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

$user_config = $config_obj->get_user_config();
$cert_config = $config_obj->get_cert_config();

//회원 라이브러리
require_once(PAVE_LIB_USER_PATH."/user.lib.php");


//본인인증 라이브러리
require_once(PAVE_LIB_CERT_PATH.'/cert.lib.php');
?>