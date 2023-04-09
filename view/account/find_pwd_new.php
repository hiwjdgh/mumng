<?php
if(get_session("find_user_no") == ""){
    url_move(get_url(PAVE_ACCOUNT_URL, "login"));
}

//헤더 불러오기
get_header("비밀번호 찾기 결과");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/find_pwd_new_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/user/find_pwd_new_form.view.php");
}

//헤더 불러오기
get_footer();
?>