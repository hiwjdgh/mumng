<?php
//충전 라이브러리
require_once(PAVE_LIB_CHARGE_PATH.'/charge.lib.php');
$charge_config = $config_obj->get_charge_config();

switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_charge_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_charge_update.php");
        break;
}
?>