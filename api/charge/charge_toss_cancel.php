<?php
$rcpt_id                    = pave_input_sanitize($rcpt_id);
$rcpt_cancel_reason         = pave_input_sanitize($rcpt_cancel_reason);
$rcpt_cancel_reason_text    = pave_input_sanitize($rcpt_cancel_reason_text);
$rcpt_refund_bank           = pave_input_sanitize($rcpt_refund_bank);
$rcpt_refund_account_number = pave_input_sanitize($rcpt_refund_account_number);
$rcpt_refund_bank_owner     = pave_input_sanitize($rcpt_refund_bank_owner);



$charge_config = $config_obj->get_charge_config();
$payment_config = $config_obj->get_payment_config();

$receipt_obj = new Receipt();
$receipt = $receipt_obj->set_user_no($pave_user["user_no"])
->set_rcpt_id($rcpt_id)
->set_rcpt_type("exp")
->set_rcpt_status("payment_complete")
->get_receipt();

//결제 영수증 오류
if(!$receipt["rcpt_id"]){
    die(return_json(null, "fail", "결제취소에 실패했습니다.\\n사유 : 결제내역을 찾을 수 없습니다."));
}

//환불은행 확인
if($receipt["rcpt_settle_case"] == "가상계좌"){
    if(!$payment_config["payment_virtual_bank_list"][$rcpt_refund_bank]){
        die(return_json(null, "fail", "결제취소에 실패했습니다.\\n사유 : 환불은행을 확인해주세요."));
    }

    if(!$rcpt_refund_account_number){
        die(return_json(null, "fail", "결제취소에 실패했습니다.\\n사유 : 환불계좌번호를 확인해주세요."));
    }

    if(!$rcpt_refund_bank_owner){
        die(return_json(null, "fail", "결제취소에 실패했습니다.\\n사유 : 예금주를 확인해주세요."));
    }
}

//취소 가능여부 확인
if(!$receipt["is_cancelable"]){
    if($receipt["item"]["it_type"] == "exp"){
        die(return_json(null, "fail", "결제취소에 실패했습니다.\\n사유 : 취소할 수 없습니다."));
    }else{

    }
}

//취소 데이터
$cancel_data = array(
    "cancelReason" => $rcpt_cancel_reason,
);

if($receipt["rcpt_settle_case"] == "가상계좌"){
    $cancel_data["refundReceiveAccount"] = array(
      "bank" => $rcpt_refund_bank,
      "accountNumber" => $rcpt_refund_account_number,
      "holderName" => $rcpt_refund_bank_owner
    );
}

//toss 결제 취소 요청
$curl = Payment::toss_payment_cancel($receipt, $cancel_data);
$response = curl_exec($curl);
$response = json_decode($response, true);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

//toss 결제 api 오류
if($http_code != 200){
    if($receipt["item"]["it_type"] == "exp"){
        die(return_json(null, "fail", "결제취소에 실패했습니다.\\n사유 : {$response["message"]}"));
    }else{

    }
}

//영수증 상태 수정
$update = array(
    "rcpt_status" => "cancel_wait",
    "rcpt_cancel_reason" => $rcpt_cancel_reason,
    "rcpt_cancel_reason_text" => $rcpt_cancel_reason_text,
    "rcpt_cancel" => json_encode($response["cancels"][0], JSON_UNESCAPED_UNICODE),
    "rcpt_cancel_dt" => PAVE_TIME_YMDHIS
);
  
if($receipt["rcpt_settle_case"] == "가상계좌"){
    $update["rcpt_refund_bank"] = $rcpt_refund_bank;
    $update["rcpt_refund_account_number"] = $rcpt_refund_account_number;
    $update["rcpt_refund_bank_owner"] = $rcpt_refund_bank_owner;
}
pave_update("pave_receipt", $update, "rcpt_id = '{$receipt["rcpt_id"]}'");



if($receipt["item"]["it_type"] == "exp"){
    //EXP 상태 수정
    pave_update("pave_exp", array("exp_state" => "cancel_wait"), "exp_no = '{$receipt["exp_no"]}'");

}else{

}
die(return_json(null, "success"));
?>