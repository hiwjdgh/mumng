<?php
$rcpt_id = pave_input_sanitize($request[3]);

//결제 영수증 가져오기
$receipt_obj = new Receipt();
$receipt = $receipt_obj->set_rcpt_id($rcpt_id)->set_user_no($pave_user["user_no"])->get_receipt();


pave_update("pave_receipt", array("rcpt_status" => "payment_cancel"), "rcpt_id = '{$receipt["rcpt_id"]}'");
url_move(get_url(PAVE_CHARGE_URL, "payment"));
?>