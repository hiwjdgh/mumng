<?php
$action = pave_input_sanitize($action);
$creation_no = pave_input_sanitize($creation_no);
$page = pave_input_sanitize($page)?:1;
$type = pave_input_sanitize($type);

if($action == "create"){
    $creation_form_title = "창작물 등록";
    $creation_submit = "등록";
    $creation["creation_age"] = "전체";
    $creation["creation_display"] = "1";
    $creation["creation_img_use"] = "1";
    $creation["creation_grp_id"] = "webtoon";
    $creation["creation_name"] = "제목";
    $creation["creation_content"] = "";

    $creation_obj = new Creation();
    $tmp_creation = $creation_obj
    ->set_user_no($pave_user["user_no"])
    ->set_creation_state("ready")
    ->get_creation();

}else if($action == "update"){
    $creation_form_title = "창작물 수정";
    $creation_submit = "수정";
    $creation_obj = new Creation();
    $creation = $creation_obj
    ->set_creation_no($creation_no)
    ->set_user_no($pave_user["user_no"])
    ->get_creation();

    if($creation["creation_no"] != $creation_no || $creation["user_no"] != $pave_user["user_no"]){
        die(return_json(null, "fail", "비정상적인 접근입니다."));
    }

 
}else{
    die(return_json(null, "fail", "잘못된 요청입니다."));
}

$return["creation"] = $creation;

ob_start();
$theme_path = $pave_theme["thm_path"]."/creation_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>