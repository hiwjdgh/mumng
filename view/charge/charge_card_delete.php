<?php
$card_id = pave_input_sanitize($request[3]);

//간편카드 가져오기
$card = $payment_obj->get_user_card_list($card_id)[0];

//간편카드 오류
if(!$card["card_id"]){
    alert("간편카드 삭제에 실패했습니다.\\n사유 : 간편카드를 찾을 수 없습니다.", get_url(PAVE_CHARGE_URL, "payment"));
}

//커머스 자동결제 카드 검사
$billing_list = $payment_obj->get_commerce_billing_list();
if(in_array($card["card_id"], array_column($billing_list, "card_id"))){
    confirm("간편카드 삭제에 실패했습니다.\\n사유 : 커머스 자동결제로 등록된 카드입니다. \\n커머스 페이지로 이동 하시겠습니까?", get_url(PAVE_COMMERCE_URL, "home"), get_url(PAVE_CHARGE_URL, "payment"));
}

pave_delete("pave_user_card", array("card_id" => $card["card_id"]));

alert("간편카드가 삭제 되었습니다.", get_url(PAVE_CHARGE_URL,"payment"));
?>