<?php
//결제 라이브러리
require_once(PAVE_LIB_PAYMENT_PATH.'/payment.lib.php');
$payment_cf = Payment::get_payment_cf();
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_payment_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_payment_update.php");
        break;
}
?>