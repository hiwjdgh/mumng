<?php
$work_id = pave_input_sanitize($request[3]);

$work_obj = new W();
$work_obj->set_work_user_id($pave_user["user_id"]);
$work_obj->set_work_display(null);
$work_obj->set_work_upload_cnt(null);
$work_obj->set_work_order("update");
$work_obj->set_work_page(0);

$work = $work_obj->get_work($work_id);

$work_form_title = "작품등록";
if($work["work_id"]){
    $work_action = "u";
    $work_form_title = "작품편집";
}else{
    $work_action = "c";
    $work["work_display"] = "1";
    $work["work_time"] = "23";
    $work["work_free"] = "1";
    $work["work_age"] = "";
    $work["work_display"] = "1";
    $work["work_time"] = "23";
    $work["work_free"] = "1";
    $work["work_age"] = "";
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
}

//헤더 불러오기
get_header($work_form_title." - 업로드");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/work_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/upload/work_form.view.php");
}

//푸터 불러오기
get_footer();
?>