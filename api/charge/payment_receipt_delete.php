<?php
$rcpt_id = pave_input_sanitize($rcpt_id);

$receipt_obj = new Receipt();
$receipt = $receipt_obj->set_user_no($pave_user["user_no"])
->set_rcpt_id($rcpt_id)
->set_rcpt_type("exp")
->set_rcpt_status(array("payment_wait","payment_complete", "cancel", "cancel_wait","refund_wait","refund_complete"))
->get_receipt();


if(!$receipt["rcpt_id"]){
    die(return_json(null, "fail", "결제내역 삭제에 실패했습니다.\\n사유 : 결제내역을 찾을 수 없습니다."));
}
pave_update("pave_receipt", array("rcpt_display" => 0), "rcpt_id = '{$receipt["rcpt_id"]}'");

die(return_json(null, "success"));

?>