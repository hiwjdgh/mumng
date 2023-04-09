<?php
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_site_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_site_update.php");
        break;
}
?>