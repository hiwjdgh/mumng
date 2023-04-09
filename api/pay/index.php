<?php
include_once(PAVE_API_PATH."/pay/_common.php");

switch ($request[2]) {
    case 'delete':
        include_once(PAVE_API_PATH."/pay/pay_delete.php");
        break;
    case 'create':
        include_once(PAVE_API_PATH."/pay/pay_create.php");
        break;
    case 'check':
        include_once(PAVE_API_PATH."/pay/pay_check.php");
        break;
    case 'form':
        include_once(PAVE_API_PATH."/pay/pay_form.php");
        break;
    case 'cancel':
        include_once(PAVE_API_PATH."/pay/pay_cancel.php");
        break;
    case 'detail':
        include_once(PAVE_API_PATH."/pay/pay_detail.php");
        break;
    case "creation":
        include_once(PAVE_API_PATH."/pay/pay_creation.php");
        break;
}
?>