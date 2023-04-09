<?php
$work_id = pave_input_sanitize($request[2]);
$page = pave_input_sanitize($page)?:1;

$work_obj = new Work();
$work = $work_obj->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)->get_work();

if(!$work["work_id"]){
    alert("작품을 찾을 수 없습니다.");
}

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

//헤더 불러오기
get_header($work["work_name"]);
//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/work_detail.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/work/work_detail.view.php");
}
//푸터 불러오기
get_footer();
?>