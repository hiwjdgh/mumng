<?php
include_once(PAVE_LEGAL_PATH."/_common.php");

switch ($request[1]) {
    case "service":
        define("__SERVICE__", true);
        include_once(PAVE_LEGAL_PATH."/service.php");
        break;
    case "privacy":
        define("__PRIVACY__", true);
        include_once(PAVE_LEGAL_PATH."/privacy.php");
        break;
    case "charge":
        define("__CHARGE__", true);
        include_once(PAVE_LEGAL_PATH."/charge.php");
        break;
    case "commerce":
        define("__COMMERCE__", true);
        include_once(PAVE_LEGAL_PATH."/commerce.php");
        break;
    default:
        define("__SERVICE__", true);
        include_once(PAVE_LEGAL_PATH."/service.php");
        break;
}
?>