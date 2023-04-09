<?php
$pave_theme = get_theme("user");

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

$user_no = $data["user_no"];
$type = $data["type"];

$theme_path = $pave_theme["thm_path"]."/modal/user_follow.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>