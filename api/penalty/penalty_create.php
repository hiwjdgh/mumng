<?php
if(get_session("csrf_token") != $csrf){
    die(return_json(null, "200", "비정상적인 접근입니다."));
}

$penalty_cate = pave_input_sanitize($penalty_cate);
$penalty_target = pave_input_sanitize($penalty_target);
$penalty_reason = pave_input_sanitize($penalty_reason);
$penalty_reason_text = pave_input_sanitize($penalty_reason_text);


$create = array(
    "penalty_cate" => $penalty_cate,
    "penalty_target" => $penalty_target,
    "penalty_reason" => $penalty_reason,
    "penalty_reason_text" => $penalty_reason_text,
    "user_id" => $pave_user["user_id"],
    "penalty_insert_dt" => PAVE_TIME_YMDHIS,
    "penalty_insert_ip" => PAVE_USER_IP,

);

$result = pave_insert("pave_penalty", $create);

if(!$result){
    die(return_json(null, "200", "신고에 실패했습니다. 다시 시도해주세요."));
}

die(return_json());
?>