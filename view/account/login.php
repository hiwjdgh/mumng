<?php
if($is_user){
    url_move(PAVE_URL);
}
//헤더 불러오기
get_header("로그인");

//컨텐츠 불러오기
$user_theme_path = $pave_theme["thm_path"]."/login.view.php";
if(is_file($user_theme_path) && file_exists($user_theme_path)){
    include_once($user_theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/account/login.view.php");
}

//푸터 불러오기
get_footer();
?>