<?php
$help_obj = new Help();
$help_obj->set_help_bd_display(null);
$help_obj->set_help_page(null);


$help_bd_list = $help_obj->get_help_bd_list();
$help_bd_cnt = $help_obj->get_help_list_cnt();


//헤더 불러오기
get_header("도움말내용관리 - 관리자");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/help_bd_list.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/adm/help_bd_list.view.php");
}

//푸터 불러오기
get_footer();
?>