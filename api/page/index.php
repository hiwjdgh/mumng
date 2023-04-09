<?php
include_once(PAVE_API_PATH."/page/_common.php");

switch ($request[2]) {
    case 'card':
        include_once(PAVE_API_PATH."/page/page_card.php");
        break;
    case "get_list":
        include_once(PAVE_API_PATH."/page/get_list.php");
        break;
    case "share_change":
        include_once(PAVE_API_PATH."/page/share_change.php");
        break;
}
?>