<?php
$search_keyword        = pave_input_sanitize($search_keyword);

$guide_obj->set_guide_keyword($search_keyword);
$guide_obj->set_guide_bo_display(1);
$guide_obj->set_guide_page(0);
$guide_bd_list = $guide_obj->get_guide_bd_list();

$guide_title = "가이드 검색";
//헤더 불러오기
get_header("{$search_keyword} - 가이드");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/guide_search.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/guide/guide_search.view.php");
}

//푸터 불러오기
get_footer();
?>