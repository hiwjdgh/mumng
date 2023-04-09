<?php
if (!defined('_PAVE_')) exit;
include_once(PAVE_LIB_THM_PATH."/constants.php");
/*************************************************************************
**
**  테마 함수 모음
**
*************************************************************************/
function get_theme_list($thm_id = ""){
 
    $sql = "SELECT * FROM pave_cf_thm";

    if($thm_id){
        $sql .= " WHERE thm_id = '{$thm_id}'";
    }
    $result = pave_query($sql);

    $theme = array();
    for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
        $theme[] = $row;
    }

    return $theme;
}

function get_theme($thm_id){
    $theme = get_theme_list($thm_id)[0];
    $theme["thm_url"] = PAVE_THM_URL.$theme["thm_path"];
    $theme["thm_path"] = PAVE_THM_PATH.$theme["thm_path"];
    $theme["thm_default"] = PAVE_THM_PATH.DIRECTORY_SEPARATOR.THM_DEFAULT;
    if(Visit::is_mobile()){
        $theme["thm_url"] = PAVE_THM_URL.$theme["thm_m_path"];
        $theme["thm_path"] = PAVE_THM_PATH.$theme["thm_m_path"];
        $theme["thm_default"] = PAVE_THM_PATH.DIRECTORY_SEPARATOR.THM_M_DEFAULT;
    }
    return $theme;
}

/************************************************************************************************************************
   테마 ID 검사 함수
************************************************************************************************************************/
function sanitize_theme_id($thm_id){
    if ($thm_id == ""){
        return "테마 ID 를 입력해 주십시오.";
    }

    if (preg_match(PAVE_THEME_ID_REGEX, $thm_id)){
        return "테마 ID 는 영문자, 숫자, _ 만 입력하세요.";
    }

    if (strlen($thm_id) < PAVE_THEME_ID_MIN_LEN || strlen($thm_id) > PAVE_THEME_ID_MAX_LEN){
        return "테마 ID 는 ".PAVE_THEME_ID_MIN_LEN."-".PAVE_THEME_ID_MAX_LEN."글자로 입력하세요.";
    }
    return "";
}

/************************************************************************************************************************
   테마 이름 검사 함수
************************************************************************************************************************/
function sanitize_theme_name($thm_name){
    $thm_name = strip_tags($thm_name);

    if ($thm_name == ""){
        return "테마 이름을 입력해 주십시오.";
    }
    
    if (preg_match(PAVE_THEME_NAME_REGEX, $thm_name)){
        return "테마 이름을 특수문자이외에 문자만 입력 가능합니다.";
    }

    if(preg_match(PAVE_THEME_NAME_JAMO_REGEX, $thm_name)){
        return "테마 이름을 자음 또는 모음만 입력할 수 없습니다.";
    }

    if (strlen($thm_name) < PAVE_THEME_ID_MIN_LEN || strlen($thm_name) > PAVE_THEME_ID_MAX_LEN){
        return "테마 이름을 ".PAVE_THEME_ID_MIN_LEN."-".PAVE_THEME_ID_MAX_LEN."글자로 입력하세요.";
    }


    return "";
}
?>