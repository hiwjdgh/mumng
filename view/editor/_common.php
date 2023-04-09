<?php
$pave_site = $config_obj->get_site($request[0], $request[1]);
$pave_theme = get_theme("editor");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

//파일 라이브러리
require_once(PAVE_LIB_FILE_PATH.'/file.lib.php');

$editor_file_config = Files::file_cf("editor_file");
?>