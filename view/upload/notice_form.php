<?php
$work_id = pave_input_sanitize($request[3]);
$cal_date = pave_input_sanitize($request[4]);

$epsd_cf = Epsds::epsd_cf("notice");

$work_obj = new W();
$work_obj->set_work_user_id($pave_user["user_id"]);
$work_obj->set_work_display(null);
$work_obj->set_work_upload_cnt(null);
$work_obj->set_work_order("update");
$work_obj->set_work_page(0);

$work = $work_obj->get_work($work_id);

if(!$work["work_id"]){
    alert("작품을 찾을 수 없습니다.", get_url(PAVE_UPLOAD_URL, "home"));
}

$epsd_obj = new Epsds();
$epsd_obj->set_work_id($work["work_id"]);
$epsd_obj->set_epsd_display(null);
$epsd_obj->set_epsd_append("date_format(epsd.epsd_upload_dt, '%Y-%m-%d') = '{$cal_date}'");
$epsd_obj->set_epsd_page(0);

$epsd = $epsd_obj->get_epsd_list()[0];

if($epsd["epsd_id"]){
    $epsd_action = "u";

    $epsd_form_title = "공지편집";
}else{
    $epsd_action = "c";

    $epsd_form_title = "공지등록";

    $latest_no = Epsds::get_latest_epsd_no($work["work_id"]);

    if($latest_no === null || $latest_no === 0){
        $epsd_no = 1;
    }else{
        $epsd_no = $latest_no + 1;   
    }
    
    //미연재 작품 검사
    $sql = "SELECT * FROM pave_epsd WHERE work_id = '{$work["work_id"]}' ORDER BY epsd_id DESC LIMIT 1";
    $last_epsd = pave_fetch($sql);


    if($last_epsd["epsd_upload_dt"]){
        $yoil = array("일","월","화","수","목","금","토");
        $day_of_week = array();
        $work_days = pave_explode($work["work_day"], ",");
        foreach ($work_days as $day) {
            $day_of_week[] = array_search($day, $yoil);
        }
        sort($day_of_week);

        $day_of_week_length = count($day_of_week);

        $last_day_of_week = date("w", strtotime($last_epsd["epsd_upload_dt"]));
        $next_day_of_week_key = array_search($last_day_of_week, $day_of_week);
        $next_day_of_week_index = ($next_day_of_week_key + 1) % $day_of_week_length;
        $next_day_of_week = $day_of_week[$next_day_of_week_index];

        $day_cnt = 0;
        if($last_day_of_week >= $next_day_of_week){
            $day_cnt = 7 - ($last_day_of_week - $next_day_of_week);
        }else{
            $day_cnt = $next_day_of_week - $last_day_of_week;
        }

        if($last_epsd["epsd_state"] == "save"){
            $next_date = Converter::display_time("Y-m-d", $last_epsd["epsd_upload_dt"]);
        }else{
            $next_date = Converter::display_time("Y-m-d", $last_epsd["epsd_upload_dt"]." +{$day_cnt} days");
        }

        if($next_date != $cal_date){
            alert("{$next_date} 회차 부터 연재해주세요.", get_url(PAVE_UPLOAD_URL, "home"));
        }
    }
}

//회차 원고
$epsd_copy = array();
$epsd_copy_list = $file_obj->get_file_list("epsd_copy", $work["work_id"], $epsd["epsd_id"]);
if(pave_is_array($epsd_copy_list)){
    foreach ((array)$epsd_copy_list as $i => $copy) {
        $epsd_copy["list"][] = array(
            "orgn" => $copy["file_orgn_name"],
            "name" => $copy["file_full_name"],
            "url" => PAVE_DATA_WEBTOON_URL.DIRECTORY_SEPARATOR.$work["work_id"].DIRECTORY_SEPARATOR.$epsd["epsd_id"].DIRECTORY_SEPARATOR.$copy["file_full_name"],
            "size" => $copy["file_size"],
            "size_text" => Converter::display_byte_format($copy["file_size"]),
            "is_success" => true
        );
    }
    $epsd_copy["total_size"] = array_sum(array_column($epsd_copy["list"], 'size'));
 
}else{
    $epsd_copy["total_size"] = 0;
}
$epsd_copy["total_size_text"] = Converter::display_byte_format($epsd_copy["total_size"]);
$epsd_copy["total_max_size"] = Converter::display_byte($epsd_copy_cf["file_total_size"].$epsd_copy_cf["file_total_unit"]);
$epsd_copy["total_ratio"] = (int)($epsd_copy["total_size"] / $epsd_copy["total_max_size"]) * 100;


//헤더 불러오기
get_header($epsd_form_title." - 업로드");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/notice_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/upload/notice_form.view.php");
}

//푸터 불러오기
get_footer();
?>