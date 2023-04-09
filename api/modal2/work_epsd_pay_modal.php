<?php
$pave_theme = get_theme("work");

$data = json_decode(stripslashes($data), true);


$work_id = pave_input_sanitize($data["work_id"]);
$epsd_id = pave_input_sanitize($data["epsd_id"]);

$work_obj = new Work();
$work = $work_obj
->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)
->get_work();

if(!$work["work_id"]){
    die(return_json(null, "fail", "작품을 찾을 수 없습니다."));
}

$epsd_obj = new Epsd();
$epsd = $epsd_obj
->set_work_id($work["work_id"])
->set_epsd_id($epsd_id)
->get_epsd();


if(!$epsd["epsd_id"]){
    die(return_json(null, "fail", "회차를 찾을 수 없습니다."));
}


$theme_path = $pave_theme["thm_path"]."/modal/work_epsd_pay.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>