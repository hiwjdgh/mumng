<?php
switch ($request[2]) {
    case 'subscribe':
        include_once(PAVE_API_PATH."/library/subscribe_list.php");
        break;
    case 'latest':
        include_once(PAVE_API_PATH."/library/latest_list.php");
        break;
    case 'pay':
        include_once(PAVE_API_PATH."/library/pay_list.php");
        break;
    case 'like':
        include_once(PAVE_API_PATH."/library/like_list.php");
        break;
    case 'comment':
        include_once(PAVE_API_PATH."/library/comment_list.php");
        break;
    case 'help':
        include_once(PAVE_API_PATH."/library/help.php");
        break;
}
?>