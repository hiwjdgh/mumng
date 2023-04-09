<?php
switch ($request[3]) {
    case 'create':
        include_once(PAVE_API_PATH."/upload/rest_create.php");
        break;
    case 'update':
        include_once(PAVE_API_PATH."/upload/rest_update.php");
        break;
    case 'save':
        include_once(PAVE_API_PATH."/upload/rest_save.php");
        break;
    case 'delete':
        include_once(PAVE_API_PATH."/upload/rest_delete.php");
        break;
}
?>