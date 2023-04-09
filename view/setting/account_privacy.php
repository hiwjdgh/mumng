<?php
$setting_title = "개인정보 설정";

//헤더 불러오기
get_header("개인정보 - 계정");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/account_privacy_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/setting/account_privacy_form.view.php");
}

//푸터 불러오기
get_footer();
?>