<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

$work_obj = new Work();
$work = $work_obj->set_user_no($pave_user["user_no"])->set_work_id($work_id)->get_work();

if(!$work["work_id"]){
    die(return_json(null, "fail", "작품을 찾을 수 없습니다."));
}

if(!$work["is_own"]){
    die(return_json(null, "fail", "작품을 찾을 수 없습니다."));
}

//알림 삭제
pave_query("DELETE FROM pave_notification WHERE JSON_SEARCH(notify_rel,'all', '{$work["work_id"]}')");

//좋아요 삭제
pave_delete("pave_like", array("work_id" => $work["work_id"]));

//조회 삭제
pave_delete("pave_hit", array("work_id" => $work["work_id"]));

//파일 삭제
pave_delete("pave_file", array("work_id" => $work["work_id"]));

//댓글 삭제
pave_delete("pave_comment", array("work_id" => $work["work_id"]));

//해시태그 삭제
pave_delete("pave_hashtag", array("work_id" => $work["work_id"]));

//구독 삭제
pave_delete("pave_subscribe", array("work_id" => $work["work_id"]));

//회차 삭제
pave_delete("pave_epsd", array("work_id" => $work["work_id"]));

//작품 함께한 작가 삭제
pave_delete("pave_work_with", array("work_id" => $work["work_id"]));
//작품 삭제
pave_delete("pave_work", array("work_id" => $work["work_id"]));

//폴더 삭제
$work_base_path = '';

if($work["work_grp_id"] == "webtoon"){
    $work_base_path = PAVE_DATA_WEBTOON_PATH;
}else if($work["work_grp_id"] == "novel"){
    $work_base_path = PAVE_DATA_NOVEL_PATH;
}
$work_path = $work_base_path.DIRECTORY_SEPARATOR."{$work["work_id"]}";

rm_rf($work_path);

die(return_json(null, "success"));