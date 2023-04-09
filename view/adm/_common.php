<?php
$pave_theme = get_theme("adm");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$is_admin){
    url_move(get_url(PAVE_URL));
}

/* if($pave_config["pave_ip"] != PAVE_USER_IP){
    url_move(get_url(PAVE_URL));
} */
?>