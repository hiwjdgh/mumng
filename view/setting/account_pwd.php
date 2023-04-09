<?php
$setting_title = "비밀번호 변경";

//헤더 불러오기
get_header("비밀번호 - 계정");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/account_pwd_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/setting/account_pwd_form.view.php");
}

//푸터 불러오기
get_footer();
?>