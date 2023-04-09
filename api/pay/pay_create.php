<?php
if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login")));
}
$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);
$type = pave_input_sanitize($type);


$work_obj = new Work();
$work = $work_obj
->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)
->get_work();

if(!$work["work_id"]){
    die(return_json(null, "fail", "작품을 찾을 수 없습니다."));
}

$epsd_obj = new Epsd();
$epsd = $epsd_obj
->set_work_id($work["work_id"])
->set_epsd_id($epsd_id)
->get_epsd();

if(!$epsd["epsd_id"]){
    die(return_json(null, "fail", "회차를 찾을 수 없습니다."));
}

$is_caution = false;
if(get_session("is_caution")){
    $is_caution = true;
}else{
    set_session("is_caution", true);
}

$result["is_caution"] = $is_caution;


Pay::pay_epsd($pave_user, $work, $epsd, $type);
die(return_json($result, "success"));
?>