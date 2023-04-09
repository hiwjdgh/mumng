<?php
$pave_theme = get_theme("upload");

if(!$is_user){
    die(return_json(null, "fail", "로그인 후 이용해주세요."));
}

$work_config = $config_obj->get_work_config("webtoon");

//작품 라이브러리
require_once(PAVE_LIB_WORK_PATH.'/work.lib.php');

//파일 라이브러리
require_once(PAVE_LIB_FILE_PATH.'/file.lib.php');



//썸네일 플러그인
require_once(PAVE_PLUGIN_THUMBNAIL_PATH.'/ImageResize.php');
require_once(PAVE_PLUGIN_THUMBNAIL_PATH.'/ImageResizeException.php');
?>