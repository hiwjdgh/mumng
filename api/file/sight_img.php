<?php
$sight_img_config = $config_obj->get_file_config("sight_img");
$sight_img_list = Files::generate_file($_FILES["file"]);


@mkdir(PAVE_DATA_TEMP_PATH, PAVE_DIR_PERMISSION, true);


//통합 파일 검사
if($msg = $file_obj->sanitize_file_total($sight_img_config, $sight_img_list)){
    die(return_json(null, "fail", $msg));  
}

$sight_img = $sight_img_list[0];


//각 파일 검사
if($msg = $file_obj->sanitize_file($sight_img_config, $sight_img)){
    die(return_json(null, "fail", $msg));  
}

$ext = $file_obj->get_file_extension($sight_img["name"]);
$unique_name = $file_obj->get_unique_file_name(PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR, $sight_img["name"], $ext);
$new_file_name = PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR.$unique_name;

if($msg = $file_obj->check_unique_file_name($new_file_name)){
    die(return_json(null, "fail", $msg));  
} 
if($msg = $file_obj->upload_file($sight_img["tmp_name"], $new_file_name)){
    die(return_json(null, "fail", $msg));  
}

$result = array(
    "orgn"  => $sight_img["name"],
    "name"  => $unique_name,
    "url"  => PAVE_DATA_TEMP_URL.DIRECTORY_SEPARATOR.$unique_name
);

die(return_json($result, "success"));
?>