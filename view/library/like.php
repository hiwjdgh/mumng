<?php
//헤더 불러오기
get_header("좋아요 - 내서재");

//컨텐츠 불러오기
$form_theme_path = $pave_theme["thm_path"]."/like_list.view.php";
if(is_file($form_theme_path) && file_exists($form_theme_path)){
    include_once($form_theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/library/like_list.view.php");
}

//푸터 불러오기
get_footer();
?>
