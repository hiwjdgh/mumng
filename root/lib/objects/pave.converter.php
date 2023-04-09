<?php
if (!defined('_PAVE_')) exit;
class Converter{
    private static $_NUMBER_REGEX = "/[^0-9]/";
    private static $_CP_CONVERT_REGEX = "/([0-9]{3})([0-9]{3,4})([0-9]{4})$/";
    private static $_TEL_CONVERT_REGEX = "/([0-9]{4})([0-9]{4})$/";
    private static $_TEL_CONVERT_REGEX2 = "/([0-9]{2,3})([0-9]{3,4})([0-9]{4})$/";
    private static $_DATE_CONVERT_REGEX = "/([0-9]{4})([0-9]{2})([0-9]{2})$/";
    private static $_BSNS_CONVERT_REGEX = "/([0-9]{3})([0-9]{2})([0-9]{5})$/";
    function __construct() {
    }

    public static function add_quotes($str){
        return sprintf("'%s'", $str);
    }

    public static function add_double_quotes($str){
        return sprintf("'%s'", $str);
    }

    public static function add_hyphen_cp($str){
        $str = preg_replace(self::$_NUMBER_REGEX, "", $str);

        $result =  preg_replace(self::$_CP_CONVERT_REGEX, "$1-$2-$3", $str);
        
        return $result;
    }

    public static function add_hyphen_tel($str){
        $str = preg_replace(self::$_NUMBER_REGEX, "", $str);
    
        if (strlen($str)=='8' && (substr($str,0,2)=='15' || substr($str,0,2)=='16' || substr($str,0,2)=='18') ){	// 지능망 번호이면
            $result =  preg_replace(self::$_TEL_CONVERT_REGEX, "$1-$2", $str);
        }else{
            $result =  preg_replace(self::$_TEL_CONVERT_REGEX2, "$1-$2-$3", $str);
        }
        
        return $result;
    }

    public static function add_hyphen_date($str){
        $str = preg_replace(self::$_NUMBER_REGEX, "", $str);
        $result =  preg_replace(self::$_DATE_CONVERT_REGEX, "$1-$2-$3", $str);
        
        return $result;
    }

    public static function add_hyphen_bsns_num($str){
        $str = preg_replace(self::$_NUMBER_REGEX, "", $str);
    
        $result =  preg_replace(self::$_BSNS_CONVERT_REGEX, "$1-$2-$3", $str);
        
        return $result;
    }


    public static function del_hyphen_cp($str){
        $str = preg_replace(self::$_NUMBER_REGEX, "", $str);
        return $str;
    }

    public static function del_hyphen_tel($str){
        $str = preg_replace(self::$_NUMBER_REGEX, "", $str);
        return $str;
    }
 
    public static function del_hyphen_date($str){
        $str = preg_replace(self::$_NUMBER_REGEX, "", $str);
        return $str;
    }

    public static function del_hyphen_bsns_number($str){
        $str = preg_replace(self::$_NUMBER_REGEX, "", $str);
        return $str;
    }

    public static function display_number($number, $unit = ""){
        if(!$number){
            return "0".$unit;
        }
    
        return number_format($number). $unit; 
    }

    public static function display_number_format($number, $unit = "", $comma = 1){
        if(!$number){
            return "0".$unit;
        }
    
        if($number < 900){
            return self::display_number($number, $unit); 
        }else if($number < 900000){
            return number_format($number/1000, $comma)  . "K"; 
        }else if($number < 900000000){
            return number_format($number/1000000, $comma)  . "M"; 
        }else{
            return number_format($number/1000000000, $comma) . "B";
        }
    }

    public static function display_byte_format($number){
        if ($number >= 1073741824){
            $bytes = number_format($number / 1073741824, 2) . "GB";
        }elseif ($number >= 1048576){
            $bytes = number_format($number / 1048576, 2) . "MB";
        }elseif ($number >= 1024){
            $bytes = number_format($number / 1024, 2) . "KB";
        }elseif ($number > 1){
            $bytes = $number . "bytes";
        }else{
            $bytes = "0bytes";
        }
    
        return $bytes;
    }

    public static function display_byte($str){
        preg_match("/(\d+)(\w+)/", $str, $matches);
        $type = strtolower($matches[2]);
        switch ($type) {
            case "kb":
                $bytes = $matches[1]*1024;
                break;
            case "mb":
                $bytes = $matches[1]*1024*1024;
                break;
            case "gb":
                $bytes = $matches[1]*1024*1024*1024;
                break;
            default:
                $bytes = $matches[1];
        
        }
    
        return $bytes;
    }

    public static function display_mask($str){
        if(!$str){
            return "";
        }
    
        $length = strlen($str);
        $visible_length = (int) round($length / 4);
        $hiddenlength = $length - ($visible_length * 2);
        
        return substr($str, 0, $visible_length) . str_repeat('*', $hiddenlength) . substr($str, ($visible_length * -1), $visible_length);
    }

    public static function display_time($str, $format = "Y-m-d"){
        if(!$str){
            return "";
        }
    
        return date($format, strtotime($str));
    }
    
    public static function display_time_ago($str, $format = "Y-m-d", $is_future_elapsed = false){
        $setting_time = strtotime($str);
        $current_time = PAVE_TIME;
    

        if($setting_time > $current_time){ //미래 시간
            if(!$is_future_elapsed){
                return self::display_time($str, $format);
            }
            $time_elapsed = $setting_time - $current_time;
        }else{
            $time_elapsed = $current_time - $setting_time;
        }

        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );

        
        // Seconds
        if($seconds <= 60){
            return "{$seconds}초";
        }
        //Minutes
        else if($minutes <=60){
            return "{$minutes}분";
        }
        //Hours
        else if($hours <=24){
            return "{$hours}시간";
        }
        //Days
        else if($days <= 7){
            return "{$days}일";
        }else{
            return self::display_time($str, $format);
        }
    }

    public static function display_time_elapse($time, $time2, $unit = "day"){
        $time_diff = strtotime($time) - strtotime($time2);

        switch ($unit) {
            case 'year':
                $time_elapsed       = round($time_diff / 31536000 );
                break;
            case 'month':
                $time_elapsed       = round($time_diff / 2592000 );
                break;
            case 'week':
                $time_elapsed       = round($time_diff / 86400 );
                break;
            case 'day':
                $time_elapsed       = round($time_diff / 86400 );
                break;
            case 'hour':
                $time_elapsed       = round($time_diff / 3600);
                break;
            case 'minute':
                $time_elapsed       = round($time_diff / 60 );
                break;
            case 'second':
                $time_elapsed       = $time_diff;
                break;
        }

        return $time_elapsed;
    }

    public static function display_file_name($file_name){
        return ".".strtolower(pathinfo($file_name, PATHINFO_FILENAME));
    }

    public static function display_file_ext($file_name){
        return ".".strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    }

    public static function gernerate_jwt($data){
        $header = json_encode(array(
            'alg' => "SHA-256",
            'typ' => 'JWT'
        ));

        // 페이로드 - 전달할 데이터
        $payload = json_encode($data);

        // 시그니처
        $signature = hash("SHA-256", $header . $payload . "pave");

        return base64_encode($header . '.' . $payload . '.' . $signature);
    }
    
}
?>