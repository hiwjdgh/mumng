<?php
switch ($request[3]) {
    case "create":
        include_once(PAVE_API_PATH."/work2/comment_create.php");
        break;
    case "delete":
        include_once(PAVE_API_PATH."/work2/comment_delete.php");
        break;
    default:
        die(return_json(null, "fail", "잘못된 요청입니다."));
        break;
}
?>