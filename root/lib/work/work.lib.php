<?php
if (!defined('_PAVE_')) exit;
/*************************************************************************
**
**  작품 관련 함수 모음
**
*************************************************************************/
/************************************************************************************************************************
   작품 명 검사 함수 
************************************************************************************************************************/
function sanitize_work_name($work_name){
    global $pave_config, $work_config;
    $work_name = pave_sanitize_strip_tag($work_name);

    if ($work_name == ""){
        return "작품명을 입력해주세요.";
    }

    if (mb_strlen($work_name, "UTF-8") < $work_config["work_name_min_len"] || mb_strlen($work_name, "UTF-8") > $work_config["work_name_max_len"]){
        return "작품명을 ".$work_config["work_name_min_len"]."-".$work_config["work_name_max_len"]."자로 입력해 주세요.";
    }

  
    $is_slang = false;
    for ($i=0; $i < count($pave_config["pave_slang_word_list"]); $i++) {
        $str = $pave_config["pave_slang_word_list"][$i];

        $pos = stripos($work_name, $str);
        if ($pos !== false) {
            $is_slang = true;
            break;
        }
    }

    if($is_slang){
        return "비속어를 작품명으로 사용할 수 없습니다.";
    }

    return "";
}

/************************************************************************************************************************
   작품 줄거리 검사 함수 
************************************************************************************************************************/
function sanitize_work_description($work_description){
    global $pave_config, $work_config;
    $work_description = pave_sanitize_strip_tag($work_description);

    if ($work_description == ""){
        return "작품 줄거리를 입력해주세요.";
    }

    if (mb_strlen($work_description, "UTF-8") < $work_config["work_description_min_len"] || mb_strlen($work_description, "UTF-8") > $work_config["work_description_max_len"]){
        return "작품 줄거리를 ".$work_config["work_description_min_len"]."-".$work_config["work_description_max_len"]."자로 입력해 주세요.";
    }

    $is_slang = false;
    for ($i=0; $i < count($pave_config["pave_slang_word_list"]); $i++) {
        $str = $pave_config["pave_slang_word_list"][$i];

        $pos = stripos($work_description, $str);
        if ($pos !== false) {
            $is_slang = true;
            break;
        }
    }

    if($is_slang){
        return "비속어를 작품 줄거리에 사용할 수 없습니다.";
    }
    return "";
}

/************************************************************************************************************************
   작품 연재요일 검사 함수 
************************************************************************************************************************/
function sanitize_work_day($work_day){
    global $pave_user, $work_config;
    $work_day = pave_sanitize_strip_tag($work_day);
    
    if(!pave_is_array($work_day)){
        return "작품 연재요일을 선택해주세요.";
    }


    foreach ($work_day as $day) {
        if(!in_array($day, $work_config["work_day_list"])){
            return "작품 연재요일을 올바르게 선택해주세요."; 
        }

        $sql = "SELECT COUNT(*) AS cnt FROM pave_work WHERE user_no = '{$pave_user["user_no"]}' AND work_day LIKE '%{$day}%'";
        $row = pave_fetch($sql);

        if($row["cnt"] > $work_config["work_day_max_cnt"]){
            return "{$day}요일에 연재할 수 있는 최대 작품 수를 초과하였습니다.";
        }
    }
  
    return "";
}

/************************************************************************************************************************
   작품 연재시간 검사 함수 
************************************************************************************************************************/
function sanitize_work_time($work_time){
    global $work_config;
    $work_time = pave_sanitize_strip_tag($work_time);

    if ($work_time == ""){
        return "작품 연재시간을 선택해주세요.";
    }

    if(!in_array($work_time, $work_config["work_time_list"])){
        return "작품 연재시간을 올바르게 선택해주세요.";
    }
  
    return "";
}

/************************************************************************************************************************
   작품 연령 검사 함수 
************************************************************************************************************************/
function sanitize_work_age($work_age){
    global $work_config;
    $work_age = pave_sanitize_strip_tag($work_age);

    if ($work_age == ""){
        return "작품 연령을 선택해주세요.";
    }

    if(!in_array($work_age, $work_config["work_age_list"])){
        return "작품 연령을 올바르게 선택해주세요.";
    }
  
    return "";
}

/************************************************************************************************************************
   작품 장르 검사 함수 
************************************************************************************************************************/
function sanitize_work_genre($work_genre){
    global $work_config;
    $work_genre = pave_sanitize_strip_tag($work_genre);
    if(!pave_is_array($work_genre)){
        return "작품 장르를 선택해주세요.";

    }

    if(count($work_genre) > $work_config["work_genre_max_cnt"]){
        return "작품 장르는 최대 {$work_config["work_genre_max_cnt"]}개 입니다.";
    }


    foreach ($work_genre as $genre) {
        if(!in_array($genre, $work_config["work_genre_list"])){
            return "작품 장르를 올바르게 선택해주세요.";
        }
    }
  
    return "";
}

/************************************************************************************************************************
   작품 해시태그 검사 함수 
************************************************************************************************************************/
function sanitize_work_hashtag($work_hashtag){
    global $work_config;
    $work_hashtag = pave_sanitize_strip_tag($work_hashtag);

    if(!pave_is_array($work_hashtag)){
        return "작품 해시태그를 입력해주세요.";
    }

    if(count($work_hashtag) > $work_config["work_hashtag_max_cnt"]){
        return "작품 해시태그는 최대 {$work_config["work_hashtag_max_cnt"]}개 입니다.";
    }
  
    return "";
}

