<?php
if(!$is_user){
    die(return_json(null, "-100", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

$pave_theme = get_theme("penalty");

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);

//신고 라이브러리
require_once(PAVE_LIB_PENALTY_PATH.'/penalty.lib.php');
$penalty_cf = Penalty::get_penalty_cf();
$penalty_obj = new Penalty();

$penalty_target = $data["target"];
$penalty_cate = $data["type"];

$theme_path = $pave_theme["thm_path"]."/modal/penalty_form.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>