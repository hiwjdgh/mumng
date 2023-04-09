<?php
$help_bd_id = pave_input_sanitize($request[4]);


$help_obj = new Help();
$help_obj->set_help_page(null);
$help_bo_list = $help_obj->get_help_bo_list();
$help_bo_cnt = $help_obj->get_help_list_cnt();
if($help_bo_cnt == 0){
    confirm("도움말 추가후 진행 가능합니다. 이동하시겠습니까?", get_url(PAVE_ADM_URL, "help/bo/form"), get_url(PAVE_ADM_URL, "help/bd/list"));
}


$help_bd = $help_obj->get_help_bd($help_bd_id);

if($help_bd["help_bd_id"]){
    $help_action = "update";
    $help_submit = "수정";
}else{
    $help_action = "create";
    $help_submit = "추가";
}


//헤더 불러오기
get_header("도움말그룹{$help_submit} - 관리자");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/help_bd_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/adm/help_bd_form.view.php");
}

//푸터 불러오기
get_footer();
?>