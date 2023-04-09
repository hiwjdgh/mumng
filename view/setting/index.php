<?php
include_once(PAVE_SETTING_PATH."/_common.php");
$pave_site = $config_obj->get_site($request[0], $request[1]);
if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}
switch ($request[1]) {
    case "home":
        include_once(PAVE_SETTING_PATH."/home.php");
        break;
    case "profile":
        define("__PROFILE__", true);
        include_once(PAVE_SETTING_PATH."/profile.php");
        break;
    case "notify":
        define("__NOTIFY__", true);
        include_once(PAVE_SETTING_PATH."/notify.php");
        break;
    case "account":
        define("__ACCOUNT__", true);
        include_once(PAVE_SETTING_PATH."/account.php");
        break;
}
?>