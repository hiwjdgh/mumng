<?php
include_once(PAVE_API_PATH."/search/_common.php");

$page = pave_input_sanitize($page)?:1;
$search_type = pave_input_sanitize($search_type);
$search_keyword = pave_input_sanitize($search_keyword);

if($search_type == "webtoon"){
    $work_obj = new Work();
    $search_list = $work_obj
    ->set_work_search("name")
    ->set_work_search_keyword($search_keyword)
    ->set_work_display(1)
    ->set_work_epsd_cnt(0)
    ->set_work_state(array('publish', 'end', 'stop'))
    ->set_work_age(array('전체', '12세', '15세'))
    ->set_work_page($page)
    ->get_work_list();
    $list_cnt = $work_obj->get_work_list_cnt();
}else if($search_type == "user"){
    $user_obj = new User();
    $search_list = $user_obj
    ->set_user_search(true)
    ->set_user_search_keyword($search_keyword)
    ->set_user_leave(0)
    ->set_user_block(0)
    ->set_user_page($page)
    ->get_user_list();
    $list_cnt = $user_obj->get_user_list_cnt();
}else if($search_type == "hashtag"){
    $hashtag_obj = new Hashtag();
    $search_list = $hashtag_obj
    ->set_hashtag_search(true)
    ->set_hashtag_search_keyword($search_keyword)
    ->set_hashtag_page($page)
    ->get_hashtag_list();

    $list_cnt = $hashtag_obj->get_hashtag_list_cnt();
}else if($search_type == "tags"){
    $work_obj = new Work();
    $search_list = $work_obj
    ->set_work_search("tag")
    ->set_work_search_keyword($search_keyword)
    ->set_work_display(1)
    ->set_work_epsd_cnt(0)
    ->set_work_state(array('publish', 'end', 'stop'))
    ->set_work_age(array('전체', '12세', '15세'))
    ->set_work_page($page)
    ->get_work_list();
    $list_cnt = $work_obj->get_work_list_cnt();

}else{
    die(return_json(null, "fail", "잘못된 요청입니다."));
}

$return = array(
    "list" => $search_list,
    "list_cnt" => $list_cnt
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/search_{$search_type}_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>