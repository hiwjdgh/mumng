<?php
$work_id = pave_input_sanitize($work_id);
$page = pave_input_sanitize($page);
$view = pave_input_sanitize($view);

$work_obj = new W();
$work = $work_obj->get_work($work_id);

if(!$work["work_id"]){
    die(return_json(null, "200", "작품을 찾을 수 없습니다."));
}

$epsd_obj = new Epsds();
$epsd_obj->set_work_id($work["work_id"]);
if($work["work_user"]["user_commerce"]){
    $epsd_obj->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj->set_epsd_state(array("success"));
}
$epsd_obj->set_epsd_cate(array("epsd", "notice"));
$epsd_obj->set_epsd_page($page);
$epsd_list = $epsd_obj->get_epsd_list();
$epsd_list_cnt = count($epsd_list);
$epsd_pagination = $epsd_obj->get_epsd_pagination();

$return = array(
    "list_cnt" => $epsd_list_cnt,
);

ob_start();
if($view == "work_detail"){
    $theme_path = $pave_theme["thm_path"]."/webtoon_epsd_box.view.php";
}else if($view == "epsd_detail"){
    $theme_path = $pave_theme["thm_path"]."/webtoon_epsd_box2.view.php";
}else{
    die(return_json(null, "200", "비정상적인 접근입니다."));
}

if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>