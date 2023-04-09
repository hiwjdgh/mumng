<?php
include_once(PAVE_PAGE_PATH."/_common.php");
$follow_obj = new Follows();
$page_user_follow = array(
    "following_cnt" => $follow_obj->set_user_no($page_user["user_no"])->set_follow_page(0)->get_following_list_cnt(),
    "follower_cnt" => $follow_obj->set_user_no($page_user["user_no"])->set_follow_page(0)->get_follower_list_cnt()
);
$page_work_total = $work_obj->get_page_work_total($page_user);

if($page_user["user_major"]){
    $page_user_major = $work_obj->set_work_id($page_user["user_major"])->set_work_display(1)->set_work_epsd_cnt(0)->get_work();
}else{
    $page_user_major = array();
}

$pave_meta["title2"] = $page_user["user_nick"];
$pave_meta["url"] = $page_user["user_page_url"];
$pave_meta["description"] = $page_user["user_introduce"]?:$pave_meta["description"];
$pave_meta["img"] = $page_user["user_img"]?:$pave_meta["img"];
$pave_meta["keyword"] = $page_user["user_full_hashtag"]?:$pave_meta["keyword"];


//헤더 불러오기
get_header($page_user["user_nick"]);

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/page.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/page/page.view.php");
}
//푸터 불러오기
get_footer();
?>