<?php
if (!defined('_PAVE_')) exit;

/************************************************************************************************************************
   결제 상수 선언
************************************************************************************************************************/
//토스 방화벽 IP
define("PAVE_TOSS_IP", array(
    "13.124.18.147",
    "13.124.108.35",
    "3.36.173.151",
    "3.38.81.32",
));

//결제 코드
define("PAVE_PAYMENT_ERROR_FAIL", 100);
define("PAVE_PAYMENT_ERROR_TOSS_PAYMENT", 101);
define("PAVE_PAYMENT_ERROR_EMPTY_RECEIPT", 102);
define("PAVE_PAYMENT_SUCCESS", 200);

//충전 코드
define("PAVE_CHARGE_ERROR_FAIL", 100);
define("PAVE_CHARGE_ERROR_EMPTY_RCMND", 101);
define("PAVE_CHARGE_ERROR_SELF_RCMND", 102);
define("PAVE_CHARGE_ERROR_ALREADY_RCMND", 103);
define("PAVE_CHARGE_SUCCESS", 200);
?>