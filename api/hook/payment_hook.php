<?php
$charge_config = $config_obj->get_charge_config();
$payment_config = $config_obj->get_payment_config();

$postData = file_get_contents('php://input');
$result = json_decode($postData, true);


$payment_status = $result["data"]["status"];
$rcpt_payment_id = $result["data"]["paymentKey"];
$rcpt_id = $result["data"]["orderId"];

$receipt_obj = new Receipt();
$receipt = $receipt_obj->set_rcpt_id($rcpt_id)->get_receipt();

if($payment_status == "DONE"){
    //결제 상품이 EXP 상품인 경우
    if($receipt["item"]["it_type"] == "exp"){
        Charge::charge_payment_exp($receipt);
    }else{ 
    }
}else if($payment_status == "CANCELED"){
    //결제 취소 상품이 EXP 상품인 경우
    if($receipt["item"]["it_type"] == "exp"){
        Charge::cancel_payment_exp($receipt);
    }else{ 
    }
}
?>