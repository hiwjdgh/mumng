<?php
include_once(PAVE_API_PATH."/hook/_common.php");

switch ($request[2]) {
    case "payment":
        include_once(PAVE_API_PATH."/hook/payment_hook.php");
        break;
    default:
        die(return_json(null, "200", "비정상적인 접근입니다."));
        break;
}
?>