<?php
$pave_theme = get_theme("charge");

if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);
$it_no = pave_input_sanitize($data["it_no"]);


$charge_config = $config_obj->get_charge_config();
$payment_config = $config_obj->get_payment_config();

$item_obj = new Item();
$item = $item_obj->set_it_type("exp")->set_it_no($it_no)->set_it_display(1)->get_item();

$rcpt_id = Receipt::genrate_receipt_id($item["it_no"], $pave_user);

$theme_path = $pave_theme["thm_path"]."/modal/charge_exp_form.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>