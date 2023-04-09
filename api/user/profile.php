<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

$user_nick      = pave_input_sanitize($user_nick);
$user_introduce = pave_input_sanitize($user_introduce);
$user_field     = pave_input_sanitize($user_field);
$user_genre     = pave_input_sanitize($user_genre);
$user_major     = pave_input_sanitize($user_major);
$user_sns       = pave_input_sanitize($user_sns);

//필명 검사
if($msg = sanitize_reg_user_nick($user_nick, true, "", true)){
    die(return_json(null, "fail", $msg));
}

//소개 검사
if($msg = sanitize_reg_user_introduce($user_introduce, false)){
    die(return_json(null, "fail", $msg));
}

//분야 검사
if($msg = sanitize_reg_user_field($user_field, false)){
    die(return_json(null, "fail", $msg));
}

//장르 검사
if($msg = sanitize_reg_user_genre($user_genre, false)){
    die(return_json(null, "fail", $msg));
}

//대표작품 검사
if($msg = sanitize_reg_user_major($user_major, false)){
    die(return_json(null, "fail", $msg));
}

//SNS 검사
if($msg = sanitize_reg_user_sns($user_sns)){
    die(return_json(null, "fail", $msg));
}

usort($user_sns, function ($item1, $item2) {
    return $item1["sns_order"] <=> $item2["sns_order"];
});

//SNS 계정 설정
$sns_config = $config_obj->get_sns_config();

foreach ($user_sns as $i => $sns) {
    if($sns["user_sns_id"]){
        $key = array_search($sns["sns_name"], array_column($sns_config, "sns_name"));
        $user_sns[$i]["sns_url"] = get_url($sns_config[$key]["sns_url"], $sns["user_sns_id"]);
    }
}

$update = array(
    "user_nick"                 => $user_nick,
    "user_major"                => $user_major,
    "user_introduce"            => $user_introduce,
    "user_sns"                  => json_encode($user_sns),
    "user_field"                => pave_implode($user_field, ","),
    "user_genre"                => pave_implode($user_genre, ","),
    "user_update_dt"            => PAVE_TIME_YMDHIS,
    "user_update_ip"            => PAVE_USER_IP
);
pave_update("pave_user", $update, "user_no ='{$pave_user["user_no"]}'");


//프로필 이미지 업로드
$user_img_path = PAVE_DATA_USER_PATH."/{$pave_user["user_code"]}/profile/";
$user_img_url =  PAVE_DATA_USER_URL."/{$pave_user["user_code"]}/profile/";

@mkdir($user_img_path, PAVE_DIR_PERMISSION, true);

if($user_tmp_img){

    //기존 프로필 이미지 삭제
    if($pave_user["user_img"] != get_url(PAVE_IMG_URL,"img_profile_empty_160px.png")){
        $del_user_img_full_path = str_replace($user_img_url, $user_img_path, $pave_user["user_img"]);
        $del_user_img = $file_obj->get_file_list("user_img")[0];
        pave_delete("pave_file", array("file_no" => $del_user_img["file_no"]));
        @unlink($del_user_img_full_path);
    }

    $user_tmp_img = json_decode(stripslashes($user_tmp_img) , true);
    $user_img_full_path =  $user_img_path.$user_tmp_img["name"];
    $user_img_data = pave_explode($user_img_data, ";");
    $user_img_data = pave_explode($user_img_data[1], ",");
    $user_crop_img = \Gumlet\ImageResize::createFromString(base64_decode($user_img_data[1]));
    $user_crop_img->save($user_img_full_path);
    
    //파일 등록
    if($file_obj->file_insert($user_img_full_path, "user_img", $user_tmp_img)){
        $update = array(
            "user_img"  => str_replace($user_img_path, $user_img_url, $user_img_full_path),
        );
    }


    pave_update("pave_user", $update, "user_id = '{$pave_user["user_id"]}'");

}

die(return_json(null, "success"));
?>