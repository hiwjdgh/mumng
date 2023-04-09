<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", PAVE_URL);
}

$sql_obj = new Objects();
$sql_obj->set_sql_common("SELECT user.*, CONCAT(user.user_field, ',', user.user_genre) AS user_full_hashtag FROM pave_user AS user");
$sql_obj->set_sql_where("WHERE user_id = '{$user_id}'");
$sql_obj->generate_sql();
$user = pave_fetch($sql_obj->get_sql());


//기본 정보
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
//비밀번호 검사
if($user_pwd){
    if($msg = sanitize_reg_user_pwd($user_pwd)){
        alert($msg);
    }
}
/* ***************************************************** */

/* ***************************************************** */
//필명 검사
if($msg = sanitize_reg_user_nick($user_nick, $user["user_id"])){
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
if($msg = sanitize_reg_user_cp($user_cp, false, $user["user_id"])){
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


$update = array(
    "user_hash"                 => password_hash($user["user_salt"].$user_pwd, PASSWORD_DEFAULT),
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
    "user_update_dt"            => PAVE_TIME_YMDHIS,
    "user_update_ip"            => PAVE_USER_IP
);

pave_update("pave_user", $update, "user_id = '{$user["user_id"]}'");

if($user["user_event_agree_state"] != $user_event_agree_state){
    //회원 이벤트 동의 등록
    $event = array(
        "user_agree_state"       => $user_event_agree_state,
        "user_agree_update_dt"   => PAVE_TIME_YMDHIS,
        "user_agree_update_ip"   => PAVE_USER_IP
    );
    pave_update("pave_user_agree", $event, "user_id = '{$user["user_id"]}' AND user_agree_type = 'event'");
}

url_move(get_url(PAVE_ADM_URL,"user/form?user_id={$user_id}"));
?>
