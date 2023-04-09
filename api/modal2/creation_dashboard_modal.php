<?php
$pave_theme = get_theme("creation");

if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);
$creation_no = $data["creation_no"];

//창작의뢰 가져오기
$creation_obj = new Creation();
$creation = $creation_obj
->set_creation_no($creation_no)
->set_user_no($pave_user["user_no"])
->get_creation();

if($creation["creation_no"] != $creation_no || !$creation["is_own"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

//의뢰 신청자 가져오기
$request_list = $creation_obj->get_creation_request_list($creation);

//신청자의 참가한 의뢰수 가져오기
foreach ((array)$request_list as $i => $request) {
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_common("SELECT COUNT(*) AS cnt FROM pave_creation_request")
    ->set_sql_where("creation_request_state = 'complete'")
    ->set_sql_where("user_no = '{$request["request_user"]["user_no"]}'");
    $row = pave_fetch($obj->generate_sql());
    $request_list[$i]["request_user"]["request_cnt"] = $row["cnt"];
}

$theme_path = $pave_theme["thm_path"]."/modal/creation_dashboard.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>