<?php
if (!defined('_PAVE_')) exit;
include_once(PAVE_LIB_USER_PATH."/constants.php");
/*************************************************************************
**
**  회원 함수 모음
**
*************************************************************************/

/************************************************************************************************************************
   회원 아이디 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_id($user_id, $is_dup_check = true){
    global $pave_config, $user_config;
    $user_id = pave_sanitize_strip_tag($user_id);

    if ($user_id == ""){
        return "아이디를 입력해 주세요.";
    }

    if (!preg_match(PAVE_USER_ID_REGEX, $user_id)){
        return "아이디를 영문 소문자부터 입력해주세요.";
    }

    if(mb_strlen($user_id, "UTF-8") < $user_config["user_id_min_len"] || mb_strlen($user_id, "UTF-8") > $user_config["user_id_max_len"]){
        return "아이디를 {$user_config["user_id_min_len"]}~{$user_config["user_id_max_len"]}자로 입력해 주세요.";
    }

    
    if (!preg_match(PAVE_USER_ID_REGEX2, $user_id)){
        return "아이디를 영문 소문자, 숫자, _ 를 사용하여 입력해 주세요.";
    }

    if($is_dup_check){
        $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_id = '{$user_id}') AS exist";
        $row = pave_fetch($sql);
        if ($row["exist"]){
            return "이미 사용중인 아이디입니다.";
        }
    

        $is_prohibit = false;
        for ($i=0; $i < count($pave_config["pave_prohibit_word_list"]); $i++) {
            $str = $pave_config["pave_prohibit_word_list"][$i];
        
            $pos = stripos($user_id, $str);
            if ($pos !== false) {
                $is_prohibit = true;
                break;
            }
        }

        if($is_prohibit){
            return "사용할 수 없는 아이디입니다.";
        }
    }

    return "";
}

/************************************************************************************************************************
   회원 비밀번호 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_pwd($user_pwd){
    global $user_config;
    $user_pwd = $user_pwd;

    if ($user_pwd == ""){
        return "비밀번호를 입력해 주세요.";
    }

    if(mb_strlen($user_pwd, "UTF-8") < $user_config["user_pwd_min_len"]){
        return "비밀번호를 최소 {$user_config["user_pwd_min_len"]}자 이상 입력해 주세요.";
    }

    if (!preg_match(PAVE_USER_PWD_REGEX, $user_pwd)){
        return "영문 소문자, 숫자,특수문자를 모두 입력해 주세요.";
    }

    return "";
}

/************************************************************************************************************************
   회원 비밀번호 재입력 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_pwd_re($user_pwd, $user_pwd_re){
    $reg_user_pwd = $user_pwd;
    $reg_user_pwd_re = $user_pwd_re;

    if ($reg_user_pwd_re == ""){
        return "비밀번호를 재입력해 주세요.";
    }

    if($reg_user_pwd != $reg_user_pwd_re){
        return "비밀번호가 일치하지 않습니다.";
    }

    return "";
}

/************************************************************************************************************************
   회원 닉네임 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_nick($user_nick, $is_required, $user_id = "", $is_dup_check){
    global $pave_config, $pave_user, $user_config;
    $user_nick = pave_sanitize_strip_tag($user_nick);

    if ($user_nick == ""){
        if(!$is_required){
            return "";
        }


        return "필명을 입력해 주세요.";
    }

    if(mb_strlen($user_nick, "UTF-8") < $user_config["user_nick_min_len"] || mb_strlen($user_nick, "UTF-8") > $user_config["user_nick_max_len"]){
        return "필명을 {$user_config["user_nick_min_len"]}~{$user_config["user_nick_max_len"]}자로 입력해 주세요.";
    }

    if (!preg_match(PAVE_USER_NICK_REGEX, $user_nick)){
        return "필명을 영문, 한글, 숫자, _, - 를 사용하여 입력해 주세요.";
    }
    
    if($is_dup_check){
        if($user_id){
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_nick = '{$user_nick}' AND user_id <> '{$user_id}') AS exist";
        }else{
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_nick = '{$user_nick}' AND user_id <> '{$pave_user["user_id"]}') AS exist";
        }
        $row = pave_fetch($sql);
        if ($row["exist"]){
            return "이미 사용중인 필명입니다.";
        }
    }



    $is_prohibit = false;
    for ($i=0; $i < count($pave_config["pave_prohibit_word_list"]); $i++) {
        $str = $pave_config["pave_prohibit_word_list"][$i];

        $pos = stripos($user_nick, $str);
        if ($pos !== false) {
            $is_prohibit = true;
            break;
        }
    }

    if($is_prohibit){
        return "사용할 수 없는 필명 입니다.";
    }

    $is_slang = false;
    for ($i=0; $i < count($pave_config["pave_slang_word_list"]); $i++) {
        $str = $pave_config["pave_slang_word_list"][$i];

        $pos = stripos($user_nick, $str);
        if ($pos !== false) {
            $is_slang = true;
            break;
        }
    }

    if($is_slang){
        return "비속어를 필명으로 사용할 수 없습니다.";
    }
    
    return "";
}

/************************************************************************************************************************
   회원 공유 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_share($user_share, $is_required, $user_id = "", $is_dup_check){
    global $pave_user, $user_config;
    $user_share = pave_sanitize_strip_tag($user_share);

    if ($user_share == ""){
        if(!$is_required){
            return "";
        }

        return "공유 URL을 입력해 주세요.";
    }

    if(mb_strlen($user_share, "UTF-8") < $user_config["user_share_min_len"] || mb_strlen($user_share, "UTF-8") > $user_config["user_share_max_len"]){
        return "공유 URL을 {$user_config["user_share_min_len"]}~{$user_config["user_share_max_len"]}자로 입력해 주세요.";
    }

    if (!preg_match(PAVE_USER_SHARE_REGEX, $user_share)){
        return "공유 URL은 영문, 숫자, 밑줄, 마침표 를 사용하여 입력해 주세요.";
    }
    
    if($is_dup_check){
        if($user_id){
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_share = '{$user_share}' AND user_id <> '{$user_id}') AS exist";
        }else{
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_share = '{$user_share}' AND user_id <> '{$pave_user["user_id"]}') AS exist";
        }
        $row = pave_fetch($sql);
        if ($row["exist"]){
            return "이미 사용중인 공유 URL입니다.";
        }
    }
    
    return "";
}

/************************************************************************************************************************
   회원 이메일 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_email($user_email, $is_required, $user_id = "", $is_dup_check){
    global $pave_user;

    $reg_user_email = pave_sanitize_strip_tag($user_email);

    if ($reg_user_email == ""){
        if(!$is_required){
            return "";
        }
        return "이메일을 입력해 주세요.";
    }

    if(!filter_var($reg_user_email,FILTER_VALIDATE_EMAIL)){
        return "이메일을 올바르게 입력해 주세요.";    
    }


    list ($name , $domain)  =  explode ( '@' , $reg_user_email);
    if(!checkdnsrr($domain, "MX")){
        return "사용 할 수 없는 이메일입니다.";
    }


    if($is_dup_check){
        if($user_id){
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_email = '{$reg_user_email}' AND user_id <> '{$user_id}') AS exist";
        }else{
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_email = '{$reg_user_email}' AND user_id <> '{$pave_user["user_id"]}') AS exist";
        }
        $row = pave_fetch($sql);
        if ($row["exist"]){
            return "이미 사용중인 이메일입니다.";
        }
    }

    return "";
}

/************************************************************************************************************************
   회원 휴대폰 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_cp($user_cp, $is_required, $user_id = "", $is_dup_check){
    global $pave_user;

    $user_cp = pave_sanitize_strip_tag($user_cp);

    if ($user_cp == ""){
        if(!$is_required){
            return "";
        }

        return "휴대폰번호를 입력해 주세요.";
    }

    if(!preg_match(PAVE_USER_CP_REGEX, $user_cp)){
        return "휴대폰번호를 올바르게 입력해 주세요.";
    }

    if($is_dup_check){
        if($user_id){
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_cp = '{$user_cp}' AND user_id <> '{$user_id}') AS exist";
        }else{
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_cp = '{$user_cp}' AND user_id <> '{$pave_user["user_id"]}') AS exist";
        }
        $row = pave_fetch($sql);
        if ($row["exist"]){
            return "이미 사용중인 휴대폰입니다.";
        }
    }

    return "";
}

/************************************************************************************************************************
   회원 보호자 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_rel($user_rel, $is_required){
    global $user_config;

    $user_rel = pave_sanitize_strip_tag($user_rel);

    if ($user_rel == ""){
        if(!$is_required){
            return "";
        }

        return "보호자 관계를 선택해 주세요.";
    }

       
    if(!in_array($user_rel, $user_config["user_rel_list"])){
        return "보호자 관계를 올바르게 선택해주세요.";
    }

    return "";
}
/************************************************************************************************************************
   회원 보호자휴대폰 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_rel_cp($user_rel_cp, $is_required, $user_id = "", $is_dup_check){
    global $pave_user;

    $user_rel_cp = pave_sanitize_strip_tag($user_rel_cp);

    if ($user_rel_cp == ""){
        if(!$is_required){
            return "";
        }

        return "휴대폰번호를 입력해 주세요.";
    }

    if(!preg_match(PAVE_USER_CP_REGEX, $user_rel_cp)){
        return "휴대폰번호를 올바르게 입력해 주세요.";
    }

    if($is_dup_check){
        if($user_id){
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_cp = '{$user_rel_cp}' AND user_id <> '{$user_id}') AS exist";
        }else{
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_cp = '{$user_rel_cp}' AND user_id <> '{$pave_user["user_id"]}') AS exist";
        }
        $row = pave_fetch($sql);
        if ($row["exist"]){
            return "이미 사용중인 휴대폰입니다.";
        }
    }

    return "";
}

/************************************************************************************************************************
   회원 전화번호 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_tel($user_tel, $is_required, $user_id = "", $is_dup_check){
    global $pave_user;

    $reg_user_tel = pave_sanitize_strip_tag($user_tel);

    if ($reg_user_tel == ""){
        if(!$is_required){
            return "";
        }
        return "전화번호를 입력해 주세요.";
    }

    if(!preg_match(PAVE_USER_TEL_REGEX, $reg_user_tel)){
        return "전화번호를 올바르게 입력해 주세요.";
    }

    if($is_dup_check){
        if($user_id){
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_tel = '{$reg_user_tel}' AND user_id <> '{$user_id}') AS exist";
        }else{
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_tel = '{$reg_user_tel}' AND user_id <> '{$pave_user["user_id"]}') AS exist";
        }
        $row = pave_fetch($sql);
        if ($row["exist"]){
            return "이미 사용중인 닉네임입니다.";
        }
    }

    return "";
}

/************************************************************************************************************************
   회원 이름 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_name($user_name, $is_required){
    $reg_user_name = pave_sanitize_strip_tag($user_name);

    if ($reg_user_name == ""){
        if(!$is_required){
            return "";
        }
        return "이름을 입력해 주세요.";
    }
}

/************************************************************************************************************************
   회원 생년월일 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_birth_date($user_birth_date, $is_required){
    global $user_config;

    $reg_user_birth_date = pave_sanitize_strip_tag($user_birth_date);

    if ($reg_user_birth_date == ""){
        if(!$is_required){
            return "";
        }
        return "생년월일을 입력해 주세요.";
    }

    if(!preg_match(PAVE_USER_BIRTH_DATE_REGEX, $reg_user_birth_date)){
        return "생년월일을 올바르게 입력해 주십시오.";
    }

    return "";
}

/************************************************************************************************************************
   회원 성별 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_sex($user_sex, $is_required){
    $reg_user_sex = pave_sanitize_strip_tag($user_sex);

    if ($reg_user_sex == ""){
        if(!$is_required){
            return "";
        }
        return "성별을 입력해 주세요.";
    }

    return "";
}

/************************************************************************************************************************
   회원 본인인증 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_di($user_di, $is_required, $user_id = "", $is_dup_check){
    global $pave_user;
    $reg_user_di = $user_di;

    if ($reg_user_di == ""){
        if(!$is_required){
            return "";
        }

        return "본인인증을 해주세요.";
    }


    if($is_dup_check){
        if($user_id){
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_di = '{$reg_user_di}' AND user_id <> '{$user_id}') AS exist";
        }else{
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_di = '{$reg_user_di}' AND user_id <> '{$pave_user["user_id"]}') AS exist";
        }
        $row = pave_fetch($sql);
        if ($row["exist"]){
            return "입력하신 본인확인 정보로 가입된 내역이 존재합니다.";
        }
    }

    return "";
}

/************************************************************************************************************************
   회원 우편번호 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_addr_zip($user_addr_zip){
    $reg_user_addr_zip = $user_addr_zip;
    if ($reg_user_addr_zip == ""){
        return "우편번호를 입력해 주세요.";
    }

    if(!preg_match(PAVE_USER_ADDR_ZIP_REGEX, $reg_user_addr_zip)){
        return "우편번호를 올바르게 입력해 주십시오.";
    }

    return "";
}

/************************************************************************************************************************
   회원 도로명 주소 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_addr_load($user_addr_load){
    $reg_user_addr_load = $user_addr_load;

    if($reg_user_addr_load == ""){
        return "도로명 주소를 입력해 주십시오.";

    }

    return "";
}


/************************************************************************************************************************
   회원 이용약관 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_term_agree($user_term_agree, $is_required){
    $reg_term_agree_use = $user_term_agree;

    if(!$reg_term_agree_use){
        if(!$is_required){
            return "";
        }


        return "이용약관 동의를 해주세요.";
    }

    return "";
}

/************************************************************************************************************************
   회원 정보공개 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_info_agree($user_info_agree, $is_required){
    $reg_info_agree_use = $user_info_agree;

    if(!$reg_info_agree_use){
        if(!$is_required){
            return "";
        }

        return "정보공개 동의를 해주세요.";
    }

    return "";
}

/************************************************************************************************************************
   회원 이벤트 수신 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_event_agree($user_event_agree, $is_required){
    $reg_event_agree_use = $user_event_agree;

    if(!$reg_event_agree_use){
        if(!$is_required){
            return "";
        }

        return "이벤트 수신 동의를 해주세요.";
    }

    return "";
}

/************************************************************************************************************************
   회원 커머스 동의 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_commerce_agree($user_commerce_agree, $is_required){
    $reg_commerce_agree_use = $user_commerce_agree;

    if(!$reg_commerce_agree_use){
        if(!$is_required){
            return "";
        }

        return "커머스 이용약관 동의를 해주세요.";
    }

    return "";
}

/************************************************************************************************************************
   회원 대표자명 검사 함수 
************************************************************************************************************************/
function sanitize_reg_bsns_owner($user_bsns_owner, $is_required){
    $user_bsns_owner = pave_sanitize_strip_tag($user_bsns_owner);

    if ($user_bsns_owner == ""){
        if(!$is_required){
            return "";
        }

        return "대표자명을 입력해 주세요.";
    }

    return "";
}

