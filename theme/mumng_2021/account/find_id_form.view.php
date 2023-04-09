<?php
if (!defined('_PAVE_')) exit;
?>
<section id="find" class="flex flex-column mxw-360 pdhz-22">
    <ul id="find__tab" class="flex gap-column-12 flex-align-self-flex-start mgb-48">
        <li class="text-weight-bold text-color-g12 text-size-large"><a href="<?=get_url(PAVE_ACCOUNT_URL,"find/id/form")?>" title="아이디 찾기">아이디 찾기</a></li>
        <li class="text-weight-bold text-color-g5 text-size-large"><a href="<?=get_url(PAVE_ACCOUNT_URL,"find/pwd/form")?>" title="비밀번호 찾기">비밀번호 찾기</a></li>
    </ul>
    <form id="find__form" class="flex flex-column" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">
        <input type="hidden" name="user_cp_cert_state" id="user_cp_cert_state" value="">
        <fieldset class="flex flex-column mxw-316">
            <legend class="skip">아이디찾기</legend>
            
            <div class="input-box input-box-t2 mgb-60">
                <label for="user_cp" class="input-box-t2__label">휴대폰번호</label>
                <input type="tel" name="user_cp" id="user_cp" class="input-box-t2__input" required>
                <button type="button" id="user_cp_cert_button" class="cert-button input-box-t2__action" disabled data-cert="find_id">인증하기</button>
                <p id="user_cp_msg" class="input-box-t2__msg"></p>
            </div>

            <button type="submit" id="find__submit" class="button-t1 button-s1 mgb-32 disabled" style="display: none;" disabled><span class="button__text">확인</span></button>
            
            <div class="flex-align-self-center">
                <a href="<?=get_url(PAVE_HELP_URL)?>" class="text-weight-regular text-color-g12 text-size-small">도움이 필요하세요?</a>
            </div>
        </fieldset>
    </form>
</section>
<script>
function find_step_check(){
    if($("#user_cp").closest(".input-box").hasClass("complete")
    && $("#user_cp_cert_state").val() == "1"){
        $("#find__submit").removeClass("disabled");
        $("#find__submit").prop("disabled",false);
        $("#find__submit").show();
        return true;
    }else{
        $("#find__submit").addClass("disabled");
        $("#find__submit").prop("disabled",true);
        $("#find__submit").hide();
        return false;
    }
}

$(document).ready(function(){
    $("#find__form").on("submit", async function(e){
        e.preventDefault();

        if(!find_step_check()){
            return false;
        }

        await check_find_id_form($(this));

        return false;
    });

    $("#user_cp").on("keyup blur", async function(e){
        result = await check_user_cp($(e.target).val(), true, "", false);
        if(result.status == "success"){
            $("#user_cp").closest(".input-box").addClass("valid").removeClass("invalid");
            $("#user_cp_msg").text("");
            $("#user_cp_cert_button").prop("disabled", false);
        }else{
            $("#user_cp_msg").text(result.msg);
            $("#user_cp").closest(".input-box").addClass("invalid").removeClass("valid");
            $("#user_cp_cert_button").prop("disabled", true);
        }
    });

});
</script>