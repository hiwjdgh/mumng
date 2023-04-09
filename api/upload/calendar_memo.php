<?php
switch ($request[4]) {
    case 'update':
        include_once(PAVE_API_PATH."/upload/calendar_memo_update.php");
        break;
    case 'load':
        include_once(PAVE_API_PATH."/upload/calendar_memo_load.php");
        break;
}
?>