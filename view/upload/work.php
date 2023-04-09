<?php
switch ($request[2]) {
    case "detail":
        include_once(PAVE_UPLOAD_PATH."/work_detail.php");
        break;
    case "form":
        include_once(PAVE_UPLOAD_PATH."/work_form.php");
        break;
}
?>