<?php
$work_id = pave_input_sanitize($work_id);


$work_obj = new W();
$work = $work_obj->get_work($work_id);

if(!$work["work_id"]){
    die(return_json(null, "200", "작품을 찾을 수 없습니다."));
}

$return["work"] = $work;

ob_start();
$theme_path = $pave_theme["thm_path"]."/work_detail.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>