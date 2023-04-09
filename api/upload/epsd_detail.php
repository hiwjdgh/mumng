<?php
$work_id = pave_input_sanitize($work_id);

$sql = array();
$sql_where = array();
$sql_common = array();

$sql_common[] = "SELECT work.*, user_img, user.user_nick, user.user_code, user.user_field, user.user_commerce FROM pave_work AS work";
$sql_common[] = "LEFT JOIN pave_user AS user ON user.user_id = work.user_id";
$sql_where[] = "WHERE work.user_id = '{$pave_user["user_id"]}'";
$sql_where[] = "work.work_id = '{$work_id}'";

$sql_common = pave_implode($sql_common, " ");
$sql_where = pave_implode($sql_where, " AND ");
$sql[] = $sql_common;
$sql[] = $sql_where;
$sql[] = $sql_order;
$sql = pave_implode($sql, " ");
$row = pave_fetch($sql);

$row["user"]["user_img"] = $row["user_img"];
$row["user"]["user_code"] = $row["user_code"];
$row["user"]["user_field"] = $row["user_field"];
$row["user"]["user_nick"] = $row["user_nick"];
$row["user"]["user_code"] = $row["user_code"];
$row["user"]["user_commerce"] = $row["user_commerce"];
$row["user"]["user_page_url"] = get_url(PAVE_PAGE_URL, $row["user_code"]);

unset($row["user_id"]);
unset($row["user_img"]);
unset($row["user_code"]);
unset($row["user_field"]);
unset($row["user_nick"]);
unset($row["user_code"]);
unset($row["user_commerce"]);

die(return_json($row));
?>