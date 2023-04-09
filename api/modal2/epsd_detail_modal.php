<?php
$pave_theme = get_theme("work");


$data = json_decode(stripslashes($data), true);

$work_id = pave_input_sanitize($data["work_id"]);
$epsd_id = pave_input_sanitize($data["epsd_id"]);


$work_obj = new Work();
$work = $work_obj->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)->get_work();

$epsd_obj = new Epsd();
$epsd_obj->set_work_id($work["work_id"])
->set_epsd_id($epsd_id)
->set_epsd_cate(array("epsd", "notice"));
if($work["work_user"]["user_commerce"]){
    $epsd_obj->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj->set_epsd_state("success");
}

$epsd = $epsd_obj->get_epsd();

//다른 회차
$epsd_obj2 = new Epsd();
$epsd_obj2->set_work_id($work["work_id"])
->set_epsd_cate(array("epsd", "notice"));
if($work["work_user"]["user_commerce"]){
    $epsd_obj2->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj2->set_epsd_state("success");
}
$epsd_list = $epsd_obj2->get_epsd_list();

//조회수 증가
Epsd::add_hit($pave_user, $epsd);
ob_start();
$theme_path = $pave_theme["thm_path"]."/modal/epsd_detail.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>