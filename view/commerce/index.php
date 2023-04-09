<?php
include_once(PAVE_COMMERCE_PATH."/_common.php");

switch ($request[1]) {
    case "home":
        include_once(PAVE_COMMERCE_PATH."/home.php");
        break;
    case "profit":
        include_once(PAVE_COMMERCE_PATH."/profit.php");
        break;
    case "calc":
        include_once(PAVE_COMMERCE_PATH."/calc.php");
        break;
    case "profile":
        include_once(PAVE_COMMERCE_PATH."/profile.php");
        break;
}
?>