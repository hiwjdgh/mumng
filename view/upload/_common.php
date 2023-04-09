<?php
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("upload");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$is_user){
    url_move(get_url(PAVE_ACCOUNT_URL, "login"));
}

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

if($is_mobile){
    alert("연재는 PC에서만 가능합니다.", get_url(PAVE_URL));
}

/* $pave_html->add_js(get_url(PAVE_LIB_WORK_URL, "js/work2.lib.js"));
$pave_html->add_css(get_url(PAVE_LIB_WORK_URL, "css/work2.lib.min.css")); */

$work_config = $config_obj->get_work_config("webtoon");

//업로드 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_UPLOAD_URL, "js/upload.lib.js"));


//파일 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_FILE_URL, "js/file.lib.js"));


//스와이퍼 플러그인
$pave_html->add_css(get_url(PAVE_PLUGIN_SWIPER_URL, "swiper-bundle.min.css"));
$pave_html->add_css(get_url(PAVE_PLUGIN_SWIPER_URL, "swiper-custom.min.css"));
$pave_html->add_js(get_url(PAVE_PLUGIN_SWIPER_URL, "swiper-bundle.min.js"));
?>