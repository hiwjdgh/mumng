<?php
$notify_cf = Notify::get_notify_cf_list();
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_notify_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_notify_update.php");
        break;
}
?>