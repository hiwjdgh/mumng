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

//정산신청 기간 검사
if(!$commerce_obj->is_calc_day()){
    die(return_json(null, "200", "정산신청 기간이 아닙니다."));
}

//정산신청 여부 검사
$last_calc = $commerce_obj->get_last_calc();
if($last_calc["calc_id"]){
    die(return_json(null, "200", "{$last_calc["calc_ready_dt"]}에 신청하셨습니다."));
}

$hold_exp = $commerce_obj->get_hold_exp();
$latest_calc = $commerce_obj->get_latest_calc();


$theme_path = $pave_theme["thm_path"]."/modal/commerce_calc_form.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>