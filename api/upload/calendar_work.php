<?php
$calendar_start = pave_input_sanitize($calendar_start);
$calendar_end = pave_input_sanitize($calendar_end);

$calendar_start = date("Y-m-d", $calendar_start);
$calendar_end = date("Y-m-d", $calendar_end);


$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT work.*, DATE(work.work_insert_dt) AS work_insert_date, DATE(work.work_end_dt) AS work_end_date FROM pave_work AS work")
->set_sql_where("user_no = '{$pave_user["user_no"]}'")
->set_sql_order("ORDER BY work.work_insert_dt DESC");
$work_list = array();
$result = pave_query($obj->generate_sql());
for ($i=0; $row = pave_fetch_assoc($result); $i++) {
    $row["work_day_list"] = pave_explode($row["work_day"], ",");
    $row["work_insert_timestamp"] = strtotime(Converter::display_time($row["work_insert_dt"]));
    if(!is_time_null($row["work_end_dt"])){
        $row["work_end_timestamp"] = strtotime(Converter::display_time($row["work_end_dt"]));
    }

    $obj2 = new Objects2();
    $obj2->generate_sql_init()
    ->set_sql_common("SELECT epsd.*, DATE(epsd.epsd_upload_dt) AS epsd_upload_date FROM pave_epsd AS epsd")
    ->set_sql_where("epsd.user_no = '{$pave_user["user_no"]}'")
    ->set_sql_where("((DATE(epsd.epsd_upload_dt)) >= '{$calendar_start}' AND (DATE(epsd.epsd_upload_dt)) < ('{$calendar_end}' + INTERVAL 1 DAY))");
    $epsd_list = array();
    $result2 = pave_query($obj2->generate_sql());
    for ($j=0; $row2 = pave_fetch_assoc($result2); $j++) {
        $epsd_list[] = $row2;
    }

    $row["epsd_list"] = $epsd_list;
    $work_list[] = $row;
}

die(return_json($work_list, "success"));

$yoil = array("일", "월", "화", "수", "목", "금", "토");

$sql = array();
$sql_where = array();
$sql_common = array();

