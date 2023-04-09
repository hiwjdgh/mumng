<?php
switch ($request[1]) {
    case "epsd":
        include_once(PAVE_CRONTAB_PATH."/epsd_optimize.php");
        break;
    case "rest":
        include_once(PAVE_CRONTAB_PATH."/rest_optimize.php");
        break;
    case "commerce":
        include_once(PAVE_CRONTAB_PATH."/commerce_score.php");
        break;
    case "creation":
        include_once(PAVE_CRONTAB_PATH."/creation_optimize.php");
        break;
}
?>