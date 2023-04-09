<?php
$user_config = $config_obj->get_user_config();
$cert_config = $config_obj->get_cert_config();


//회원 라이브러리
require_once(PAVE_LIB_USER_PATH.'/user.lib.php');

//본인인증 라이브러리
require_once(PAVE_LIB_CERT_PATH.'/cert.lib.php');

//파일 라이브러리
require_once(PAVE_LIB_FILE_PATH.'/file.lib.php');


//썸네일 플러그인
require_once(PAVE_PLUGIN_THUMBNAIL_PATH.'/ImageResize.php');
require_once(PAVE_PLUGIN_THUMBNAIL_PATH.'/ImageResizeException.php');
?>