<?php
include_once(PAVE_API_PATH."/work2/_common.php");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        include_once(PAVE_API_PATH."/work2/work_get.php");
        break;
    case 'POST':
        include_once(PAVE_API_PATH."/work2/work_crud.php");
        break;
    default:
        die(return_json(null, "fail", "잘못된 요청입니다."));
        break;
}
?>