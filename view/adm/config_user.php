<?php
$user_config = $config_obj->get_user_config();
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_user_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_user_update.php");
        break;
}
?>