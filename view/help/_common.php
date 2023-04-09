<?php
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("help");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

//도움말 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.help.php'); 

$help_obj = new Help();
$help_obj->set_help_group_display(1);
$help_obj->set_help_page(null);
$help_group_list = $help_obj->get_help_group_list();

$help_obj->set_help_group_display(1);
$help_obj->set_help_bo_display(1);
$help_obj->set_help_page(null);
$help_bo_list = $help_obj->get_help_bo_list();

foreach ((array)$help_group_list as $i => $group) {
    foreach ((array)$help_bo_list as $j => $bo) {  
        if($group["help_group_name"] == $bo["help_group_name"]){
            $help_group_list[$i]["help_bo_list"][] = $bo;
        }
    }
}
?>