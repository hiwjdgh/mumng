<?php
include_once(PAVE_USER_PATH."/_common.php");
$pave_site = $config_obj->get_site($request[0], $request[1]);

switch ($request[1]) {
    case "wallet":
        include_once(PAVE_USER_PATH."/wallet.php");
        break;
    case "notify":
        include_once(PAVE_USER_PATH."/notify.php");
        break;
    case "creation":
        include_once(PAVE_USER_PATH."/creation.php");
        break;
}
?>