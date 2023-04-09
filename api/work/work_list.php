<?php
$work_user_id = pave_input_sanitize($work_user_id);
$work_day = pave_input_sanitize($work_day);
$work_state = pave_input_sanitize($work_state);
$work_age = pave_input_sanitize($work_age);
$work_genre = pave_input_sanitize($work_genre);
$work_type = pave_input_sanitize($work_type);
$work_page = pave_input_sanitize($work_page)?:1;


$work_obj = new W();
$work_obj->set_work_grp_id("webtoon");
$work_obj->set_work_user_id($work_user_id);
$work_obj->set_work_display(1);
$work_obj->set_work_epsd_cnt(0);
$work_obj->set_work_day($work_day);
$work_obj->set_work_type($work_type);
$work_obj->set_work_state(pave_explode($work_state, ","));
$work_obj->set_work_genre($work_genre);
$work_obj->set_work_order("update");
$work_obj->set_work_age(pave_explode($work_age, ","));
$work_obj->set_work_page($work_page);

$work_list = $work_obj->get_work_list();

$return = array(
    "list" => $work_list,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/webtoon_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>