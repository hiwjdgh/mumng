<?php
$calendar_date = pave_input_sanitize($calendar_date);
$calendar_date_yoil = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일")[date("w", $calendar_date_yoil)];
$work_id_list = pave_input_sanitize($work_id_list);
$work_id_list = pave_explode($work_id_list, ",");

//캘린더 가져오기
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT * FROM pave_upload_calendar")
->set_sql_where("user_no = '{$pave_user["user_no"]}'")
->set_sql_where("calendar_date = '{$calendar_date}'");
$memo = pave_fetch($obj->generate_sql());


//작품 가져오기
$work_list = array();
foreach ($work_id_list as $i => $work_id) {
    $work_obj = new Work();
    $work = $work_obj->set_user_no($pave_user["user_no"])->set_work_id($work_id)->get_work();
    $work_list[] = $work;
}

foreach ($work_list as $i => $work) {
    $sql = "SELECT epsd_id, epsd_name, epsd_cate, epsd_state, epsd_insert_dt, epsd_upload_dt FROM pave_epsd WHERE work_id = '{$work["work_id"]}' AND date_format(epsd_upload_dt, '%Y-%m-%d') = '{$calendar_date}'";
    $row = pave_fetch($sql);

    if($row["epsd_id"]){
        if($row["epsd_state"] == "reserve"){
            $row["epsd_state_text"] = "예약";
        }else if($row["epsd_state"] == "success"){
            $row["epsd_state_text"] = "연재중";
        }else if($row["epsd_state"] == "save"){
            $row["epsd_state_text"] = "임시저장";
        }
        $row["epsd_insert_dt_text"] = Converter::display_time("Y-m-d", $row["epsd_insert_dt"]);
        $row["epsd_upload_dt_text"] = Converter::display_time("Y-m-d", $row["epsd_upload_dt"]);
    }else{
        if(Converter::display_time_elapse($calendar_date, PAVE_TIME_YMD) < 0){
            $row["epsd_state_text"] = "미연재";
        }
    }
 
    $work_list[$i]["epsd"] = $row;
}


$return = array(
    "work_list" => $work_list,
    "calendar" => $memo
);

$theme_path = $pave_theme["thm_path"]."/calendar_popup.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "fail", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));


?>