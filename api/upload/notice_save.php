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

if($epsd_id){
    //회차 가져오기
    $epsd_obj = new Epsd();
    $epsd = $epsd_obj->set_user_no($pave_user["user_no"])->set_work_id($work["work_id"])->set_epsd_id($epsd_id)->get_epsd();
    
    if(!$epsd["epsd_id"]){
        die(return_json(null, "fail", "비정상적인 접근입니다."));
    }

    $update = array(
        "epsd_name"             => $epsd_name,
        "epsd_seo_tit"          => $epsd_name,
        "epsd_eplg"             => $epsd_eplg,
        "epsd_copyright"        => $epsd_copyright,
        "epsd_agree"            => $epsd_agree,
        "epsd_update_dt"        => PAVE_TIME_YMDHIS,
        "epsd_update_ip"        => PAVE_USER_IP
    );
    $result = pave_update("pave_epsd", $update, "epsd_id = '{$epsd["epsd_id"]}'");

    if(!$result){
        die(return_json(null," fail", "공지 임시저장에 실패했습니다."));
    }

    $epsd_id = $epsd["epsd_id"];
}else{
    //회차 번호 검사
    $epsd_upload_dt = Converter::display_time($epsd_upload_date." +{$work["work_time"]} hours", "Y-m-d H:i:s");

    $epsd = array(
        "work_id"               => $work["work_id"],
        "user_no"               => $pave_user["user_no"],
        "epsd_no"               => "-1",
        "epsd_no_type"          => "",
        "epsd_cate"             => "notice",
        "epsd_name"             => $epsd_name,
        "epsd_seo_tit"          => $epsd_name,
        "epsd_eplg"             => $epsd_eplg,
        "epsd_copyright"        => $epsd_copyright,
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
        die(return_json(null,"fail", "공지 임시저장에 실패했습니다."));
    }
    
    $epsd_id = pave_insert_id();
}


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

    //기존 회차 이미지 가져오기
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_common("SELECT files.* FROM pave_file AS files")
    ->set_sql_where("files.user_no = '{$pave_user["user_no"]}'")
    ->set_sql_where("files.work_id = '{$work["work_id"]}'")
    ->set_sql_where("files.epsd_id = '{$epsd_id}'")
    ->set_sql_where("files.file_id = 'epsd_img'");
    $delete_file = pave_fetch($obj->generate_sql());

    //기존 회차 이미지 삭제
    if($delete_file["file_no"]){
        $delete_epsd_img_full_path = str_replace($epsd_img_url, $epsd_img_path, $epsd["epsd_img"]);
        pave_delete("pave_file", array("file_no" => $delete_file["file_no"]));
        @unlink($delete_epsd_img_full_path);
    }

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
    
    //기존 원고 가져오기
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_common("SELECT files.file_no, files.file_full_name FROM pave_file AS files")
    ->set_sql_where("files.user_no = '{$pave_user["user_no"]}'")
    ->set_sql_where("files.work_id = '{$work["work_id"]}'")
    ->set_sql_where("files.epsd_id = '{$epsd_id}'")
    ->set_sql_where("files.file_id = 'epsd_copy'");
    $result = pave_query($obj->generate_sql());

    $delete_file_list = array();
     for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
        $delete_file_list[$row["file_no"]] = $row["file_full_name"];
     }
 

    foreach ($epsd_tmp_copy as $key => $value) {
        $epsd_tmp_copy_item = json_decode(stripslashes($value) , true);

        if(in_array($epsd_tmp_copy_item["name"], $delete_file_list)){
            $delete_file_index = array_search($epsd_tmp_copy_item["name"], $delete_file_list);
            unset($delete_file_list[$delete_file_index]);

            $epsd_content .= "<img src=\"".$epsd_copy_url.$epsd_tmp_copy_item["name"]."\" alt=\"회차이미지\">";
            continue;
        }
       
        $epsd_tmp_copy_full_path = PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR.$epsd_tmp_copy_item["name"];
        $epsd_copy_full_path = $epsd_copy_path.$epsd_tmp_copy_item["name"];

        if(!is_file($epsd_tmp_copy_full_path) || !file_exists($epsd_tmp_copy_full_path)){
            continue;
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

    pave_update("pave_epsd", array("epsd_content" => $epsd_content), "epsd_id = '{$epsd_id}'");

    //기존 원고 삭제
    foreach ($delete_file_list as $file_no => $file_full_name) {
        $del_epsd_copy_full_path = $epsd_copy_path.$file_full_name;

        pave_delete("pave_file", array("file_no" => $file_no));
        @unlink($del_epsd_copy_full_path);
    }
}

die(return_json(null, "success"));
?>