<?php
/* $now_ymd = PAVE_TIME_YMD;
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

$sql = "SELECT * FROM pave_epsd WHERE work_id IN('{$reserve_work_id}') AND date_format(epsd_upload_dt, '%Y-%m-%d') = '{$now_ymd}' AND epsd_cate = 'rest'";
$result = pave_query($sql);

$reserve_rest = array();
for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
    $reserve_rest[] = $row;
}

foreach ((array)$reserve_rest as $i => $epsd) {
    $work = $reserve_work[$epsd["work_id"]];
    $work_update = array();
 
    if($epsd["epsd_state"] == "reserve"){
        $work_update["work_rest_cnt"] = $work["work_rest_cnt"] + 1;
        $work_update["work_reserve_cnt"] = $work["work_reserve_cnt"] - 1;
        $work_update["work_state"] = "stop";

        pave_update("pave_epsd", array("epsd_state" => "success"), "epsd_id = '{$epsd["epsd_id"]}'");
    }
    pave_update("pave_work", $work_update, "work_id = '{$work["work_id"]}'");

} */
?>