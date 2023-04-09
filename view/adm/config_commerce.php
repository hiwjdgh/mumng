<?php
//커머스 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.commerce.php");
$commerce_cf = Commerce::get_commerce_cf_list();

switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_commerce_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_commerce_update.php");
        break;
}
?>