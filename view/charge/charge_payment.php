<?php
$item_obj = new Item();
$item_list = $item_obj->set_it_type("exp")
->set_it_display(1)
->set_it_order("price_asc")
->get_item_list();

//헤더 불러오기
get_header("EXP 충전하기");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/charge_payment.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/charge/charge_payment.view.php");
}

//푸터 불러오기
get_footer();
?>