<?php
if(!$is_user){
    die(return_json(null, "-100", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

$work_obj = new W();
$work = $work_obj->get_work($work_id);

if(!$work["work_id"]){
    die(return_json(null, "200", "구매 진행에 실패했습니다. 다시시도 해주세요."));
}

$epsd_obj = new Epsds();
$epsd_obj->set_work_id($work["work_id"]);
$epsd = $epsd_obj->get_epsd($epsd_id);


ob_start();
$theme_path = $pave_theme["thm_path"]."/pay_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>