<?php
if(!$is_user){
    die(return_json(null, "-100", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}

$pay_type = pave_input_sanitize($pay_type);
$page = pave_input_sanitize($page)?:1;

if($pay_type == "rent"){
    $pay_type = array("rent", "preview", "preview2");
}else if($pay_type == "keep"){
    $pay_type = array("keep", "keep2");
}else if($pay_type == "end"){
    $pay_type = array("end", "end2");
}

$pay_obj->set_pay_user_id($pave_user["user_id"]);
$pay_obj->set_pay_type($pay_type);
$pay_obj->set_pay_status(array("success"));
$pay_obj->set_pay_page($page);
$list = $pay_obj->get_pay_list();
$list_cnt = $pay_obj->get_pay_list_cnt();

$return = array(
    "list" => $list,
    "list_cnt" => $list_cnt,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/library_pay_list.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>
