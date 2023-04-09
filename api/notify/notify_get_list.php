<?php
$page = pave_input_sanitize($page)?:1;

$notify_obj = new Notification();
$notify_list = $notify_obj->set_notify_to($pave_user["user_id"])
->set_notify_page($page)
->get_notify_list();

$return = array(
    "list" => $notify_list
);

ob_start();
$theme_path = PAVE_LIB_NOTIFY_PATH."/theme/notify_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return));
?>