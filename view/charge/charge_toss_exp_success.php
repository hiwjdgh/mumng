<?php
//결제 영수증 가져오기
$receipt_obj = new Receipt();

$receipt = $receipt_obj->set_rcpt_id($orderId)->set_user_no($pave_user["user_no"])->get_receipt();

//결제 영수증 오류
if(!$receipt["rcpt_id"]){
    alert("결제에 실패했습니다.\\n사유 : 결제 영수증을 찾을 수 없습니다.");
}

//결제 상품 오류
if(!$receipt["item"]["it_no"]){
    pave_update("pave_receipt", array("rcpt_status" => "payment_fail"), "rcpt_id = '{$receipt["rcpt_id"]}'");
    alert("결제에 실패했습니다.\\n사유 : 상품을 찾을 수 없습니다.");
}

//결제 금액 검사
if($receipt["item"]["it_real_price"] != $amount){
    pave_update("pave_receipt", array("rcpt_status" => "payment_fail"), "rcpt_id = '{$receipt["rcpt_id"]}'");
    alert("결제에 실패했습니다.\\n사유 : 상품 정보에 오류가 있습니다.");
}

//일반 결제 요청
$curl = Payment::toss_payment($paymentKey, $orderId, $amount);
$response = curl_exec($curl);
$response = json_decode($response, true);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

//toss 결제 api 오류
if($http_code != 200){
    pave_update("pave_receipt", array("rcpt_status" => "payment_fail"), "rcpt_id = '{$receipt["rcpt_id"]}'");
    alert("결제에 실패했습니다.\\n사유 : {$response["message"]}");
}

//결제 상품이 EXP 상품인 경우
if($receipt["item"]["it_type"] == "exp"){
    //결제 EXP 대기 상태 발급
    $exp = array(
        "user_no" => $pave_user["user_no"],
        "exp_type" => "payment",
        "exp_amount" => $receipt["item"]["it_exp"],
        "exp_state" => "success_wait",
        "exp_expire_dt" => $charge_config["charge_payment_expire_dt"],
        "exp_insert_dt" => PAVE_TIME_YMDHIS,
        "exp_insert_ip" => PAVE_USER_IP
    );

    pave_insert("pave_exp", $exp);

    $exp_no = pave_insert_id();
}else{ 
    $exp_no = 0;
}


//결제 영수증 수정
$update = array(
    "exp_no" => $exp_no,
    "rcpt_type" => $receipt["item"]["it_type"],
    "rcpt_payment_type" => strtolower($response["type"]),
    "rcpt_trsn_id" => $response["transactionKey"],
    "rcpt_customer" => $pave_user["user_name"],
    "rcpt_payment_id" => $response["paymentKey"],
    "rcpt_card" => json_encode($response["card"], JSON_UNESCAPED_UNICODE),
    "rcpt_virtual" => json_encode($response["virtualAccount"],JSON_UNESCAPED_UNICODE),
    "rcpt_cash" => json_encode($response["cashReceipt"],JSON_UNESCAPED_UNICODE),
    "rcpt_cp" => json_encode($response["mobilePhone"],JSON_UNESCAPED_UNICODE),
    "rcpt_virtual_id" => $response["secret"],
    "rcpt_name" => $response["orderName"],
    "rcpt_settle_case" => $response["method"],
    "rcpt_price" => $response["totalAmount"],
    "rcpt_cancel_price" => $response["balanceAmount"],
    "rcpt_supllied_price" => $response["suppliedAmount"],
    "rcpt_vat_price" => $response["vat"],
    "rcpt_mobile" => Visit::is_mobile(),
    "rcpt_status" => "payment_wait",
    "rcpt_success_dt" => PAVE_TIME_YMDHIS
);

pave_update("pave_receipt", $update, "rcpt_id = '{$receipt["rcpt_id"]}'");

if($receipt["item"]["it_type"] == "exp"){
    alert("결제가 완료되었습니다.", get_url(PAVE_CHARGE_URL, "receipt/list/1"));
}else{

}
?>