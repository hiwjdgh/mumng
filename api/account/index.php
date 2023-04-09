<?php
include_once(PAVE_API_PATH."/account/_common.php");
switch ($request[2]) {
    case 'login':
        include_once(PAVE_API_PATH."/account/login.php");
        break;
    case 'logout':
        include_once(PAVE_API_PATH."/account/logout.php");
        break;
    case 'check':
        include_once(PAVE_API_PATH."/account/check.php");
        break;
    case 'reg':
        include_once(PAVE_API_PATH."/account/reg.php");
        break;
    case 'reg2':
        include_once(PAVE_API_PATH."/account/reg2.php");
        break;
    case 'find':
        include_once(PAVE_API_PATH."/account/find.php");
        break;
    case 'new_pwd':
        include_once(PAVE_API_PATH."/account/new_pwd.php");
        break;
}
?>