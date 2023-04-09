<?php
switch ($request[3]) {
    case "detail":
        include_once(PAVE_API_PATH."/work/epsd_detail.php");
        break;
    case "list":
        include_once(PAVE_API_PATH."/work/epsd_list.php");
        break;
    case 'comment':
        include_once(PAVE_API_PATH."/work/comment.php");
        break;
}
?>