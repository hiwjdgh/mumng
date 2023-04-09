<?php
$work_obj = new W();
$work_obj->set_work_user_id($pave_user["user_id"]);
$work_obj->set_work_order("update");
$work_obj->set_work_page(0);

$work_list = $work_obj->get_work_list();

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/work_list.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/upload/work_list.view.php");
}

?>