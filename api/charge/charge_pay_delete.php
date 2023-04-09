<?php
$rcpt_id = pave_input_sanitize($rcpt_id);

$pay_obj = new Pay();
$pay = $pay_obj->set_pay_id($pay_id)
->set_user_no($pave_user["user_no"])
->set_pay_display(1)
->get_pay();


if(!$pay["pay_id"]){
    die(return_json(null, "fail", "구매내역 삭제에 실패했습니다.\\n사유 : 구매내역을 찾을 수 없습니다."));
}
pave_update("pave_epsd_pay", array("pay_display" => 0), "pay_id = '{$pay["pay_id"]}'");

die(return_json(null, "success"));
?>