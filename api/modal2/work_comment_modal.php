<?php
$pave_theme = get_theme("work");

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

$work_id = $data["work_id"];
$epsd_id = $data["epsd_id"];

$work_obj = new Work();
$work = $work_obj->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)->get_work();

if(!$work["work_id"]){
    die(return_json(null, "fail", "의견을 찾을 수 없습니다."));
}

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
if(!$epsd["epsd_id"]){
    die(return_json(null, "fail", "의견을 찾을 수 없습니다."));
}

$comment_obj = new Comment();
$comment_obj->set_work_id($work["work_id"])
->set_epsd_id($epsd["epsd_id"])
->set_comment_display(1)
->set_comment_parent_no(0);
if($type == "best"){
    $comment_obj->set_comment_best(true);
}
$comment_list = $comment_obj->set_comment_page($page)->get_comment_list();

$theme_path = $pave_theme["thm_path"]."/modal/work_comment.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>