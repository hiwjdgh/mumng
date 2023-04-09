<?php
$pave_theme = get_theme("account");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

$user_config = $config_obj->get_user_config();
$cert_config = $config_obj->get_cert_config();

//본인인증 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_CERT_URL, "js/cert.lib.js"));
?>