<?php
no_refresh("본인인증 완료");
$key = get_session("nice_key", $key);
$iv = get_session("nice_iv", $iv);

set_session("nice_key", "");
set_session("nice_iv", "");

$result = decrypt_nice($enc_data, $key, $iv);
$result = iconv("EUC-KR", "UTF-8", $result);


$result = json_decode($result, true);

if($result["resultcode"] !== "0000"){
    alert_close("본인인증에 실패했습니다. 오류코드 : [{$result["resultcode"]}]");
    return;
}

$user_cp = $result["mobileno"];
$user_name = $result["name"];
$user_birthdate = $result["birthdate"];
$user_birth_year = substr($result["birthdate"],0, 4);
$user_birth_month = substr($result["birthdate"],4, 2);
$user_birth_day = substr($result["birthdate"],6, 2);
$user_sex = $result["gender"]=="1"?"m":"f";
$user_di = $result["di"];
$user_cp_cert_state = 1;
$user_kid_cert_state = ((int)$user_birthdate <= (int)Converter::display_time("-14 years", "Ymd")) ? 0 : 1;
$user_adult_cert_state = ((int)$user_birthdate <= (int)Converter::display_time("-19 years", "Ymd")) ? 1 : 0;
$cert_type = $result["receivedata"];

//본인인증 타입 검사
if(!in_array($cert_type, $cert_config["cert_type_list"])){
    alert_close("비정상적인 접근입니다.");
    return;
}

//본인인증 로그
Certification::insert_cert_log($pave_user, $cert_type, $cert_config["cert_module_name"]);

if($cert_type == "reg_user"){
    //중복 가입 검사
    if($msg = sanitize_reg_user_di($user_di, true, $pave_user["user_id"], true)){
        alert_close($msg);
        return;
    }

    set_session("nice_result", $result);

}else if($cert_type == "reg_user_rel"){
    if(!$user_adult_cert_state){
        alert_close("보호자(법정대리인)이 불가합니다.");
        return;
    }
    set_session("nice_result_rel", $result);
}else if($cert_type == "commerce_user"){
    if($pave_user["user_di"] != $user_di){
        alert_close("회원님의 정보와 일치하지 않습니다.");
        return;
    }
    set_session("nice_result", $result);
}else if($cert_type == "commerce_user_rel"){
    if(!$user_adult_cert_state){
        alert_close("보호자(법정대리인)이 불가합니다.");
        return;
    }
    set_session("nice_result_rel", $result);
}else if($cert_type == "find_id" || $cert_type == "find_pwd"){
    $sql = "SELECT * FROM pave_user WHERE user_di = '{$user_di}'";
    $row = pave_fetch($sql);

    if(!$row["user_id"]){
        alert_close("가입정보를 확인할 수 없습니다.");
        return;
    }
    set_session("nice_result", $result);
}else if($cert_type == "renew_user"){
    if($pave_user["user_di"] != $user_di){
        alert_close("회원님의 정보와 일치하지 않습니다.");
        return;
    }
    set_session("nice_result", $result);
}
?>
<script>
    <?php if($cert_type == "reg_user") { ?>
        if(opener.$("#user_cp").val() != "<?=$user_cp?>"){
            alert("입력하신 휴대폰번호와 일치하지 않습니다.")
            set_session("nice_result", "");
        }else{
            opener.$("#reg__step2-msg").text("본인 인증이 완료되었습니다.");
            opener.$("#user_cp").prop("readonly", true);
            opener.$("#user_cp").closest(".input-box").addClass("readonly");
            opener.$("#user_cp").closest(".input-box").addClass("complete");
            opener.$("#user_name_text").text("<?=$user_name?>");
            opener.$("#user_birth_year_text").text("<?=$user_birth_year?>");
            opener.$("#user_birth_month_text").text("<?=$user_birth_month?>");
            opener.$("#user_birth_day_text").text("<?=$user_birth_day?>");
            opener.$("#user_sex").val("<?=$user_sex?>");
            opener.$("#user_sex").closest(".select-box").addClass("focus");
            opener.$("#user_sex").closest(".select-box").addClass("valid");
            opener.$("#user_cp_cert_state").val("<?=$user_cp_cert_state?>");
            opener.$("#user_kid_cert_state").val("<?=$user_kid_cert_state?>");
            opener.reg_second_step_check();
            
            if("<?=$user_kid_cert_state?>" === "1"){
                alert("미성년자는 보호자(법정대리인) 동의 후 가입이 가능합니다.");
            }
        }
    <?php }else if($cert_type == "reg_user_rel"){ ?>
        if(opener.$("#user_rel_cp").val() != "<?=$user_cp?>"){
            alert("입력하신 휴대폰번호와 일치하지 않습니다.")
            set_session("nice_result_rel", "");
        }else{
            opener.$("#reg__step3-msg").text("보호자 인증이 완료되었습니다.");
            opener.$("#user_rel_cp").prop("readonly", true);
            opener.$("#user_rel_cp").closest(".input-box").addClass("readonly");
            opener.$("#user_rel_cp").closest(".input-box").addClass("complete");
            opener.$("#user_rel_cp_cert_state").val("<?=$user_cp_cert_state?>");
            opener.reg_third_step_check();
        }
    <?php }else if($cert_type == "commerce_user"){ ?>
        opener.$("#user_cp_cert_state").val("<?=$user_cp_cert_state?>");
    <?php }else if($cert_type == "commerce_user_rel"){ ?>
        opener.$("#user_rel_cp_cert_state").val("<?=$user_cp_cert_state?>");
    <?php }else if($cert_type == "find_id" || $cert_type == "find_pwd"){ ?>
        if(opener.$("#user_cp").val() != "<?=$user_cp?>"){
            alert("입력하신 휴대폰번호와 일치하지 않습니다.")
            set_session("nice_result", "");
        }else{
            opener.$("#user_cp").prop("readonly", true);
            opener.$("#user_cp").closest(".input-box").addClass("readonly");
            opener.$("#user_cp").closest(".input-box").addClass("complete");
            opener.$("#user_cp_cert_state").val("<?=$user_cp_cert_state?>");
            opener.find_step_check();
        }
    <?php }else if($cert_type == "renew_user"){ ?>
        if(opener.$("#user_cp").val() != "<?=$user_cp?>"){
            alert("입력하신 휴대폰번호와 일치하지 않습니다.")
            set_session("nice_result", "");
        }else{
            opener.$("#user_cp").prop("readonly", true);
            opener.$("#user_cp").closest(".input-box").addClass("readonly");
            opener.$("#user_cp").closest(".input-box").addClass("complete");
            opener.$("#user_cp_cert_state").val("<?=$user_cp_cert_state?>");
            opener.cert_step_check();
        }
    <?php } ?>
    window.close();
</script>