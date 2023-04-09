<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}


$work_config = $config_obj->get_work_config("webtoon");
$epsd_config = $config_obj->get_epsd_config($epsd_cate);
$epsd_img_config = $config_obj->get_file_config("epsd_img");
$epsd_copy_config = $config_obj->get_file_config("epsd_copy");

$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);
$epsd_cate = pave_input_sanitize($epsd_cate);
$epsd_upload_date = pave_input_sanitize($epsd_upload_date);
$epsd_no_type = pave_input_sanitize($epsd_no_type);
$epsd_name = pave_input_sanitize($epsd_name);
$epsd_eplg = pave_input_sanitize($epsd_eplg);
$epsd_copyright = pave_input_sanitize($epsd_copyright);
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


//회차타입 검사
if($msg = sanitize_epsd_no_type($epsd_no_type, true)){
    die(return_json(null, "fail", $msg));
}

//회차 번호 검사
$latest_epsd_no = Epsd::generate_epsd_no($work);
if($latest_epsd_no === null && $epsd_no_type == "prlg"){
    $epsd_no = 0;
}else{
    $epsd_no = $latest_epsd_no + 1;   
}

//회차 이미지 검사
if($msg = sanitize_epsd_img($epsd_tmp_img, true)){
    die(return_json(null, "fail", $msg));
}

//회차명 검사
if($msg = sanitize_epsd_name($epsd_name, true)){
    die(return_json(null, "fail", $msg));
}

//회차원고 검사
if($msg = sanitize_epsd_copy($epsd_tmp_copy, true)){
    die(return_json(null, "fail", $msg));
}

//회차에필로그 검사
if($msg = sanitize_epsd_eplg($epsd_eplg, true)){
    die(return_json(null, "fail", $msg));
}

//작품 운영원칙 검사
if($msg = sanitize_work_agree($epsd_agree)){
    die(return_json(null, "fail", $msg));
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
    "epsd_no"               => $epsd_no,
    "epsd_no_type"          => $epsd_no_type,
    "epsd_cate"             => "epsd",
    "epsd_name"             => $epsd_name,
    "epsd_seo_tit"          => $epsd_name,
    "epsd_eplg"             => $epsd_eplg,
    "epsd_copyright"        => $epsd_copyright,
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
    die(return_json(null, "fail", "회차등록에 실패했습니다."));
}

$epsd_id = pave_insert_id();

//회차 이미지 검사
$epsd_img_tmp_path = PAVE_DATA_TEMP_PATH;
$epsd_img_tmp_url = PAVE_DATA_TEMP_URL;
$epsd_img_path = PAVE_DATA_WEBTOON_PATH."/{$work["work_id"]}/{$epsd_id}/";
$epsd_img_url =  PAVE_DATA_WEBTOON_URL."/{$work["work_id"]}/{$epsd_id}/";
$file_obj = new Files();
@mkdir($epsd_img_path, PAVE_DIR_PERMISSION, true);

if($epsd_tmp_img){
    $epsd_tmp_img = json_decode(stripslashes($epsd_tmp_img) , true);
    $epsd_tmp_img_full_path = PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR.$epsd_tmp_img["name"];
    $epsd_img_full_path = $epsd_img_path.$epsd_tmp_img["name"];

    //회차 이미지 이동
    rename($epsd_tmp_img_full_path, $epsd_img_full_path);

    //파일 등록
    if($file_obj->file_insert($epsd_img_full_path, "epsd_img", $epsd_tmp_img, $work["work_id"], $epsd_id)){
        $update = array(
            "epsd_img"      => str_replace($epsd_img_path, $epsd_img_url, $epsd_img_full_path),
        );

        pave_update("pave_epsd", $update, "epsd_id = '{$epsd_id}'");
    }
}

//회차 원고 검사
$epsd_copy_tmp_path = PAVE_DATA_TEMP_PATH;
$epsd_copy_tmp_url = PAVE_DATA_TEMP_URL;
$epsd_copy_path = PAVE_DATA_WEBTOON_PATH."/{$work["work_id"]}/{$epsd_id}/";
$epsd_copy_url =  PAVE_DATA_WEBTOON_URL."/{$work["work_id"]}/{$epsd_id}/";

@mkdir($epsd_copy_path, PAVE_DIR_PERMISSION, true);

if(pave_is_array($epsd_tmp_copy)){
    $epsd_content = "";
    

    foreach ($epsd_tmp_copy as $key => $value) {
        $epsd_tmp_copy_item = json_decode(stripslashes($value) , true);

        $epsd_tmp_copy_full_path = PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR.$epsd_tmp_copy_item["name"];
        $epsd_copy_full_path = $epsd_copy_path.$epsd_tmp_copy_item["name"];

        if(!is_file($epsd_tmp_copy_full_path) || !file_exists($epsd_tmp_copy_full_path)){
            continue;
        }

        if($epsd_copyright == $key){
            $epsd_content .= "<img src=\"".get_url(PAVE_IMG_URL, "img_copyright_960px.png")."\" alt=\"회차이미지\">";
        }

        $resize_image = new \Gumlet\ImageResize($epsd_tmp_copy_full_path);
        $resize_image->resizeToWidth(960);
        $resize_image->save($epsd_tmp_copy_full_path);

        //원고 이미지 이동
        rename($epsd_tmp_copy_full_path, $epsd_copy_full_path);


        //파일 등록
        if($file_obj->file_insert($epsd_copy_full_path, "epsd_copy", $epsd_tmp_copy_item, $work["work_id"], $epsd_id, $key)){
            $epsd_content .= "<img src=\"".str_replace($epsd_copy_path, $epsd_copy_url, $epsd_copy_full_path)."\" alt=\"회차이미지\">";
        }
    }

    if($epsd_copyright == ($key+1)){
        $epsd_content .= "<img src=\"".get_url(PAVE_IMG_URL, "img_copyright_960px.png")."\" alt=\"회차이미지\">";
    }

    pave_update("pave_epsd", array("epsd_content" => $epsd_content), "epsd_id = '{$epsd_id}'");
}


//작품 수정
$update = array();
if($epsd_state == "success"){
    $update["work_update_dt"] = PAVE_TIME_YMDHIS; 
    $update["work_update_ip"] = PAVE_USER_IP;    
    $update["work_epsd_cnt"] = $work["work_epsd_cnt"] + 1;
    $update["work_upload_cnt"] = $work["work_upload_cnt"] + 1;

    //첫 회차 시작 수정 
    if(is_time_null($work["work_start_dt"])){
        $update["work_start_dt"] = PAVE_TIME_YMDHIS;
    }
    
    //지각 수 수정
    if($epsd_delay){
        $update["work_delay_cnt"] = $work["work_delay_cnt"] + 1;
    }

    //완결 수정
    if($epsd_no_type == "end"){
        $update["work_state"] = "end";
        $update["work_end_dt"] = PAVE_TIME_YMDHIS;
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