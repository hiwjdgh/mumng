<?php
$check_key = pave_input_sanitize($request[3]);

if($check_key == "user_di"){
    if($msg = sanitize_reg_user_di($user_di, $is_dup_check, $user_id, $is_dup_check)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_id"){
    if($msg = sanitize_reg_user_id($user_id, $is_dup_check)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_pwd"){
    if($msg = sanitize_reg_user_pwd($user_pwd)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_pwd_re"){
    if($msg = sanitize_reg_user_pwd_re($user_pwd, $user_pwd_re)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_nick"){
    if($msg = sanitize_reg_user_nick($user_nick, $is_required, $user_id, $is_dup_check)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_email"){
    if($msg = sanitize_reg_user_email($user_email, $is_required, $user_id, $is_dup_check)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_cp"){
    if($msg = sanitize_reg_user_cp($user_cp, $is_required, $user_id, $is_dup_check)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_tel"){
    if($msg = sanitize_reg_user_tel($user_tel, $is_required, $user_id, $is_dup_check)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_name"){
    if($msg = sanitize_reg_user_name($user_name, $is_required)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_birthdate"){
    if($msg = sanitize_reg_user_birth_date($user_birthdate, $is_required)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_sex"){
    if($msg = sanitize_reg_user_sex($user_sex, $is_required)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_rel"){
    if($msg = sanitize_reg_user_rel($user_rel, $is_required)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_rel_cp"){
    if($msg = sanitize_reg_user_rel_cp($user_rel_cp, $is_required, $user_id, $is_dup_check)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_share"){
    if($msg = sanitize_reg_user_share($user_share, $is_required, $user_id, $is_dup_check)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_term_agree"){
    if($msg = sanitize_reg_user_term_agree($user_term_agree, $is_required)){
        die(return_json(null, "fail", $msg));
    }
}else if($check_key == "user_info_agree"){
    if($msg = sanitize_reg_user_info_agree($user_info_agree, $is_required)){
        die(return_json(null, "fail", $msg));
    }

}else if($check_key == "user_event_agree"){
    if($msg = sanitize_reg_user_event_agree($user_event_agree, $is_required)){
        die(return_json(null, "fail", $msg));
    }
}else{
    die(return_json(null, "fail", "잘못된 요청입니다."));
}

die(return_json(null, "success"));
?>