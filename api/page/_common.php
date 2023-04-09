<?php
$pave_theme = get_theme("page");

$page_user_code = pave_input_sanitize($user_code);
$page_work_grp_id = pave_input_sanitize($work_grp_id)?:"webtoon";
$page_work_order = pave_input_sanitize($work_order)?:"update";

/* $page_obj = new Page();
$page_user = $page_obj->get_page_user($page_user_code);
 */
?>