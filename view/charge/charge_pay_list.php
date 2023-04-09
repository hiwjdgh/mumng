<?php
$page = pave_input_sanitize($request[3])?:1;
$pay_id = pave_input_sanitize($request[4]);

$pay_obj = new Pay();

$pay_list = $pay_obj->set_user_no($pave_user["user_no"])->set_pay_display(1)->set_pay_page($page)->get_pay_list();
$pay_list_cnt = $pay_obj->get_pay_list_cnt();

$pagination = Objects2::get_pagination($page, $list_cnt, 5);

//헤더 불러오기
get_header("EXP 사용내역");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/charge_pay_list.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/charge/charge_pay_list.view.php");
}

//상세 컨텐츠 불러오기
if($pay_id){
    include_once(PAVE_CHARGE_PATH."/charge_pay_detail.php");
}

//푸터 불러오기
get_footer();
?>