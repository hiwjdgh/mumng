<?php
if(!$pave_user["user_commerce"]){
    url_move(get_url(PAVE_COMMERCE_URL, "home"));
}


//헤더 불러오기
get_header("정보 - 커머스");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/profile.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/commerce/profile.view.php");
}

//푸터 불러오기
get_footer();
?>
