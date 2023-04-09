<?php
include_once(PAVE_SIGHT_PATH."/_common.php");

switch ($request[1]) {
    case "list":
        include_once(PAVE_SIGHT_PATH."/sight_list.php");
        break;
    case "detail":
        include_once(PAVE_SIGHT_PATH."/sight_detail.php");
        break;
}
?>