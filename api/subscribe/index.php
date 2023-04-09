<?php
switch ($request[2]) {
    case 'work':
        include_once(PAVE_API_PATH."/subscribe/subscribe_work.php");
        break;
    case 'notify':
        include_once(PAVE_API_PATH."/subscribe/subscribe_notify.php");
        break;
}
?>