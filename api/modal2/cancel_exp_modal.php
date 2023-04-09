<?php
$pave_theme = get_theme("charge");

if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

$rcpt_id = pave_input_sanitize($data["rcpt_id"]);
$settle_type = pave_input_sanitize($data["settle_type"]);

$charge_config = $config_obj->get_charge_config();
$payment_config = $config_obj->get_payment_config();

$receipt_obj = new Receipt();
$receipt = $receipt_obj->set_user_no($pave_user["user_no"])
->set_rcpt_id($rcpt_id)
->set_rcpt_type("exp")
->set_rcpt_status("payment_complete")
->get_receipt();

if(!$receipt["rcpt_id"]){
    die(return_json(null, "fail", "충전내역을 찾을 수 없습니다."));
}

$theme_path = $pave_theme["thm_path"]."/modal/cancel_exp_form.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>