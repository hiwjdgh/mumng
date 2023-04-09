<?php
$work_id = pave_input_sanitize($request[3]);

$work_obj = new W();
$work_obj->set_work_user_id($pave_user["user_id"]);
$work_obj->set_work_display(null);
$work_obj->set_work_upload_cnt(null);
$work_obj->set_work_order("update");
$work_obj->set_work_page(0);

$detail = $work_obj->get_work($work_id);

$epsd_obj = new Epsds();
$epsd_obj->set_work_id($detail["work_id"]);
$epsd_obj->set_epsd_page(0);
$epsd_list = $epsd_obj->get_epsd_list();


//헤더 불러오기
get_header("작품상세 - 업로드");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/work_detail.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/upload/work_detail.view.php");
}

//푸터 불러오기
get_footer();
?>