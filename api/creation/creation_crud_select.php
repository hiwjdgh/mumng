<?php
$creation_request_no                  = pave_input_sanitize($creation_request_no);

// 의뢰 신청 가져오기
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT request.* FROM pave_creation_request AS request")
->set_sql_where("request.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("request.creation_no = '{$creation_request_no}'");

$creation_request = pave_fetch($obj->generate_sql());



$request_list = array();
$result = pave_query($obj->generate_sql());
for ($i=0; $row = pave_fetch_assoc($result); $i++) {
    $user_obj = new User();
    
    $row["request_user"] = $user_obj->set_user_no($row["user_no"])->get_user();
    $request_list[] = $row;
}


?>