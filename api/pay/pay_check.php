<?php
if(!$is_user){
    die(return_json(null, "fail", "로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?", get_url(PAVE_ACCOUNT_URL, "login?url=".urlencode(PAVE_USER_REFERER))));
}
$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);

$work_obj = new Work();
$work = $work_obj->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)->get_work();

if(!$work["work_id"]){
    die(return_json(null, "fail", "작품을 찾을 수 없습니다."));
}

$epsd_obj = new Epsd();
$epsd_obj->set_work_id($work["work_id"])
->set_epsd_id($epsd_id)
->set_epsd_cate(array("epsd", "notice"));
if($work["work_user"]["user_commerce_state"]){
    $epsd_obj->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj->set_epsd_state("success");
}

$epsd = $epsd_obj->get_epsd();

if(!$epsd["epsd_id"]){
    die(return_json(null, "fail", "회차를 찾을 수 없습니다."));
}

die(return_json(array("is_pay_need" => Pay::is_pay_need($pave_user, $work, $epsd)), "success"));
?>