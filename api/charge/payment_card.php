<?php
switch ($request[3]) {
    case 'create':
        include_once(PAVE_API_PATH."/charge/payment_card_create.php");
        break;
    case 'delete':
        include_once(PAVE_API_PATH."/charge/payment_card_delete.php");
        break;
}
?>