$sql_common[] = "SELECT work.*, user_img, user.user_nick, user.user_code, user.user_field, user.user_commerce, commerce.commerce_reserve FROM pave_work AS work";
$sql_common[] = "LEFT JOIN pave_user AS user ON user.user_id = work.user_id";
$sql_common[] = "LEFT JOIN pave_cf_commerce AS commerce ON user.user_grd = commerce.commerce_id";
$sql_where[] = "WHERE (work.user_id = '{$pave_user["user_id"]}' OR FIND_IN_SET('{$pave_user["user_id"]}', work.work_with))";
$sql_order = "ORDER BY work.work_insert_dt DESC";
$sql_common = pave_implode($sql_common, " ");
$sql_where = pave_implode($sql_where, " AND ");
$sql[] = $sql_common;
$sql[] = $sql_where;
$sql[] = $sql_order;
$sql = pave_implode($sql, " ");
$result = pave_query($sql);
$event_list = array();
for ($i = 0; $row = pave_fetch_assoc($result); $i++) { // 모든 작품 출력
    $day_of_week = array();
    $row["work_day"] = pave_explode($row["work_day"], ",");
    foreach ($row["work_day"] as $day) {
        $day_of_week[] = array_search($day, $yoil);
    }
    sort($day_of_week);

    $epsd_last_upload_date = "";
    //등록된 에피소드
    $sql2 = "SELECT * FROM pave_epsd WHERE work_id = '{$row["work_id"]}'";
    $result2 = pave_query($sql2);
    $epsd_cnt = pave_row($result2);
    for ($j = 0; $row2 = pave_fetch_assoc($result2); $j++) {

        if ($row["work_state"] == "end") {
            $event_html = '<span class="calendar-badge__text">완결</span>';
            $event_html .= '<span class="calendar-badge__text2 text-truncate">' . $row2["epsd_name"] . '</span>';
        } else {
            if ($row2["epsd_state"] == "reserve") {
                $event_html = '<span class="calendar-badge__text">예약</span>';
                $event_html .= '<span class="calendar-badge__text2 text-truncate">' . $row2["epsd_name"] . '</span>';
            } else if ($row2["epsd_state"] == "success") {

                if ($row2["epsd_delay"]) {
                    $event_html = '<span class="calendar-badge__text delay">지각</span>';
                } else {
                    $event_html = '<span class="calendar-badge__text">연재중</span>';
                }


                $event_html .= '<span class="calendar-badge__text2 text-truncate">' . $row2["epsd_name"] . '</span>';
            } else if ($row2["epsd_state"] == "save") {
                $event_html = '<span class="calendar-badge__text">임시저장</span>';
            }
        }
        $event_list[] = array(
            "groupId"   => $row["work_id"],
            "id"        => $row2["epsd_id"],
            "color"     => $row["work_color"],
            "start"     => $row2["epsd_upload_dt"],
            "extendedProps" => array(
                "epsd_html" => $event_html
            )
        );

        $epsd_last_upload_date = $row2["epsd_upload_dt"];
    }

    //남은 일수 계산
    $day_of_week_length = count($day_of_week);
    if ($epsd_last_upload_date) {
        $last_day_of_week = date("w", strtotime($epsd_last_upload_date));
        $next_day_of_week_key = array_search($last_day_of_week, $day_of_week);
        $next_day_of_week_index = ($next_day_of_week_key + 1) % $day_of_week_length;
        $next_day_of_week = $day_of_week[$next_day_of_week_index];
    } else {
        $last_day_of_week = date("w", PAVE_TIME);
        $closest_day_of_week_key = null;
        for ($i = 0; $i < count($day_of_week); $i++) {
            $now = $day_of_week[$i];

            if ($now == 0) {
                $now = 7;
            }

            if ($now >= $last_day_of_week) {
                $closest_day_of_week_key = $i;
                break;
            }
        }

        $next_day_of_week_index = ($closest_day_of_week_key) % $day_of_week_length;
        $next_day_of_week = $day_of_week[$next_day_of_week_index];
    }

    $day_cnt = 0;
    if ($last_day_of_week >= $next_day_of_week) {
        $day_cnt = 7 - ($last_day_of_week - $next_day_of_week);
    } else {
        $day_cnt = $next_day_of_week - $last_day_of_week;
    }

    if ($epsd_last_upload_date) {
        $reserve_start_date = Converter::display_time("Y-m-d H:i:s", $epsd_last_upload_date . " +{$day_cnt} days");
        if (strtotime($epsd_last_upload_date) > PAVE_TIME) {
            $reserve_end_date = $reserve_start_date;
        } else {
            $current_day_of_week = date("w", PAVE_TIME);

            //오늘을 포함한 이전 업로드 가능 일자 뽑기
            if (in_array($current_day_of_week, $day_of_week)) {
                $closest_day_of_week_key2 = array_search($current_day_of_week, $day_of_week);
                /*   $closest_day_of_week_key2--;
                if($closest_day_of_week_key2 < 0){
                    $closest_day_of_week_key2 = $day_of_week_length-1;
                } */
                $day_cnt2 = 0;
            } else {
                $closest_day_of_week_key2 = null;
                $current_day_of_week2 = $current_day_of_week != 0 ? $current_day_of_week : 7;
                rsort($day_of_week);
                for ($i = 0; $i < count($day_of_week); $i++) {
                    $now = $day_of_week[$i];

                    if ($now == 0) {
                        $now = 7;
                    }

                    if ($current_day_of_week2 >= $now) {
                        $closest_day_of_week_key2 = $i;
                     
                        break;
                    }
                }
                $end_day_of_week = $day_of_week[$closest_day_of_week_key2];

                $day_cnt2 = $current_day_of_week - $end_day_of_week;
                sort($day_of_week);
            }

            $reserve_end_date = Converter::display_time("Y-m-d H:i:s", PAVE_TIME_YMD . " -{$day_cnt2} days" . " +{$row["work_time"]} hours");
        }
    } else {
        $reserve_start_date = Converter::display_time("Y-m-d H:i:s", PAVE_TIME_YMD . " +{$day_cnt} days" . " +{$row["work_time"]} hours");
        $reserve_end_date = $reserve_start_date;
    }



    //남은 예약 계산
     if(!$row["user_commerce"]){
        $row["commerce_reserve"] = 5;
    }
    $remain_reserve_cnt = $row["commerce_reserve"] - $row["work_reserve_cnt"];
    if($remain_reserve_cnt > 0){
        $reserve_start_date = "";
        $reserve_end_date = "";
        if($epsd_last_upload_date){
            $reserve_start_date = Converter::display_time("Y-m-d", $epsd_last_upload_date." +1 days");
        }else{
            if(strtotime($row["work_insert_dt"]) < strtotime(PAVE_TIME_YMDHIS)){
                $reserve_start_date = Converter::display_time("Y-m-d",PAVE_TIME_YMDHIS);
            }else{
                $reserve_start_date = Converter::display_time("Y-m-d",$row["work_insert_dt"]);
            }
        }

        $day_cnt = "";
        $week_cnt = 0;
        while($remain_reserve_cnt > 0){
            for ($i=0; $i < count($day_of_week); $i++) {
                if($remain_reserve_cnt == 0){
                    break;
                }

                if($week_cnt == 0){
                    if(date("w", strtotime($reserve_start_date)) > $day_of_week[$i]){
                        continue;
                    }
                }
                $day_cnt = $day_of_week[$i];
                --$remain_reserve_cnt;
            }
            if($remain_reserve_cnt == 0){
                break;
            }
            $week_cnt++;
        }

        $day_cnt++;
        $reserve_end_date = " + {$week_cnt} weeks ".($day_cnt-date("w", PAVE_TIME))." days";
        
        $reserve_start_date = Converter::display_time("Y-m-d", $reserve_start_date);
        $reserve_end_date = Converter::display_time("Y-m-d", $reserve_start_date.$reserve_end_date);
        if($reserve_start_date == $reserve_end_date){
            $reserve_end_date = Converter::display_time("Y-m-d H:i:s", $reserve_end_date." + 86399 seconds");
        }else{
            $reserve_end_date = Converter::display_time("Y-m-d H:i:s", $reserve_end_date." - 1 seconds");
        }
        $reserve_start_date = Converter::display_time("Y-m-d H:i:s", $reserve_start_date);

        $event = array(
            "groupId" => $row["work_id"],
            "daysOfWeek" => $day_of_week,
            "color" => $row["work_color"],
            "startRecur" => $reserve_start_date,
            "endRecur" =>  $reserve_end_date
        );

        if(strtotime(Converter::display_time("Y-m-d",PAVE_TIME_YMDHIS)) > strtotime($reserve_start_date)){
            $event["extendedProps"] = array(
                "epsd_html" => '<span class="calendar-badge__text">미연재</span>'
            );
        }
        $event_list[] = $event;
    }
}
die(json_encode($event_list, JSON_UNESCAPED_UNICODE));
