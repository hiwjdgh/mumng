<?php
//파일 라이브러리
require_once(PAVE_LIB_FILE_PATH.'/file.lib.php');
$file_cf = Files::get_file_cf_list();

switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_file_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_file_update.php");
        break;
}
?>