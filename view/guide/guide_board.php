<?php
$guide_group_id        = pave_input_sanitize($request[2]);
$guide_bo_id        = pave_input_sanitize($request[3]);

$guide_obj->set_guide_group_id($guide_group_id);
$guide_obj->set_guide_bo_id($guide_bo_id);
$guide_obj->set_guide_bd_display(1);
$guide_bd = $guide_obj->get_guide_bd_list()[0];


$guide_title = $guide_bd["guide_group_name"];
//헤더 불러오기
get_header("{$guide_title} - 가이드");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/guide_board.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/guide/guide_board.view.php");
}

//푸터 불러오기
get_footer();
?>