<?php
switch ($request[2]) {
    case "list":
        include_once(PAVE_API_PATH."/notify/notify_get_list.php");
        break;
    default:
        die(return_json(null, "fail", "잘못된 요청입니다."));
        break;
}
?>