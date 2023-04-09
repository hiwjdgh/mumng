<?php
$sns_config = $config_obj->get_sns_config();
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_sns_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_sns_update.php");
        break;
}
?>