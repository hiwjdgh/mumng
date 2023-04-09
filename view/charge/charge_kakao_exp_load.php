<?php
$rcpt_id = pave_input_sanitize($rcpt_id);


//결제 영수증 가져오기
$receipt_obj = new Receipt();

$receipt = $receipt_obj->set_rcpt_id($rcpt_id)->set_user_no($pave_user["user_no"])->get_receipt();


//결제 영수증 오류
if(!$receipt["rcpt_id"]){
    alert_close("결제에 실패했습니다.\\n사유 : 결제 영수증을 찾을 수 없습니다.");
}

//결제 상품 오류
if(!$receipt["item"]["it_no"]){
    pave_update("pave_receipt", array("rcpt_status" => "payment_fail"), "rcpt_id = '{$receipt["rcpt_id"]}'");
    alert_close("결제에 실패했습니다.\\n사유 : 상품을 찾을 수 없습니다.");
}

//카카오 결제 준비 요청
$curl = Payment::ready_kakao_payment($receipt);
$response = curl_exec($curl);
$response = json_decode($response, true);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

//카카오 결제 api 오류
if($http_code != 200){
    pave_update("pave_receipt", array("rcpt_status" => "payment_fail"), "rcpt_id = '{$receipt["rcpt_id"]}'");
    alert_close("결제에 실패했습니다.\\n사유[{$response["code"]}] : {$response["msg"]}");
}

pave_update("pave_receipt", array("rcpt_payment_id" => $response["tid"], "rcpt_payment_type" => "kakaopay"), "rcpt_id = '{$receipt["rcpt_id"]}'");

if($is_mobile){
    url_move($response["next_redirect_mobile_url"]);
}else{
    url_move($response["next_redirect_pc_url"]);
}
?>