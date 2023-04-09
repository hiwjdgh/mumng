<?php
$pave_site = $config_obj->get_site("work");
$pave_theme = get_theme("work");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}
$work_config = $config_obj->get_work_config("webtoon");

//작품 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_WORK_URL, "js/work2.lib.js"));
if($is_mobile){
    $pave_html->add_css(get_url(PAVE_LIB_WORK_URL, "css/mobile/work2.lib.min.css"));
}else{
    $pave_html->add_css(get_url(PAVE_LIB_WORK_URL, "css/work2.lib.min.css"));
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