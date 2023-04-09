<?php
$sight_no = pave_input_sanitize($sight_no);


$sight_obj = new Sight();
$sight = $sight_obj
->set_sight_no($sight_no)
->get_sight();

if($sight["sight_no"] != $sight_no){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}



ob_start();
$theme_path = $pave_theme["thm_path"]."/sight_detail.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>