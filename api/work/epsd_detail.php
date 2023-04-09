<?php
$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);

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
    //함께한 작가 이거나 대표 작가인 경우
    if($pave_user["user_id"] == $work["work_user"]["user_id"] || 
    (pave_is_array($work["work_with_user"]) && in_array($pave_user["user_id"], array_column($work["work_with_user"], "user_id")))){
        $epsd_obj->set_epsd_state(array("reserve", "success"));
    }else{
        $epsd_obj->set_epsd_state(array("success"));
    }
}
$epsd_obj->set_epsd_cate(array("epsd", "notice"));
$epsd = $epsd_obj->get_epsd($epsd_id);

if(!$epsd["epsd_id"]){
    die(return_json(null, "200", "회차를 찾을 수 없습니다."));
}

//구매 필요 검사
$pay_obj = new Pay();
if($pay_obj->is_pay_need($work, $epsd)){
    die(return_json(null, "200", "회차 구매후 이용가능합니다.", $work["work_url"]));
}


$return = array(
    "work" => $work,
    "epsd" => $epsd,
);

$epsd_obj->add_epsd_hit($epsd["epsd_id"]);

ob_start();
$theme_path = $pave_theme["thm_path"]."/epsd_detail.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();


die(return_json($return));
?>