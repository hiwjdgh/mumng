<?php
switch ($request[2]) {
    case 'follower':
        include_once(PAVE_API_PATH."/follow/follower.php");
        break;
    case 'following':
        include_once(PAVE_API_PATH."/follow/following.php");
        break;
    case 'change':
        include_once(PAVE_API_PATH."/follow/follow_change.php");
        break;
}
?>