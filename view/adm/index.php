<?php
include_once(PAVE_ADM_PATH."/_common.php");
switch ($request[1]) {
    case "home":
        include_once(PAVE_ADM_PATH."/home.php");
        break;
    case "config":
        include_once(PAVE_ADM_PATH."/config.php");
        break;
    case "help":
        include_once(PAVE_ADM_PATH."/help.php");
        break;
    case "commerce":
        include_once(PAVE_ADM_PATH."/commerce.php");
        break;
    case "user":
        include_once(PAVE_ADM_PATH."/user.php");
        break;
    case "test":
        include_once(PAVE_ADM_PATH."/test.php");
        break;
}
?>