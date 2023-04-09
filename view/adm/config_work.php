<?php
$work_cf = W::get_work_cf_list();
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_work_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_work_update.php");
        break;
}
?>