<?php
$page = pave_input_sanitize($request[3])?:1;
$rcpt_id = pave_input_sanitize($request[4]);

$receipt_obj = new Receipt();
$receipt_list = $receipt_obj->set_user_no($pave_user["user_no"])
->set_rcpt_type("exp")
->set_rcpt_status(array("payment_wait","payment_complete", "cancel", "cancel_wait","refund_wait","refund_complete"))
->set_rcpt_page($page)
->set_rcpt_display(1)
->get_receipt_list();

$receipt_list_cnt = $receipt_obj->get_receipt_list_cnt();
$pagination = Objects2::get_pagination($page, $receipt_list_cnt, 5);

//헤더 불러오기
get_header("충전내역");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/charge_receipt_list.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/charge/charge_receipt_list.view.php");
}

//상세 컨텐츠 불러오기
if($rcpt_id){
    include_once(PAVE_CHARGE_PATH."/charge_receipt_detail.php");
}

//푸터 불러오기
get_footer();
?>