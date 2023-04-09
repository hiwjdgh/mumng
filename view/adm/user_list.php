<?php
$search_field = pave_input_sanitize($search_field)?:"user_id";
$page = pave_input_sanitize($page)?:1;
$list_cnt = 10;
$page_from = ($page - 1) * $list_cnt;
$page_to = $list_cnt;

$sql_obj = new Objects();
$sql_obj->set_sql_common("SELECT user.*, CONCAT(user.user_field, ',', user.user_genre) AS user_full_hashtag FROM pave_user AS user");
$sql_obj->set_sql_where("WHERE 1=1");

if($search_field == "user_id" && $search_keyword != ""){
    $sql_obj->set_sql_order("ORDER BY user.user_leave_state, user.user_id LIKE '{$search_keyword}%' DESC,ifnull(nullif(instr(user.user_id, ' {$search_keyword}'), 0), 99999), ifnull(nullif(instr(user.user_id, '{$search_keyword}'), 0), 99999), user.user_id, user.user_insert_dt DESC");
}else if($search_field == "user_nick" && $search_keyword != ""){
    $sql_obj->set_sql_order("ORDER BY user.user_leave_state, user.user_nick LIKE '{$search_keyword}%' DESC,ifnull(nullif(instr(user.user_nick, ' {$search_keyword}'), 0), 99999), ifnull(nullif(instr(user.user_nick, '{$search_keyword}'), 0), 99999), user.user_nick, user.user_insert_dt DESC");
}else{
    $sql_obj->set_sql_order("ORDER BY user.user_leave_state, user.user_insert_dt DESC");
}
$sql_obj->set_sql_limit("LIMIT {$page_from}, {$page_to}");
$sql_obj->generate_sql();
$result = pave_query($sql_obj->get_sql());
$user_list = array();
for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
    //회원 페이지 링크
    $row["user_page_url"] = get_url(PAVE_PAGE_URL, "page", "user_code={$row["user_code"]}");

    //text
    switch ($row["user_sex"]) {
        case "m":
            $row["user_sex_text"] = "남";
            break;
        case "f":
            $row["user_sex_text"] = "여";
            break;
        case "n":
            $row["user_sex_text"] = "해당없음";
            break;
        case "a":
            $row["user_sex_text"] = "선택안함";
            break;
    } 

    $user_list[] = $row;
}
// 총 회원수
$sql_obj->generate_sql_init();
$sql_obj->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_user AS user");
$sql_obj->generate_cnt_sql();
$total_user_list_cnt = pave_fetch($sql_obj->get_sql_cnt())["cnt"];

// 일반 회원수
$sql_obj->generate_sql_init();
$sql_obj->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_user AS user");
$sql_obj->set_sql_cnt_where("WHERE user_commerce = '0'");
$sql_obj->set_sql_cnt_where("user_temporary_state = '0'");
$sql_obj->set_sql_cnt_where("user_leave_state = '0'");
$sql_obj->generate_cnt_sql();
$normal_user_list_cnt = pave_fetch($sql_obj->get_sql_cnt())["cnt"];

// 가계정 회원수
$sql_obj->generate_sql_init();
$sql_obj->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_user AS user");
$sql_obj->set_sql_cnt_where("WHERE user_temporary_state = '1'");
$sql_obj->set_sql_cnt_where("user_leave_state = '0'");
$sql_obj->generate_cnt_sql();
$temp_user_list_cnt = pave_fetch($sql_obj->get_sql_cnt())["cnt"];

// 커머스 회원수
$sql_obj->generate_sql_init();
$sql_obj->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_user AS user");
$sql_obj->set_sql_cnt_where("WHERE user_commerce = '1'");
$sql_obj->set_sql_cnt_where("user_leave_state = '0'");
$sql_obj->generate_cnt_sql();
$commerce_user_list_cnt = pave_fetch($sql_obj->get_sql_cnt())["cnt"];

// 탈퇴 회원수
$sql_obj->generate_sql_init();
$sql_obj->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_user AS user");
$sql_obj->set_sql_cnt_where("WHERE user_leave_state = '1'");
$sql_obj->generate_cnt_sql();
$leave_user_list_cnt = pave_fetch($sql_obj->get_sql_cnt())["cnt"];

// 차단 회원수
$sql_obj->generate_sql_init();
$sql_obj->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_user AS user");
$sql_obj->set_sql_cnt_where("WHERE user_block_state = '1'");
$sql_obj->generate_cnt_sql();
$block_user_list_cnt = pave_fetch($sql_obj->get_sql_cnt())["cnt"];

$pagination = $sql_obj->get_pagination($page, $total_user_list_cnt, $list_cnt);

$adm_title = "회원내역";
//헤더 불러오기
get_header("회원관리 - 관리자");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/user_list.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/adm/user_list.view.php");
}

//푸터 불러오기
get_footer();
?>