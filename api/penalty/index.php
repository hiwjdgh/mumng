<?php
include_once(PAVE_API_PATH."/penalty/_common.php");

switch ($request[2]) {
    case 'create':
        include_once(PAVE_API_PATH."/penalty/penalty_create.php");
        break;
}
?>