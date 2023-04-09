<?php
$search_keyword        = pave_input_sanitize($search_keyword);

$help_obj->set_help_keyword($search_keyword);
$help_obj->set_help_bo_display(1);
$help_obj->set_help_page(0);
$help_bd_list = $help_obj->get_help_bd_list();

$help_title = "도움말 검색";
//헤더 불러오기
get_header("{$search_keyword} - 도움말");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/help_search.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/help/help_search.view.php");
}

//푸터 불러오기
get_footer();
?>