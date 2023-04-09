<?php
$help_group_id        = pave_input_sanitize($request[2]);

$help_obj->set_help_group_id($help_group_id);
$help_obj->set_help_bo_display(1);
$help_obj->set_help_page(0);
$help_group = $help_obj->get_help_group_list()[0];

if(!$help_group["help_group_id"]){
    url_move(get_url(PAVE_HELP_URL, "home"));
}

$help_obj->set_help_group_id($help_group_id);
$help_obj->set_help_bo_display(1);
$help_obj->set_help_page(0);
$help_bo_list = $help_obj->get_help_bo_list();

$help_title = $help_group["help_group_name"];
//헤더 불러오기
get_header("{$help_title} - 도움말");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/help_group.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/help/help_group.view.php");
}

//푸터 불러오기
get_footer();
?>