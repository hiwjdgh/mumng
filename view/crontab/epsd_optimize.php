<?php
$notify_obj = new Notification();

//마감 1시간 남은 작품
$deadline_ymd = date("Y-m-d", PAVE_TIME + 86400);
$deadline_day = array("일", "월", "화", "수", "목", "금", "토")[date("w", PAVE_TIME + 86400)];
$deadline_time = date("H", PAVE_TIME + 86400);

$sql = "SELECT * FROM pave_work WHERE work_day LIKE '%{$deadline_day}%' AND work_time = '{$deadline_time}'";
$result = pave_query($sql);

$deadline_work = array();
for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
    $deadline_work[$row["work_id"]] = $row;
}
$deadline_work_id = array_keys($deadline_work);
$deadline_work_id = pave_implode($deadline_work_id, "','");

$sql = "SELECT * FROM pave_epsd WHERE epsd_state = 'reserve' AND work_id IN('{$deadline_work_id}') AND date_format(epsd_upload_dt, '%Y-%m-%d') = '{$deadline_ymd}' ORDER BY epsd_insert_dt DESC";
$result = pave_query($sql);

for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
    unset($deadline_work[$row["work_id"]]);
}

foreach ((array)$deadline_work as $i => $work) {
    $notify_obj->send_notify("mumng", $work["user_id"], "notify_work_deadline", array("work_id" => $work["work_id"]));
}

//정상 예약 작품
$now_ymd = PAVE_TIME_YMD;
$now_day = PAVE_SHORT_YOIL;
$now_time = PAVE_HOUR;

$sql = "SELECT * FROM pave_work WHERE work_day LIKE '%{$now_day}%' AND work_time = '{$now_time}'";
$result = pave_query($sql);

$reserve_work = array();
for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
    $reserve_work[$row["work_id"]] = $row;
}
$reserve_work_id = array_keys($reserve_work);
$reserve_work_id = pave_implode($reserve_work_id, "','");

$sql = "SELECT * FROM pave_epsd WHERE epsd_state = 'reserve' AND work_id IN('{$reserve_work_id}') AND date_format(epsd_upload_dt, '%Y-%m-%d') = '{$now_ymd}' ORDER BY epsd_insert_dt DESC";
$result = pave_query($sql);

$reserve_epsd = array();
for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
    $reserve_epsd[] = $row;
}

foreach ((array)$reserve_epsd as $i => $epsd) {
    $work = $reserve_work[$epsd["work_id"]];

    $work_update = array(
        "work_upload_cnt" => $work["work_upload_cnt"] + 1,
        "work_reserve_cnt" => $work["work_reserve_cnt"] - 1,
        "work_update_dt" => PAVE_TIME_YMDHIS
    );

    if($epsd["epsd_cate"] == "epsd"){ //회차
        $work_update["work_epsd_cnt"] = $work["work_epsd_cnt"] + 1;
        $work_update["work_state"] = "publish";
        //첫 회차 시작 수정 
        if(is_time_null($work["work_start_dt"])){
            $work_update["work_start_dt"] = PAVE_TIME_YMDHIS;
        }

        //완결
        if($epsd["epsd_no_type"] == "end"){
            $work_update["work_state"] = "end";
            $work_update["work_end_dt"] = PAVE_TIME_YMDHIS;
        }

    }else if($epsd["epsd_cate"] == "notice"){ //공지
        $work_update["work_state"] = "publish";
        $work_update["work_notice_cnt"] = $work["work_notice_cnt"] + 1;

    }else if($epsd["epsd_cate"] == "rest"){ //휴재
        $work_update["work_state"] = "stop";
        $work_update["work_rest_cnt"] = $work["work_rest_cnt"] + 1;
    }

    pave_update("pave_work", $work_update, "work_id = '{$work["work_id"]}'");
    pave_update("pave_epsd", array("epsd_state" => "success"), "epsd_id = '{$epsd["epsd_id"]}'");

    //강등 작가 복구
    pave_update("pave_user", array("user_commerce_demote" => 0, "user_commerce_demote_dt" => "0000-00-00 00:00:00"), "user_id = '{$work["user_id"]}'");

    //작품 업로드 알림
    $notify_obj->send_notify("mumng", $work["user_id"], "notify_work_complete", array("work_id" => $work["work_id"], "epsd_id" => $epsd["epsd_id"]));

    //구독 작품 알림
    $sql2 = "SELECT * FROM pave_subscribe WHERE work_id = '{$work["work_id"]}'";
    $result2 = pave_query($sql2);

    for ($j=0; $row2 = pave_fetch_assoc($result2) ; $j++) { 
        if($epsd["epsd_cate"] == "epsd"){ //회차
            //구독 작품 새 회차 알림
            $notify_obj->send_notify($work["user_id"], $row2["user_id"], "notify_subscribe_epsd", array("work_id" => $work["work_id"]));
        }else if($epsd["epsd_cate"] == "notice"){ //공지
            //구독 작품 새 공지 알림
            $notify_obj->send_notify($work["user_id"], $row2["user_id"], "notify_subscribe_notice", array("work_id" => $work["work_id"]));
        }else if($epsd["epsd_cate"] == "rest"){ //휴재
            //구독 작품 휴재 알림
            $notify_obj->send_notify($work["user_id"], $row2["user_id"], "notify_subscribe_rest", array("work_id" => $work["work_id"], "rest_date" => $now_ymd));
        }
    }

    unset($reserve_work[$epsd["work_id"]]);
}

// 회차 지각 알림
foreach ((array)$reserve_work as $i => $late_work) {
    $notify_obj->send_notify("mumng", $late_work["user_id"], "notify_work_late", array("work_id" => $late_work["work_id"]));
}
?>