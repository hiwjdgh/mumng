<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", get_url(PAVE_ADM_URL, "help/bo/list"));
}
$help_bo_id = pave_input_sanitize($help_bo_id);
$help_group_id = pave_input_sanitize($help_group_id);
$help_bo_name = pave_input_sanitize($help_bo_name);
$help_bo_order = pave_input_sanitize($help_bo_order);
$help_bo_display = pave_input_sanitize($help_bo_display);


$create = array(
    "help_bo_id" => $help_bo_id,
    "help_group_id" => $help_group_id,
    "help_bo_name" => $help_bo_name,
    "help_bo_order" => $help_bo_order,
    "help_bo_display" => $help_bo_display
);

$result = pave_insert("pave_help_bo", $create);
if(!$result){
    alert("도움말 추가에 실패 했습니다.", get_url(PAVE_ADM_URL, "help/bo/list"));
}

url_move(get_url(PAVE_ADM_URL, "help/bo/form/{$help_bo_id}"));
?>