<?php
switch ($request[3]) {
    case 'delete':
        include_once(PAVE_API_PATH."/charge/payment_receipt_delete.php");
        break;
}
?>