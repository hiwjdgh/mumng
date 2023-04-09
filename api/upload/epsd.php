<?php
//썸네일 플러그인
require_once(PAVE_PLUGIN_THUMBNAIL_PATH.'/ImageResize.php');
require_once(PAVE_PLUGIN_THUMBNAIL_PATH.'/ImageResizeException.php');

switch ($request[3]) {
    case 'list':
        include_once(PAVE_API_PATH."/upload/epsd_list.php");
        break;
    case 'detail':
        include_once(PAVE_API_PATH."/upload/epsd_detail.php");
        break;
    case 'form':
        include_once(PAVE_API_PATH."/upload/epsd_form.php");
        break;
    case 'create':
        include_once(PAVE_API_PATH."/upload/epsd_create.php");
        break;
    case 'delete':
        include_once(PAVE_API_PATH."/upload/epsd_delete.php");
        break;
    case 'update':
        include_once(PAVE_API_PATH."/upload/epsd_update.php");
        break;
    case 'save':
        include_once(PAVE_API_PATH."/upload/epsd_save.php");
        break;
}
?>