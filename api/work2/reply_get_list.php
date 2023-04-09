<?php
$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);
$comment_no = pave_input_sanitize($comment_no);
$page = pave_input_sanitize($page);

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
->set_comment_parent_no($comment_no);
$comment_list = $comment_obj->set_comment_page($page)->get_comment_list();


$return = array(
    "list" => $comment_list,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/reply_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));

?>