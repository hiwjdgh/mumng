<?php
$work_id = pave_input_sanitize($work_id);

$work_obj = new Work();
$work = $work_obj->set_user_no($pave_user["user_no"])->set_work_id($work_id)->get_work();

if(!$work["work_id"]){
    die(return_json(null, "fail", "해당 작품을 찾을 수 없습니다."));
}

$epsd_obj = new Epsd();
$epsd_list = $epsd_obj->set_work_id($work["work_id"])->set_epsd_page(null)->get_epsd_list();

$theme_path = $pave_theme["thm_path"]."/work_detail.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}

ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>