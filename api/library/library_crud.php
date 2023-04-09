<?php
switch ($request[2]) {
    case 'latest':
        include_once(PAVE_API_PATH."/library/latest_delete.php");
        break;
}
?>