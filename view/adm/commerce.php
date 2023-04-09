<?php
define("ADM_COMMERCE", true);

//커머스 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.commerce.php");

switch ($request[2]) {
    case "calc":
        include_once(PAVE_ADM_PATH."/commerce_calc.php");
        break;
}
?>