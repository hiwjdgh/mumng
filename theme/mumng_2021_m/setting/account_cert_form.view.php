<?php
if (!defined('_PAVE_')) exit;
?>
<div class="setting__account">
    <form id="account_cert_form" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">
        <input type="hidden" name="user_cp_cert_state" id="user_cp_cert_state" value="">

        <div class="form-group mgb-34">
            <div class="form-group__box">
                <div class="input-box input-box-t2">
                    <label for="user_cp" class="input-box-t2__label">휴대폰번호</label>
                    <input type="tel" name="user_cp" id="user_cp" class="input-box-t2__input" required>
                    <button type="button" id="user_cp_cert_button" class="cert-button input-box-t2__action" disabled data-cert="renew_user">인증하기</button>

                    <p id="user_cp_msg" class="input-box-t2__msg"></p>
                </div>
            </div>
        </div>
        <button type="submit" class="account_cert_submit button-t1 button-s1 disabled" style="display: none;" disabled>재인증</button>
    </form>
</div>
<script>
function cert_step_check(){
    if($("#user_cp").closest(".input-box").hasClass("complete")
    && $("#user_cp_cert_state").val() == "1"){
        $(".account_cert_submit").removeClass("disabled");
        $(".account_cert_submit").prop("disabled",false);
        $(".account_cert_submit").show();
        return true;
    }else{
        $(".account_cert_submit").addClass("disabled");
        $(".account_cert_submit").prop("disabled",true);
        $(".account_cert_submit").hide();
        return false;
    }

    return true;
}
$(document).ready(function(){
    $("#account_cert_form").on("submit", async function(e){
        e.preventDefault();

        if(!cert_step_check()){
            return false;
        }

        await check_cert_form($(this));

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