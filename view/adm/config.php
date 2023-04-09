<?php
define("ADM_CONFIG", true);
switch ($request[2]) {
    case "site":
        include_once(PAVE_ADM_PATH."/config_site.php");
        break;
    case "cert":
        include_once(PAVE_ADM_PATH."/config_cert.php");
        break;
    case "charge":
        include_once(PAVE_ADM_PATH."/config_charge.php");
        break;
    case "commerce":
        include_once(PAVE_ADM_PATH."/config_commerce.php");
        break;
    case "epsd":
        include_once(PAVE_ADM_PATH."/config_epsd.php");
        break;
    case "file":
        include_once(PAVE_ADM_PATH."/config_file.php");
        break;
    case "notify":
        include_once(PAVE_ADM_PATH."/config_notify.php");
        break;
    case "pay":
        include_once(PAVE_ADM_PATH."/config_pay.php");
        break;
    case "payment":
        include_once(PAVE_ADM_PATH."/config_payment.php");
        break;
    case "sitemap":
        include_once(PAVE_ADM_PATH."/config_sitemap.php");
        break;
    case "sns":
        include_once(PAVE_ADM_PATH."/config_sns.php");
        break;
    case "theme":
        include_once(PAVE_ADM_PATH."/config_theme.php");
        break;
    case "user":
        include_once(PAVE_ADM_PATH."/config_user.php");
        break;
    case "work":
        include_once(PAVE_ADM_PATH."/config_work.php");
        break;
}
?>