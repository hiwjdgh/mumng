<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}
$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);

//작품 가져오기
$work_obj = new Work();
$work = $work_obj->set_user_no($pave_user["user_no"])->set_work_id($work_id)->get_work();

if(!$work["work_id"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

if(!$work["is_own"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

//회차 가져오기
$epsd_obj = new Epsd();
$epsd = $epsd_obj->set_user_no($pave_user["user_no"])->set_work_id($work["work_id"])->set_epsd_id($epsd_id)->get_epsd();

if(!$epsd["epsd_id"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

//휴재 삭제 검사
if($epsd["epsd_state"] == "success"){
    die(return_json(null, "fail", "등록된 휴재는 삭제가 불가 합니다."));
}


//todo: 작품 환불

/* //알림 삭제
pave_query("DELETE FROM pave_notification WHERE JSON_SEARCH(notify_rel,'all', '{$work["work_id"]}')");
 */
//좋아요 삭제
pave_delete("pave_like", array("work_id" => $work["work_id"], "epsd_id" => $epsd["epsd_id"]));

//조회 삭제
pave_delete("pave_hit", array("work_id" => $work["work_id"], "epsd_id" => $epsd["epsd_id"]));

//파일 삭제
pave_delete("pave_file", array("work_id" => $work["work_id"], "epsd_id" => $epsd["epsd_id"]));

//댓글 삭제
pave_delete("pave_comment", array("work_id" => $work["work_id"], "epsd_id" => $epsd["epsd_id"]));

//회차 삭제
pave_delete("pave_epsd", array("epsd_id" => $epsd["epsd_id"]));


//폴더 삭제
$epsd_base_path = PAVE_DATA_WEBTOON_PATH;
$epsd_path = $epsd_base_path."/{$work["work_id"]}/{$epsd["epsd_id"]}";
rm_rf($epsd_path);


//작품 수정
$update = array();

if($epsd["epsd_state"] == "reserve"){
    $update["work_reserve_cnt"] = $work["work_reserve_cnt"] - 1;
}
pave_update("pave_work", $update, "work_id = '{$work["work_id"]}'");
die(return_json(null, "success"));
?>