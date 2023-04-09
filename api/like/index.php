<?php
switch ($request[2]) {
    case 'comment':
        include_once(PAVE_API_PATH."/like/like_comment.php");
        break;
    case 'epsd':
        include_once(PAVE_API_PATH."/like/like_epsd.php");
        break;
}
?>