<?php
$hit_no = pave_input_sanitize($hit_no);
    
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT hit.* FROM pave_hit AS hit")
->set_sql_where("hit.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("hit.hit_no = '{$hit_no}'");

$latest = pave_fetch($obj->generate_sql());

if(!$latest["hit_no"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

pave_delete("pave_hit", array("hit_no" => $hit_no));

die(return_json(null, "success"));
?>