<?php
include_once(PAVE_CREATION_PATH."/_common.php");

switch ($request[1]) {
    case "list":
        include_once(PAVE_CREATION_PATH."/creation_list.php");
        break;
    case "detail":
        include_once(PAVE_CREATION_PATH."/creation_detail.php");
        break;
    case "form":
        include_once(PAVE_CREATION_PATH."/creation_form.php");
        break;
}
?>