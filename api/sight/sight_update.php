<?php
if(get_session("csrf_token") != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}


$sight_config = $config_obj->get_sight_config($sight_grp_id);

$sight_no                   = pave_input_sanitize($sight_no);
$sight_grp_id               = pave_input_sanitize($sight_grp_id);
$sight_img_use              = pave_input_sanitize($sight_img_use);
$sight_name                 = pave_input_sanitize($sight_name);
$sight_display              = pave_input_sanitize($sight_display);
$sight_age                  = pave_input_sanitize($sight_age);
$sight_hashtag              = pave_input_sanitize($sight_hashtag);
$sight_content              = $sight_content;

$sight_obj = new Sight();
$sight = $sight_obj
->set_sight_no($sight_no)
->set_user_no($pave_user["user_no"])
->get_sight();

if(!$sight["sight_no"] || $sight["user_no"] != $pave_user["user_no"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}


//창작물 이미지 검사
if(!$sight["sight_img"] && $sight_img_use && !$sight_tmp_img){
    die(return_json(null," fail", "창작물 이미지를 등록해주세요."));
}

//창작물 명 검사
if($msg = sanitize_sight_name($sight_name, true)){
    die(return_json(null, "fail", $msg));
}

//창작물 연령 검사
if($msg = sanitize_sight_age($sight_age, true)){
    die(return_json(null, "fail", $msg));
}

/* //창작물 장르 검사
if($msg = sanitize_sight_genre($sight_genre)){
    die(return_json(null, "fail", $msg));
} */

//창작물 해시태그 검사
if($msg = sanitize_sight_hashtag($sight_hashtag, true)){
    die(return_json(null, "fail", $msg));
}

//창작물 내용 검사
if($msg = sanitize_sight_content($sight_content, true)){
    die(return_json(null, "fail", $msg));
}


$update = array(
    "sight_grp_id"          => $sight_grp_id,
    "sight_img_use"         => $sight_img_use,
    "sight_name"            => $sight_name,
    "sight_display"         => $sight_display,
    "sight_age"             => $sight_age,
    "sight_hashtag"         => pave_implode($sight_hashtag, ","),
    "sight_insert_dt"       => PAVE_TIME_YMDHIS,
    "sight_insert_ip"       => PAVE_USER_IP,
    "sight_update_dt"       => PAVE_TIME_YMDHIS,
    "sight_update_ip"       => PAVE_USER_IP
);
$result = pave_update("pave_sight", $update, "sight_no = '{$sight["sight_no"]}'");

if(!$result){
    die(return_json(null," fail", "창작물 수정에 실패했습니다."));
}



//대표 이미지 업로드
$sight_img_path = PAVE_DATA_SIGHT_PATH."/{$sight["sight_no"]}/";
$sight_img_url =  PAVE_DATA_SIGHT_URL."/{$sight["sight_no"]}/";
$file_obj = new Files();
@mkdir(PAVE_DATA_TEMP_PATH, PAVE_DIR_PERMISSION, true);
@mkdir(PAVE_DATA_SIGHT_PATH, PAVE_DIR_PERMISSION, true);
@mkdir($sight_img_path, PAVE_DIR_PERMISSION, true);
if($sight_img_use){
    if($sight_tmp_img){
        $sight_tmp_img = json_decode(stripslashes($sight_tmp_img) , true);
        $sight_tmp_img_full_path = PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR.$sight_tmp_img["name"];
        $sight_img_full_path = $sight_img_path.$sight_tmp_img["name"];
        
        //기존 대표 이미지 가져오기
        $obj = new Objects2();
        $obj->generate_sql_init()
        ->set_sql_common("SELECT files.* FROM pave_file AS files")
        ->set_sql_where("files.user_no = '{$pave_user["user_no"]}'")
        ->set_sql_where("files.sight_no = '{$sight["sight_no"]}'")
        ->set_sql_where("files.file_id = 'sight_img'");
        $delete_file = pave_fetch($obj->generate_sql());

        //기존 대표 이미지 삭제
        if($delete_file["file_no"]){
            $delete_sight_img_full_path = str_replace($sight_img_url, $sight_img_path, $sight["sight_img"]);
            pave_delete("pave_file", array("file_no" => $delete_file["file_no"]));
            @unlink($delete_sight_img_full_path);
        }

        
        //작품 이미지 이동
        rename($sight_tmp_img_full_path, $sight_img_full_path);
    
        //파일 등록
        if($file_obj->sight_file_insert($sight_img_full_path, "sight_img", $sight_tmp_img, $sight["sight_no"])){
            $update = array(
                "sight_img"  => str_replace($sight_img_path, $sight_img_url, $sight_img_full_path)
            );
    
            pave_update("pave_sight", $update, "sight_no = '{$sight["sight_no"]}'");
        }
    }
}else{
    //기존 대표 이미지 가져오기
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_common("SELECT files.* FROM pave_file AS files")
    ->set_sql_where("files.user_no = '{$pave_user["user_no"]}'")
    ->set_sql_where("files.sight_no = '{$sight["sight_no"]}'")
    ->set_sql_where("files.file_id = 'sight_img'");
    $delete_file = pave_fetch($obj->generate_sql());

    //기존 대표 이미지 삭제
    if($delete_file["file_no"]){
        $delete_sight_img_full_path = str_replace($sight_img_url, $sight_img_path, $sight["sight_img"]);
        pave_delete("pave_file", array("file_no" => $delete_file["file_no"]));
        @unlink($delete_sight_img_full_path);
    }
    
    pave_update("pave_sight", array("sight_img" => "" ), "sight_no = '{$sight["sight_no"]}'");
}


$sight_content = stripslashes($sight_content);
    
preg_match_all("/<img[^>]*src=[\'\"]?([^>\'\"]+[^>\'\"]+)[\'\"]?[^>]*>/i", $sight_content, $src_matchs);
preg_match_all("/<img[^>]*title=[\'\"]?([^>\'\"]+[^>\'\"]+)[\'\"]?[^>]*>/i", $sight_content, $title_matchs);
$img_url = $src_matchs[1];
$img_name = $title_matchs[1];
if(pave_is_array($img_url)){

    //기존 원고 가져오기
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_common("SELECT files.file_no, files.file_full_name FROM pave_file AS files")
    ->set_sql_where("files.user_no = '{$pave_user["user_no"]}'")
    ->set_sql_where("files.sight_no = '{$sight["sight_no"]}'")
    ->set_sql_where("files.file_id = 'editor_file'");
    $result = pave_query($obj->generate_sql());
 
    $delete_file_list = array();
    for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
        $delete_file_list[$row["file_no"]] = $row["file_full_name"];
    }


    for ($i=0; $i < count($img_url); $i++) { 
        $tmp_img_name = str_replace(PAVE_DATA_TEMP_URL.DIRECTORY_SEPARATOR, "", $img_url[$i]);
        $tmp_img_path = str_replace(PAVE_DATA_TEMP_URL, PAVE_DATA_TEMP_PATH, $img_url[$i]);
        $sight_img_path = str_replace(PAVE_DATA_TEMP_PATH, $sight_img_path, $tmp_img_path);
        
        if(in_array($tmp_img_name, $delete_file_list)){
            $delete_file_index = array_search($tmp_img_name, $delete_file_list);
            unset($delete_file_list[$delete_file_index]);
            continue;
        }

        
        //원고 이미지 이동
        rename($tmp_img_path, $sight_img_path);

        
        $tmp_file = array(
            "orgn" => $img_name[$i],
            "name" => $tmp_img_name
        );
        //파일 등록
        $file_obj->sight_file_insert($sight_img_path, "editor_file", $tmp_file, $sight["sight_no"]);

    }

    //기존 원고 삭제
    foreach ($delete_file_list as $file_no => $file_full_name) {
        pave_delete("pave_file", array("file_no" => $file_no));
        @unlink(PAVE_DATA_SIGHT_PATH."/{$sight["sight_no"]}/".$file_full_name);
    }

    $sight_content = str_replace(PAVE_DATA_TEMP_URL, PAVE_DATA_SIGHT_URL."/{$sight["sight_no"]}", $sight_content);
    pave_update("pave_sight", array("sight_content" => $sight_content), "sight_no = '{$sight["sight_no"]}'");
}else{
    pave_update("pave_sight", array("sight_content" => $sight_content), "sight_no = '{$sight["sight_no"]}'");
}

die(return_json(null, "success"));
?>