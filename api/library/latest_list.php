<?php
$page = pave_input_sanitize($library_page)?:1;

$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT hit.* FROM pave_hit AS hit")
->set_sql_where("hit.user_no = '{$pave_user["user_no"]}'")
->set_sql_order("ORDER BY hit.hit_no DESC");

$from = ($page - 1) * 10;
$to = 10;
$obj->set_sql_limit("LIMIT {$from}, {$to}"); 
$result = pave_query($obj->generate_sql());
$latest_list = array();

for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
    //최근본 작품 정보
    $work_obj = new Work();
    $row["latest_work"] = $work_obj->set_work_id($row["work_id"])->get_work();

    //최근본 회차 정보
    $epsd_obj = new Epsd();
    $row["latest_epsd"] = $epsd_obj->set_work_id($row["work_id"])->set_epsd_id($epsd_id)->get_epsd();
    $latest_list[] = $row;
}

$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_hit AS hit")
->set_sql_cnt_where("hit.user_no = '{$pave_user["user_no"]}'");
$latest_list_cnt = pave_fetch($obj->generate_cnt_sql())["cnt"];

$return = array(
    "list" => $latest_list,
    "list_cnt" => $latest_list_cnt,
);

ob_start();
$theme_path = $pave_theme["thm_path"]."/latest_item.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>