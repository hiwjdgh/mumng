<?php
include_once(PAVE_API_PATH."/_common.php");
switch ($request[1]) {
    case 'work':
        include_once(PAVE_API_PATH."/work/index.php");
        break;
    case 'work2':
        include_once(PAVE_API_PATH."/work2/index.php");
        break;
    case 'user':
        include_once(PAVE_API_PATH."/user/index.php");
        break;
    case 'account':
        include_once(PAVE_API_PATH."/account/index.php");
        break;
    case 'follow':
        include_once(PAVE_API_PATH."/follow/_common.php");
        include_once(PAVE_API_PATH."/follow/index.php");
        break;
    case 'commerce':
        include_once(PAVE_API_PATH."/commerce/index.php");
        break;
    case 'charge':
        include_once(PAVE_API_PATH."/charge/index.php");
        break;
    case 'creation':
        include_once(PAVE_API_PATH."/creation/index.php");
        break;
    case 'modal':
        include_once(PAVE_API_PATH."/modal/index.php");
        break;
    case 'modal2':
        include_once(PAVE_API_PATH."/modal2/index.php");
        break;
    case 'hook':
        include_once(PAVE_API_PATH."/hook/index.php");
        break;
    case 'library':
        include_once(PAVE_API_PATH."/library/index.php");
        break;
    case 'file':
        include_once(PAVE_API_PATH."/file/index.php");
        break;
    case 'search':
        include_once(PAVE_API_PATH."/search/index.php");
        break;
    case 'notify':
        include_once(PAVE_API_PATH."/notify/index.php");
        break;
    case 'subscribe':
        include_once(PAVE_API_PATH."/subscribe/_common.php");
        include_once(PAVE_API_PATH."/subscribe/index.php");
        break;
    case 'like':
        include_once(PAVE_API_PATH."/like/_common.php");
        include_once(PAVE_API_PATH."/like/index.php");
        break;
    case 'page':
        include_once(PAVE_API_PATH."/page/index.php");
        break;
    case 'upload':
        include_once(PAVE_API_PATH."/upload/_common.php");
        include_once(PAVE_API_PATH."/upload/index.php");
        break;
    case 'pay':
        include_once(PAVE_API_PATH."/pay/index.php");
        break;
    case 'penalty':
        include_once(PAVE_API_PATH."/penalty/index.php");
        break;
    case 'sight':
        include_once(PAVE_API_PATH."/sight/index.php");
        break;
    case 'cert':
        include_once(PAVE_API_PATH."/cert/index.php");
        break;
    default:
        # code...
        break;
}
?>