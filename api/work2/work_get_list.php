<?php
$user_no = pave_input_sanitize($user_no);
$work_day = pave_input_sanitize($work_day);
$work_state = pave_input_sanitize($work_state);
$work_age = pave_input_sanitize($work_age);
$work_genre = pave_input_sanitize($work_genre);
$work_type = pave_input_sanitize($work_type);
$page = pave_input_sanitize($page)?:1;


$work_obj = new Work();
$work_list = $work_obj
->set_work_day($work_day)
->set_work_type($work_type)
->set_work_state(pave_explode($work_state, ","))
->set_work_age(pave_explode($work_age, ","))
->set_work_genre($work_genre)
->set_user_no($user_no)
->set_work_display(1)
->set_work_epsd_cnt(0)
->set_work_page($page)
->get_work_list();

$return = array(
    "list" => $work_list,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/work_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>