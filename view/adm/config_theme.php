<?php
$theme_cf = get_theme_list();
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_theme_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_theme_update.php");
        break;
}
?>