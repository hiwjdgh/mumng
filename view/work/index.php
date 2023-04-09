<?php
include_once(PAVE_WORK_PATH."/_common.php");

switch ($request[1]) {
    case "list":
        include_once(PAVE_WORK_PATH."/list.php");
        break;
  /*   case "detail":
        include_once(PAVE_WORK_PATH."/detail.php");
        break; */
    case "epsd":
        include_once(PAVE_WORK_PATH."/epsd.php");
        break;
    default:
        include_once(PAVE_WORK_PATH."/main.php");
        break;
}
?>