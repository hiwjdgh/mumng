<?php
$key = pave_input_sanitize($key);
$value = pave_input_sanitize($value);

if($value && !$pave_user["user_adult_cert_state"]){
    die(return_json(null, "fail", "미성년자는 성인컨텐츠를 볼 수 없습니다."));
}

if($value && !$pave_user["user_cp_cert_state"]){
    die(return_json(null, "fail", "본인인증이 필요합니다. 본인인증을 진행하시겠습니까?", get_url(PAVE_SETTING_URL, "account/cert")));
}

$update = array(
    $key => $value
);

$result = pave_update("pave_user", $update, "user_no = '{$pave_user["user_no"]}'");

if(!$result){
    die(return_json(null, "200", "게시물 설정 변경에 실패했습니다."));
}

die(return_json(null, "success"));
?>