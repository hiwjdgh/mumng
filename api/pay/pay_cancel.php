<?php
$pay_id                     = pave_input_sanitize($pay_id);
$pay_cancel_reason          = pave_input_sanitize($pay_cancel_reason);
$pay_cancel_reason_text     = pave_input_sanitize($pay_cancel_reason_text);


if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

//구매 내역 가져오기
$pay_obj = new Pay();
$pay = $pay_obj->set_pay_id($pay_id)
->set_user_no($pave_user["user_no"])
->set_pay_status("success")
->set_pay_display(1)
->get_pay();

//구매 내역 오류
if(!$pay["pay_id"]){
    die(return_json(null, "fail","구매내역을 찾을 수 없습니다."));
}

if(!$pay["is_cancelable"]){
    die(return_json(null, "fail","구매 취소가 불가능합니다."));
}

//구매 취소사유 검사
if(!in_array($pay_cancel_reason, array_column($pay_config["pay_cancel_reason_list"], "cancel_key"))){
    die(return_json(null, "fail","구매 취소사유를 확인해주세요."));
}

if($pay_cancel_reason == "etc"){
    if($pay_cancel_reason_text == ""){
        die(return_json(null, "fail","구매 취소 기타사유를 확인해주세요."));
    }
}

//구매 취소
Pay::cancel_pay_epsd($pave_user, $pay, $pay_cancel_reason, $pay_cancel_reason_text);

die(return_json(null, "success"));
?>