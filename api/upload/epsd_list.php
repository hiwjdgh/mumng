<?php
$work_id = pave_input_sanitize($work_id);

$work_obj = new W();
$work_obj->set_work_user_id($pave_user["user_id"]);
$work_obj->set_work_display(null);
$work_obj->set_work_upload_cnt(null);
$work_obj->set_work_order("update");
$work_obj->set_work_page(0);

$work = $work_obj->get_work($work_id);

$epsd_obj = new Epsds();
$epsd_obj->set_work_id($work["work_id"]);
$epsd_obj->set_epsd_page(0);
$epsd_list = $epsd_obj->get_epsd_list();

$return = array(
    "work" => $work,
    "epsd_list" => $epsd_list
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/epsd_list.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>