<?php
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/commerce_calc_form.php");
        break;
    case "list":
        include_once(PAVE_ADM_PATH."/commerce_calc_list.php");
        break;
    case "detail":
        include_once(PAVE_ADM_PATH."/commerce_calc_detail.php");
        break;
    case "create":
        include_once(PAVE_ADM_PATH."/commerce_calc_create.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/commerce_calc_update.php");
        break;
    case "delete":
        include_once(PAVE_ADM_PATH."/commerce_calc_delete.php");
        break;
}
?>