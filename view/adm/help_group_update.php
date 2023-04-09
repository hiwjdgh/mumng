<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", get_url(PAVE_ADM_URL, "help/group/list"));
}
$help_group_id = pave_input_sanitize($help_group_id);
$help_group_name = pave_input_sanitize($help_group_name);
$help_group_display = pave_input_sanitize($help_group_display);
$help_group_order = pave_input_sanitize($help_group_order);

$help_obj = new Help();
$help_group = $help_obj->get_help_group($help_group_id);

if(!$help_group["help_group_id"]){
    alert("도움말 그룹을 찾을 수 없습니다.", get_url(PAVE_ADM_URL, "help/group/list"));
}


$update = array(
    "help_group_name" => $help_group_name,
    "help_group_order" => $help_group_order,
    "help_group_display" => $help_group_display
);

$result = pave_update("pave_help_group", $update, "help_group_id = '{$help_group["help_group_id"]}'");
if(!$result){
    alert("도움말 그룹 수정에 실패 했습니다.", get_url(PAVE_ADM_URL, "help/group/list"));
}

url_move(get_url(PAVE_ADM_URL, "help/group/form/{$help_group["help_group_id"]}"));
?>