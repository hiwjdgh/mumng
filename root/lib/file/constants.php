<?php
if (!defined('_PAVE_')) exit;

/************************************************************************************************************************
   파일 상수 선언
************************************************************************************************************************/
define("PAVE_UPLOAD_ID_REGEX", "/[^0-9a-z_]+/i");
define("PAVE_UPLOAD_ID_MIN_LEN", 4);
define("PAVE_UPLOAD_ID_MAX_LEN", 20);
define("PAVE_UPLOAD_NAME_REGEX", "/[^\pL\pN]+/u");
define("PAVE_UPLOAD_NAME_JAMO_REGEX", "/[\x{1100}-\x{11ff}\x{3130}-\x{318f}\x{a960}-\x{a97f}\x{d7b0}-\x{d7ff}]+/u");
define("PAVE_UPLOAD_NAME_MIN_LEN", 4);
define("PAVE_UPLOAD_NAME_MAX_LEN", 20);

define("PAVE_UPLOAD_WIDTH_REGEX", "/[^0-9]/");
define("PAVE_UPLOAD_HEIGHT_REGEX", "/[^0-9]/");
define("PAVE_UPLOAD_SIZE_REGEX", "/[^0-9]/");
define("PAVE_UPLOAD_UNIT_REGEX", "/[^(MB|KB)]+/i");

define("PAVE_NOT_ALLOW_EXT_REGEX", "/(\.(php|htm|html|inc|htm|shtm|ztx|dot|cgi|pl|phtm|ph|exe))$/i");
define("PAVE_FILE_NAME_MAX_LEN", 255);
define("PAVE_FILE_IMAGE_EXT_REGX", "/((gif|jpe?g|png))$/i");
define("PAVE_DOC_EXT_REGX", "/((hwp|xls|doc|xlsx|docx|pdf|txt|ppt|pptx))$/i");
define("PAVE_IMG_SRC_REGEX", "/<img[^>]*src=[\'\"]?([^>\'\"]+[^>\'\"]+)[\'\"]?[^>]*>/i");


define("PAVE_FILE_USER_IMG_TEMP_PATH", PAVE_DATA_TEMP_PATH.DIRECTORY_SEPARATOR);
define("PAVE_FILE_USER_IMG_TEMP_URL", PAVE_DATA_TEMP_URL.DIRECTORY_SEPARATOR);
define("PAVE_FILE_USER_IMG_PATH", PAVE_DATA_USER_PATH.DIRECTORY_SEPARATOR);
define("PAVE_FILE_USER_IMG_URL", PAVE_DATA_USER_URL.DIRECTORY_SEPARATOR);
?>
