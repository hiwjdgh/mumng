<?php
if (!defined('_PAVE_')) exit;
include_once(PAVE_LIB_SECURE_PATH."/constants.php");

/*************************************************************************
**
**  보안코딩 관련 함수 모음
**
*************************************************************************/

/************************************************************************************************************************
   escape_string 함수 
************************************************************************************************************************/
function pave_escape($value){
	global $db_conn;
	return is_array($value)? array_map('pave_escape', $value) : mysqli_real_escape_string($db_conn, $value);
}

/************************************************************************************************************************
   trim 함수 
************************************************************************************************************************/
function pave_trim($value){
	return is_array($value)? array_map('pave_trim', $value) : trim($value);
}

/************************************************************************************************************************
   extract 함수 
************************************************************************************************************************/
function pave_extract($array){
	$ext_arr = array ('PHP_SELF', '_ENV', '_GET', '_POST', '_FILES', '_SERVER', '_COOKIE', '_SESSION', '_REQUEST',
	'HTTP_ENV_VARS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS',
	'HTTP_COOKIE_VARS', 'HTTP_SESSION_VARS', 'GLOBALS');
	$ext_cnt = count($ext_arr);
	for ($i=0; $i<$ext_cnt; $i++) {
		if (isset($array[$ext_arr[$i]]))  unset($array[$ext_arr[$i]]);
	}

	return $array;
}

/************************************************************************************************************************
   preg_replace 함수 
************************************************************************************************************************/
function pave_sanitize_replace($array, $replace = "", $regex){
	if(is_array($array)){
		foreach ($array as $key => $value) {
			$array[$key] = pave_sanitize_replace($value, $replace, $regex);
		}
	}else{	
		$array = preg_replace($regex, $replace, $array);
	}

	return $array;
}

/************************************************************************************************************************
   preg_match 함수 
************************************************************************************************************************/
function pave_sanitize_match($array, $regex){
	if(is_array($array)){
		foreach ($array as $key => $value) {
			$array[$key] = pave_sanitize_match($value, $regex);
		}
	}else{	
		$array = preg_match($regex, $array);
	}

	return $array;
}

/************************************************************************************************************************
   strip_tag 함수 
************************************************************************************************************************/
function pave_sanitize_strip_tag($array, $allow = ""){
	if(is_array($array)){
		foreach ($array as $key => $value) {
			$array[$key] = pave_sanitize_strip_tag($value, $allow);
		}
	}else{	
		$array = strip_tags($array, $allow);
	}

	return $array;
}

/************************************************************************************************************************
   implode 함수 
************************************************************************************************************************/
function pave_implode($array, $glue = ""){
    if(!is_array($array) || !$array){
        return "";
    }

    return implode($glue, $array);
}

/************************************************************************************************************************
   explode 함수 
************************************************************************************************************************/
function pave_explode($string, $glue = ""){
    if(!$string){
        return array();
    }

    return explode($glue, $string);
}

/************************************************************************************************************************
   input sanitize 함수 
************************************************************************************************************************/
function pave_input_sanitize($string){
	$string = pave_trim($string);
	return pave_sanitize_strip_tag($string);
}

/************************************************************************************************************************
   is_array 함수 
************************************************************************************************************************/
function pave_is_array($array){
    if(!$array){
        return false;
    }

    if(!is_countable($array)){
        return false;
    }

    if(!is_array($array)){
        return false;
    }

    if(count($array) < 1){
        return false;
    }

    return true;
}
?>