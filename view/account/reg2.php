<?php
if(!$is_user ||  (get_session("reg_user_no") != $pave_user["user_no"])){
   url_move(get_url(PAVE_URL));
}

//파일 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_FILE_URL, "js/file.lib.js"));

//크롭 플러그인
$pave_html->add_css(get_url(PAVE_PLUGIN_CROP_URL, "cropper.min.css"));
$pave_html->add_css(get_url(PAVE_PLUGIN_CROP_URL, "cropper-custom.css"));
$pave_html->add_js(get_url(PAVE_PLUGIN_CROP_URL, "cropper.min.js"));
$pave_html->add_js(get_url(PAVE_PLUGIN_CROP_URL, "jquery-cropper.min.js"));

$user_img_config = $config_obj->get_file_config("user_img");

//헤더 불러오기
get_header("추가정보");

//컨텐츠 불러오기
$form_theme_path = $pave_theme["thm_path"]."/reg2_form.view.php";
if(is_file($form_theme_path) && file_exists($form_theme_path)){
    include_once($form_theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/account/reg2_form.view.php");
}

//푸터 불러오기
get_footer();
?>