<?php
if(!$is_user){
    url_move(PAVE_URL);
}

if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

if(get_session("reg_user_no") != $pave_user["user_no"]){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

$user_skip = pave_input_sanitize($user_skip);
$user_nick = pave_input_sanitize($user_nick);
$user_field = pave_input_sanitize($user_field);
$user_genre = pave_input_sanitize($user_genre);

if($user_skip){
    set_session("reg_user_no", "");
    die(return_json(null, "success", "", get_url(PAVE_URL)));
}

//필명 검사
if($msg = sanitize_reg_user_nick($user_nick, true, "", true)){
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


//프로필 이미지 업로드
$user_img_path = PAVE_DATA_USER_PATH.DIRECTORY_SEPARATOR."{$pave_user["user_code"]}/profile/";
$user_img_url =  PAVE_DATA_USER_URL.DIRECTORY_SEPARATOR."{$pave_user["user_code"]}/profile/";

@mkdir($user_img_path, PAVE_DIR_PERMISSION, true);

if($user_tmp_img){
    $user_tmp_img = json_decode(stripslashes($user_tmp_img) , true);
    $user_img_full_path =  $user_img_path.$user_tmp_img["name"];
    $user_img_data = pave_explode($user_img_data, ";");
    $user_img_data = pave_explode($user_img_data[1], ",");
    $user_crop_img = \Gumlet\ImageResize::createFromString(base64_decode($user_img_data[1]));
    $user_crop_img->save($user_img_full_path);
    
    //파일 등록
    $file_obj = new Files();
    if($file_obj->file_insert($user_img_full_path, "user_img", $user_tmp_img)){
        $update = array(
            "user_img"  => str_replace($user_img_path, $user_img_url, $user_img_full_path),
        );
    }

    pave_update("pave_user", $update, "user_no = '{$pave_user["user_no"]}'");
}
$update = array(
    "user_nick"                 => $user_nick,
    "user_field"                => pave_implode($user_field, ","),
    "user_genre"                => pave_implode($user_genre, ",")
);
pave_update("pave_user", $update, "user_no = '{$pave_user["user_no"]}'");

set_session("reg_user_no", "");
die(return_json(null, "success", "", get_url(PAVE_URL)));
?>
