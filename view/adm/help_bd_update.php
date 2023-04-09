<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", get_url(PAVE_ADM_URL, "help/bd/list"));
}
$help_bd_id = pave_input_sanitize($help_bd_id);
$help_bo_id = pave_input_sanitize($help_bo_id);
$help_bd_display = pave_input_sanitize($help_bd_display);
$help_bd_content = pave_input_sanitize($help_bd_content);

$help_obj = new Help();
$help_bo = $help_obj->get_help_bo($help_bo_id);

if(!$help_bo["help_bo_id"]){
    alert("도움말을 찾을 수 없습니다.", get_url(PAVE_ADM_URL, "help/bd/list"));
}

$help_bd = $help_obj->get_help_bd($help_bd_id);

if(!$help_bd["help_bd_id"]){
    alert("도움말을 찾을 수 없습니다.", get_url(PAVE_ADM_URL, "help/bd/list"));
}


$update = array(
    "help_group_id" => $help_bo["help_group_id"],
    "help_bo_id" => $help_bo["help_bo_id"],
    "help_bd_content" => json_encode($help_bd_content, JSON_UNESCAPED_UNICODE),
    "help_bd_display" => $help_bd_display
);

$result = pave_update("pave_help_bd", $update, "help_bd_id = '{$help_bd["help_bd_id"]}'");
if(!$result){
    alert("도움말 수정에 실패 했습니다.", get_url(PAVE_ADM_URL, "help/bd/list"));
}

url_move(get_url(PAVE_ADM_URL, "help/bd/form/{$help_bd["help_bd_id"]}"));
?>