<?php
switch ($request[2]) {
    case "list":
        include_once(PAVE_API_PATH."/creation/creation_get_list.php");
        break;
    case "detail":
        include_once(PAVE_API_PATH."/creation/creation_get_detail.php");
        break;
    case "form":
        include_once(PAVE_API_PATH."/creation/creation_get_form.php");
        break;
    default:
        die(return_json(null, "fail", "잘못된 요청입니다."));
        break;
}
?>