<?php
if(get_session("csrf_token") != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

$work_id = get_unique(20);
$work_display = pave_input_sanitize($work_display);
$work_name = pave_input_sanitize($work_name);
$work_description = pave_input_sanitize($work_description);
$work_day = pave_input_sanitize($work_day);
$work_time = pave_input_sanitize($work_time);
$work_age = pave_input_sanitize($work_age);
$work_genre = pave_input_sanitize($work_genre);
$work_hashtag = pave_input_sanitize($work_hashtag);
$work_with = pave_input_sanitize($work_with);
$work_free = pave_input_sanitize($work_free);
$work_agree = pave_input_sanitize($work_agree);

//작품 대표이미지 검사
if(!$work_tmp_img){
    die(return_json(null, "fail", "대표이미지를 등록해주세요."));
}

//작품명 검사
if($msg = sanitize_work_name($work_name)){
    die(return_json(null, "fail", $msg));
}

//작품 줄거리 검사
if($msg = sanitize_work_description($work_description)){
    die(return_json(null, "fail", $msg));
}

//작품 연재요일 검사
if($msg = sanitize_work_day($work_day)){
    die(return_json(null, "fail", $msg));
}

//작품 연재시간 검사
if($msg = sanitize_work_time($work_time)){
    die(return_json(null, "fail", $msg));
}

//작품 연령 검사
if($msg = sanitize_work_age($work_age)){
    die(return_json(null, "fail", $msg));
}

//작품 장르 검사
if($msg = sanitize_work_genre($work_genre)){
    die(return_json(null, "fail", $msg));
}

//작품 해시태그 검사
if($msg = sanitize_work_hashtag($work_hashtag)){
    die(return_json(null, "fail", $msg));
}

//작품 연재 EXP 검사
if($pave_user["user_commerce_state"]){
    if($work_free){
        $work_preview_exp = 0;
        $work_rent_exp = 0;
        $work_keep_exp = 0;
        $work_end_exp = 0;
        $work_preview2_exp = pave_input_sanitize($work_preview2_exp);
        $work_keep2_exp = pave_input_sanitize($work_keep2_exp);
        $work_end2_exp = pave_input_sanitize($work_end2_exp);

    }else{
        $work_preview_exp = pave_input_sanitize($work_preview_exp);
        $work_rent_exp = pave_input_sanitize($work_rent_exp);
        $work_keep_exp = pave_input_sanitize($work_keep_exp);
        $work_end_exp = pave_input_sanitize($work_end_exp);
        $work_preview2_exp = 0;
        $work_keep2_exp = 0;
        $work_end2_exp = 0;
    }
}else{
    $work_free = 1;
    $work_preview_exp = 0;
    $work_rent_exp = 0;
    $work_keep_exp = 0;
    $work_end_exp = 0;
    $work_preview2_exp = 0;
    $work_keep2_exp = 0;
    $work_end2_exp = 0;
}

//작품 운영원칙 검사
if($msg = sanitize_work_agree($work_agree)){
    die(return_json(null, "fail", $msg));
}

$work_full_hashtag = array_unique(array_merge($work_genre,$work_hashtag));

$work = array(
    "work_id"             => $work_id,
    "user_no"             => $pave_user["user_no"],
    "work_grp_id"         => "webtoon",
    "work_display"        => $work_display,
    "work_name"           => $work_name,
    "work_description"    => $work_description,
    "work_day"            => pave_implode($work_day, ","),
    "work_time"           => $work_time,
    "work_age"            => $work_age,
    "work_genre"          => pave_implode($work_genre, ","),
    "work_hashtag"        => pave_implode($work_hashtag, ","),
    "work_full_hashtag"   => pave_implode($work_full_hashtag, ","),
    "work_free"           => $work_free,
    "work_agree"          => $work_agree,
    "work_preview_exp"    => $work_preview_exp,
    "work_preview2_exp"   => $work_preview2_exp,
    "work_rent_exp"       => $work_rent_exp,
    "work_keep_exp"       => $work_keep_exp,
    "work_keep2_exp"      => $work_keep2_exp,
    "work_end_exp"        => $work_end_exp,
    "work_end2_exp"       => $work_end2_exp,
    "work_insert_dt"      => PAVE_TIME_YMDHIS,
    "work_insert_ip"      => PAVE_USER_IP,
    "work_update_dt"      => PAVE_TIME_YMDHIS,
    "work_update_ip"      => PAVE_USER_IP

);
$result = pave_insert("pave_work", $work);

if(!$result){
    die(return_json(null,"fail", "작품등록에 실패했습니다."));
}

//함께한 작가 등록
if(pave_is_array($work_with)){
    foreach ($work_with as $i => $with) {
        $with = array(
            "work_id"             => $work_id,
            "user_no"             => $with,
            "work_with_state"     => "ready",
            "work_with_insert_dt"      => PAVE_TIME_YMDHIS,
            "work_with_insert_ip"      => PAVE_USER_IP
        );
        pave_insert("pave_work_with", $with);

      /*   //함께한 작가 요청 Notification
        $notify_obj = new Notification();
        foreach ($work_with as $key => $with) {
            $notify_obj->send_notify($pave_user["user_id"], $with["user_id"], "notify_work_with", array("work_id" => $work_id));
        } */
    }
}


//해시태그 등록
foreach ($work_full_hashtag as $i => $hashtag) {
    pave_insert("pave_hashtag", array("work_id" => $work_id, "hashtag_name" => $hashtag));
}

//대표 이미지 업로드
$work_img_tmp_path = PAVE_DATA_TEMP_PATH;
$work_img_tmp_url = PAVE_DATA_TEMP_URL;
$work_img_path = PAVE_DATA_WEBTOON_PATH."/{$work_id}/";
$work_img_url =  PAVE_DATA_WEBTOON_URL."/{$work_id}/";
$file_obj = new Files();
@mkdir($work_img_path, PAVE_DIR_PERMISSION, true);

if($work_tmp_img){
    $work_tmp_img = json_decode(stripslashes($work_tmp_img) , true);
    $work_tmp_img_full_path = PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR.$work_tmp_img["name"];
    $work_img_full_path = $work_img_path.$work_tmp_img["name"];
    
    //작품 이미지 이동
    rename($work_tmp_img_full_path, $work_img_full_path);


    //파일 등록
    if($file_obj->file_insert($work_img_full_path, "work_img", $work_tmp_img, $work_id)){
        $update = array(
            "work_img"  => str_replace($work_img_path, $work_img_url, $work_img_full_path)
        );

        pave_update("pave_work", $update, "work_id = '{$work_id}'");
    }
}

die(return_json(null, "success"));
?>