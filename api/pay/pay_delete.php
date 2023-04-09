<?php
if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

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