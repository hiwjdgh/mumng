<?php
define("__NOTIFY__", true);
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("notify");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

if(!$is_user){
    confirm("로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login?url=".urlencode(get_url(PAVE_NOTIFY_URL, "list"))), get_url(PAVE_URL));
}

if(!$is_mobile){
    url_move(get_url(PAVE_URL));
}
?>