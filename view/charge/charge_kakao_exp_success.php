<?php
no_refresh("카카오 결제 완료");
$rcpt_id = pave_input_sanitize($request[3]);
$pg_token = pave_input_sanitize($pg_token);


//결제 영수증 가져오기
$receipt_obj = new Receipt();
$receipt = $receipt_obj->set_rcpt_id($rcpt_id)->set_user_no($pave_user["user_no"])->get_receipt();



//결제 영수증 오류
if(!$receipt["rcpt_id"]){
    alert("결제에 실패했습니다.\\n사유 : 결제 영수증을 찾을 수 없습니다.", get_url(PAVE_CHARGE_URL, "payment"));
}

//결제 상품 오류
if(!$receipt["item"]["it_no"]){
    pave_update("pave_receipt", array("rcpt_status" => "payment_fail"), "rcpt_id = '{$receipt["rcpt_id"]}'");
    alert("결제에 실패했습니다.\\n사유 : 상품을 찾을 수 없습니다.", get_url(PAVE_CHARGE_URL, "payment"));
}

if(!$pg_token){
    pave_update("pave_receipt", array("rcpt_status" => "payment_fail"), "rcpt_id = '{$receipt["rcpt_id"]}'");
    alert("결제에 실패했습니다.\\n사유 : 카카오결제 토큰이 없습니다.", get_url(PAVE_CHARGE_URL, "payment"));
}

//카카오 결제 요청
$curl = Payment::kakao_payment($receipt, $pg_token);
$response = curl_exec($curl);
$response = json_decode($response, true);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

//카카오 결제 api 오류
if($http_code != 200){
    pave_update("pave_receipt", array("rcpt_status" => "payment_fail"), "rcpt_id = '{$receipt["rcpt_id"]}'");
    alert("결제에 실패했습니다.\\n사유 : {$response["msg"]}", get_url(PAVE_CHARGE_URL, "payment"));
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

$update = array(
    "exp_no" => $exp_no,
    "rcpt_type" => $receipt["item"]["it_type"],
    "rcpt_payment_type" => "kakaopay",
    "rcpt_trsn_id" => $response["aid"],
    "rcpt_customer" => $pave_user["user_name"],
    "rcpt_payment_id" => $response["tid"],
    "rcpt_card" => json_encode($response["card_info"], JSON_UNESCAPED_UNICODE),
    "rcpt_name" => $response["item_name"],
    "rcpt_settle_case" => "카카오페이",
    "rcpt_price" => $response["amount"]["total"],
    "rcpt_cancel_price" => $response["amount"]["total"],
    "rcpt_supllied_price" => $response["amount"]["total"] - $response["amount"]["vat"],
    "rcpt_vat_price" => $response["amount"]["vat"],
    "rcpt_mobile" => Visit::is_mobile(),
    "rcpt_status" => "payment_wait",
    "rcpt_success_dt" => PAVE_TIME_YMDHIS
);
pave_update("pave_receipt", $update, "rcpt_id = '{$receipt["rcpt_id"]}'");


if($receipt["item"]["it_type"] == "exp"){
    //결제 영수증 다시 가져오기
    $receipt_obj = new Receipt();
    $receipt = $receipt_obj->set_rcpt_id($rcpt_id)->set_user_no($pave_user["user_no"])->get_receipt();
    //EXP 즉시 발급(빌링결제)
    Charge::charge_payment_exp($receipt);
    alert("결제가 완료되었습니다.", get_url(PAVE_CHARGE_URL, "receipt/list/1"));
}else{

}
?>