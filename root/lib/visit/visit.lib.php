<?php
if (!defined('_PAVE_')) exit;
include_once(PAVE_LIB_VISIT_PATH."/constants.php");

/*************************************************************************
**
**  방문로그 관련 함수 모음
**
*************************************************************************/
/************************************************************************************************************************
   사용자 브라우저 추출 함수 
************************************************************************************************************************/
function get_user_browser(){
    if(preg_match(PAVE_BROWSER_MS, PAVE_USER_AGENT)){
        $browser    = "Internet Explorer";
    }else if( preg_match(PAVE_BROWSER_MS2, PAVE_USER_AGENT)){
		$browser	= "Internet Explorer";
	}else if( preg_match(PAVE_BROWSER_FIREFOX, PAVE_USER_AGENT)){
		$browser	= "Mozilla Firefox";
	}else if( preg_match(PAVE_BROWSER_CHROME, PAVE_USER_AGENT)){
		$browser	= "Google Chrome";
	}else if( preg_match(PAVE_BROWSER_SAFARI, PAVE_USER_AGENT)){
		$browser	= "Apple Safari";
	}else if( preg_match(PAVE_BROWSER_OPERA, PAVE_USER_AGENT)){
		$browser	= "Opera";
	}else if( preg_match(PAVE_BROWSER_NETSCAPE, PAVE_USER_AGENT) ){
		$browser    = "Netscape";
	}else{
        $browser    = "unknwon";
    }

    return $browser;
}

/************************************************************************************************************************
   사용자 운영체제 추출 함수 
************************************************************************************************************************/
function get_user_os(){
    if( preg_match(PAVE_OS_LINUX, PAVE_USER_AGENT) ){
		$os = "linux";
	}else if( preg_match(PAVE_OS_MAC, PAVE_USER_AGENT) ){
		$os = "mac";
	}else if( preg_match(PAVE_OS_WINDOW, PAVE_USER_AGENT) ){
		$os = "windows";
	}else{
        $os = "unknown";
    }

    return $os;
}

/************************************************************************************************************************
   사용자 모바일 기기 추출 함수 
************************************************************************************************************************/
function get_user_device(){
    if(strpos(PAVE_USER_AGENT,'Android') !== false) { 
        $device = "android";
    }else if(strpos(PAVE_USER_AGENT,'iPad') !== false) { 
        $device = "ipad";
    }else if(strpos(PAVE_USER_AGENT,'iPhone') !== false) { 
        $device = "iphone";
    }else if(strpos(PAVE_USER_AGENT,'Tablet') !== false) { 
        $device = "tablet";
    }else{
        $device = "unknown";
    }

    return $device;
}

/************************************************************************************************************************
   사용자 모바일 접속 추출 함수 
************************************************************************************************************************/
function is_mobile(){
    return preg_match(PAVE_DEVICE_MOBILE, PAVE_USER_AGENT) ? "mobile" : "pc";
}

/************************************************************************************************************************
   사용자 앱 접속 추출 함수 
************************************************************************************************************************/
function is_app(){
    return preg_match(PAVE_DEVICE_APP, PAVE_USER_AGENT) ? "app" : "";
}

/************************************************************************************************************************
   익스플로러 차단 함수
************************************************************************************************************************/
function is_explorer(){
    if(preg_match(PAVE_BROWSER_MS, PAVE_USER_AGENT) || preg_match(PAVE_BROWSER_MS2, PAVE_USER_AGENT)){
        return true;
    }
    return false;
}

/************************************************************************************************************************
   방문로그 함수 
************************************************************************************************************************/
function visit_log(){
    $visit = array();
    $visit["vst_ip"] = PAVE_USER_IP;
    $visit["vst_date"] = PAVE_TIME_YMD;
    $visit["vst_year"] = PAVE_YEAR;
    $visit["vst_month"] = PAVE_MONTH;
    $visit["vst_day"] = PAVE_DAY;
    $visit["vst_yoil"] = PAVE_YOIL;
    $visit["vst_hour"] = PAVE_HOUR;
    $visit["vst_referer"] = PAVE_USER_REFERER;
	$visit["vst_agent"] = PAVE_USER_AGENT;
	$visit["vst_page"] = PAVE_PHPSELF;
    $visit["vst_query"] = PAVE_QUERYS;
    $visit["vst_browser"] = get_user_browser();
    $visit["vst_os"] = get_user_os();
    $visit["vst_device"] = get_user_device();

    $sql = "SELECT EXISTS (SELECT 1 FROM pave_vst WHERE vst_date = '".PAVE_TIME_YMD."' AND vst_ip = '".PAVE_USER_IP."') AS exist";
    $row = pave_fetch($sql);
    $visit["vst_today_first"] = !$row["exist"];

    pave_insert("pave_vst", $visit);
}
?>