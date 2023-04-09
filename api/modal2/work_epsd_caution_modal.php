<?php
$pave_theme = get_theme("work");



$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);


$work_id = pave_input_sanitize($data["work_id"]);
$epsd_id = pave_input_sanitize($data["epsd_id"]);


$theme_path = $pave_theme["thm_path"]."/modal/work_epsd_caution.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}

ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>