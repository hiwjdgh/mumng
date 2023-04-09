<?php
switch ($request[3]) {
    case "list":
        include_once(PAVE_ADM_PATH."/help_group_list.php");
        break;
    case "form":
        include_once(PAVE_ADM_PATH."/help_group_form.php");
        break;
    case "create":
        include_once(PAVE_ADM_PATH."/help_group_create.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/help_group_update.php");
        break;
    case "delete":
        include_once(PAVE_ADM_PATH."/help_group_delete.php");
        break;
}
?>