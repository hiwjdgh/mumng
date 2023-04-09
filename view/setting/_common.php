<?php
$pave_theme = get_theme("setting");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

$user_config = $config_obj->get_user_config();
$cert_config = $config_obj->get_cert_config();

if(!$is_user){
    url_move(get_url(PAVE_ACCOUNT_URL, "login"));
}
?>