<?php
$work_id = pave_input_sanitize($work_id);
$work_color = pave_input_sanitize($work_color);


$work_obj = new Work();
$work = $work_obj->set_user_no($pave_user["user_no"])->set_work_id($work_id)->get_work();

if(!$work["work_id"]){
    die(return_json(null, "fail", "해당 작품을 찾을 수 없습니다."));
}

pave_update("pave_work", array("work_color" => $work_color), "work_id = '{$work["work_id"]}'");

die(return_json(null, "success"));
?>