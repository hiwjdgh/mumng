<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

$sight_obj = new Sight();
$sight = $sight_obj
->set_sight_no($sight_no)
->set_user_no($pave_user["user_no"])
->get_sight();

if($sight["sight_no"] != $sight_no || $sight["user_no"] != $pave_user["user_no"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

//파일 삭제
pave_delete("pave_file", array("sight_no" => $sight["sight_no"]));

//창작물 삭제
pave_delete("pave_sight", array("sight_no" => $sight["sight_no"]));

//폴더 삭제
$sight_base_path = PAVE_DATA_SIGHT_PATH;
$sight_path = $sight_base_path.DIRECTORY_SEPARATOR."{$sight["sight_no"]}";

rm_rf($sight_path);

die(return_json(null, "success"));