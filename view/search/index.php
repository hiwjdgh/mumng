<?php
include_once(PAVE_SEARCH_PATH."/_common.php");

switch ($request[1]) {
    case "webtoon":
        include_once(PAVE_SEARCH_PATH."/search_webtoon.php");
        break;
    case "user":
        include_once(PAVE_SEARCH_PATH."/search_user.php");
        break;
    case "hashtag":
        include_once(PAVE_SEARCH_PATH."/search_hashtag.php");
        break;
    case "tags":
        include_once(PAVE_SEARCH_PATH."/search_tags.php");
        break;
    default:
        alert("비정상적인 접근입니다.");
}
?>