<?php
no_refresh("간편 카드 등록 완료");

$customer_key = pave_input_sanitize($customerKey);
$auth_key = pave_input_sanitize($authKey);

//회원코드 검사
if($pave_user["user_code"] != $customerKey){
    alert("간편카드 등록에 실패했습니다. \\n사유 : 인증키가 일치하지않습니다.", get_url(PAVE_CHARGE_URL, "payment"));
}

//빌링키 요청
$curl = Payment::request_billing_key($auth_key, $customer_key);
$response = curl_exec($curl);
$response = json_decode($response, true);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

//toss 빌링키 api 오류
if($http_code != 200){
    alert("간편카드 등록에 실패했습니다. \\n사유 : {$response["message"]}", get_url(PAVE_CHARGE_URL, "payment"));
}

//카드 중복 검사
$sql = "SELECT EXISTS (SELECT 1 FROM pave_user_card WHERE user_no = '{$pave_user["user_no"]}' AND card_number = '{$response["cardNumber"]}') AS exist";
$row = pave_fetch($sql);
if ($row["exist"]){
    alert("간편카드 등록에 실패했습니다. \\n사유 : 이미 등록된 간편카드 입니다.", get_url(PAVE_CHARGE_URL, "payment"));
}

//카드 등록
$user_card = array(
    "user_no" => $pave_user["user_no"],
    "card_billing_key" => $response["billingKey"],
    "card_company" => $response["cardCompany"],
    "card_number" => $response["cardNumber"],
    "card_auth_dt" => Converter::display_time("Y-m-d H:i:s", $response["authenticatedAt"]),
    "card_insert_dt" => PAVE_TIME_YMDHIS,
    "card_insert_ip" => PAVE_USER_IP
);

pave_insert("pave_user_card", $user_card);

$card_id = pave_insert_id();

?>