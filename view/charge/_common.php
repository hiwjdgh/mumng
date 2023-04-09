<?php
define("_CHARGE_", true);
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("charge");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$is_user){
    confirm("로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login?url=".urlencode(get_url(PAVE_CHARGE_URL, "payment"))), get_url(PAVE_URL));
}

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

if($is_mobile){
    $pave_html->add_js(get_url(PAVE_LIB_WORK_URL, "js/mobile/work2.lib.js"));
    $pave_html->add_css(get_url(PAVE_LIB_WORK_URL, "css/mobile/work2.lib.min.css"));
}else{
    $pave_html->add_js(get_url(PAVE_LIB_WORK_URL, "js/work2.lib.js"));
    $pave_html->add_css(get_url(PAVE_LIB_WORK_URL, "css/work2.lib.min.css"));
}

$charge_config = $config_obj->get_charge_config();
$payment_config = $config_obj->get_payment_config();

//결제 라이브러리
if($payment_config["payment_toss_test"]){
    $pave_html->add_js_inline("<script>const pave_toss_client_key = \"{$payment_config["payment_toss_test_client_key"]}\";</script>");
}else{
    $pave_html->add_js_inline("<script>const pave_toss_client_key = \"{$payment_config["payment_toss_client_key"]}\";</script>");
}
$pave_html->add_js($payment_config["payment_toss_module_url"]);


//충전 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_CHARGE_URL, "js/charge.lib.js"));
?>