<?php
$action = pave_input_sanitize($action);
$sight_no = pave_input_sanitize($sight_no);
$page = pave_input_sanitize($page)?:1;
$type = pave_input_sanitize($type);

$sight_file_config = $config_obj->get_file_config("sight_img");

if($action == "create"){
    $sight_form_title = "창작물 등록";
    $sight_submit = "등록";
    $sight["sight_age"] = "전체";
    $sight["sight_display"] = "1";
    $sight["sight_img_use"] = "1";
    $sight["sight_grp_id"] = "webtoon";
    $sight["sight_name"] = "제목";
    $sight_config = $config_obj->get_sight_config("webtoon");
    $sight["sight_content"] = "";

}else if($action == "update"){
    $sight_form_title = "창작물 수정";
    $sight_submit = "수정";
    $sight_obj = new Sight();
    $sight = $sight_obj
    ->set_sight_no($sight_no)
    ->set_user_no($pave_user["user_no"])
    ->get_sight();

    if($sight["sight_no"] != $sight_no || $sight["user_no"] != $pave_user["user_no"]){
        die(return_json(null, "fail", "비정상적인 접근입니다."));
    }

    $sight_config = $config_obj->get_sight_config($sight["sight_grp_id"]);
}else{
    die(return_json(null, "fail", "잘못된 요청입니다."));
}

$return["sight"] = $sight;

ob_start();
$theme_path = $pave_theme["thm_path"]."/sight_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>