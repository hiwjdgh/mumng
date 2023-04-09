<?php
$user_no = pave_input_sanitize($user_no);
$page = pave_input_sanitize($page)?:1;
$keyword = pave_input_sanitize($keyword);

$user = $user_obj->set_user_no($user_no)->set_user_leave(0)->set_user_block(0)->get_user();
if(!$user["user_id"]){
    die(return_json(null, "fail", "작가님을 찾을 수 없습니다."));
}

$follow_list = $follow_obj->set_user_no($user["user_no"])
->set_follow_page($page)
->set_follow_search(true)
->set_follow_search_keyword($keyword)
->get_following_list();
$follow_list_cnt = $follow_obj->get_following_list_cnt();

$return = array(
    "list" => $follow_list,
    "list_cnt" => $follow_list_cnt,
);

ob_start();
$theme_path = PAVE_LIB_FOLLOW_PATH."/theme/follow_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>