<?php
//창작 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_CREATION_URL, "js/creation.lib.js"));
$pave_html->add_css(get_url(PAVE_LIB_CREATION_URL, "css/creation.lib.min.css"));

$creation_state = pave_input_sanitize($request[3]);
// 상태별 갯수 가져오기
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT creation_state, COUNT(*) AS cnt FROM pave_creation")
->set_sql_where("user_no = '{$pave_user["user_no"]}'")
->set_sql_group("GROUP BY creation_state");

$result = pave_query($obj->generate_sql());
$creation_state_list = array();
for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
    $creation_state_list[$row["creation_state"]] = $row["cnt"];
}
//창작 의뢰 가져오기
$creation_obj = new Creation();

$creation_obj->set_user_no($pave_user["user_no"]);
if($creation_state != "all"){
    $creation_obj->set_creation_state($creation_state);
}
$creation_list = $creation_obj->get_creation_list();


//헤더 불러오기
get_header();

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/creation.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/user/creation.view.php");
}
//푸터 불러오기
get_footer();
?>