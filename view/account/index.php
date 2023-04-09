<?php
include_once(PAVE_ACCOUNT_PATH."/_common.php");
$pave_site = $config_obj->get_site($request[0], $request[1]);

switch ($request[1]) {
    case "reg":
        include_once(PAVE_ACCOUNT_PATH."/reg.php");
        break;
    case "reg2":
        include_once(PAVE_ACCOUNT_PATH."/reg2.php");
        break;
    case "find":
        include_once(PAVE_ACCOUNT_PATH."/find.php");
        break;
    case "login":
        include_once(PAVE_ACCOUNT_PATH."/login.php");
        break;
}
?>