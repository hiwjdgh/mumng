<?php
$help_group_id = pave_input_sanitize($request[4]);


$help_obj = new Help();

$help_group = $help_obj->get_help_group($help_group_id);

if($help_group["help_group_id"]){
    $help_action = "update";
    $help_submit = "수정";
}else{
    $help_action = "create";
    $help_submit = "추가";
}


//헤더 불러오기
get_header("도움말그룹{$help_submit} - 관리자");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/help_group_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/adm/help_group_form.view.php");
}

//푸터 불러오기
get_footer();
?>