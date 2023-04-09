<?php
if(!$is_user){
    die(return_json(null, "-100", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

$pay_id = pave_input_sanitize($pay_id);

$pay_obj->set_pay_id($pay_id);
$pay_obj->set_pay_user_id($pave_user["user_id"]);
$pay_obj->set_pay_page(0);
$pay = $pay_obj->get_pay_list()[0];


if(!$pay["pay_id"]){
    die(return_json(null, "200", "구매내역을 찾을 수 없습니다."));
}

$return = array();

ob_start();
$theme_path = $pave_theme["thm_path"]."/charge_pay_detail.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();
die(return_json($return));
?>