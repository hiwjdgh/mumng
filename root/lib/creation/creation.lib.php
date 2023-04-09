<?php
if (!defined('_PAVE_')) exit;
/*************************************************************************
**
**  창작 관련 함수 모음
**
*************************************************************************/


/************************************************************************************************************************
   창작 필드 검사 함수 
************************************************************************************************************************/
function sanitize_creation_field($creation_field, $is_required){
    global $creation_config;
    $creation_field = pave_sanitize_strip_tag($creation_field);

    if ($creation_field == ""){
        if(!$is_required){
            return "";
        }
        return "창작 의뢰 필드를 선택해주세요.";
    }
  
    return "";
}

/************************************************************************************************************************
   창작 제목 검사 함수 
************************************************************************************************************************/
function sanitize_creation_name($creation_name, $is_required){
    global $creation_config;
    $creation_name = pave_sanitize_strip_tag($creation_name);

    if ($creation_name == ""){
        if(!$is_required){
            return "";
        }
        return "창작 의뢰 제목을 입력해주세요.";
    }

    if (mb_strlen($creation_name, "UTF-8") < $creation_config["creation_name_min_len"] || mb_strlen($creation_name, "UTF-8") > $creation_config["creation_name_max_len"]){
        return "창작 의뢰 제목을 ".$creation_config["creation_name_min_len"]."-".$creation_config["creation_name_max_len"]."자로 입력해 주세요.";
    }

  
    return "";
}


/************************************************************************************************************************
   창작 간략 내용 검사 함수 
************************************************************************************************************************/
function sanitize_creation_content($creation_content, $is_required){
    global $creation_config;
    $creation_content = pave_sanitize_strip_tag($creation_content);

    if ($creation_content == ""){
        if(!$is_required){
            return "";
        }
        return "창작 의뢰 상세 내용을 입력해주세요.";
    }

    if (mb_strlen($creation_content, "UTF-8") > $creation_config["creation_content_max_len"]){
        return "창작 의뢰 상세 내용을 {$creation_config["creation_content_max_len"]} 자 이하로 입력해 주세요.";
    }

  
    return "";
}

/************************************************************************************************************************
   창작 사용용도 검사 함수 
************************************************************************************************************************/
function sanitize_creation_purpose($creation_purpose, $is_required){
    global $creation_config;
    $creation_purpose = pave_sanitize_strip_tag($creation_purpose);

    if ($creation_purpose == ""){
        if(!$is_required){
            return "";
        }
        return "사용용도를 입력해주세요.";
    }

    if (mb_strlen($creation_purpose, "UTF-8") < $creation_config["creation_purpose_min_len"] || mb_strlen($creation_purpose, "UTF-8") > $creation_config["creation_purpose_max_len"]){
        return "사용용도를 ".$creation_config["creation_purpose_min_len"]."-".$creation_config["creation_purpose_max_len"]."자로 입력해 주세요.";
    }

  
    return "";
}


/************************************************************************************************************************
   창작 EXP 검사 함수 
************************************************************************************************************************/
function sanitize_creation_exp($creation_exp, $is_required){
    global $creation_config;
    $creation_exp = pave_sanitize_strip_tag($creation_exp);

    if ($creation_exp == "" || $creation_exp == "0"){
        if(!$is_required){
            return "";
        }
        return "창작 의뢰 EXP를 입력해주세요.";
    }


    if(($creation_exp % $creation_config["creation_exp_step"]) != 0){
        return "창작 의뢰 EXP를  천 단위로 입력해주세요.";
    }

  
    return "";
}

/************************************************************************************************************************
   창작 마감일 검사 함수 
************************************************************************************************************************/
function sanitize_creation_end_date($creation_end_date, $is_required){
    global $creation_config;
    $creation_end_date = pave_sanitize_strip_tag($creation_end_date);

    if ($creation_end_date == ""){
        if(!$is_required){
            return "";
        }
        return "창작 의뢰 마감일을 입력해주세요.";
    }

    if(Converter::display_time_elapse($creation_end_date, PAVE_TIME_YMD) < 1){
        return "창작 의뢰 마감일을 올바르게 입력해주세요.";
    }
  
    return "";
}

/************************************************************************************************************************
   창작 데포르메 검사 함수 
************************************************************************************************************************/
function sanitize_creation_ratio($creation_ratio, $is_required){
    global $creation_config;
    $creation_ratio = pave_sanitize_strip_tag($creation_ratio);

    if ($creation_ratio == ""){
        if(!$is_required){
            return "";
        }
        return "창작 의뢰 데포르메를 선택해주세요.";
    }

    if(!in_array($creation_ratio, $creation_config["creation_ratio_list"])){
        return "창작 의뢰 데포르메를 올바르게 선택해주세요.";
    }

    return "";
}


/************************************************************************************************************************
   창작 사이즈 검사 함수 
************************************************************************************************************************/
function sanitize_creation_size($creation_size, $is_required){
    global $creation_config;
    $creation_size = pave_sanitize_strip_tag($creation_size);

    if ($creation_size == ""){
        if(!$is_required){
            return "";
        }
        return "창작 의뢰 사이즈를 선택해주세요.";
    }

    if(!in_array($creation_size, $creation_config["creation_size_list"])){
        return "창작 의뢰 사이즈를 올바르게 선택해주세요.";
    }

    return "";
}

/************************************************************************************************************************
   창작 배경화면 요청사항 검사 함수 
************************************************************************************************************************/
function sanitize_creation_background_content($creation_background_content, $is_required){
    global $creation_config;
    $creation_background_content = pave_sanitize_strip_tag($creation_background_content);

    if ($creation_background_content == ""){
        if(!$is_required){
            return "";
        }
        return "창작 의뢰 배경화면 요청사항을 입력해주세요.";
    }

    if (mb_strlen($creation_background_content, "UTF-8") > $creation_config["creation_add_content_max_len"]){
        return "창작 의뢰 배경화면 요청사항을 ".$creation_config["creation_add_content_max_len"]."자 이하로 입력해 주세요.";
    }


    return "";
}

/************************************************************************************************************************
   창작 소품 요청사항 검사 함수 
************************************************************************************************************************/
function sanitize_creation_accessory_content($creation_accessory_content, $is_required){
    global $creation_config;
    $creation_accessory_content = pave_sanitize_strip_tag($creation_accessory_content);

    if ($creation_accessory_content == ""){
        if(!$is_required){
            return "";
        }
        return "창작 의뢰 소품 요청사항을 입력해주세요.";
    }

    if (mb_strlen($creation_accessory_content, "UTF-8") > $creation_config["creation_add_content_max_len"]){
        return "창작 의뢰 소품 요청사항을 ".$creation_config["creation_add_content_max_len"]."자 이하로 입력해 주세요.";
    }


    return "";
}
?>