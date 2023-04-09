<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

$user_email             = pave_input_sanitize($user_email);
$user_bank_name              = pave_input_sanitize($user_bank_name);
$user_bank_number       = pave_input_sanitize($user_bank_number);
$user_bank_owner        = pave_input_sanitize($user_bank_owner);
$user_bsns_state        = pave_input_sanitize($user_bsns_state);
$user_bsns_owner        = pave_input_sanitize($user_bsns_owner);
$user_bsns_name         = pave_input_sanitize($user_bsns_name);
$user_bsns_number       = pave_input_sanitize($user_bsns_number);
$commerce_agree       = pave_input_sanitize($commerce_agree);


//이메일 검사
if($msg = sanitize_reg_user_email($user_email, true, "", true)){
    die(return_json(null, "fail", $msg));
}

//은행 검사
if($msg = sanitize_reg_user_bank_name($user_bank_name, true)){
   die(return_json(null, "fail", $msg));
}

//계좌번호 검사
if($msg = sanitize_reg_user_bank_number($user_bank_number, true)){
   die(return_json(null, "fail", $msg));
}

//예금주 검사
if($msg = sanitize_reg_user_bank_owner($user_bank_owner, true)){
   die(return_json(null, "fail", $msg));
}

if($user_bsns_state){
    //대표자 검사
    if($msg = sanitize_reg_bsns_owner($user_bsns_owner, true)){
       die(return_json(null, "fail", $msg));
    }
    
    //상호명 검사
    if($msg = sanitize_reg_bsns_name($user_bsns_name, true)){
       die(return_json(null, "fail", $msg));
    }
    
    //사업자번호 검사
    if($msg = sanitize_reg_user_bsns_num($user_bsns_number, true, "", true)){
       die(return_json(null, "fail", $msg));
    }
}else{
    $user_bsns_owner = "";
    $user_bsns_name = "";
    $user_bsns_number = "";
}

if(!$commerce_agree){
    die(return_json(null, "fail", "커머스 이용약관에 동의해주세요."));
}



//만약 현재 이벤트 진행중이라면 바꿔야함
$commerce_config = $config_obj->get_commerce_config("C7");


//커머스 등록
$commerce = array(
    "user_no"                   => $pave_user["user_no"],
    "user_commerce_grd"         => $commerce_config["commerce_id"],
    "user_commerce_fee"         => $commerce_config["commerce_fee"],
    "user_commerce_score"       => 0,
    "user_commerce_start_dt"    => PAVE_TIME_YMDHIS,
    "user_commerce_insert_dt"   => PAVE_TIME_YMDHIS,
    "user_commerce_insert_ip"   => PAVE_USER_IP,
    "user_commerce_update_dt"   => PAVE_TIME_YMDHIS,
    "user_commerce_update_ip"   => PAVE_USER_IP
);

$result = pave_insert("pave_user_commerce", $commerce);

//은행 등록
$bank = array(
    "user_no"               => $pave_user["user_no"],
    "user_bank_name"        => $user_bank_name,
    "user_bank_number"      => $user_bank_number,
    "user_bank_owner"       => $user_bank_owner,
    "user_bank_default"     => 1,
    "user_bank_insert_dt"   => PAVE_TIME_YMDHIS,
    "user_bank_insert_ip"   => PAVE_USER_IP,
    "user_bank_update_dt"   => PAVE_TIME_YMDHIS,
    "user_bank_update_ip"   => PAVE_USER_IP
);

$result = pave_insert("pave_user_bank", $bank);


//사업자 등록
if($user_bsns_state){
    $bsns = array(
        "user_no"               => $pave_user["user_no"],
        "user_bsns_owner"       => $user_bsns_owner,
        "user_bsns_name"        => $user_bsns_name,
        "user_bsns_number"      => $user_bsns_number,
        "user_bsns_insert_dt"   => PAVE_TIME_YMDHIS,
        "user_bsns_insert_ip"   => PAVE_USER_IP,
        "user_bsns_update_dt"   => PAVE_TIME_YMDHIS,
        "user_bsns_update_ip"   => PAVE_USER_IP
    );
    
    $result = pave_insert("pave_user_bsns", $bsns);

}

//회원 커머스 동의 등록
$commerce_agree = array(
    "user_no"                => $pave_user["user_no"],
    "user_agree_type"        => "commerce",
    "user_agree_state"       => 1,
    "user_agree_insert_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_insert_ip"   => PAVE_USER_IP,
    "user_agree_update_dt"   => PAVE_TIME_YMDHIS,
    "user_agree_update_ip"   => PAVE_USER_IP
);
$result = pave_insert("pave_user_agree", $commerce_agree);

//회원 커머스 업데이트
$update = array(
    "user_email" => $user_email,
    "user_commerce_state" => "1",
    "user_bsns_state" => $user_bsns_state,
    "user_bank_state" => "1",
    "user_update_dt" => PAVE_TIME_YMDHIS,
    "user_update_ip" => PAVE_USER_IP
);
pave_update("pave_user", $update, "user_no = '{$pave_user["user_no"]}'");


/* //커머스등급변경 알림
$notify_obj = new Notification();
$notify_obj->send_notify("mumng", $pave_user["user_id"], "notify_commerce_grade");
 */
die(return_json(null, "success"));
?>