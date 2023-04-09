<?php
$sitemap_cf = $config_obj->get_site_list();
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_sitemap_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_sitemap_update.php");
        break;
}
?>