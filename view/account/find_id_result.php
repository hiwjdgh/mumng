<?php
$find_user_no = get_session("find_user_no");

if(!$find_user_no){
    url_move(get_url(PAVE_ACCOUNT_URL, "login"));
}
set_session("find_user_no", "");

$user_obj = new User();
$user = $user_obj->set_user_no($find_user_no)
->set_user_leave(0)
->set_user_block(0)
->get_user();

//헤더 불러오기
get_header("아이디 찾기 결과");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/find_id_result.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/account/find_id_result.view.php");
}


//헤더 불러오기
get_footer();
?>