<?php
switch ($request[3]) {
    case 'delete':
        include_once(PAVE_API_PATH."/charge/charge_pay_delete.php");
        break;
}
?>