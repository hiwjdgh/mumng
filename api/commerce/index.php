<?php
include_once(PAVE_API_PATH."/commerce/_common.php");
switch ($request[2]) {
    case 'reg':
        include_once(PAVE_API_PATH."/commerce/reg.php");
        break;
    case 'calc':
        include_once(PAVE_API_PATH."/commerce/calc.php");
        break;
}
?>