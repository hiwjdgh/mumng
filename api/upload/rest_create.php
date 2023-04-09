<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

$work_config = $config_obj->get_work_config("webtoon");
$epsd_config = $config_obj->get_epsd_config($epsd_cate);

$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);
$epsd_cate = pave_input_sanitize($epsd_cate);
$epsd_upload_date = pave_input_sanitize($epsd_upload_date);
$epsd_name = "휴재";
$epsd_content = pave_input_sanitize($epsd_content);
$epsd_agree = pave_input_sanitize($epsd_agree);


//작품 가져오기
$work_obj = new Work();
$work = $work_obj->set_user_no($pave_user["user_no"])->set_work_id($work_id)->get_work();

if(!$work["work_id"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

if(!$work["is_own"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}



//회차내용 검사
if($msg = sanitize_epsd_content($epsd_content, true)){
    die(return_json(null, "200", $msg));
}

//작품 운영원칙 검사
if($msg = sanitize_work_agree($epsd_agree)){
    die(return_json(null, "200", $msg));
}

//지각 검사
$epsd_delay = 0;
$epsd_upload_dt = Converter::display_time($epsd_upload_date." +{$work["work_time"]} hours", "Y-m-d H:i:s");
if(PAVE_TIME > strtotime($epsd_upload_dt)){
    $epsd_delay = 1;
}

//회차 상태 검사
$epsd_state = "reserve";
if($epsd_delay){
    $epsd_state = "success";
}
        
$epsd = array(
    "work_id"               => $work["work_id"],
    "user_no"               => $pave_user["user_no"],
    "epsd_no"               => "-1",
    "epsd_no_type"          => "",
    "epsd_cate"             => "notice",
    "epsd_name"             => $epsd_name,
    "epsd_seo_tit"          => $epsd_name,
    "epsd_content"          => $epsd_content,
    "epsd_agree"            => $epsd_agree,
    "epsd_state"            => $epsd_state,
    "epsd_delay"            => $epsd_delay,
    "epsd_upload_dt"        => $epsd_upload_dt,
    "epsd_upload_ip"        => PAVE_USER_IP,
    "epsd_insert_dt"        => PAVE_TIME_YMDHIS,
    "epsd_insert_ip"        => PAVE_USER_IP,
    "epsd_update_dt"        => PAVE_TIME_YMDHIS,
    "epsd_update_ip"        => PAVE_USER_IP
);

$result = pave_insert("pave_epsd", $epsd);

if(!$result){
    die(return_json(null,"fail", "휴재등록에 실패했습니다."));
}

//작품 수정
$update = array();
if($epsd_state == "success"){
    $update["work_update_dt"] = PAVE_TIME_YMDHIS; 
    $update["work_update_ip"] = PAVE_USER_IP;    
    $update["work_rest_cnt"] = $work["work_rest_cnt"] + 1;
    $update["work_upload_cnt"] = $work["work_upload_cnt"] + 1;

    //첫 회차 시작 수정 
    if(is_time_null($work["work_start_dt"])){
        $update["work_start_dt"] = PAVE_TIME_YMDHIS;
    }
    
    //지각 수 수정
    if($epsd_delay){
        $update["work_delay_cnt"] = $work["work_delay_cnt"] + 1;
    }

}else if($epsd_state == "reserve"){
    $update["work_reserve_cnt"] = $work["work_reserve_cnt"] + 1;

    //작품 예약 알림
    $notify_obj = new Notification();
    $notify_obj->send_notify("mumng", $pave_user["user_id"], "notify_work_reserve", array("work_id" => $work["work_id"], "epsd_id" => $epsd_id));
}

pave_update("pave_work", $update, "work_id = '{$work["work_id"]}'");
die(return_json(null, "success"));
?>