/************************************************************************************************************************
   작품 함께한 작가 검사 함수 
************************************************************************************************************************/
function sanitize_work_with($work_with){
    $work_with = pave_sanitize_strip_tag($work_with);
    $work_with = pave_explode($work_with, ",");

    if(!pave_is_array($work_with)){
        return "";
    }

    return "";
}

/************************************************************************************************************************
   작품 운영원칙 검사 함수 
************************************************************************************************************************/
function sanitize_work_agree($work_agree){
    $work_agree = pave_sanitize_strip_tag($work_agree);

    if (!$work_agree){
        return "작품 운영원칙을 동의해주세요.";
    }
    return "";
}

/************************************************************************************************************************
   회차 구분 검사 함수 
************************************************************************************************************************/
function sanitize_epsd_cate($epsd_cate, $is_required){
    global $epsd_config;
    $epsd_cate = pave_sanitize_strip_tag($epsd_cate);

    if ($epsd_cate == ""){
        if(!$is_required){
            return "";
        }
        
        return "잘못된 접근입니다.";
    }

    return "";
}

/************************************************************************************************************************
   회차 명 검사 함수 
************************************************************************************************************************/
function sanitize_epsd_name($epsd_name, $is_required){
    global $epsd_config;
    $epsd_name = pave_sanitize_strip_tag($epsd_name);

    if ($epsd_name == ""){
        if(!$is_required){
            return "";
        }

        return "회차 명을 입력해주세요.";
    }

    if (mb_strlen($epsd_name, "UTF-8") < $epsd_config["epsd_name_min_len"] || mb_strlen($epsd_name, "UTF-8") > $epsd_config["epsd_name_max_len"]){
        return "회차 명을 ".$epsd_config["epsd_name_min_len"]."-".$epsd_config["epsd_name_max_len"]."자로 입력해 주세요.";
    }

  
    return "";
}

/************************************************************************************************************************
   회차 이미지 검사 함수 
************************************************************************************************************************/
function sanitize_epsd_img($epsd_img, $is_required){
    $epsd_img = pave_sanitize_strip_tag($epsd_img);

    if (!$epsd_img){
        if(!$is_required){
            return "";
        }

        return "회차 이미지를 등록해주세요.";
    }

  
    return "";
}

/************************************************************************************************************************
   회차 타입 검사 함수 
************************************************************************************************************************/
function sanitize_epsd_no_type($epsd_no_type, $is_required){
    global $epsd_config;
    $epsd_no_type = pave_sanitize_strip_tag($epsd_no_type);

    if ($epsd_no_type == ""){
        if(!$is_required){
            return "";
        }

        return "회차 구분을 선택해주세요.";
    }

    if(!in_array($epsd_no_type, $epsd_config["epsd_no_type_list"])){
        return "잘못된 접근입니다.";
    }
  
    return "";
}

/************************************************************************************************************************
   회차 에필로그 검사 함수 
************************************************************************************************************************/
function sanitize_epsd_eplg($epsd_eplg, $is_required){
    global $epsd_config;
    $epsd_eplg = pave_sanitize_strip_tag($epsd_eplg);

    if ($epsd_eplg == ""){
        if(!$is_required){
            return "";
        }

        return "회차 에필로그를 입력해주세요.";
    }

    if (mb_strlen($epsd_eplg, "UTF-8") > $epsd_config["epsd_eplg_max_len"]){
        return "회차 에필로그를 ".$epsd_config["epsd_eplg_max_len"]."자 이내로 입력해 주세요.";
    }
  
    return "";
}


/************************************************************************************************************************
   회차 원고 검사 함수 
************************************************************************************************************************/
function sanitize_epsd_copy($epsd_copy, $is_required){
    if(!pave_is_array($epsd_copy)){
        if(!$is_required){
            return "";
        }

        return "회차 원고를 등록해주세요.";
    }
  
    return "";
}

/************************************************************************************************************************
   회차 내용 검사 함수 
************************************************************************************************************************/
function sanitize_epsd_content($epsd_content, $is_required){
    global $epsd_config;
    $epsd_content = pave_sanitize_strip_tag($epsd_content);

    if ($epsd_content == ""){
        if(!$is_required){
            return "";
        }
        
        return "휴재 내용을 입력해주세요.";
    }

    if (mb_strlen($epsd_content, "UTF-8") > $epsd_config["epsd_content_max_len"]){
        return "휴재 내용을 ".$epsd_config["epsd_content_max_len"]."자 이내로 입력해 주세요.";
    }
  
    return "";
}

/************************************************************************************************************************
   회차 의견 검사 함수 
************************************************************************************************************************/
function sanitize_comment_content($comment_content, $is_required){
    global $pave_config, $comment_config;
    $comment_content = pave_sanitize_strip_tag($comment_content);

    if ($comment_content == ""){
        if(!$is_required){
            return "";
        }
        return "의견을 입력해주세요.";
    }

    if (mb_strlen($comment_content, "UTF-8") < $comment_config["comment_min_len"]){
        return "의견을 {$comment_config["comment_min_len"]} 자 이상 입력해주세요.";
    }

    if (mb_strlen($comment_content, "UTF-8") > $comment_config["comment_max_len"]){
        return "의견을 {$comment_config["comment_max_len"]}자 이하로 입력해주세요.";
    }
  
    
    $is_slang = false;
    for ($i=0; $i < count($pave_config["pave_slang_word_list"]); $i++) {
        $str = $pave_config["pave_slang_word_list"][$i];

        $pos = stripos($comment_content, $str);
        if ($pos !== false) {
            $is_slang = true;
            break;
        }
    }

    if($is_slang){
        return "비속어를 사용할 수 없습니다.";
    }
    
    return "";
}
?>