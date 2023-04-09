<?php
$pave_theme = get_theme("sight");

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

$sight_config = $config_obj->get_sight_config($data["sight_grp_id"]);
$sight_file_config = $config_obj->get_file_config("sight_img");
$action = "create";

$theme_path = $pave_theme["thm_path"]."/modal/sight_form.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>