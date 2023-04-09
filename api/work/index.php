<?php
include_once(PAVE_API_PATH."/work/_common.php");

switch ($request[2]) {
    case "list":
        include_once(PAVE_API_PATH."/work/work_list.php");
        break;
    case "detail":
        include_once(PAVE_API_PATH."/work/work_detail.php");
        break;
    case 'epsd':
        include_once(PAVE_API_PATH."/work/epsd.php");
        break;
    case 'comment':
        include_once(PAVE_API_PATH."/work/comment.php");
        break;
    case 'reply':
        include_once(PAVE_API_PATH."/work/reply.php");
        break;
}
?>