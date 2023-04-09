<?php
$page = pave_input_sanitize($page)?:1;
$pay_type = pave_input_sanitize($pay_type);

if($pay_type == "rent"){
    $pay_type = array("rent", "preview", "preview2");
}else if($pay_type == "keep"){
    $pay_type = array("keep", "keep2");
}else if($pay_type == "end"){
    $pay_type = array("end", "end2");
}

$pay_obj = new Pay();
$pay_list = $pay_obj->set_user_no($pave_user["user_no"])
->set_pay_type($pay_type)
->set_pay_display(1)
->set_pay_page($page)
->get_pay_list();

$pay_list_cnt = $pay_obj->get_pay_list_cnt();

$return = array(
    "list" => $pay_list,
    "list_cnt" => $pay_list_cnt,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/pay_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return,"success"));
?>
