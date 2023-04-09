<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.");
}

$calc_id = pave_input_sanitize($calc_id);

//정산 EXP 검사
if($msg = sanitize_reg_user_calc_exp($calc_exp)){
    alert($msg);
}

//정산은행 검사
if($msg = sanitize_reg_user_bank_name($calc_bank)){
    alert($msg);
}

//정산은행 계좌번호 검사
if($msg = sanitize_reg_user_bank_number($calc_bank_number)){
    alert($msg);
}

//정산은행 예금주 검사
if($msg = sanitize_reg_user_bank_owner($calc_bank_owner)){
    alert($msg);
}

//사업자 검사
if($calc_bsns){
    //대표자명 검사
    if($msg = sanitize_reg_bsns_owner($calc_bsns_owner)){
        alert($msg);
    }

    //상호명 검사
    if($msg = sanitize_reg_bsns_name($calc_bsns_name)){
        alert($msg);
    }

    //사업자번호 검사
    if($msg = sanitize_reg_user_bsns_num($calc_bsns_number, false)){
        alert($msg);
    }

}else{
    $calc_bsns_owner = "";
    $calc_bsns_name = "";
    $calc_bsns_number = "";
}


if($calc_status == "calc_ready"){
    $calc_ready_dt = PAVE_TIME_YMDHIS;
    $calc_wait_dt = "";
    $calc_complete_dt = "";
    $calc_cancel_dt = "";
}else if($calc_status == "calc_wait"){
    $calc_ready_dt = PAVE_TIME_YMDHIS;
    $calc_wait_dt = PAVE_TIME_YMDHIS;
    $calc_complete_dt = "";
    $calc_cancel_dt = "";
}else if($calc_status == "calc_complete"){
    $calc_ready_dt = PAVE_TIME_YMDHIS;
    $calc_wait_dt = PAVE_TIME_YMDHIS;
    $calc_complete_dt = PAVE_TIME_YMDHIS;
    $calc_cancel_dt = "";
}else if($calc_status == "calc_cancel"){
    $calc_ready_dt = PAVE_TIME_YMDHIS;
    $calc_wait_dt = "";
    $calc_complete_dt = "";
    $calc_cancel_dt = PAVE_TIME_YMDHIS;
}

$commerce_calc = array(
    "user_id" => $user_id,
    "calc_status" => $calc_status,
    "calc_exp" => $calc_exp,
    "calc_real_price" => $calc_real_price,
    "calc_fee_price" => $calc_fee_price,
    "calc_tax_price" => $calc_tax_price,
    "calc_vat_price" => $calc_vat_price,
    "calc_bank" => $calc_bank,
    "calc_bank_number" => $calc_bank_number,
    "calc_bank_owner" => $calc_bank_owner,
    "calc_bsns" => $calc_bsns,
    "calc_bsns_owner" => $calc_bsns_owner,
    "calc_bsns_name" => $calc_bsns_name,
    "calc_bsns_number" => $calc_bsns_number,
    "calc_ready_dt" => $calc_ready_dt,
    "calc_wait_dt" => $calc_wait_dt,
    "calc_complete_dt" => $calc_complete_dt,
    "calc_cancel_dt" => $calc_cancel_dt,
    "calc_insert_dt" => PAVE_TIME_YMDHIS,
    "calc_insert_ip" => PAVE_USER_IP,
);

pave_insert("pave_commerce_calc", $commerce_calc);
?>
