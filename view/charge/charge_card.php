<?php
switch ($request[3]) {
    case "success":
        include_once(PAVE_CHARGE_PATH."/charge_card_success.php");
        break;
    case "fail":
        include_once(PAVE_CHARGE_PATH."/charge_card_fail.php");
        break;
    case "billing":
        include_once(PAVE_CHARGE_PATH."/charge_card_billing.php");
        break;
}
?>