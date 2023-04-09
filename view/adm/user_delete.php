<?php
$temp = pave_input_sanitize($temp);

$delete_user_list = pave_explode($temp, ",");

foreach ((array)$delete_user_list as $i => $delete_user_id) {
    $sql_obj = new Objects();
    $sql_obj->set_sql_common("SELECT user.*, CONCAT(user.user_field, ',', user.user_genre) AS user_full_hashtag FROM pave_user AS user");
    $sql_obj->set_sql_where("WHERE user_id = '{$delete_user_id}'");
    $sql_obj->generate_sql();
    $delete_user = pave_fetch($sql_obj->get_sql());

    //회원 인증 삭제
    pave_delete("pave_cert", array("user_id" => $delete_user["user_id"]));
    //회원 캘린더 삭제
    pave_delete("pave_cal", array("user_id" => $delete_user["user_id"]));
    //회원 회차 삭제
    pave_delete("pave_epsd", array("user_id" => $delete_user["user_id"]));
    //회원 댓글 삭제
    pave_delete("pave_epsd_cmt", array("user_id" => $delete_user["user_id"]));
    //회원 구매내역 삭제
    pave_delete("pave_epsd_pay", array("user_id" => $delete_user["user_id"]));
    //회원 파일 삭제
    pave_delete("pave_file", array("user_id" => $delete_user["user_id"]));
    //회원 팔로우 삭제
    pave_delete("pave_user_follow", array("user_follower_from" => $delete_user["user_no"]));
    pave_delete("pave_user_follow", array("user_following_to" => $delete_user["user_no"]));
    //회원 조회 삭제
    pave_delete("pave_hit", array("user_id" => $delete_user["user_id"]));
    //회원 좋아요 삭제
    pave_delete("pave_like", array("user_id" => $delete_user["user_id"]));
    //회원 구독 삭제
    pave_delete("pave_subscribe", array("user_id" => $delete_user["user_id"]));
    //회원 작품 삭제
    $sql = "SELECT * FROm pave_work WHERE user_id= '{$delete_user["user_id"]}'";
    $result = pave_query($sql);
    for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
        $work_base_path = PAVE_DATA_WEBTOON_PATH;
        if($row["work_grp_id"] == "novel"){
            $work_base_path = PAVE_DATA_NOVEL_PATH;
        }
        $work_path = $work_base_path."/{$row["work_id"]}";
    
        rm_rf($work_path);
    }
    pave_delete("pave_work", array("user_id" => $delete_user["user_id"]));
  
    //회원 로그인 삭제
    pave_delete("pave_log_login", array("user_id" => $delete_user["user_no"]));
    //회원 동의 삭제
    pave_delete("pave_user_agree", array("user_id" => $delete_user["user_id"]));
    //회원 알림 설정 삭제
    pave_delete("pave_user_notify", array("user_no" => $delete_user["user_no"]));
    //회원 결제내역 삭제
    //회원 신고 삭제
    
    //회원 경로 삭제
    $user_path = PAVE_DATA_USER_PATH."/{$delete_user["user_code"]}";
    rm_rf($user_path);

    //회원 삭제
    pave_update("pave_user", array("user_leave_state" => 1, "user_leave_dt" => PAVE_TIME_YMDHIS), "user_id = '{$delete_user["user_id"]}'");
}

url_move(get_url(PAVE_ADM_URL, "user/list"));
?>