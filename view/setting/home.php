<?php
if(!$is_mobile){
    url_move(get_url(PAVE_SETTING_URL, "profile"));
}
$setting_title = "설정";
//헤더 불러오기
get_header("설정");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/home.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/setting/home.view.php");
}

//푸터 불러오기
get_footer();
?>