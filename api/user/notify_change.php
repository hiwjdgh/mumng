<?php
$key = pave_input_sanitize($key);
$value = pave_input_sanitize($value);

$update = array(
    $key => $value
);

$result = pave_update("pave_user_notify", $update, "user_no = '{$pave_user["user_no"]}'");

if(!$result){
    die(return_json(null, "fail", "알림변경에 실패했습니다."));
}

die(return_json(null, "success"));
?>
