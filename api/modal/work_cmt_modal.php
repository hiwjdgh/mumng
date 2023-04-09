<?php
$pave_theme = get_theme("work");

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

$work_id = $data["work_id"];
$epsd_id = $data["epsd_id"];

$work_obj = new W();
$work = $work_obj->get_work($work_id);

if(!$work["work_id"]){
    die(return_json(null, "200", "작품을 찾을 수 없습니다."));
}

$theme_path = $pave_theme["thm_path"]."/modal/work_cmt.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>