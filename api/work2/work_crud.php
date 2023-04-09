<?php
switch ($request[2]) {
    case "comment":
        include_once(PAVE_API_PATH."/work2/comment_crud.php");
        break;
    default:
        die(return_json(null, "fail", "잘못된 요청입니다."));
        break;
}
?>