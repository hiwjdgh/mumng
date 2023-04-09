<?php
if (!defined('_PAVE_')) exit;
include_once(PAVE_LIB_CF_PATH."/constants.php");
/*************************************************************************
**
**  홈페이지 설정 함수 모음
**
*************************************************************************/
/************************************************************************************************************************
   홈페이지 제목 검사 함수 
************************************************************************************************************************/
function sanitize_pave_tit($pave_tit){
    $pave_tit = pave_sanitize_strip_tag($pave_tit);

    if ($pave_tit == ""){
        return "홈페이지 이름을 입력해 주세요.";
    }

    if (preg_match(PAVE_CHAR_REGEX, $pave_tit)){
        return "홈페이지 이름은 문자만 입력해 주세요.";
    }

    if (strlen($pave_tit) < PAVE_CF_TIT_MIN_LEN || strlen($pave_tit) > PAVE_CF_TIT_MAX_LEN){
        return "홈페이지 이름을 ".PAVE_CF_TIT_MIN_LEN."-".PAVE_CF_TIT_MAX_LEN."자로 입력해 주세요.";
    }
    return "";
}

/************************************************************************************************************************
   홈페이지 관리자 ID 검사 함수 
************************************************************************************************************************/
function sanitize_pave_adm($pave_adm){
    $pave_adm = pave_sanitize_strip_tag($pave_adm);

    if ($pave_adm == ""){
        return "관리자 아이디를 입력해 주세요.";
    }

    if (preg_match(PAVE_CF_ADM_REGEX, $pave_adm)){
        return "관리자 아이디는 영문자, 숫자, _ 만 입력해 주세요.";
    }
    

    if (strlen($pave_adm) < PAVE_CF_ADM_MIN_LEN || strlen($pave_adm) > PAVE_CF_ADM_MAX_LEN){
        return "관리자 아이디를 ".PAVE_CF_ADM_MIN_LEN."-".PAVE_CF_ADM_MAX_LEN."자로 입력해 주세요.";
    }

    return "";
}

/************************************************************************************************************************
   홈페이지 관리자 Email 검사 함수 
************************************************************************************************************************/
function sanitize_pave_adm_email($pave_adm_email){
    $pave_adm_email = pave_sanitize_strip_tag($pave_adm_email);

    if ($pave_adm_email == ""){
        return " 관리자 이메일을 입력해 주세요.";
    }

    if(!filter_var($pave_adm_email, FILTER_VALIDATE_EMAIL)){
        return "관리자 이메일을 올바르게 입력해 주세요.";    
    }

    list ($name , $domain)  =  explode ( '@' , $pave_adm_email);

    if(!checkdnsrr($domain, "MX")){
        return "사용 할 수 없는 관리자 이메일 입니다.";
    }
    
    return "";
}

/************************************************************************************************************************
   홈페이지 분석 스크립트 검사 함수 
************************************************************************************************************************/
function sanitize_pave_anly($pave_anly){
    return "";
}

/************************************************************************************************************************
   홈페이지 로봇차단 스크립트 검사 함수 
************************************************************************************************************************/
function sanitize_pave_robot($pave_robot){
    return "";
}

