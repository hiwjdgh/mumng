<?php
define("ADM_USER", true);

switch ($request[2]) {
    case "list":
        include_once(PAVE_ADM_PATH."/user_list.php");
        break;
    case "form":
        include_once(PAVE_ADM_PATH."/user_form.php");
        break;
    case "create":
        include_once(PAVE_ADM_PATH."/user_create.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/user_update.php");
        break;
    case "delete":
        include_once(PAVE_ADM_PATH."/user_delete.php");
        break;
}
?>