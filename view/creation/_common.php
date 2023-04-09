<?php
define("__CREATION__", true);
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("creation");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));


if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}


$creation_config = $config_obj->get_creation_config();

//창작 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_CREATION_URL, "js/creation.lib.js"));
$pave_html->add_css(get_url(PAVE_LIB_CREATION_URL, "css/creation.lib.min.css"));
$pave_html->add_css(get_url(PAVE_LIB_CREATION_URL, "css/style.min.css"));
?>