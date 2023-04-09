<?php
switch ($request[2]) {
    case "home":
        include_once(PAVE_SETTING_PATH."/account_home.php");
        break;
    case "privacy":
        define("__ACCOUNT_PRIVACY__", true);
        include_once(PAVE_SETTING_PATH."/account_privacy.php");
        break;
    case "cert":
        define("__ACCOUNT_CERT__", true);
        include_once(PAVE_SETTING_PATH."/account_cert.php");
        break;
    case "content":
        define("__ACCOUNT_CONTENT__", true);
        include_once(PAVE_SETTING_PATH."/account_content.php");
        break;
    case "pwd":
        define("__ACCOUNT_PWD__", true);
        include_once(PAVE_SETTING_PATH."/account_pwd.php");
        break;
}
?>