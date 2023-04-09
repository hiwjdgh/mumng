<?php
if(!$is_mobile){
    url_move(get_url(PAVE_URL));
}

//헤더 불러오기
get_header("알림");

//컨텐츠 불러오기
$form_theme_path = $pave_theme["thm_path"]."/notify.view.php";
if(is_file($form_theme_path) && file_exists($form_theme_path)){
    include_once($form_theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/user/notify.view.php");
}

//푸터 불러오기
get_footer();
?>