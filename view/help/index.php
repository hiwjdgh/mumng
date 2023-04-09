<?php
include_once(PAVE_HELP_PATH."/_common.php");
switch ($request[1]) {
    case "home":
        include_once(PAVE_HELP_PATH."/help_home.php");
        break;
    case "service":
        include_once(PAVE_HELP_PATH."/help_service.php");
        break;
    case "group":
        include_once(PAVE_HELP_PATH."/help_group.php");
        break;
    case "board":
        include_once(PAVE_HELP_PATH."/help_board.php");
        break;
    case "search":
        include_once(PAVE_HELP_PATH."/help_search.php");
        break;
}
?>