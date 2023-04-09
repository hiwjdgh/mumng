<?php
$rcpt_id                    = pave_input_sanitize($rcpt_id);
$rcpt_cancel_reason         = pave_input_sanitize($rcpt_cancel_reason);
$rcpt_cancel_reason_text    = pave_input_sanitize($rcpt_cancel_reason_text);
$rcpt_refund_bank           = pave_input_sanitize($rcpt_refund_bank);
$rcpt_refund_account_number = pave_input_sanitize($rcpt_refund_account_number);
$rcpt_refund_bank_owner     = pave_input_sanitize($rcpt_refund_bank_owner);


$charge_config = $config_obj->get_charge_config();
$payment_config = $config_obj->get_payment_config();

//결제 영수증 가져오기
$receipt_obj = new Receipt();
$receipt = $receipt_obj->set_user_no($pave_user["user_no"])
->set_rcpt_id($rcpt_id)
->set_rcpt_type("exp")
->set_rcpt_status("payment_complete")
->get_receipt();

//결제 영수증 오류
if(!$receipt["rcpt_id"]){
    die(return_json(null, "fail", "결제취소에 실패했습니다.\n사유 : 결제내역을 찾을 수 없습니다."));
}

//취소 가능여부 확인
if(!$receipt["is_cancelable"]){
    if($receipt["item"]["it_type"] == "exp"){
        die(return_json(null, "fail", "결제취소에 실패했습니다.\n사유 : 취소할 수 없습니다."));
    }else{
    }
}

//카카오 결제 취소 요청
$curl = Payment::kakao_payment_cancel($receipt);
$response = curl_exec($curl);
$response = json_decode($response, true);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

//카카오 결제 api 오류
if($http_code != 200){
    if($receipt["item"]["it_type"] == "exp"){
        die(return_json(null, "fail", "결제취소에 실패했습니다.\n사유[{$response["code"]}] : {$response["msg"]}"));
    }else{
    }
    
}

//영수증 상태 수정
$update = array(
    "rcpt_status" => "cancel_wait",
    "rcpt_cancel_reason" => $rcpt_cancel_reason,
    "rcpt_cancel_reason_text" => $rcpt_cancel_reason_text,
    "rcpt_cancel" => json_encode($response["canceled_amount"], JSON_UNESCAPED_UNICODE),
    "rcpt_cancel_dt" => PAVE_TIME_YMDHIS
);
  
pave_update("pave_receipt", $update, "rcpt_id = '{$receipt["rcpt_id"]}'");



if($receipt["item"]["it_type"] == "exp"){
    //EXP 상태 즉시 수정
    Charge::cancel_payment_exp($receipt);
    die(return_json(null, "success"));
}else{

}
?>