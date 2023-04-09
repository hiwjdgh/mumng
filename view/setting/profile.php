<?php
//파일 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_FILE_URL, "js/file.lib.js"));


//크롭 플러그인
$pave_html->add_css(get_url(PAVE_PLUGIN_CROP_URL, "cropper.min.css"));
$pave_html->add_css(get_url(PAVE_PLUGIN_CROP_URL, "cropper-custom.css"));
$pave_html->add_js(get_url(PAVE_PLUGIN_CROP_URL, "cropper.min.js"));
$pave_html->add_js(get_url(PAVE_PLUGIN_CROP_URL, "jquery-cropper.min.js"));

$user_img_config = $config_obj->get_file_config("user_img");

if($pave_user["user_major"]){
    $work_obj = new Work();
    $work = $work_obj->set_work_id($pave_user["user_major"])->get_work();
    $pave_user["user_major"] = $work;
}

$setting_title = "프로필";
//헤더 불러오기
get_header("프로필 - 설정");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/profile.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/setting/profile.view.php");
}

//푸터 불러오기
get_footer();
?>