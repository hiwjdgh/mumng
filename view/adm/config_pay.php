<?php
$pay_config = $config_obj->get_pay_config();
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_pay_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_pay_update.php");
        break;
}
?>