<?php
include_once(PAVE_NOTIFY_PATH."/_common.php");

switch ($request[1]) {
    case "list":
        include_once(PAVE_NOTIFY_PATH."/notify_list.php");
        break;
}
?>