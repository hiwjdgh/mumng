<?php
switch ($request[3]) {
    case 'list':
        include_once(PAVE_API_PATH."/work/comment_list.php");
        break;
    case 'delete':
        include_once(PAVE_API_PATH."/work/comment_delete.php");
        break;
    case 'delete_list':
        include_once(PAVE_API_PATH."/work/comment_delete_list.php");
        break;
    case 'create':
        include_once(PAVE_API_PATH."/work/comment_create.php");
        break;
}
?>