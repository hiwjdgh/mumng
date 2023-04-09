<?php
$user_nice          = get_session("nice_result")?:null;
$user_rel_nice      = get_session("nice_result_rel")?:null;

if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

if($is_user){
    die(return_json(null, "fail","", get_url(PAVE_URL)));
}


$token                      = get_token();
$user_id                    = pave_input_sanitize($user_id);
$user_pwd                   = pave_input_sanitize($user_pwd);
$user_pwd_re                = pave_input_sanitize($user_pwd_re);

$user_cp                    = $user_nice["mobileno"];
$user_di                    = $user_nice["di"];

$user_name                  = $user_nice["name"];
$user_sex                   = pave_input_sanitize($user_sex);
$user_birth_date            = $user_nice["birthdate"];

$user_rel                   = pave_input_sanitize($user_rel);

$user_kid_state             = ((int)$user_birth_date <= (int)Converter::display_time("-14 years", "Ymd")) ? 0 : 1;
$user_adult_cert_state      = ((int)$user_birth_date <= (int)Converter::display_time("-19 years", "Ymd")) ? 1 : 0;


$user_term_agree            = pave_input_sanitize($user_term_agree);
$user_info_agree            = pave_input_sanitize($user_info_agree);
$user_event_agree           = pave_input_sanitize($user_event_agree);
$user_code                  = get_unique(10);

$user_cp_cert_dt            = Converter::display_time("+ {$cert_config["cert_expire_day_no"]} {$cert_config["cert_expire_day_unit"]}", "Y-m-d H:i:s");
$user_pwd_dt                = Converter::display_time("+ {$user_config["user_pwd_expire_day_no"]} {$user_config["user_pwd_expire_day_unit"]}", "Y-m-d H:i:s");




//아이디 검사
if($msg = sanitize_reg_user_id($user_id)){
    die(return_json(null, "fail", $msg));
}

//비밀번호 검사
if($msg = sanitize_reg_user_pwd($user_pwd)){
    die(return_json(null, "fail", $msg));
}
if($msg = sanitize_reg_user_pwd_re($user_pwd, $user_pwd_re)){
    die(return_json(null, "fail", $msg));
}

//휴대폰 검사
if($msg = sanitize_reg_user_cp($user_cp, true, "", true)){
    die(return_json(null, "fail", $msg));
}

//본인인증검사
if($msg = sanitize_reg_user_di($user_di, true, "", true)){
    die(return_json(null, "fail", $msg));
}

if($user_kid_state){
    //보호자 관계 검사
    if($msg = sanitize_reg_user_rel($user_rel, false)){
        die(return_json(null, "fail", $msg));
    }
}


//이름 검사
if($msg = sanitize_reg_user_name($user_name, true)){
    die(return_json(null, "fail", $msg));
}

//성별 검사
if($msg = sanitize_reg_user_sex($user_sex, true)){
    die(return_json(null, "fail", $msg));
}

//생년월일 검사
if($msg = sanitize_reg_user_birth_date($user_birth_date, true)){
    die(return_json(null, "fail", $msg));
}

//동의 검사
if($msg = sanitize_reg_user_term_agree($user_term_agree, true)){
    die(return_json(null, "fail", $msg));
}
if($msg = sanitize_reg_user_info_agree($user_info_agree, true)){
    die(return_json(null, "fail", $msg));
}
if($msg = sanitize_reg_user_event_agree($user_event_agree, false)){
    die(return_json(null, "fail", $msg));
}

//코드 검사
if($msg = sanitize_reg_user_code($user_code)){
    die(return_json(null, "fail", $msg));
}

$user_sns = $config_obj->get_sns_config();

