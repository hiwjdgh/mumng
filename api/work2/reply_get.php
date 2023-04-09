<?php
switch ($request[3]) {
    case "list":
        include_once(PAVE_API_PATH."/work2/reply_get_list.php");
        break;
    case "detail":
        include_once(PAVE_API_PATH."/work2/reply_get_detail.php");
        break;
    default:
        die(return_json(null, "fail", "잘못된 요청입니다."));
        break;
}
?>