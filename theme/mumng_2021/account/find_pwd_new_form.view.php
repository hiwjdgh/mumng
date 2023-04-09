<?php
if (!defined('_PAVE_')) exit;
?>
<section id="find" class="flex flex-column mxw-360 pdhz-22">
    <h2 id="find__title" class="text-weight-bold text-color-g12 text-size-large mgb-48">비밀번호를 재설정해 주세요</h2>
    <form id="find__form" class="flex flex-column" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">
        <input type="hidden" name="user_no" id="user_no" value="<?=$find_user_no?>">

        <fieldset id="find_step" class="flex flex-column mxw-316">
            <legend class="skip">비밀번호재설정</legend>

            <div class="input-box input-box-t2 mgb-10">
                <label for="user_pwd" class="input-box-t2__label">새로운 비밀번호</label>
                <input type="password" name="user_pwd" id="user_pwd" class="input-box-t2__input" value="" title="비밀번호" minlength="<?=$user_cf["user_pwd_min_len"]?>" autocomplete="new-password" required>
                <p id="user_pwd_msg" class="input-box-t2__msg"></p>
            </div>
            
            <div class="input-box input-box-t2 mgb-60">
                <label for="user_pwd_re" class="input-box-t2__label">새로운 비밀번호 확인</label>
                <input type="password" name="user_pwd_re" id="user_pwd_re" class="input-box-t2__input" value="" title="비밀번호 재입력" minlength="<?=$user_cf["user_pwd_min_len"]?>" autocomplete="new-password" required>
                <p id="user_pwdre_msg" class="input-box-t2__msg"></p>
            </div>

            <button type="submit" id="find__submit" class="button-t1 button-s1 disabled" disabled><span class="button__text">재설정 후 로그인</span></button>
        </fieldset>
    </form>
</section>
<script>
function pwd_update_step_check(){
    if($("#user_pwd").closest(".input-box").hasClass("valid")
    && $("#user_pwd_re").closest(".input-box").hasClass("valid")){
        $("#find__submit").removeClass("disabled");
        $("#find__submit").prop("disabled",false);
        return true;
    }else{
        $("#find__submit").addClass("disabled");
        $("#find__submit").prop("disabled",true);
        return false;
    }
}
$(document).ready(function(){
    $("#find__form").on("submit", async function(e){
        e.preventDefault();

        if(!pwd_update_step_check()){
            return false;
        }

        await check_new_pwd_form($(this));

        return false;
    });

    $("#find_step").on("keyup", async function(e){
        e.preventDefault();
        if (e.target === $("#user_pwd")[0]){
            result = await check_user_pwd($(e.target).val());

            if(result.status == "success"){
                $("#user_pwd_msg").text("");
                $("#user_pwd").closest(".input-box").addClass("valid").removeClass("invalid");
            }else{
                $("#user_pwd_msg").text(result.msg);
                $("#user_pwd").closest(".input-box").addClass("invalid").removeClass("valid");
            }

            if($("#user_pwd").val() != $("#user_pwd_re").val()){
                $("#user_pwd_re").closest(".input-box").addClass("invalid").removeClass("valid");
            }

        }else if (e.target === $("#user_pwd_re")[0]){
            result = await check_user_pwd_re($("#user_pwd").val(), $(e.target).val());

            if(result.status == "success"){
                $("#user_pwd_re_msg").text("");
                $("#user_pwd_re").closest(".input-box").addClass("valid").removeClass("invalid");
            }else{
                $("#user_pwd_re_msg").text(result.msg);
                $("#user_pwd_re").closest(".input-box").addClass("invalid").removeClass("valid");
            }
        }

        pwd_update_step_check();
    });
});

</script>
