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

if($epsd_id){
    //회차 가져오기
    $epsd_obj = new Epsd();
    $epsd = $epsd_obj->set_user_no($pave_user["user_no"])->set_work_id($work["work_id"])->set_epsd_id($epsd_id)->get_epsd();
    
    if(!$epsd["epsd_id"]){
        die(return_json(null, "fail", "비정상적인 접근입니다."));
    }

    $update = array(
        "epsd_content"          => $epsd_content,
        "epsd_agree"            => $epsd_agree,
        "epsd_update_dt"        => PAVE_TIME_YMDHIS,
        "epsd_update_ip"        => PAVE_USER_IP
    );
    $result = pave_update("pave_epsd", $update, "epsd_id = '{$epsd["epsd_id"]}'");

    if(!$result){
        die(return_json(null, "fail", "휴재 임시저장에 실패했습니다."));
    }
}else{
    //회차 번호 검사
    $epsd_no = -1;
    $epsd_upload_dt = Converter::display_time($epsd_upload_date." +{$work["work_time"]} hours", "Y-m-d H:i:s");

    $epsd = array(
        "work_id"               => $work["work_id"],
        "user_no"               => $pave_user["user_no"],
        "epsd_no"               => $epsd_no,
        "epsd_no_type"          => "",
        "epsd_cate"             => "rest",
        "epsd_name"             => $epsd_name,
        "epsd_seo_tit"          => $epsd_name,
        "epsd_content"          => $epsd_content,
        "epsd_agree"            => $epsd_agree,
        "epsd_state"            => "save",
        "epsd_delay"            => 0,
        "epsd_upload_dt"        => $epsd_upload_dt,
        "epsd_upload_ip"        => PAVE_USER_IP,
        "epsd_insert_dt"        => PAVE_TIME_YMDHIS,
        "epsd_insert_ip"        => PAVE_USER_IP,
        "epsd_update_dt"        => PAVE_TIME_YMDHIS,
        "epsd_update_ip"        => PAVE_USER_IP
    );
    
    $result = pave_insert("pave_epsd", $epsd);
    
    if(!$result){
        die(return_json(null,"fail", "휴재 임시저장에 실패했습니다."));
    }
    
    $epsd_id = pave_insert_id();
}

die(return_json(null, "success"));
?>