<?php
if (!defined('_PAVE_')) exit;
/************************************************************************************************************************
   회원가입 상수 선언
************************************************************************************************************************/
define("PAVE_THEME_ID_REGEX", "/[^0-9a-z_]+/i");
define("PAVE_THEME_ID_MIN_LEN", 4);
define("PAVE_THEME_ID_MAX_LEN", 20);

define("PAVE_THEME_NAME_REGEX", "/[^\pL\pN]+/u");
define("PAVE_THEME_NAME_JAMO_REGEX", "/[\x{1100}-\x{11ff}\x{3130}-\x{318f}\x{a960}-\x{a97f}\x{d7b0}-\x{d7ff}]+/u");
define("PAVE_THEME_NAME_MIN_LEN", 4);
define("PAVE_THEME_NAME_MAX_LEN", 20);
?>