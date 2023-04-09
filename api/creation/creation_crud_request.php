<?php
if(get_session("csrf_token") != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

$creation_no                 = pave_input_sanitize($creation_no);
$creation_request_exp        = pave_input_sanitize($creation_request_exp);

if(!$pave_user["user_commerce_state"]){
    die(return_json(null, "fail", "커머스 작가 등록 후 진행해주세요.", get_url(PAVE_COMMERCE_URL, "home")));
}

$creation_obj = new Creation();
$creation = $creation_obj
->set_creation_no($creation_no)
->set_creation_state("recruit")
->get_creation();

if($creation["creation_no"] != $creation_no){
    die(return_json(null, "fail", "해당 의뢰를 찾을 수 없습니다."));
}

$sight_obj = new Sight();
$sight_list_count = $sight_obj->set_user_no($pave_user["user_no"])
->set_sight_display(1)
->get_sight_list_count();

if($sight_list_count < 1){
    die(return_json(null, "fail", "의뢰 신청은 공개된 창작물 1개 이상 등록 후 이용가능합니다.\n창작물을 등록하시겠습니까?", get_url(PAVE_SIGHT_URL, "list")));
}

$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT * FROM pave_creation_request")
->set_sql_where("creation_no = '{$creation["creation_no"]}'")
->set_sql_where("user_no = '{$pave_user["user_no"]}'");

$already_request = pave_fetch($obj->generate_sql());

if($already_request["creation_request_no"]){
    die(return_json(null, "fail", "이미 신청한 의뢰입니다."));
}

$creation_request = array(
    "creation_no"                   => $creation["creation_no"],
    "user_no"                       => $pave_user["user_no"],
    "creation_request_exp"          => $creation_request_exp,
    "creation_request_insert_dt"    => PAVE_TIME_YMDHIS,
    "creation_request_insert_ip"    => PAVE_USER_IP
);

$result = pave_insert("pave_creation_request", $creation_request);

if(!$result){
    die(return_json(null," fail", "신청에 실패했습니다."));
}


die(return_json(null, "success"));
?>