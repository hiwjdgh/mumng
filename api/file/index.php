<?php
include_once(PAVE_API_PATH."/file/_common.php");

switch ($request[2]) {
    case 'user_img':
        include_once(PAVE_API_PATH."/file/user_img.php");
        break;
    case 'work_img':
        include_once(PAVE_API_PATH."/file/work_img.php");
        break;
    case 'sight_img':
        include_once(PAVE_API_PATH."/file/sight_img.php");
        break;
    case 'epsd_copy':
        include_once(PAVE_API_PATH."/file/epsd_copy.php");
        break;
    case 'epsd_img':
        include_once(PAVE_API_PATH."/file/epsd_img.php");
        break;
    case 'editor_file':
        include_once(PAVE_API_PATH."/file/editor_file.php");
        break;
}
?>