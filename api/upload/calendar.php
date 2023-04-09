<?php
switch ($request[3]) {
    case 'work':
        include_once(PAVE_API_PATH."/upload/calendar_work.php");
        break;
    case 'popup':
        include_once(PAVE_API_PATH."/upload/calendar_popup.php");
        break;
    case 'memo':
        include_once(PAVE_API_PATH."/upload/calendar_memo.php");
        break;
}
?>