/************************************************************************************************************************
   회원 상호명 검사 함수 
************************************************************************************************************************/
function sanitize_reg_bsns_name($user_bsns_name, $is_required){
    $user_bsns_name = pave_sanitize_strip_tag($user_bsns_name);

    if ($user_bsns_name == ""){

        if(!$is_required){
            return "";
        }
        return "상호명을 입력해 주세요.";
    }

    return "";
}


/************************************************************************************************************************
   회원 사업자 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_bsns_num($user_bsns_num, $is_required, $user_no = "", $is_dup_check = true){
    global $pave_user;

    $reg_user_bsns_num = pave_sanitize_strip_tag($user_bsns_num);

    if($reg_user_bsns_num == ""){
        if(!$is_required){
            return "";
        }
        return "사업자번호를 입력해 주세요.";
    }

    if(!preg_match(PAVE_USER_BSNS_NUM_REGEX, $reg_user_bsns_num)){
        return "사업자번호를 올바르게 입력해 주세요.";
    }


    $att = 0;
    $sum = 0;
    $arr = array(1, 3, 7, 1, 3, 7, 1, 3, 5);
    $cnt = count($arr);
    for($i=0; $i<$cnt; $i++) {
        $sum += ($reg_user_bsns_num[$i] * $arr[$i]);
    }
    $sum += intval(($reg_user_bsns_num[8] * 5) / 10);
    $at = $sum % 10;
    if ($at != 0)
        $att = 10 - $at;
    if ($reg_user_bsns_num[9] != $att){
        return "사업자번호를 올바르게 입력해 주세요.";
    }

    if($is_dup_check){
        if($user_no){
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user_bsns WHERE user_bsns_number = '{$reg_user_bsns_num}' AND user_no <> '{$user_no}') AS exist";
        }else{
            $sql = "SELECT EXISTS (SELECT 1 FROM pave_user_bsns WHERE user_bsns_number = '{$reg_user_bsns_num}' AND user_no <> '{$pave_user["user_no"]}') AS exist";
        }
        
        $row = pave_fetch($sql);
        if ($row["exist"]){
            return "이미 사용중인 사업자번호입니다.";
        }
    }
    return "";
}

/************************************************************************************************************************
   회원 추천인 코드 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_code($user_code){
    $reg_user_code = pave_sanitize_strip_tag($user_code);

    if($reg_user_code == ""){
        return "잠시 후 다시 시도 해주세요.";
    }

    $sql = "SELECT EXISTS (SELECT 1 FROM pave_user WHERE user_code = '{$reg_user_code}') AS exist";
    $row = pave_fetch($sql);
    if ($row["exist"]){
        return "잠시 후 다시 시도 해주세요.";
    }


    return "";
}

/************************************************************************************************************************
   회원 분야 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_field($user_field, $is_required){
    global $user_config;

    $reg_user_field = pave_sanitize_strip_tag($user_field);

    if($is_required){
        if(count($reg_user_field) == 0){
            return "분야를 선택해주세요.";
        }
    }else{
        if(!pave_is_array($reg_user_field)){
            return "";
        }
    }
    
    foreach ($reg_user_field as $field) {
        if(!in_array($field, $user_config["user_field_list"])){
            return "분야를 올바르게 선택해주세요.";
        }
    }


    return "";
}

/************************************************************************************************************************
   회원 장르 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_genre($user_genre, $is_required){
    global $user_config;
    $reg_user_genre = pave_sanitize_strip_tag($user_genre);
    
    if($is_required){
        if(count($reg_user_genre) == 0){
            return "장르를 선택해주세요.";
        }
    }else{
        if(!pave_is_array($reg_user_genre)){
            return "";
        }
    }

    if(count($reg_user_genre) > $user_config["user_genre_max_cnt"]){
        return "장르는 최대 {$user_config["user_genre_max_cnt"]}개 까지 선택가능합니다.";
    }

    foreach ($reg_user_genre as $genre) {
        if(!in_array($genre, $user_config["user_genre_list"])){
            return "장르를 올바르게 선택해주세요.";;
        }
    }
  
    return "";
}

/************************************************************************************************************************
   회원 대표작품 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_major($user_major, $is_required){
    $reg_user_major = pave_sanitize_strip_tag($user_major);
    

    if(!$reg_user_major){
        if(!$is_required){
            return "";
        }

        return "대표작품을 등록해주세요.";
    }

    $work_obj = new Work();

    $work = $work_obj->set_work_id($user_major)
    ->set_work_display(1)
    ->set_work_epsd_cnt(0)
    ->set_work_age(array("전체", "12세", "15세"))
    ->get_work();

    if(!$work["work_id"]){
        return "등록불가한 대표작품입니다.";

    }
  
    return "";
}

/************************************************************************************************************************
   회원 소개 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_introduce($user_introduce, $is_required){
    global $pave_config, $user_config;
    $reg_user_introduce = pave_sanitize_strip_tag($user_introduce);

    if(!$reg_user_introduce){
        if(!$is_required){
            return "";
        }
        return "소개를 등록해주세요.";
    }

    
    if (mb_strlen($reg_user_introduce, "UTF-8") > $user_config["user_introduce_max_len"]){
        return "소개를 ".$user_config["user_introduce_max_len"]."자로 이내로 입력해 주세요.";
    }
 

    $is_slang = false;
    for ($i=0; $i < count($pave_config["pave_slang_word_list"]); $i++) {
        $str = $pave_config["pave_slang_word_list"][$i];

        $pos = stripos($reg_user_introduce, $str);
        if ($pos !== false) {
            $is_slang = true;
            break;
        }
    }

    if($is_slang){
        return "소개에 비속어를 사용할 수 없습니다.";
    }

    return "";
}

/************************************************************************************************************************
   회원 SNS 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_sns($user_sns){
    $reg_user_sns = pave_sanitize_strip_tag($user_sns);

    if(!pave_is_array($reg_user_sns)){
        return "비정상적인 오류 입니다.";
    }

    return "";
}

/************************************************************************************************************************
   회원 정산은행 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_bank_name($user_bank_name, $is_required = true){
    global $user_config;
    $user_bank_name = pave_sanitize_strip_tag($user_bank_name);

    if($user_bank_name == ""){
        if($is_required){
            return "정산은행을 입력해주세요.";
        }else{
            return "";
        }
    }

    if(!array_key_exists($user_bank_name, $user_config["user_bank_list"])){
        return "정산은행을 올바르게 입력해주세요.";
    }

    return "";
}

/************************************************************************************************************************
   회원 정산은행 예금주 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_bank_owner($user_bank_owner, $is_required = true){
    $user_bank_owner = pave_sanitize_strip_tag($user_bank_owner);

    if($user_bank_owner == ""){
        if($is_required){
            return "정산은행 예금주를 입력해주세요.";
        }else{
            return "";
        }

    }

    return "";
}

/************************************************************************************************************************
   회원 정산은행 계좌번호 검사 함수 
************************************************************************************************************************/
function sanitize_reg_user_bank_number($user_bank_number, $is_required = true){
    $user_bank_number = pave_sanitize_strip_tag($user_bank_number);

    if($user_bank_number == ""){
        if($is_required){
            return "정산은행 계좌번호를 입력해주세요.";
        }else{
            return "";
        }

    }

    return "";
}
?>