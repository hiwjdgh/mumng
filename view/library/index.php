<?php
include_once(PAVE_LIBRARY_PATH."/_common.php");

switch ($request[1]) {
    case "subscribe":
        define("_LIBRARY_SUBSCRIBE_", true);
        include_once(PAVE_LIBRARY_PATH."/subscribe.php");
        break;
    case "latest":
        define("_LIBRARY_LATEST_", true);
        include_once(PAVE_LIBRARY_PATH."/latest.php");
        break;
    case "pay":
        define("_LIBRARY_PAY_", true);
        include_once(PAVE_LIBRARY_PATH."/pay.php");
        break;
    case "like":
        define("_LIBRARY_LIKE_", true);
        include_once(PAVE_LIBRARY_PATH."/like.php");
        break;
    case "comment":
        define("_LIBRARY_COMMENT_", true);
        include_once(PAVE_LIBRARY_PATH."/comment.php");
        break;
}
?>