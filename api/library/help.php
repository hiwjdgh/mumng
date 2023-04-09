<?php
$type = pave_input_sanitize($type);
$more_id = pave_input_sanitize($more_id);

if($type == "work"){
    $work_obj = new W();
    $more = $work_obj->get_work($more_id)["work_user"];
}else if($type == "epsd"){
    $epsd_obj = new Epsds();
    $return["s"] = 
    $more = $epsd_obj->get_epsd($more_id)["epsd_user"];
}else if($type == "cmt"){
    $cmt_obj = new Cmts();
    $more = $cmt_obj->get_cmt($more_id)["cmt_user"];
}

$return = array();

ob_start();
$theme_path = $pave_theme["thm_path"]."/help.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();
die(return_json($return));
?>