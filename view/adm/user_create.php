<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", PAVE_URL);
}

//본인인증 라이브러리
require_once(PAVE_LIB_CERT_PATH.'/cert.lib.php');
$cert_cf = get_cert_cf();

$token              = get_token();
//기본 정보
$user_code              = pave_input_sanitize($user_code);
$user_id                = pave_input_sanitize($user_id);
$user_pwd               = pave_input_sanitize($user_pwd);

//프로필 정보
$user_nick              = pave_input_sanitize($user_nick);
$user_field             = pave_input_sanitize($user_field);
$user_genre             = pave_input_sanitize($user_genre);
$user_introduce         = pave_input_sanitize($user_introduce);

//개인정보
$user_name              = pave_input_sanitize($user_name);
$user_birth_year        = pave_input_sanitize($user_birth_year);
$user_birth_month       = pave_input_sanitize($user_birth_month);
$user_birth_day         = pave_input_sanitize($user_birth_day);
$user_birth_date        = "{$user_birth_year}{$user_birth_month}{$user_birth_day}";
$user_sex               = pave_input_sanitize($user_sex);

//인증 정보
$user_cp                = pave_input_sanitize($user_cp);
$user_cp_cert_state     = pave_input_sanitize($user_cp_cert_state);

//동의 정보
$user_term_agree_state  = pave_input_sanitize($user_term_agree_state);
$user_info_agree_state  = pave_input_sanitize($user_info_agree_state);
$user_event_agree_state = pave_input_sanitize($user_event_agree_state);
$user_adult_content     = pave_input_sanitize($user_adult_content);

//부가 정보
$user_email             = pave_input_sanitize($user_email);

//사업자 정보
$user_bsns_state        = pave_input_sanitize($user_bsns_state);
$user_bsns_owner        = pave_input_sanitize($user_bsns_owner);
$user_bsns_name         = pave_input_sanitize($user_bsns_name);
$user_bsns_number       = pave_input_sanitize($user_bsns_number);

//정산 정보
$user_bank              = pave_input_sanitize($user_bank);
$user_bank_number       = pave_input_sanitize($user_bank_number);
$user_bank_owner        = pave_input_sanitize($user_bank_owner);

/* ***************************************************** */
//코드 검사
if($msg = sanitize_reg_user_code($user_code)){
    alert($msg);
}

//아이디 검사
if($msg = sanitize_reg_user_id($user_id)){
    alert($msg);
}

//비밀번호 검사
if($msg = sanitize_reg_user_pwd($user_pwd)){
    alert($msg);
}
/* ***************************************************** */

/* ***************************************************** */
//필명 검사
if($msg = sanitize_reg_user_nick($user_nick)){
    alert($msg);
}

//분야 검사
if($msg = sanitize_reg_user_field($user_field)){
    alert($msg);
}

//장르 검사
if($msg = sanitize_reg_user_genre($user_genre)){
    alert($msg);
}

//소개 검사
if($msg = sanitize_reg_user_introduce($user_introduce)){
    alert($msg);
}
/* ***************************************************** */

/* ***************************************************** */
//이름 검사
if($msg = sanitize_reg_user_name($user_name)){
    alert($msg);
}

//생년월일 검사
if($msg = sanitize_reg_user_birth_date($user_birth_date)){
    alert($msg);
}

//성별 검사
if($msg = sanitize_reg_user_sex($user_sex)){
    alert($msg);
}
/* ***************************************************** */

/* ***************************************************** */
//휴대폰 검사
if($msg = sanitize_reg_user_cp($user_cp,false)){
    alert($msg);
}
/* ***************************************************** */

/* ***************************************************** */
//동의 검사
if($msg = sanitize_reg_user_term_agree($user_term_agree_state)){
    alert($msg);
}
if($msg = sanitize_reg_user_info_agree($user_info_agree_state)){
    alert($msg);
}
if($msg = sanitize_reg_user_event_agree($user_event_agree_state)){
    alert($msg);
}

/* ***************************************************** */

/* ***************************************************** */
//이메일 검사
//안함!!!!!
/* ***************************************************** */

/* ***************************************************** */
if($user_bsns_state){
    //대표자 검사
    if($msg = sanitize_reg_bsns_owner($user_bsns_owner)){
        alert($msg);
    }
    
    //상호명 검사
    if($msg = sanitize_reg_bsns_name($user_bsns_name)){
        alert($msg);
    }
    
    //사업자번호 검사
    if($msg = sanitize_reg_user_bsns_num($user_bsns_number, false)){
        alert($msg);
    }
}else{
    $user_bsns_owner = "";
    $user_bsns_name = "";
    $user_bsns_number = "";
}
/* ***************************************************** */

