<?php
$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);
$page = pave_input_sanitize($page)?:1;
$type = pave_input_sanitize($type)?:"all";


$work_obj = new W();
$work = $work_obj->get_work($work_id);

if(!$work["work_id"]){
    die(return_json(null, "200", "작품이 존재하지않습니다."));
}

$epsd_obj = new Epsds();
$epsd_obj->set_work_id($work["work_id"]);
if($work["work_user"]["user_commerce"]){
    $epsd_obj->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj->set_epsd_state(array("success"));
}
$epsd_obj->set_epsd_cate(array("epsd", "notice"));
$epsd = $epsd_obj->get_epsd($epsd_id);

if(!$epsd["epsd_id"]){
    die(return_json(null, "200", "회차가 존재하지않습니다."));
}

$cmt_obj = new Cmts();
$cmt_obj->set_work_id($work["work_id"]);
$cmt_obj->set_epsd_id($epsd["epsd_id"]);

if($type == "best"){
    $cmt_obj->set_cmt_best(true);
}
$cmt_obj->set_cmt_parent_id(0);
$cmt_obj->set_cmt_page($page);
$cmt_list = $cmt_obj->get_cmt_list();

$return = array(
    "list" => $cmt_list,
    "list_cnt" => $epsd["epsd_cmt"]
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/cmt_list.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>