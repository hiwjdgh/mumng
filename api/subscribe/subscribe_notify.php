<?php
$subscribe_no = pave_input_sanitize($subscribe_no);

$subscribe_obj = new Subscribe();
$subscribe = $subscribe_obj->set_user_no($pave_user["user_no"])->set_subscribe_no($subscribe_no)->get_subscribe();


if(!$subscribe["subscribe_no"]){
    die(return_json(null, "fail", "구독 작품을 찾을 수 없습니다."));
}

$update = array(
    "subscribe_notify" => !$subscribe["subscribe_notify"]
);
pave_update("pave_subscribe", $update, "subscribe_no = '{$subscribe["subscribe_no"]}'");
die(return_json(null, "success"));
?>