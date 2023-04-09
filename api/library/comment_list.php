<?php
$page = pave_input_sanitize($page)?:1;
$cmt_type = pave_input_sanitize($cmt_type);

$comment_obj = new Comment();
$comment_obj->set_user_no($pave_user["user_no"])
->set_comment_parent_no(0)
->set_comment_page($page);
if($cmt_type == "best"){
    $comment_obj->set_comment_best(true);
}
$comment_list = $comment_obj->get_comment_list();
$comment_list_cnt = $comment_obj->get_comment_list_cnt();




$return = array(
    "list" => $comment_list,
    "list_cnt" => $comment_list_cnt,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/comment_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>