/* ***************************************************** */
//은행 검사
if($msg = sanitize_reg_user_bank_name($user_bank, false)){
    alert($msg);
}

//계좌번호 검사
if($msg = sanitize_reg_user_bank_number($user_bank_number, false)){
    alert($msg);
}

//예금주 검사
if($msg = sanitize_reg_user_bank_owner($user_bank_owner, false)){
    alert($msg);
}
/* ***************************************************** */

/* ***************************************************** */
//성인인증검사
$adult_date = date("Ymd", strtotime("-19 years", PAVE_TIME));
$user_adult_cert_state = ((int)$user_birth_date <= (int)$adult_date) ? 1 : 0;
if(!$user_adult_cert_state || !$user_cp_cert_state){
    $user_adult_content = 1; //성인물 차단
}else{
    $user_adult_content = 0; 
}
/* ***************************************************** */

//SNS 계정
$user_sns = $config_obj->get_sns_config();


$user = array(
    "user_code"                 => $user_code,
    "user_id"                   => $user_id,
    "user_hash"                 => password_hash($token.$user_pwd, PASSWORD_DEFAULT),
    "user_salt"                 => $token,
    "user_nick"                 => $user_nick,
    "user_field"                => pave_implode($user_field, ","),
    "user_genre"                => pave_implode($user_genre, ","),
    "user_introduce"            => $user_introduce,
    "user_name"                 => $user_name,
    "user_sex"                  => $user_sex,
    "user_birth_date"           => Converter::add_hyphen_date($user_birth_date),
    "user_cp"                   => Converter::del_hyphen_cp($user_cp),
    "user_cp_cert_state"        => $user_cp_cert_state,
    "user_adult_cert_state"     => $user_adult_cert_state,
    "user_term_agree_state"     => $user_term_agree_state,
    "user_info_agree_state"     => $user_info_agree_state,
    "user_event_agree_state"    => $user_event_agree_state,
    "user_adult_content"        => $user_adult_content,
    "user_email"                => $user_email,
    "user_bsns_state"           => $user_bsns_state,
    "user_bsns_owner"           => $user_bsns_owner,
    "user_bsns_name"            => $user_bsns_name,
    "user_bsns_number"          => $user_bsns_number,
    "user_bank"                 => $user_bank,
    "user_bank_number"          => $user_bank_number,
    "user_bank_owner"           => $user_bank_owner,
    "user_temporary_state"      => $user_temporary_state,
    "user_rel"                  => json_encode(null),
    "user_sns"                  => json_encode($user_sns),
    "user_img"                  => get_url(PAVE_IMG_URL, "img_profile_empty_160px.png"),
    "user_di"                   => "",
    "user_pwd_dt"               => Converter::display_time("Y-m-d H:i:s", "+ {$user_cf["user_pwd_expire_day_no"]} {$user_cf["user_pwd_expire_day_unit"]}"),
    "user_cp_cert_dt"           => Converter::display_time("Y-m-d H:i:s", "+ {$cert_cf["cert_expire_day_no"]} {$cert_cf["cert_expire_day_unit"]}"),
    "user_insert_dt"            => PAVE_TIME_YMDHIS,
    "user_insert_ip"            => PAVE_USER_IP,
    "user_update_dt"            => PAVE_TIME_YMDHIS,
    "user_update_ip"            => PAVE_USER_IP
);


$result = pave_insert("pave_user", $user);
if(!$result){
    alert("회원가입에 실패 했습니다.", get_url(PAVE_ADM_URL, "user/form"));
}

//회원 알림 등록
pave_insert("pave_user_notify", array("user_no" => $user["user_no"]));

//회원 이용약관 동의 등록
$term = array(
    "user_id"               => $user_id,
    "user_agree_type"        => "term",
    "user_agree_state"       => $user_term_agree_state,
    "user_agree_insert_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_insert_ip"   => PAVE_USER_IP
);
$result = pave_insert("pave_user_agree", $term);

//회원 정보공개 동의 등록
$info = array(
    "user_id"                => $user_id,
    "user_agree_type"        => "info",
    "user_agree_state"       => $user_info_agree_state,
    "user_agree_insert_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_insert_ip"   => PAVE_USER_IP
);
$result = pave_insert("pave_user_agree", $info);

//회원 이벤트 동의 등록
$event = array(
    "user_id"                => $user_id,
    "user_agree_type"        => "event",
    "user_agree_state"       => $user_event_agree_state,
    "user_agree_insert_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_insert_ip"   => PAVE_USER_IP
);
$result = pave_insert("pave_user_agree", $event);


//회원 파일 생성
@mkdir(PAVE_DATA_USER_PATH."/{$user_code}/", PAVE_DIR_PERMISSION, true);

url_move(get_url(PAVE_ADM_URL,"user/form?user_id={$user_id}"));
?>
