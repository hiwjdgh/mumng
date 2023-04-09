<?php
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("legal");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}
?>