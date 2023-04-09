<?php
$page = pave_input_sanitize($page)?:1;

$subscribe_obj = new Subscribe();
$work_list = $subscribe_obj->set_user_no($pave_user["user_no"])->set_subscribe_page($page)->get_subscribe_list();
$work_list_cnt = $subscribe_obj->get_subscribe_list_cnt();
$return = array(
    "list" => $work_list,
    "list_cnt" => $work_list_cnt,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/subscribe_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>