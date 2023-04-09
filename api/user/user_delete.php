<?php
//회원 인증 삭제
pave_delete("pave_log_cert", array("user_no" => $pave_user["user_no"]));
//회원 캘린더 삭제
pave_delete("pave_cal", array("user_id" => $pave_user["user_id"]));
//회원 회차 삭제
pave_delete("pave_epsd", array("user_id" => $pave_user["user_id"]));
//회원 댓글 삭제
pave_delete("pave_epsd_cmt", array("user_id" => $pave_user["user_id"]));
//회원 구매내역 삭제
pave_delete("pave_epsd_pay", array("user_id" => $pave_user["user_id"]));
//회원 파일 삭제
pave_delete("pave_file", array("user_id" => $pave_user["user_id"]));
//회원 팔로우 삭제
pave_delete("pave_user_follow", array("user_follower_from" => $pave_user["user_no"]));
pave_delete("pave_user_follow", array("user_following_to" => $pave_user["user_no"]));
//회원 조회 삭제
pave_delete("pave_hit", array("user_no" => $pave_user["user_no"]));
//회원 좋아요 삭제
pave_delete("pave_like", array("user_no" => $pave_user["user_no"]));
//회원 구독 삭제
pave_delete("pave_subscribe", array("user_no" => $pave_user["user_no"]));
//회원 작품 삭제
$sql = "SELECT * FROm pave_work WHERE user_no= '{$pave_user["user_no"]}'";
$result = pave_query($sql);
for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
    $work_base_path = PAVE_DATA_WEBTOON_PATH;
    if($row["work_grp_id"] == "novel"){
        $work_base_path = PAVE_DATA_NOVEL_PATH;
    }
    $work_path = $work_base_path."/{$row["work_id"]}";

    rm_rf($work_path);
}
pave_delete("pave_work", array("user_no" => $pave_user["user_no"]));

//회원 로그인 삭제
pave_delete("pave_log_login", array("user_no" => $pave_user["user_no"]));

//회원 동의 삭제
pave_delete("pave_user_agree", array("user_no" => $pave_user["user_no"]));

//회원 삭제
pave_delete("pave_user", array("user_no" => $pave_user["user_no"]));
//회원 결제내역 삭제
//회원 신고 삭제

//회원 경로 삭제
$user_path = PAVE_DATA_USER_PATH."/{$pave_user["user_code"]}";
rm_rf($user_path);

session_unset();
session_destroy();

set_cookie("user_auto_login", '', -3600);
set_cookie("user_id", '', -3600);

die(return_json(null, "success", "", get_url(PAVE_URL)));
//todo: data check
?>