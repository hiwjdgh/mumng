<?php
define("__SIGHT__", true);
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("sight");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

//발견 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_SIGHT_URL, "js/sight.lib.js"));
$pave_html->add_css(get_url(PAVE_LIB_SIGHT_URL, "css/style.min.css"));

//파일 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_FILE_URL, "js/file.lib.js"));

//에디터 플러그인
$pave_html->add_js(get_url(PAVE_PLUGIN_EDITOR_URL, "smarteditor2/js/service/HuskyEZCreator.js"));
$pave_html->add_js(get_url(PAVE_PLUGIN_EDITOR_URL, "editor.js"));
?>