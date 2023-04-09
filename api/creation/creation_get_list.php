<?php
$field = pave_input_sanitize($field);
$state = pave_input_sanitize($state);
$ratio = pave_input_sanitize($ratio);
$size = pave_input_sanitize($size);
$exp = pave_input_sanitize($exp);
$order = pave_input_sanitize($order);
$page = pave_input_sanitize($page);

$creation_obj = new Creation();

$creation_list = $creation_obj
->set_creation_field(pave_explode($field, ","))
->set_creation_state(pave_explode($state, ","))
->set_creation_ratio(pave_explode($ratio, ","))
->set_creation_size(pave_explode($size, ","))
->set_creation_exp(pave_explode($exp, ","))
->set_creation_order(pave_explode($order, ","))
->set_creation_page($page)
->get_creation_list();
$return = array(
    "list" => $creation_list,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/creation_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>