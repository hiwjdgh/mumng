<?php
$pay_id = pave_input_sanitize($request[3]);

$pay_obj->set_pay_id($pay_id);
$pay_obj->set_pay_user_id($pave_user["user_id"]);
$pay_obj->set_pay_page(0);
$pay = $pay_obj->get_pay_list()[0];


if(!$pay["pay_id"]){
    alert("구매내역 삭제에 실패했습니다.\\n사유 : 구매내역을 찾을 수 없습니다.", get_url(PAVE_CHARGE_URL, "pay/list/1"));
}

pave_update("pave_epsd_pay", array("pay_display" => 0), "pay_id = '{$pay["pay_id"]}'");

alert("구매내역이 삭제되었습니다.", get_url(PAVE_CHARGE_URL, "pay/list/1"));
?>