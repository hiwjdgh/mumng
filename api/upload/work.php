<?php
switch ($request[3]) {
    case 'list':
        include_once(PAVE_API_PATH."/upload/work_list.php");
        break;
    case 'detail':
        include_once(PAVE_API_PATH."/upload/work_detail.php");
        break;
    case 'form':
        include_once(PAVE_API_PATH."/upload/work_form.php");
        break;
    case 'create':
        include_once(PAVE_API_PATH."/upload/work_create.php");
        break;
    case 'delete':
        include_once(PAVE_API_PATH."/upload/work_delete.php");
        break;
    case 'update':
        include_once(PAVE_API_PATH."/upload/work_update.php");
        break;
    case 'color':
        include_once(PAVE_API_PATH."/upload/work_color.php");
        break;
    case 'with':
        include_once(PAVE_API_PATH."/upload/work_with_list.php");
        break;
}
?>