<?php
$epsd_img_config = $config_obj->get_file_config("epsd_img");
$epsd_img_list = Files::generate_file($_FILES["file"]);



@mkdir(PAVE_DATA_TEMP_PATH, PAVE_DIR_PERMISSION, true);

//파일 검사
$epsd_img= $epsd_img_list[0];
if($msg = $file_obj->sanitize_file($epsd_img_config, $epsd_img)){
    die(return_json(null, "fail", $msg));  
}

$ext = $file_obj->get_file_extension($epsd_img["name"]);
$unique_name = $file_obj->get_unique_file_name(PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR, $epsd_img["name"], $ext);
$new_file_name = PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR.$unique_name;

if($msg = $file_obj->check_unique_file_name($new_file_name)){
    die(return_json(null, "fail", $msg));  
} 

if($msg = $file_obj->upload_file($epsd_img["tmp_name"], $new_file_name)){
    die(return_json(null, "fail", $msg));  
}

$result = array(
    "orgn"  => $epsd_img["name"],
    "name"  => $unique_name,
    "url"  => PAVE_DATA_TEMP_URL.DIRECTORY_SEPARATOR.$unique_name
);


die(return_json($result, "success"));
?>