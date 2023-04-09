<?php
switch ($request[3]) {
    case "form":
        include_once(PAVE_ACCOUNT_PATH."/find_id_form.php");
        break;
    case "result":
        include_once(PAVE_ACCOUNT_PATH."/find_id_result.php");
        break;
}
?>