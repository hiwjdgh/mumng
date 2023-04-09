<?php
switch ($request[2]) {
    case "success":
        include_once(PAVE_CHARGE_PATH."/charge_toss_exp_success.php");
        break;
    case "fail":
        include_once(PAVE_CHARGE_PATH."/charge_toss_exp_fail.php");
        break;
    case "card":
        include_once(PAVE_CHARGE_PATH."/charge_card.php");
        break;
}
?>