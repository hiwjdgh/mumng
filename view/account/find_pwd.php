<?php
switch ($request[3]) {
    case "form":
        include_once(PAVE_ACCOUNT_PATH."/find_pwd_form.php");
        break;
    case "new":
        include_once(PAVE_ACCOUNT_PATH."/find_pwd_new.php");
        break;
}
?>