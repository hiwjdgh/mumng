<?php
include_once(PAVE_GUIDE_PATH."/_common.php");
switch ($request[1]) {
    case "home":
        include_once(PAVE_GUIDE_PATH."/guide_home.php");
        break;
    case "group":
        include_once(PAVE_GUIDE_PATH."/guide_group.php");
        break;
    case "board":
        include_once(PAVE_GUIDE_PATH."/guide_board.php");
        break;
    case "search":
        include_once(PAVE_GUIDE_PATH."/guide_search.php");
        break;
}
?>