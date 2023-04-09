<?php
$epsd_cf = Epsds::epsd_cf_list();

switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_epsd_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_epsd_update.php");
        break;
}
?>