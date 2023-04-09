<?php
$pave_theme = get_theme("user");

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

$work_obj = new W();
$work_obj->set_work_user_id($pave_user["user_id"]);
$work_obj->set_work_display(1);
$work_obj->set_work_epsd_cnt(0);
$work_obj->set_work_state(array("publish", "end", "stop"));
$work_obj->set_work_order("update");
$work_obj->set_work_age(array("전체", "12세", "15세"));
$work_obj->set_work_page(0);



$list = $work_obj->get_work_list();

$theme_path = $pave_theme["thm_path"]."/modal/user_major.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>