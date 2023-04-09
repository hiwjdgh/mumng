<?php
$creation_no = pave_input_sanitize($request[2]);

if(!$creation_no){
    alert("창작 의뢰를 찾을 수 없습니다.");
}

$creation_obj = new Creation();

//창작 의뢰 가져오기
$creation = $creation_obj
->set_creation_state(array("recruit", "ongoing", "complete"))
->set_creation_no($creation_no)
->get_creation();

if(!$creation["creation_no"]){
    alert("창작 의뢰를 찾을 수 없습니다.");
}

//의뢰 신청서 가져오기
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT * FROM pave_creation_request")
->set_sql_where("creation_no = '{$creation["creation_no"]}'")
->set_sql_where("user_no = '{$pave_user["user_no"]}'");

$already_request = pave_fetch($obj->generate_sql());

//헤더 불러오기
get_header("커미션");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/creation_detail.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/creation/creation_detail.view.php");
}

//푸터 불러오기
get_footer();
?>