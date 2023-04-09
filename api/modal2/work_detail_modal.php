<?php
$pave_theme = get_theme("work");


$data = json_decode(stripslashes($data), true);

$work_id = pave_input_sanitize($data["work_id"]);
$page = pave_input_sanitize($data["page"]);


$work_obj = new Work();
$work = $work_obj->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)->get_work();

$epsd_obj = new Epsd();
$epsd_obj->set_work_id($work["work_id"])
->set_epsd_cate(array("epsd", "notice"));
if($work["work_user"]["user_commerce"]){
    $epsd_obj->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj->set_epsd_state("success");
}
$epsd_list = $epsd_obj->set_epsd_page($page)->get_epsd_list();
$epsd_list_cnt = $epsd_obj->get_epsd_list_cnt();

$epsd_pagination = Objects2::get_pagination($page, $epsd_list_cnt);

ob_start();
$theme_path = $pave_theme["thm_path"]."/modal/work_detail.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>