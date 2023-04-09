<?php
switch ($request[2]) {
    case "list":
        include_once(PAVE_API_PATH."/work2/work_get_list.php");
        break;
    case "detail":
        include_once(PAVE_API_PATH."/work2/work_get_detail.php");
        break;
    case "epsd":
        include_once(PAVE_API_PATH."/work2/epsd_get.php");
        break;
    case "comment":
        include_once(PAVE_API_PATH."/work2/comment_get.php");
        break;
    case "reply":
        include_once(PAVE_API_PATH."/work2/reply_get.php");
        break;
    default:
        die(return_json(null, "fail", "잘못된 요청입니다."));
        break;
}
?>