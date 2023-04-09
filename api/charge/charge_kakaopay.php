<?php
switch ($request[3]) {
    case 'cancel':
        include_once(PAVE_API_PATH."/charge/charge_kakaopay_cancel.php");
        break;
}
?>