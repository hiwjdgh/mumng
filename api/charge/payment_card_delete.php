<?php
$card_no = pave_input_sanitize($card_no);


//간편카드 가져오기
$is_card_exist = false;
$billing_card = null;
foreach ($pave_user["user_card"] as $i => $card) {
    if($card["card_no"] == $card_no){
        $is_card_exist = true;
        $billing_card = $card;
        break;
    }
}

if(!$is_card_exist){
    die(return_json(null, "fail", "간편카드 삭제에 실패했습니다.\\n사유 : 간편카드를 찾을 수 없습니다."));
}

pave_delete("pave_user_card", array("card_no" => $billing_card["card_no"]));

die(return_json(null, "success"));
?>