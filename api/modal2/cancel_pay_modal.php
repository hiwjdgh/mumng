<?php
$pave_theme = get_theme("charge");

if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

//구매 라이브러리
require_once(PAVE_LIB_PAY_PATH.'/pay.lib.php');

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);
$pay_id = $data["pay_id"];

$pay_config = $config_obj->get_pay_config();

$pay_obj = new Pay();
$pay = $pay_obj->set_pay_id($pay_id)
->set_user_no($pave_user["user_no"])
->set_pay_display(1)
->get_pay();

if(!$pay["pay_id"]){
    die(return_json(null, "fail", "구매내역을 찾을 수 없습니다."));
}

$theme_path = $pave_theme["thm_path"]."/modal/cancel_pay_form.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>