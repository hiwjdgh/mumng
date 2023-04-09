<?php
switch ($request[2]) {
    case "load":
        include_once(PAVE_CHARGE_PATH."/charge_kakao_exp_load.php");
        break;
    case "success":
        include_once(PAVE_CHARGE_PATH."/charge_kakao_exp_success.php");
        break;
    case "fail":
        include_once(PAVE_CHARGE_PATH."/charge_kakao_exp_fail.php");
        break;
    case "cancel":
        include_once(PAVE_CHARGE_PATH."/charge_kakao_exp_cancel.php");
        break;
    }
?>