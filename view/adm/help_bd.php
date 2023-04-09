<?php
switch ($request[3]) {
    case "list":
        include_once(PAVE_ADM_PATH."/help_bd_list.php");
        break;
    case "form":
        include_once(PAVE_ADM_PATH."/help_bd_form.php");
        break;
    case "create":
        include_once(PAVE_ADM_PATH."/help_bd_create.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/help_bd_update.php");
        break;
    case "delete":
        include_once(PAVE_ADM_PATH."/help_bd_delete.php");
        break;
}
?>