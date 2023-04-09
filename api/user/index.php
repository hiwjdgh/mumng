<?php
include_once(PAVE_API_PATH."/user/_common.php");
switch ($request[2]) {
    case "profile":
        include_once(PAVE_API_PATH."/user/profile.php");
        break;
    case 'content_change':
        include_once(PAVE_API_PATH."/user/content_change.php");
        break;
    case 'notify_change':
        include_once(PAVE_API_PATH."/user/notify_change.php");
        break;
    case 'share_change':
        include_once(PAVE_API_PATH."/user/share_change.php");
        break;
    case 'privacy':
        include_once(PAVE_API_PATH."/user/user_privacy.php");
        break;
    case 'delete':
        include_once(PAVE_API_PATH."/user/user_delete.php");
        break;
    case 'cert':
        include_once(PAVE_API_PATH."/user/user_cert.php");
        break;
    case 'pwd_check':
        include_once(PAVE_API_PATH."/user/user_pwd_check.php");
        break;
    case 'pwd':
        include_once(PAVE_API_PATH."/user/user_pwd.php");
        break;
}
?>