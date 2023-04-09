<?php
$epsd_copy_config = $config_obj->get_file_config("epsd_copy");
$epsd_copy_list = Files::generate_file($_FILES["file"]);
$epsd_copy_result = array();
@mkdir(PAVE_DATA_TEMP_PATH, PAVE_DIR_PERMISSION, true);

//통합 파일 검사
if($msg = $file_obj->sanitize_file_total($epsd_copy_config, $epsd_copy_list)){
    die(return_json(null, "fail", $msg));  
}


//각 파일 검사
foreach ($epsd_copy_list as $key => $epsd_copy) {
    if($msg = $file_obj->sanitize_file($epsd_copy_config, $epsd_copy)){
        $epsd_copy_result[$key] = array(
            "orgn"  => $epsd_copy["name"],
            "name"  => $unique_name,
            "url"  => PAVE_DATA_TEMP_URL.$unique_name,
            "size_text" => Converter::display_byte_format($epsd_copy["size"]),
            "size" => $epsd_copy["size"],
            "msg" => $msg,
            "is_success"=> false
        );
        continue;
    }
    
    $ext = $file_obj->get_file_extension($epsd_copy["name"]);
    $unique_name = $file_obj->get_unique_file_name(PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR, $epsd_copy["name"], $ext);
    $new_file_name = PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR.$unique_name;
    
    if($msg = $file_obj->check_unique_file_name($new_file_name)){
        $epsd_copy_result[$key] = array(
            "orgn"  => $epsd_copy["name"],
            "name"  => $unique_name,
            "url"  => PAVE_DATA_TEMP_URL.$unique_name,
            "size_text" => Converter::display_byte_format($epsd_copy["size"]),
            "size" => $epsd_copy["size"],
            "msg" => $msg,
            "is_success"=> false
        );
        continue;
    } 
    
    if($msg = $file_obj->upload_file($epsd_copy["tmp_name"], $new_file_name)){
        $epsd_copy_result[$key] = array(
            "orgn"  => $epsd_copy["name"],
            "name"  => $unique_name,
            "url"  => PAVE_DATA_TEMP_URL.$unique_name,
            "size_text" => Converter::display_byte_format($epsd_copy["size"]),
            "size" => $epsd_copy["size"],
            "msg" => $msg,
            "is_success"=> false
        );
        continue;
    }

    $epsd_copy_result[$key] = array(
        "orgn"  => $epsd_copy["name"],
        "name"  => $unique_name,
        "url"  => PAVE_DATA_TEMP_URL.$unique_name,
        "size_text" => Converter::display_byte_format($epsd_copy["size"]),
        "size" => $epsd_copy["size"],
        "is_success"=> true
    );
}

die(return_json($epsd_copy_result, "success"));
?>