<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

//성별 검사
if($msg = sanitize_reg_user_sex($user_sex, true)){
    die(return_json(null, "fail", $msg));
}

//동의 검사
if($msg = sanitize_reg_user_event_agree($user_event_agree, false)){
    die(return_json(null, "fail", $msg));
}

$update = array(
    "user_sex"                  => $user_sex,
    "user_event_agree_state"    => $user_event_agree,
    "user_update_dt"            => PAVE_TIME_YMDHIS,
    "user_update_ip"            => PAVE_USER_IP
);

$result = pave_update("pave_user", $update, "user_no = '{$pave_user["user_no"]}'");

if(!$result){
    die(return_json(null, "fail", "개인정보 수정에 실패 했습니다."));
}

if($pave_user["user_event_agree_state"] != $user_event_agree){
    //회원 이벤트 동의 등록
    $event = array(
        "user_agree_state"       => $user_event_agree,
        "user_agree_update_dt"   => PAVE_TIME_YMDHIS,
        "user_agree_update_ip"   => PAVE_USER_IP
    );
    pave_update("pave_user_agree", $event, "user_no = '{$pave_user["user_no"]}' AND user_agree_type = 'event'");
}


die(return_json(null, "success"));
?>