/************************************************************************************************************************
   홈페이지 기업명 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_name($pave_co_name){
    $pave_co_name = pave_sanitize_strip_tag($pave_co_name);

    
    if ($pave_co_name == ""){
        return " 기업명을 입력해 주세요.";
    }

    if (preg_match(PAVE_CHAR_REGEX, $pave_co_name)){
        return "기업명은 문자만 입력해 주세요.";
    }

    if (strlen($pave_co_name) < PAVE_CF_CO_NAME_MIN_LEN || strlen($pave_co_name) > PAVE_CF_CO_NAME_MAX_LEN){
        return "기업명을 ".PAVE_CF_CO_NAME_MIN_LEN."-".PAVE_CF_CO_NAME_MAX_LEN."자로 입력해 주세요.";
    }

    return "";
}

/************************************************************************************************************************
   홈페이지 기업 대표자 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_own($pave_co_own){
    $pave_co_own = pave_sanitize_strip_tag($pave_co_own);

    if ($pave_co_own == ""){
        return "기업 대표자를 입력해 주세요.";
    }

    if (strlen($pave_co_own) < PAVE_CF_CO_OWN_MIN_LEN || strlen($pave_co_own) > PAVE_CF_CO_OWN_MAX_LEN){
        return "기업 대표자를 ".PAVE_CF_CO_OWN_MIN_LEN."-".PAVE_CF_CO_OWN_MAX_LEN."자로 입력해 주세요.";
    }

    return "";
}

/************************************************************************************************************************
   홈페이지 기업 사업자번호 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_bsns_num($pave_co_bsns_num){
    $pave_co_bsns_num = pave_sanitize_strip_tag($pave_co_bsns_num);

    if ($pave_co_bsns_num == ""){
        return "기업 사업자번호를 입력해 주세요.";
    }

    if(preg_match(PAVE_NUM_REGEX, $pave_co_bsns_num)){
        return "기업 사업자번호는 숫자만 입력해 주세요.";
    }

    $att = 0;
    $sum = 0;
    $arr = array(1, 3, 7, 1, 3, 7, 1, 3, 5);
    $cnt = count($arr);
    for($i=0; $i<$cnt; $i++) {
        $sum += ($pave_co_bsns_num[$i] * $arr[$i]);
    }
    $sum += intval(($pave_co_bsns_num[8] * 5) / 10);
    $at = $sum % 10;
    if ($at != 0){
        $att = 10 - $at;
    }
    if ($pave_co_bsns_num[9] != $att){
        return "기업 사업자등록번호를 올바르게 입력해 주세요.";
    }

    return "";
}

/************************************************************************************************************************
   홈페이지 기업 우편번호 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_addr_zip($pave_co_addr_zip){
    $pave_co_addr_zip = pave_sanitize_strip_tag($pave_co_addr_zip);

    if ($pave_co_addr_zip == ""){
        return "기업 우편번호를 입력해 주세요.";
    }

    if(preg_match(PAVE_NUM_REGEX, $pave_co_addr_zip)){
        return "기업 우편번호는 숫자만 입력해 주세요.";
    }

    if (!preg_match(PAVE_CF_CO_ADDR_ZIP_REGEX, $pave_co_addr_zip)){
        return "기업 우편번호를 올바르게 입력해 주세요.";
    }
    return "";
    
}

/************************************************************************************************************************
   홈페이지 기업 도로명주소 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_addr_load($pave_co_addr_load){
    $pave_co_addr_load = pave_sanitize_strip_tag($pave_co_addr_load);

    if ($pave_co_addr_load == ""){
        return "기업 도로명주소를 입력해 주세요.";
    }

    return "";
}

/************************************************************************************************************************
   홈페이지 기업 상세주소 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_addr_detail($pave_co_addr_detail){
    return "";
}

/************************************************************************************************************************
   홈페이지 기업 지번주소 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_addr_jibun($pave_co_addr_jibun){
    return "";
}

/************************************************************************************************************************
   홈페이지 기업 참고항목 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_addr_extra($pave_co_addr_extra){
    return "";
}

/************************************************************************************************************************
   홈페이지 기업 전화번호 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_tel_num($pave_co_tel_num){
    if ($pave_co_tel_num == ""){
        return "기업 전화번호를 입력해 주세요.";
    }

    if(preg_match(PAVE_NUM_REGEX, $pave_co_tel_num)){
        return "기업 전화번호는 숫자만 입력해 주세요.";
    }

    if(!preg_match(PAVE_CF_CO_TEL_NUM_REGEX, $pave_co_tel_num)){
        return "기업 전화번호를 올바르게 입력해 주세요.";
    }

    return "";
}

/************************************************************************************************************************
   홈페이지 기업 팩스번호 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_fax_num($pave_co_fax_num){
    if ($pave_co_fax_num == ""){
        return "기업 팩스번호를 입력해 주세요.";
    }
        
    if(preg_match(PAVE_NUM_REGEX, $pave_co_fax_num)){
        return "기업 팩스번호는 숫자만 입력해 주세요.";
    }

    if(preg_match(PAVE_CF_CO_FAX_NUM_REGEX, $pave_co_fax_num)){
        return "기업 팩스번호를 올바르게 입력해 주세요.";
    }
 
    return "";
}

/************************************************************************************************************************
   홈페이지 기업 통신판매번호 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_telemarket_num($pave_co_telemarket_num){
    $pave_co_telemarket_num = pave_sanitize_strip_tag($pave_co_telemarket_num);

    if ($pave_co_telemarket_num == ""){
    }
    
    return "";
}

/************************************************************************************************************************
   홈페이지 기업 개인정보책임자 검사 함수 
************************************************************************************************************************/
function sanitize_pave_co_cpo_name($pave_co_cpo_name){
    $pave_co_cpo_name = pave_sanitize_strip_tag($pave_co_cpo_name);

    if ($pave_co_cpo_name == ""){
        return "기업 개인정보책임자를 입력해 주세요.";
    }
    
    if (preg_match(PAVE_CHAR_REGEX, $pave_co_cpo_name)){
        return "기업 개인정보책임자는 문자만 입력해 주세요";
    }

    if (strlen($pave_co_cpo_name) < PAVE_CF_CO_CPO_MIN_LEN || strlen($pave_co_cpo_name) > PAVE_CF_CO_CPO_MAX_LEN){
        return "기업 개인정보책임자는 ".PAVE_CF_CO_CPO_MIN_LEN."-".PAVE_CF_CO_CPO_MAX_LEN."자로 입력해 주세요.";
    }

    return "";
}
?>