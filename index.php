<?php
include_once('./_common.php');
$request = pave_explode($request, "/");

switch ($request[0]) {
    case "account":
        include_once(PAVE_ACCOUNT_PATH."/index.php");
        break;
    case "adm":
        include_once(PAVE_ADM_PATH."/index.php");
        break;
    case "api":
        include_once(PAVE_API_PATH."/index.php");
        break;
    case "user":
        include_once(PAVE_USER_PATH."/index.php");
        break;
    case "search":
        include_once(PAVE_SEARCH_PATH."/index.php");
        break;
    case "upload":
        include_once(PAVE_UPLOAD_PATH."/index.php");
        break;
    case "charge":
        include_once(PAVE_CHARGE_PATH."/index.php");
        break;
    case "pay":
        include_once(PAVE_PAY_PATH."/index.php");
        break;
    case "work":
        include_once(PAVE_WORK_PATH."/index.php");
        break;
    case "library":
        include_once(PAVE_LIBRARY_PATH."/index.php");
        break;
    case "cert":
        include_once(PAVE_CERT_PATH."/index.php");
        break;
    case "setting":
        include_once(PAVE_SETTING_PATH."/index.php");
        break;
    case "legal":
        include_once(PAVE_LEGAL_PATH."/index.php");
        break;
    case "cs":
        include_once(PAVE_CS_PATH."/index.php");
        break;
    case "commerce":
        include_once(PAVE_COMMERCE_PATH."/index.php");
        break;
    case "plan":
        include_once(PAVE_PLAN_PATH."/index.php");
        break;
    case "page":
        include_once(PAVE_PAGE_PATH."/index.php");
        break;
    case "guide":
        include_once(PAVE_GUIDE_PATH."/index.php");
        break;
    case "penalty":
        include_once(PAVE_PENALTY_PATH."/index.php");
        break;
    case "help":
        include_once(PAVE_HELP_PATH."/index.php");
        break;
    case "notify":
        include_once(PAVE_NOTIFY_PATH."/index.php");
        break;
    case "sight":
        include_once(PAVE_SIGHT_PATH."/index.php");
        break;
    case "creation":
        include_once(PAVE_CREATION_PATH."/index.php");
        break;
    case "editor":
        include_once(PAVE_EDITOR_PATH."/index.php");
        break;
    case "crontab":
        include_once(PAVE_CRONTAB_PATH."/index.php");
        break;
    default:
        include_once(PAVE_WORK_PATH."/index.php");
        break;
}

?>
