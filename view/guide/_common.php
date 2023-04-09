<?php
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("guide");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

// 가이드 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.guide.php'); 

$guide_obj = new Guide();
$guide_obj->set_guide_group_display(1);
$guide_obj->set_guide_page(null);
$guide_group_list = $guide_obj->get_guide_group_list();


$guide_obj->set_guide_group_display(1);
$guide_obj->set_guide_bo_display(1);
$guide_obj->set_guide_page(null);
$guide_bo_list = $guide_obj->get_guide_bo_list();
?>