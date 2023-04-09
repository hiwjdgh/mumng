<?php
switch ($request[3]) {
    case "list":
        include_once(PAVE_ADM_PATH."/help_bo_list.php");
        break;
    case "form":
        include_once(PAVE_ADM_PATH."/help_bo_form.php");
        break;
    case "create":
        include_once(PAVE_ADM_PATH."/help_bo_create.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/help_bo_update.php");
        break;
    case "delete":
        include_once(PAVE_ADM_PATH."/help_bo_delete.php");
        break;
}
?>