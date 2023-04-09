<?php
if (!defined('_PAVE_')) exit;
class Visit{
    /* 운영체제 */
    private static $_OS_LINUX_REGEX = "/linux/i";
    private static $_OS_MAC_REGEX = "/macintosh|mac os x/i";
    private static $_OS_WINDOW_REGEX = "/win(32|64|dows)/i";

    /* 브라우저 */
    private static $_BROWSER_MS_REGEX = "/MSIE/i";
    private static $_BROWSER_MS2_REGEX = "/Trident/i";
    private static $_BROWSER_FIREFOX_REGEX = "/Firefox/i";
    private static $_BROWSER_CHROME_REGEX = "/Chrome/i";
    private static $_BROWSER_SAFARI_REGEX = "/Safari/i";
    private static $_BROWSER_OPERA_REGEX = "/Opera/i";
    private static $_BROWSER_NETSCAPE_REGEX = "/Netscape/i";

    /* 기기 */
    private static $_DEVICE_MOBILE_REGEX = "/mobile|tablet|ip(hone|od|ad)|android|blackBerry/i";
    private static $_DEVICE_APP_REGEX = "/pave_app_android|pave_app_ios/i";

    function __construct() {
    }

    public static function insert_visit_log(){
        $visit = array(
            "log_visit_ip"          => PAVE_USER_IP,
            "log_visit_date"        => PAVE_TIME_YMD,
            "log_visit_year"        => PAVE_YEAR,
            "log_visit_month"       => PAVE_MONTH,
            "log_visit_day"         => PAVE_DAY,
            "log_visit_yoil"        => PAVE_YOIL,
            "log_visit_hour"        => PAVE_HOUR,
            "log_visit_referer"     => PAVE_USER_REFERER,
            "log_visit_agent"       => PAVE_USER_AGENT,
            "log_visit_page"        => PAVE_PHPSELF,
            "log_visit_query"       => PAVE_QUERYS,
            "log_visit_browser"     => self::get_user_browser(),
            "log_visit_os"          => self::get_user_os(),
            "log_visit_device"      => self::get_user_device()
        );

        $obj = new Objects2();

        $obj->generate_sql_init()->set_sql_common("SELECT EXISTS (SELECT 1 FROM pave_log_visit WHERE log_visit_date = '".PAVE_TIME_YMD."' AND log_visit_ip = '".PAVE_USER_IP."') AS exist");
    
        $row = pave_fetch($obj->generate_sql());
        $visit["log_visit_first"] = !$row["exist"];
    
        pave_insert("pave_log_visit", $visit);
    }

    public static function get_user_browser(){
        if(preg_match(self::$_BROWSER_MS_REGEX, PAVE_USER_AGENT)){
            $browser    = "Internet Explorer";
        }else if( preg_match(self::$_BROWSER_MS2_REGEX, PAVE_USER_AGENT)){
            $browser	= "Internet Explorer";
        }else if( preg_match(self::$_BROWSER_FIREFOX_REGEX, PAVE_USER_AGENT)){
            $browser	= "Mozilla Firefox";
        }else if( preg_match(self::$_BROWSER_CHROME_REGEX, PAVE_USER_AGENT)){
            $browser	= "Google Chrome";
        }else if( preg_match(self::$_BROWSER_SAFARI_REGEX, PAVE_USER_AGENT)){
            $browser	= "Apple Safari";
        }else if( preg_match(self::$_BROWSER_OPERA_REGEX, PAVE_USER_AGENT)){
            $browser	= "Opera";
        }else if( preg_match(self::$_BROWSER_NETSCAPE_REGEX, PAVE_USER_AGENT) ){
            $browser    = "Netscape";
        }else{
            $browser    = "unknwon";
        }

        return $browser;
    }

    public static function get_user_os(){
        if( preg_match(self::$_OS_LINUX_REGEX, PAVE_USER_AGENT) ){
            $os = "linux";
        }else if( preg_match(self::$_OS_MAC_REGEX, PAVE_USER_AGENT) ){
            $os = "mac";
        }else if( preg_match(self::$_OS_WINDOW_REGEX, PAVE_USER_AGENT) ){
            $os = "windows";
        }else{
            $os = "unknown";
        }

        return $os;
    }

    public static function get_user_device(){
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

    public static function is_mobile(){
        if(preg_match(self::$_DEVICE_MOBILE_REGEX, PAVE_USER_AGENT)){
            return true;
        }

        return false;
    }

    public static function is_app(){
        if(preg_match(self::$_DEVICE_APP_REGEX, PAVE_USER_AGENT)){
            return true;
        }

        return false;
    }

    public static function is_explorer(){
        if(preg_match(self::$_BROWSER_MS_REGEX, PAVE_USER_AGENT) || preg_match(self::$_BROWSER_MS2_REGEX, PAVE_USER_AGENT)){
            return true;
        }
        return false;
    }
}
?>