$user = array(
    "user_id"                   => $user_id,
    "user_code"                 => $user_code,
    "user_hash"                 => password_hash($token.$user_pwd, PASSWORD_DEFAULT),
    "user_salt"                 => $token,
    "user_name"                 => $user_name,
    "user_nick"                 => $user_code,
    "user_share"                => $user_code,
    "user_di"                   => $user_di,
    "user_img"                  => get_url(PAVE_IMG_URL, "img_profile_empty_160px.png"),
    "user_cp"                   => Converter::del_hyphen_cp($user_cp),
    "user_sex"                  => $user_sex,
    "user_sns"                  => json_encode($user_sns),
    "user_cp_cert_state"        => 1,
    "user_adult_cert_state"     => $user_adult_cert_state,
    "user_kid_state"            => $user_kid_state,
    "user_sex"                  => $user_sex,
    "user_birth_date"           => Converter::add_hyphen_date($user_birth_date),
    "user_term_agree_state"     => $user_term_agree,
    "user_info_agree_state"     => $user_info_agree,
    "user_event_agree_state"    => $user_event_agree,
    "user_pwd_dt"               => $user_pwd_dt,
    "user_cp_cert_dt"           => $user_cp_cert_dt,
    "user_insert_dt"            => PAVE_TIME_YMDHIS,
    "user_insert_ip"            => PAVE_USER_IP,
    "user_update_dt"            => PAVE_TIME_YMDHIS,
    "user_update_ip"            => PAVE_USER_IP
);


$result = pave_insert("pave_user", $user);

if(!$result){
    die(return_json(null, "fail", "회원가입에 실패 했습니다."));
}

$user_no = pave_insert_id();


//회원 보호자 등록
if($user_kid_state){
    $user_rel = array(
        "user_no"                   => $user_no,
        "user_rel"                  => $user_rel,
        "user_rel_name"             => $user_rel_nice["name"],
        "user_rel_cp"               => Converter::del_hyphen_cp($user_rel_nice["mobileno"]),
        "user_rel_birth_date"       => Converter::add_hyphen_date($user_rel_nice["birthdate"]),
        "user_rel_di"               => $user_rel_nice["di"],
        "user_rel_insert_dt"        => PAVE_TIME_YMDHIS,
        "user_rel_insert_ip"        => PAVE_USER_IP,
    );
    
    $result = pave_insert("pave_user_rel", $user_rel);
}


//회원 알림 등록
pave_insert("pave_user_notify", array("user_no" => $user_no));


//회원 이용약관 동의 등록
$term = array(
    "user_no"               => $user_no,
    "user_agree_type"        => "term",
    "user_agree_state"       => $user_term_agree,
    "user_agree_insert_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_insert_ip"   => PAVE_USER_IP,
    "user_agree_update_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_update_ip"   => PAVE_USER_IP
);
$result = pave_insert("pave_user_agree", $term);

//회원 정보공개 동의 등록
$info = array(
    "user_no"                => $user_no,
    "user_agree_type"        => "info",
    "user_agree_state"       => $user_info_agree,
    "user_agree_insert_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_insert_ip"   => PAVE_USER_IP,
    "user_agree_update_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_update_ip"   => PAVE_USER_IP
);
$result = pave_insert("pave_user_agree", $info);

//회원 이벤트 동의 등록
$event = array(
    "user_no"                => $user_no,
    "user_agree_type"        => "event",
    "user_agree_state"       => $user_event_agree,
    "user_agree_insert_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_insert_ip"   => PAVE_USER_IP,
    "user_agree_update_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_update_ip"   => PAVE_USER_IP
);
$result = pave_insert("pave_user_agree", $event);


//회원 세션 생성
set_session("user_no", $user_no);
set_session("reg_user_no", $user_no);

//나이스 세션 삭제
set_session("nice_result" , "");
set_session("nice_result_rel" , "");

//회원 파일 생성
@mkdir(PAVE_DATA_USER_PATH, PAVE_DIR_PERMISSION, true);
@mkdir(PAVE_DATA_USER_PATH."/{$user_code}/", PAVE_DIR_PERMISSION, true);

die(return_json(null, "success", "회원가입을 완료했습니다.", get_url(PAVE_ACCOUNT_URL, "reg2")));
?>