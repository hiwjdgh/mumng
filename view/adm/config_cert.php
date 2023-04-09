<?php
//본인인증 라이브러리
require_once(PAVE_LIB_CERT_PATH.'/cert.lib.php');
$cert_cf = get_cert_cf();
switch ($request[3]) {
    case "form":
        include_once(PAVE_ADM_PATH."/config_cert_form.php");
        break;
    case "update":
        include_once(PAVE_ADM_PATH."/config_cert_update.php");
        break;
}
?>