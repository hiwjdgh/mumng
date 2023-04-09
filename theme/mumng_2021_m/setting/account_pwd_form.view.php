<?php
if (!defined('_PAVE_')) exit;
?>
<div class="setting__account">
    <form id="pwd_change_form" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">

        <fieldset id="pwd_change_step1" class="flex flex-column">
            <div class="form-group mgb-60">
                <div class="form-group__box">
                    <div class="input-box input-box-t1">
                        <label for="old_user_pwd" class="input-box-t1__label">현재 비밀번호</label>
                        <input type="password" name="old_user_pwd" id="old_user_pwd" class="input-box-t1__input" value="" title="현재 비밀번호" minlength="<?=$user_config["user_pwd_min_len"]?>" required>
                    </div>
                </div>
            </div>

            <button type="button" id="pwd_change_step1_button" class="text-button bold large g10 flex-align-self-flex-end">다음</button>
        </fieldset>

        <fieldset id="pwd_change_step2" class="flex flex-column" style="display: none;">
            <div class="form-group mgb-10">
                <div class="form-group__box">
                    <div id="pwd_setting__pwd" class="input-box input-box-t2">
                        <label for="user_pwd" class="input-box-t2__label">새로운 비밀번호</label>
                        <input type="password" name="user_pwd" id="user_pwd" class="input-box-t2__input" required>
                        <p id="user_pwd_msg" class="input-box-t2__msg"></p>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-60">
                <div class="form-group__box">
                    <div id="pwd_setting__pwd-re" class="input-box input-box-t2">
                        <label for="user_pwd_re" class="input-box-t2__label">새로운 비밀번호 확인</label>
                        <input type="password" name="user_pwd_re" id="user_pwd_re" class="input-box-t2__input" required>
                        <p id="user_pwd_re_msg" class="input-box-t2__msg"></p>
                    </div>
                </div>
            </div>

            <button type="submit" id="pwd_change_step2_button" class="button-t1 button-s1 disabled" disabled><span class="button__text">재설정 후 로그인</span></button>
        </fieldset>
    </form>
</div>
<script>
function pwd_change_step_check(){
    if($("#user_pwd").closest(".input-box").hasClass("valid")
    && $("#user_pwd_re").closest(".input-box").hasClass("valid")){
        $("#pwd_change_step2_button").removeClass("disabled");
        $("#pwd_change_step2_button").prop("disabled",false);
        return true;
    }else{
        $("#pwd_change_step2_button").addClass("disabled");
        $("#pwd_change_step2_button").prop("disabled",true);
        return false;
    }
}
$(document).ready(function(){
    $("#pwd_change_form").on("submit", async function(e){
        e.preventDefault();

        if(!pwd_change_step_check()){
            return false;
        }

        await check_pwd_form($(this));

        return false;
    });

    $("#pwd_change_step1_button").on("click", function(){
        pave_async_ajax("/api/user/pwd_check", "POST", {user_pwd: $("#old_user_pwd").val()})
        .then(function(result){
            if(result.status == "success"){
                $("#pwd_change_step1").hide();
                $("#pwd_change_step2").show();
            }else{
                alert(result.msg);
            }
        });
    });

    $("#pwd_change_step1").on("keyup", function(e){
        e.preventDefault();
        if (e.keyCode == 13){
            $("#pwd_change_step1_button").trigger("click");
        }
    });

    $("#pwd_change_step2").on("keyup", async function(e){
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
            }else{
                $("#user_pwd").closest(".input-box").addClass("invalid").removeClass("valid");
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

        if (e.keyCode == 13){
            $("#pwd_change_step2_button").trigger("click");
        }else{
            pwd_change_step_check();
        }
    });
});
</script>