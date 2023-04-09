<?php
include_once(PAVE_CERT_PATH."/_common.php");
switch ($request[1]) {
    case "form":
        include_once(PAVE_CERT_PATH."/form.php");
        break;
    case "success":
        include_once(PAVE_CERT_PATH."/success.php");
        break;
}
?>