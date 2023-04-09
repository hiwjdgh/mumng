<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

//본인확인 결과값
$user_nice = get_session("nice_result")?:null;
set_session("nice_result" , "");


if($user_nice == null){
    die(return_json(null, "fail", "본인인증 후 진행해주세요."));
}


//재인증 검사
$user_cp = $user_nice["mobileno"];
$user_name = $user_nice["name"];
$user_birth_date = $user_nice["birthdate"];
$user_di = $user_nice["di"];
$user_adult_cert_state = ((int)$user_birth_date <= (int)Converter::display_time("-19 years", "Ymd")) ? 1 : 0;

$update = array(
    "user_cp"                   => Converter::del_hyphen_cp($user_cp),
    "user_di"                   => $user_di,
    "user_name"                 => $user_name,
    "user_birth_date"           => Converter::add_hyphen_date($user_birth_date),
    "user_adult_cert_state"     => $user_adult_cert_state,
    "user_cp_cert_dt"           => Converter::display_time("+ {$cert_config["cert_expire_day_no"]} {$cert_config["cert_expire_day_unit"]}", "Y-m-d H:i:s"),
    "user_update_dt"            => PAVE_TIME_YMDHIS,
    "user_update_ip"            => PAVE_USER_IP
);

$result = pave_update("pave_user", $update, "user_no = '{$pave_user["user_no"]}'");

if(!$result){
    die(return_json(null, "fail", "본인인증 수정에 실패 했습니다."));

}

die(return_json(null, "success", get_url(PAVE_SETTING_URL,"account/privacy")));
?>