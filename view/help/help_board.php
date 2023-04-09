<?php
$help_group_id        = pave_input_sanitize($request[2]);
$help_bo_id        = pave_input_sanitize($request[3]);

$help_obj->set_help_group_id($help_group_id);
$help_obj->set_help_bo_id($help_bo_id);
$help_obj->set_help_bd_display(1);
$help_bd = $help_obj->get_help_bd_list()[0];


$help_title = $help_bd["help_bo_name"];
//헤더 불러오기
get_header("{$help_title} - 도움말");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/help_board.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/help/help_board.view.php");
}

//푸터 불러오기
get_footer();
?>