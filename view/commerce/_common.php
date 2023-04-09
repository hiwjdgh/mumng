<?php
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("commerce");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

if(!$is_user){
    confirm("로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login?url=".urlencode(get_url(PAVE_COMMERCE_URL, "home"))), get_url(PAVE_URL));
}

//본인인증 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_CERT_URL, "js/cert.lib.js"));
?>