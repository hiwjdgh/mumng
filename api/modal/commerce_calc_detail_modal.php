<?php
$pave_theme = get_theme("commerce");

if(!$is_user){
    die(return_json(null, "-100", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

//커머스 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.commerce.php");
$commerce_obj = new Commerce();

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

$calc_id = pave_input_sanitize($data["calc_id"]);


$commerce_obj->set_calc_id($calc_id);
$calc_detail = $commerce_obj->get_commerce_calc_list()[0];


$theme_path = $pave_theme["thm_path"]."/modal/commerce_calc_detail.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>