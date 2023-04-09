<?php
switch ($request[2]) {
    case 'work':
        include_once(PAVE_API_PATH."/upload/work.php");
        break;
    case 'epsd':
        include_once(PAVE_API_PATH."/upload/epsd.php");
        break;
    case 'rest':
        include_once(PAVE_API_PATH."/upload/rest.php");
        break;
    case 'notice':
        include_once(PAVE_API_PATH."/upload/notice.php");
        break;
    case 'calendar':
        include_once(PAVE_API_PATH."/upload/calendar.php");
        break;
}
?>