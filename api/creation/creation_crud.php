<?php
if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login?url=".urlencode(PAVE_USER_REFERER))));
}
switch ($request[2]) {
    case "create":
        include_once(PAVE_API_PATH."/creation/creation_crud_create.php");
        break;
    case "save":
        include_once(PAVE_API_PATH."/creation/creation_crud_save.php");
        break;
    case "update":
        include_once(PAVE_API_PATH."/creation/creation_crud_update.php");
        break;
    case "delete":
        include_once(PAVE_API_PATH."/creation/creation_crud_delete.php");
        break;
    case "request":
        include_once(PAVE_API_PATH."/creation/creation_crud_request.php");
        break;
    case "select":
        include_once(PAVE_API_PATH."/creation/creation_crud_select.php");
        break;
    default:
        die(return_json(null, "fail", "잘못된 요청입니다."));
        break;
}
?>