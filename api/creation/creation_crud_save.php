<?php
if(get_session("csrf_token") != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}
$creation_no                    = pave_input_sanitize($creation_no);
$creation_field                 = pave_input_sanitize($creation_field);
$creation_name                  = pave_input_sanitize($creation_name);
$creation_content               = pave_input_sanitize($creation_content);
$creation_purpose               = pave_input_sanitize($creation_purpose);
$creation_exp                   = pave_input_sanitize($creation_exp);
$creation_end_date              = pave_input_sanitize($creation_end_date);
$creation_ratio                 = pave_input_sanitize($creation_ratio);
$creation_size                  = pave_input_sanitize($creation_size);
$creation_background            = pave_input_sanitize($creation_background);
$creation_background_content    = pave_input_sanitize($creation_background_content);
$creation_accessory             = pave_input_sanitize($creation_accessory);
$creation_accessory_content     = pave_input_sanitize($creation_accessory_content);


if($action == "create"){
    $creation = array(
        "creation_field"                => $creation_field,
        "user_no"                       => $pave_user["user_no"],
        "creation_name"                 => $creation_name,
        "creation_content"              => $creation_content,
        "creation_purpose"              => $creation_purpose,
        "creation_exp"                  => $creation_exp,
        "creation_end_dt"               => Converter::display_time($creation_end_date."+ 86399 seconds", "Y-m-d H:i:s"),
        "creation_ratio"                => $creation_ratio,
        "creation_size"                 => $creation_size,
        "creation_state"                => "ready",
        "creation_background"           => $creation_background,
        "creation_background_content"   => $creation_background_content,
        "creation_accessory"            => $creation_accessory,
        "creation_accessory_content"    => $creation_accessory_content,
        "creation_insert_dt"            => PAVE_TIME_YMDHIS,
        "creation_insert_ip"            => PAVE_USER_IP,
        "creation_update_dt"            => PAVE_TIME_YMDHIS,
        "creation_update_ip"            => PAVE_USER_IP
    );
    $result = pave_insert("pave_creation", $creation);
}else if($action == "update"){
    $creation_obj = new Creation();
    $creation = $creation_obj
    ->set_creation_no($creation_no)
    ->set_user_no($pave_user["user_no"])
    ->get_creation();

    if($creation["creation_no"] != $creation_no || !$creation["is_own"]){
        die(return_json(null, "fail", "비정상적인 접근입니다."));
    }

    $update = array(
        "creation_field"                => $creation_field,
        "creation_name"                 => $creation_name,
        "creation_content"              => $creation_content,
        "creation_purpose"              => $creation_purpose,
        "creation_exp"                  => $creation_exp,
        "creation_end_dt"               => Converter::display_time($creation_end_date."+ 86399 seconds", "Y-m-d H:i:s"),
        "creation_ratio"                => $creation_ratio,
        "creation_size"                 => $creation_size,
        "creation_state"                => "ready",
        "creation_background"           => $creation_background,
        "creation_background_content"   => $creation_background_content,
        "creation_accessory"            => $creation_accessory,
        "creation_accessory_content"    => $creation_accessory_content,
        "creation_update_dt"            => PAVE_TIME_YMDHIS,
        "creation_update_ip"            => PAVE_USER_IP
    );

    $result = pave_update("pave_creation", $update, "creation_no = '{$creation["creation_no"]}'");
}

die(return_json(null, "success"));
?>