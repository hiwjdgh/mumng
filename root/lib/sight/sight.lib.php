<?php
if (!defined('_PAVE_')) exit;
/*************************************************************************
**
**  발견 관련 함수 모음
**
*************************************************************************/


/************************************************************************************************************************
   창작물명 검사 함수 
************************************************************************************************************************/
function sanitize_sight_name($sight_name, $is_required){
    global $sight_config;
    $sight_name = pave_sanitize_strip_tag($sight_name);

    if ($sight_name == ""){
        if(!$is_required){
            return "";
        }
        return "창작물명을 입력해주세요.";
    }

    if (mb_strlen($sight_name, "UTF-8") < $sight_config["sight_name_min_len"] || mb_strlen($sight_name, "UTF-8") > $sight_config["sight_name_max_len"]){
        return "창작물명을 ".$sight_config["sight_name_min_len"]."-".$sight_config["sight_name_max_len"]."자로 입력해 주세요.";
    }

  
    return "";
}


/************************************************************************************************************************
   창작물 연령 검사 함수 
************************************************************************************************************************/
function sanitize_sight_age($sight_age, $is_required){
    global $sight_config;
    $sight_age = pave_sanitize_strip_tag($sight_age);

    if ($sight_age == ""){
        if(!$is_required){
            return "";
        }
        return "창작물 연령을 선택해주세요.";
    }

    if(!in_array($sight_age, $sight_config["sight_age_list"])){
        return "창작물 연령을 올바르게 선택해주세요.";
    }
  
    return "";
}

/************************************************************************************************************************
   창작물 장르 검사 함수 
************************************************************************************************************************/
function sanitize_sight_genre($sight_genre){
    global $sight_config;
    $sight_genre = pave_sanitize_strip_tag($sight_genre);
    $sight_genre = pave_explode($sight_genre, ",");
    if(!pave_is_array($sight_genre)){
        return "창작물 장르를 선택해주세요.";

    }

    if(count($sight_genre) > $sight_config["sight_genre_max_cnt"]){
        return "창작물 장르는 최대 {$sight_config["sight_genre_max_cnt"]}개 입니다.";
    }


    foreach ($sight_genre as $genre) {
        if(!in_array($genre, $sight_config["sight_genre_list"])){
            return "창작물 장르를 올바르게 선택해주세요.";
        }
    }
  
    return "";
}

/************************************************************************************************************************
   창작물 해시태그 검사 함수 
************************************************************************************************************************/
function sanitize_sight_hashtag($sight_hashtag, $is_required){
    global $sight_config;
    $sight_hashtag = pave_sanitize_strip_tag($sight_hashtag);
    if(!pave_is_array($sight_hashtag)){
        if(!$is_required){
            return "";
        }
        return "창작물 해시태그를 입력해주세요.";
    }

    if(count($sight_hashtag) > $sight_config["sight_hashtag_max_cnt"]){
        return "창작물 해시태그는 최대 {$sight_config["sight_hashtag_max_cnt"]}개 입니다.";
    }
  
    return "";
}

/************************************************************************************************************************
   창작물 내용 검사 함수 
************************************************************************************************************************/
function sanitize_sight_content($sight_content, $is_required){
    if ($sight_content == ""){
        if(!$is_required){
            return "";
        }
        return "창작물 내용을 입력해주세요.";
    }

    return "";
}
?>