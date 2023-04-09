<?php
$sql_obj = new Objects();
$sql_obj->set_sql_common("SELECT user.*, CONCAT(user.user_field, ',', user.user_genre) AS user_full_hashtag FROM pave_user AS user");
$sql_obj->set_sql_where("WHERE user_id = '{$user_id}'");
$sql_obj->generate_sql();
$user = pave_fetch($sql_obj->get_sql());

if($user["user_id"]){
    $action = "update";
    $submit = "수정";
    
    if($user["user_temporary_state"]){
        $adm_title = "{$user["user_nick"]}(가계정)님 정보";
    }else{
        $adm_title = "{$user["user_nick"]}님 정보";
    }
    $user["user_field_list"] = pave_explode($user["user_field"], ",");
    $user["user_genre_list"] = pave_explode($user["user_genre"], ",");
    $user["user_birth_list"] = pave_explode($user["user_birth_date"], "-");

    //회원 페이지 링크
    $user["user_page_url"] = get_url(PAVE_PAGE_URL, "page", "user_code={$user["user_code"]}");

    //미성년자 여부
    if(!$user["user_adult_cert_state"]){
        $user["user_kid"] = 1;
    }

    //보호자 데이터
    if($user["user_rel"]){
        $user["user_rel"] = json_decode($user["user_rel"], true);
    }

}else{
    $action = "create";
    $submit = "추가";
    $adm_title = "가계정 추가";
    $user["user_code"] = get_unique(10);
    $user["user_term_agree_state"] = 1;
    $user["user_info_agree_state"] = 1;
    $user["user_event_agree_state"] = 0;
}

//헤더 불러오기
get_header("회원관리 - 관리자");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/user_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/adm/user_form.view.php");
}

//푸터 불러오기
get_footer();
?>