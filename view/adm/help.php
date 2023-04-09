<?php
define("ADM_HELP", true);

//도움말 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.help.php'); 

switch ($request[2]) {
    case "group":
        include_once(PAVE_ADM_PATH."/help_group.php");
        break;
    case "bo":
        include_once(PAVE_ADM_PATH."/help_bo.php");
        break;
    case "bd":
        include_once(PAVE_ADM_PATH."/help_bd.php");
        break;
}
?>