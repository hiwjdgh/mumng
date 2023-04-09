<?php
$page = pave_input_sanitize($page)?:1;

$like_obj = new Like();
$like_list = $like_obj->set_user_no($pave_user["user_no"])
->set_like_page($page)
->set_like_comment_no(0)
->get_like_epsd_list();
$like_list_cnt = $like_obj->get_like_epsd_list_cnt();

$return = array(
    "list" => $like_list,
    "list_cnt" => $like_list_cnt,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/like_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>