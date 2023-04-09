<?php
include_once(PAVE_CHARGE_PATH."/_common.php");
switch ($request[1]) {
    case "payment":
        define("_CHARGE_PAYMENT_", true);
        include_once(PAVE_CHARGE_PATH."/charge_payment.php");
        break;
    case "receipt":
        define("_CHARGE_RECEIPT_", true);
        include_once(PAVE_CHARGE_PATH."/charge_receipt.php");
        break;
    case "pay":
        define("_CHARGE_PAY_", true);
        include_once(PAVE_CHARGE_PATH."/charge_pay.php");
        break;
    case "toss":
        include_once(PAVE_CHARGE_PATH."/charge_toss.php");
        break;
    case "kakaopay":
        include_once(PAVE_CHARGE_PATH."/charge_kakaopay.php");
        break;
}
?>