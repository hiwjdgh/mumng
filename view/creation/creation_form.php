<?php
$action = pave_input_sanitize($action);
$creation_no = pave_input_sanitize($creation_no);

$creation_config = $config_obj->get_creation_config();

if($action == "create"){
    $creation_form_title = "창작 의뢰 등록";
    $creation_submit = "등록";
    $creation["creation_field"] = "commission";
    $creation["creation_img_use"] = "1";
    $creation["creation_exp"] = "1000";
    $creation["creation_exp_request"] = 0;
    $creation["creation_ratio"] = "SD";
    $creation["creation_size"] = "두상";
    $creation["creation_background"] = "0";
    $creation["creation_accessory"] = "0";
    $creation["creation_adult"] = "0";

    $creation_obj = new Creation();
    $tmp_creation = $creation_obj
    ->set_user_no($pave_user["user_no"])
    ->set_creation_state("ready")
    ->get_creation();

}else if($action == "update"){
    if(!$creation_no){
        alert("창작 의뢰를 찾을 수 없습니다.");
    }
    $creation_form_title = "창작 의뢰 수정";
    $creation_submit = "수정";
    $creation_obj = new Creation();
    $creation = $creation_obj
    ->set_creation_no($creation_no)
    ->set_user_no($pave_user["user_no"])
    ->get_creation();

    if($creation["creation_no"] != $creation_no || $creation["user_no"] != $pave_user["user_no"]){
        alert("비정상적인 접근입니다.", get_url(PAVE_CREATION_URL, "list"));
    }
}else{
    alert("잘못된 요청입니다.", get_url(PAVE_CREATION_URL, "list"));
}

//헤더 불러오기
get_header("커미션");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/creation_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/creation/creation_form.view.php");
}

//푸터 불러오기
get_footer();
?>