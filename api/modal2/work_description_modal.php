<?php
$pave_theme = get_theme("work");

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

$work_id = $data["work_id"];

$work_obj = new Work();
$work = $work_obj->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)->get_work();


$theme_path = $pave_theme["thm_path"]."/modal/work_description.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>