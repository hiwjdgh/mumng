<?php
$pave_theme = get_theme("user");

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

$work_obj = new Work();
$work_list = $work_obj->set_user_no($pave_user["user_no"])
->set_work_display(1)
->set_work_epsd_cnt(0)
->get_work_list();

$theme_path = $pave_theme["thm_path"]."/modal/user_major.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>