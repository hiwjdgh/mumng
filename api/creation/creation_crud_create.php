<?php
if(get_session("csrf_token") != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

$creation_field                 = pave_input_sanitize($creation_field);
$creation_name                  = pave_input_sanitize($creation_name);
$creation_content           = pave_input_sanitize($creation_content);
$creation_purpose               = pave_input_sanitize($creation_purpose);
$creation_exp                   = pave_input_sanitize($creation_exp);
$creation_end_date              = pave_input_sanitize($creation_end_date);
$creation_ratio                 = pave_input_sanitize($creation_ratio);
$creation_size                  = pave_input_sanitize($creation_size);
$creation_background            = pave_input_sanitize($creation_background);
$creation_background_content    = pave_input_sanitize($creation_background_content);
$creation_accessory             = pave_input_sanitize($creation_accessory);
$creation_accessory_content     = pave_input_sanitize($creation_accessory_content);

$creation_config = $config_obj->get_creation_config();


//창작 필드 검사
if($msg = sanitize_creation_field($creation_field, true)){
    die(return_json(null, "fail", $msg));
}

//창작 제목 검사
if($msg = sanitize_creation_name($creation_name, true)){
    die(return_json(null, "fail", $msg));
}

//창작 내용 검사
if($msg = sanitize_creation_content($creation_content, true)){
    die(return_json(null, "fail", $msg));
}

//창작 사용용도 검사
if($msg = sanitize_creation_purpose($creation_purpose, true)){
    die(return_json(null, "fail", $msg));
}

//창작 EXP 검사
if($msg = sanitize_creation_exp($creation_exp, true)){
    die(return_json(null, "fail", $msg));
}

//창작 마감일 검사
if($msg = sanitize_creation_end_date($creation_end_date, true)){
    die(return_json(null, "fail", $msg));
}

//창작 데포르메 검사
if($msg = sanitize_creation_ratio($creation_ratio, true)){
    die(return_json(null, "fail", $msg));
}

//창작 사이즈 검사
if($msg = sanitize_creation_size($creation_size, true)){
    die(return_json(null, "fail", $msg));
}

//창작 배경화면 여부 검사
if($creation_background){
    if($msg = sanitize_creation_background_content($creation_background_content, true)){
        die(return_json(null, "fail", $msg));
    }
}else{
    $creation_background_content = "";
}

//창작 소품 여부 검사
if($creation_accessory){
    if($msg = sanitize_creation_accessory_content($creation_accessory_content, true)){
        die(return_json(null, "fail", $msg));
    }
}else{
    $creation_accessory_content = "";
}


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

$creation_no = pave_insert_id();

if(!$result){
    die(return_json(null," fail", "창작 의뢰 등록에 실패했습니다."));
}

die(return_json(null, "success", "", get_url(PAVE_CREATION_URL, "detail/{$creation_no}")));
?>