<?php
if($is_user){
    url_move(PAVE_URL);
}

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

switch ($request[2]) {
    case "id":
        define("_FIND_ID_" , true);
        include_once(PAVE_ACCOUNT_PATH."/find_id.php");
        break;
    case "pwd":
        define("_FIND_PWD_" , true);
        include_once(PAVE_ACCOUNT_PATH."/find_pwd.php");
        break;
}
?>