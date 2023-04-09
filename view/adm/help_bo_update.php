<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", get_url(PAVE_ADM_URL, "help/bo/list"));
}
$help_bo_id = pave_input_sanitize($help_bo_id);
$help_group_id = pave_input_sanitize($help_group_id);
$help_bo_name = pave_input_sanitize($help_bo_name);
$help_bo_order = pave_input_sanitize($help_bo_order);
$help_bo_display = pave_input_sanitize($help_bo_display);

$help_obj = new Help();
$help_bo = $help_obj->get_help_bo($help_bo_id);

if(!$help_bo["help_bo_id"]){
    alert("도움말을 찾을 수 없습니다.", get_url(PAVE_ADM_URL, "help/bo/list"));
}


$update = array(
    "help_group_id" => $help_group_id,
    "help_bo_name" => $help_bo_name,
    "help_bo_order" => $help_bo_order,
    "help_bo_display" => $help_bo_display
);

$result = pave_update("pave_help_bo", $update, "help_bo_id = '{$help_bo["help_bo_id"]}'");
if(!$result){
    alert("도움말 수정에 실패 했습니다.", get_url(PAVE_ADM_URL, "help/bo/list"));
}

url_move(get_url(PAVE_ADM_URL, "help/bo/form/{$help_bo["help_bo_id"]}"));
?>