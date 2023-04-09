<?php
include_once(PAVE_API_PATH."/charge/_common.php");
switch ($request[2]) {
    case 'card':
        include_once(PAVE_API_PATH."/charge/payment_card.php");
        break;
    case 'receipt':
        include_once(PAVE_API_PATH."/charge/payment_receipt.php");
        break;
    case 'toss':
        include_once(PAVE_API_PATH."/charge/charge_toss.php");
        break;
    case 'kakaopay':
        include_once(PAVE_API_PATH."/charge/charge_kakaopay.php");
        break;
    case 'pay':
        include_once(PAVE_API_PATH."/charge/charge_pay.php");
        break;
}
?>