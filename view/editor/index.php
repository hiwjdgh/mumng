<?php
include_once(PAVE_EDITOR_PATH."/_common.php");

switch ($request[1]) {
    case "upload":
        include_once(PAVE_EDITOR_PATH."/upload.php");
        break;
    default:
        alert_close("비정상적인 접근입니다.");
}

?>