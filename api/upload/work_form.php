<?php
$action = pave_input_sanitize($action);
$work_id = pave_input_sanitize($work_id);

$work_config = $config_obj->get_work_config("webtoon");
$work_img_config = $config_obj->get_file_config("work_img");


if($action == "create"){
    $work_form_title = "작품등록";
    $work["work_display"] = "1";
    $work["work_time"] = "23";
    $work["work_free"] = "1";
    $work["work_age"] = "전체";
    $work["work_genre_list"] = array();
    $work["work_hashtag_list"] = array();
    $work["work_with_user"] = array();
    $work["work_preview2_exp"] = "0";
    $work["work_keep2_exp"] = "0";
    $work["work_end2_exp"] = "0";
    $work["work_preview_exp"] = "0";
    $work["work_rent_exp"] = "0";
    $work["work_keep_exp"] = "0";
    $work["work_end_exp"] = "0";
}else if($action == "update"){
    $work_form_title = "작품편집";
    $work_obj = new Work();
    $work = $work_obj->set_user_no($pave_user["user_no"])->set_work_id($work_id)->get_work();
    
    if(!$work["work_id"]){
        die(return_json(null, "fail", "비정상적인 접근입니다."));
    }
    if(!$work["is_own"]){
        die(return_json(null, "fail", "비정상적인 접근입니다."));
    }
}else{
    die(return_json(null, "fail", "잘못된 요청입니다."));
}

$theme_path = $pave_theme["thm_path"]."/work_form.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>