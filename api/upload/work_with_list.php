<?php
$keyword = pave_input_sanitize($keyword);
$search = pave_input_sanitize($search);
$page = pave_input_sanitize($page)?:1;
$work_with_list = pave_input_sanitize($work_with_list);
$work_with_list = pave_explode($work_with_list, ",");
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT user.user_no, user.user_img, user.user_nick, user.user_field, user.user_share FROM pave_user_follow AS follow")
->set_sql_common("LEFT JOIN pave_user AS user ON (follow.user_follow_to = user.user_no)")
->set_sql_where("follow.user_follow_from = '{$pave_user["user_no"]}'")
->set_sql_where("follow.user_follow_to IN (SELECT user_follow_from FROM pave_user_follow WHERE user_follow_to = '{$pave_user["user_no"]}')");
if($search && $keyword){
    $keyword_list = pave_explode($keyword, " ");
    $obj->set_sql_order("ORDER BY user.user_nick LIKE '{$keyword_list[0]}%' DESC,ifnull(nullif(instr(user.user_nick, ' {$keyword_list[0]}'), 0), 99999), ifnull(nullif(instr(user.user_nick, '{$keyword_list[0]}'), 0), 99999), user.user_nick");
}else{
    $obj->set_sql_order("ORDER BY user_follow_no DESC");
}
$from = ($page - 1) * 10;
$to = 10;
$obj->set_sql_limit("LIMIT {$from}, {$to}");

$user_list = array();
$result = pave_query($obj->generate_sql());
for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
    $row["user_page_url"] = get_url(PAVE_PAGE_URL, $row["user_share"]);
    $user_list[] = $row;
}

$return["list"] = $user_list;

$theme_path = $pave_theme["thm_path"]."/work_with_item.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>