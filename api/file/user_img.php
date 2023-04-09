<?php
$user_img_config = $config_obj->get_file_config("user_img");

$user_img_list = Files::generate_file($_FILES["file"]);

@mkdir(PAVE_DATA_TEMP_PATH, PAVE_DIR_PERMISSION, true);

//통합 파일 검사
if($msg = $file_obj->sanitize_file_total($user_img_config, $user_img_list)){
    die(return_json(null, "fail", $msg));  
}

//파일 검사
$user_img= $user_img_list[0];
if($msg = $file_obj->sanitize_file($user_img_config, $user_img)){
    die(return_json(null, "fail", $msg));  
}

$ext = $file_obj->get_file_extension($user_img["name"]);
$unique_name = $file_obj->get_unique_file_name(PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR, $user_img["name"], $ext);
$new_file_name = PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR.$unique_name;

if($msg = $file_obj->check_unique_file_name($new_file_name)){
    die(return_json(null, "fail", $msg));  
} 

if($msg = $file_obj->upload_file($user_img["tmp_name"], $new_file_name)){
    die(return_json(null, "fail", $msg));  
}

$result = array(
    "orgn"  => $user_img["name"],
    "name"  => $unique_name,
    "url"  => PAVE_DATA_TEMP_URL.DIRECTORY_SEPARATOR.$unique_name
);

die(return_json($result, "success"));
?>