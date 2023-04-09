<?php
$work_id        = pave_input_sanitize($work_id);
$epsd_id        = pave_input_sanitize($epsd_id);
$action         = pave_input_sanitize($action);
$epsd_cate      = pave_input_sanitize($epsd_cate);
$calendar_date  = pave_input_sanitize($calendar_date);


$epsd_config = $config_obj->get_epsd_config($epsd_cate);
$epsd_img_config = $config_obj->get_file_config("epsd_img");
$epsd_copy_config = $config_obj->get_file_config("epsd_copy");

$work_obj = new Work();
$work = $work_obj->set_user_no($pave_user["user_no"])->set_work_id($work_id)->get_work();

if(!$work["work_id"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}

if(!$work["is_own"]){
    die(return_json(null, "fail", "비정상적인 접근입니다."));
}


$epsd_obj = new Epsd();
if($action == "create"){
    $latest_epsd_no = Epsd::generate_epsd_no($work);
    if($latest_epsd_no === null || $latest_epsd_no === 0){
        $epsd_no = 1;
    }else{
        $epsd_no = $latest_epsd_no + 1;   
    }
    //미연재 작품 검사
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_common("SELECT * FROM pave_epsd")
    ->set_sql_where("work_id = '{$work["work_id"]}'")
    ->set_sql_order("ORDER BY epsd_id DESC")
    ->set_sql_limit("LIMIT 1"); 

    $last_epsd = pave_fetch($obj->generate_sql());
    $next_upload_dt = $epsd_obj->get_next_upload_dt($work, $last_epsd);

    if($next_upload_dt != $calendar_date){
        die(return_json(null, "fail", "{$next_upload_dt} 연재부터 진행해주세요."));
    }
    
    if($epsd_cate == "epsd"){
        $epsd_form_title = "회차";
    }else if($epsd_cate == "notice"){
        $epsd_form_title = "공지";
    }else if($epsd_cate == "rest"){
        $epsd_form_title = "휴재";
    }
    $epsd_form_title .= "등록";
    $epsd_date = $calendar_date;

    $epsd_copy_total_capacity = 0;
    $epsd_copy_total_max_capacity = Converter::display_byte($epsd_copy_config["file_total_size"].$epsd_copy_config["file_total_unit"]);
    $epsd_copy_total_ratio = 0;
}else if($action == "update"){
    $epsd_obj->set_work_id($work["work_id"]);
    if($epsd_id){
        $epsd_obj->set_epsd_id($epsd_id);
    }
    $epsd = $epsd_obj->get_epsd();

    if($epsd["epsd_cate"] == "epsd"){
        $epsd_form_title = "회차";
    }else if($epsd["epsd_cate"] == "notice"){
        $epsd_form_title = "공지";
    }else if($epsd["epsd_cate"] == "rest"){
        $epsd_form_title = "휴재";
    }
    $epsd_form_title .= "편집";
    $epsd_date = Converter::display_time($epsd["epsd_upload_dt"]);

    
    //회차 원고
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_common("SELECT files.* FROM pave_file AS files")
    ->set_sql_where("files.file_id = 'epsd_copy'")
    ->set_sql_where("files.work_id = '{$work["work_id"]}'")
    ->set_sql_where("files.epsd_id = '{$epsd["epsd_id"]}'");

    $epsd_copy_list = array();
    $result = pave_query($obj->generate_sql());
    for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
        $epsd_copy_list[] = $row;
    }

    $epsd_copy_total_capacity = array_sum(array_column($epsd_copy_list, 'file_size'));
    $epsd_copy_total_max_capacity = Converter::display_byte($epsd_copy_config["file_total_size"].$epsd_copy_config["file_total_unit"]);
    $epsd_copy_total_ratio = (int)(($epsd_copy_total_capacity * 100) / $epsd_copy_total_max_capacity) ;
 /*    console($epsd_copy_total_capacity);
    console($epsd_copy_total_max_capacity);
    console($epsd_copy_total_ratio); */
}else{
    die(return_json(null, "fail", "잘못된 요청입니다."));
}


if($epsd_cate == "epsd"){
    $theme_path = $pave_theme["thm_path"]."/epsd_form.view.php";
}else if($epsd_cate == "rest"){
    $theme_path = $pave_theme["thm_path"]."/rest_form.view.php";
}else if($epsd_cate == "notice"){
    $theme_path = $pave_theme["thm_path"]."/notice_form.view.php";
}

if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>