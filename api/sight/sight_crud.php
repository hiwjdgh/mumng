<?php
switch ($request[2]) {
    case "create":
        include_once(PAVE_API_PATH."/sight/sight_create.php");
        break;
    case "update":
        include_once(PAVE_API_PATH."/sight/sight_update.php");
        break;
    case "delete":
        include_once(PAVE_API_PATH."/sight/sight_delete.php");
        break;
    default:
        die(return_json(null, "fail", "잘못된 요청입니다."));
        break;
}
?>