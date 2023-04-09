<?php
if (!defined('_PAVE_')) exit;

/************************************************************************************************************************
   설정 정규식 선언
************************************************************************************************************************/

//문자 정규식
define("PAVE_CHAR_REGEX", "/[^\pL\pN]+/u");
//번호 정규식
define("PAVE_NUM_REGEX", "/[^0-9]/");

//제목
define("PAVE_CF_TIT_MIN_LEN", 1);
define("PAVE_CF_TIT_MAX_LEN", 20);

//관리자 아이디
define("PAVE_CF_ADM_REGEX", "/[^0-9a-z_]+/i");
define("PAVE_CF_ADM_MIN_LEN", 4);
define("PAVE_CF_ADM_MAX_LEN", 20);

//기업명
define("PAVE_CF_CO_NAME_MIN_LEN", 1);
define("PAVE_CF_CO_NAME_MAX_LEN", 20);

//기업 대표자
define("PAVE_CF_CO_OWN_MIN_LEN", 1);
define("PAVE_CF_CO_OWN_MAX_LEN", 20);


//기업 우편번호
define("PAVE_CF_CO_ADDR_ZIP_REGEX", "/^[0-9]{5,6}$/");

//기업 연락처
define("PAVE_CF_CO_TEL_NUM_REGEX", "/^[0-9]{8,12}$/");

//기업 팩스
define("PAVE_CF_CO_FAX_NUM_REGEX", "/^[0-9]{8,12}$/");

//개인정보 보호 책임자
define("PAVE_CF_CO_CPO_MIN_LEN", 1);
define("PAVE_CF_CO_CPO_MAX_LEN", 20);

?>