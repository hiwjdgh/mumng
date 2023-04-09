<?php
$page = pave_input_sanitize($page)?:1;
$type = pave_input_sanitize($type);

$list_count = 10;
$from = ($page - 1) * $list_count;
$to = $list_count;

$sight_obj = new Sight();

$sight_list = $sight_obj
->set_sight_display(1)
->set_sight_type($type)
->set_sight_page($page)
->get_sight_list();
$return = array(
    "list" => $sight_list,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/sight_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>