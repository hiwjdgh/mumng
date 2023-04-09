<?php
include_once(PAVE_API_PATH."/cert/_common.php");

switch ($request[2]) {
    case 'check':
        include_once(PAVE_API_PATH."/cert/check.php");
        break;
}
?>