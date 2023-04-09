<?php
$pave_theme = get_theme("upload");

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

$theme_path = $pave_theme["thm_path"]."/modal/upload_work_guide.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>