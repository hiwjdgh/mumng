<?php
if (!defined('_PAVE_')) exit;
?>
<section id="reg">
    <div id="reg__step-box">
        <h2 id="reg__step-title">계정가입</h2>
        <div id="reg__step-line" class="step1">
            <div id="reg__step-line-slider"></div>
        </div>
        <div id="reg__step-msg-box" class="step1">
            <span id="reg__step1-msg" class="reg__step-msg">이미 계정이 있으신가요?</span>
            <a href="<?=get_url(PAVE_ACCOUNT_URL, "login")?>" id="reg__step1-link" class="reg__step-link">로그인</a>
            <span id="reg__step2-msg" class="reg__step-msg">본인확인을 위해 휴대폰 인증을 해주세요</span>
            <span id="reg__step3-msg" class="reg__step-msg">만 14세 미만은 보호자(법정대리인)의 동의가 필요합니다.</span>
            <span id="reg__step4-msg" class="reg__step-msg">입력된 정보를 확인 및 동의 후 가입을 진행해주세요.</span>
        </div>
    </div>
    <form id="reg__form" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">

        <fieldset id="reg_step1" class="reg_step flex flex-column mxw-316">
            <legend class="skip">회원가입 사이트정보</legend>

            <div class="form-group mgb-10">
                <div class="form-group__box">
                    <div class="input-box input-box-t2">
                        <label for="user_id" class="input-box-t2__label">아이디</label>
                        <input type="text" name="user_id" id="user_id" class="input-box-t2__input form_real_time" value="" title="아이디" minlength="<?=$user_cf["user_id_min_len"]?>" maxlength="<?=$user_cf["user_id_max_len"]?>" required spellcheck="false">
                        <p id="user_id_msg" class="input-box-t2__msg"></p>
                    </div>
                </div>
            </div>
            
            <div class="form-group mgb-10">
                <div class="form-group__box">
                    <div class="input-box input-box-t2" style="display: none;">
                        <label for="user_pwd" class="input-box-t2__label">비밀번호</label>
                        <input type="password" name="user_pwd" id="user_pwd" class="input-box-t2__input" value="" title="비밀번호" minlength="<?=$user_cf["user_pwd_min_len"]?>" autocomplete="new-password" required>
                        <p id="user_pwd_msg" class="input-box-t2__msg"></p>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-36">
                <div class="form-group__box">
                    <div class="input-box input-box-t2" style="display: none;">
                        <label for="user_pwd_re" class="input-box-t2__label">비밀번호 재입력</label>
                        <input type="password" name="user_pwd_re" id="user_pwd_re" class="input-box-t2__input" value="" title="비밀번호 재입력" minlength="<?=$user_cf["user_pwd_min_len"]?>" autocomplete="new-password" required>
                        <p id="user_pwd_re_msg" class="input-box-t2__msg"></p>
                    </div>
                </div>
            </div>
            
            <button type="button" id="reg_step1_button" class="reg_step_button disabled" disabled style="display: none;">다음</button>
        </fieldset>


        <fieldset id="reg_step2" class="reg_step flex flex-column mxw-316" style="display: none;">
            <legend class="skip">회원가입 개인정보</legend>   
            <input type="hidden" name="user_cp_cert_state" id="user_cp_cert_state" value="">
            <input type="hidden" name="user_kid_cert_state" id="user_kid_cert_state" value="">

            <div class="form-group mgb-36">
                <div class="form-group__box">
                    <div class="input-box input-box-t2">
                        <label for="user_cp" class="input-box-t2__label">휴대폰번호</label>
                        <input type="tel" name="user_cp" id="user_cp" class="input-box-t2__input" value="" title="휴대폰번호" maxlength="<?=$user_cf["user_cp_max_len"]?>" required>
                        <button type="button" id="user_cp_cert_button" class="cert-button input-box-t2__action" disabled data-cert="reg_user">인증하기</button>
                        <p id="user_cp_msg" class="input-box-t2__msg"></p>
                    </div>
                </div>
            </div>

            <button type="button" id="reg_step2_button" class="reg_step_button disabled" disabled style="display: none;">다음</button>
        </fieldset>


        <fieldset id="reg_step3" class="reg_step flex flex-column mxw-316" style="display: none;">
            <input type="hidden" name="user_rel_cp_cert_state" id="user_rel_cp_cert_state" value="">
            <legend class="skip">회원가입 법정대리인 정보</legend>   

            <div class="form-group mgb-36">
                <div class="form-group__box">
                    <div class="input-box input-box-t2">
                        <label for="user_rel_cp" class="input-box-t2__label">보호자 휴대폰번호</label>
                        <input type="tel" name="user_rel_cp" id="user_rel_cp" class="input-box-t2__input" value="" title="보호자 휴대폰번호" maxlength="<?=$user_cf["user_cp_max_len"]?>">
                        <button type="button" id="user_rel_cp_cert_button" class="cert-button input-box-t2__action" disabled data-cert="reg_user_rel">인증하기</button>
                        <p id="user_rel_cp_msg" class="input-box-t2__msg"></p>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-36">
                <div class="form-group__box">
                    <div id="reg__sex" class="select-box" style="display: none;">
                        <label for="user_rel" class="select-box__label">보호자 관계</label>
                        <select name="user_rel" id="user_rel" class="select-box__select" title="보호자 관계">
                            <option value="" disabled selected>선택해주세요.</option>
                            <?php foreach ($user_config["user_rel_list"] as $i => $user_rel) { ?>
                            <option value="<?=$user_rel?>"><?=$user_rel?></option>
                            <?php } ?>
                        </select>
                        <p id="user_rel_msg" class="select-box__msg"></p>
                    </div>
                </div>
            </div>

            <button type="button" id="reg_step3_button" class="button-s1 button-t2 disabled" disabled style="display: none;">동의 후 진행하기</button>
        </fieldset>

        <fieldset id="reg_step4" class="reg_step flex flex-column mxw-316" style="display: none;">
            <legend class="skip">회원가입 기타정보</legend>
            
            <div class="form-group mgb-36">
                <div class="form-group__box">
                    <div class="input-box input-box-t2 readonly focus">
                        <label for="user_name" class="input-box-t2__label">이름</label>
                        <span id="user_name_text" class="input-box-t2__input"></span>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-36">
                <div class="form-group__box">
                    <div id="reg__birth" class="input-box input-box-t3 readonly focus">
                        <label for="user_birth_year" class="input-box-t3__label">생년월일</label>
                        <span id="user_birth_year_text" class="input-box-t3__input"></span>
                        <span id="user_birth_month_text" class="input-box-t3__input"></span>
                        <span id="user_birth_day_text" class="input-box-t3__input"></span>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-36">
                <div class="form-group__box">
                    <div id="reg__sex" class="select-box focus">
                        <label for="user_sex" class="select-box__label">성별</label>
                        <select name="user_sex" id="user_sex" class="select-box__select" title="성별" required>
                            <option value="" disabled selected>선택해주세요.</option>
                            <option value="m" <?=get_selected("m", $reg_user_sex)?>>남</option>
                            <option value="f" <?=get_selected("f", $reg_user_sex)?>>여</option>
                            <option value="n" <?=get_selected("n", $reg_user_sex)?>>선택안함</option>
                            <option value="a" <?=get_selected("a", $reg_user_sex)?>>해당없음</option>
                        </select>
                        <p id="user_sex_msg" class="select-box__msg"></p>
                    </div>
                </div>
            </div>
            
            <div class="form-group mgb-16">
                <div class="form-group__box">
                    <div class="check-group">
                        <h3 class="check-group__label">전체동의</h3>
                        <div class="check-group__box">
                            <label for="user_all_agree" class="check-box">
                                <input type="checkbox" name="user_all_agree" id="user_all_agree" class="check-box__check" value="1" title="전체동의">
                                <span class="check-box__span"></span>
                                <span class="check-box__label">무명 전체 동의</span>
                            </label>
                        </div>
                        <p class="check-group__description">무명 이용약관, 개인정보 수집 및 이용, 이벤트 마케팅 정보 수신(선택)에 모두 동의합니다.</p>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-4">
                <div class="form-group__box">
                    <label id="reg_agree-term" for="user_term_agree" class="check-box">
                        <input type="checkbox" name="user_term_agree" id="user_term_agree" class="check-box__check" value="1" title="무명 이용약관 동의" required>
                        <span class="check-box__span"></span>
                        <span class="check-box__label">무명 이용약관 동의(필수)</span>
                        <a href="<?=get_url(PAVE_LEGAL_URL, "service")?>" target="_blank" class="check-box__more"><span class="skip">더보기</span><span class="icon-right icon-20"></span></a>
                    </label>
                </div>
            </div>

            <div class="form-group mgb-4">
                <div class="form-group__box">
                    <label id="reg_agree-info" for="user_info_agree" class="check-box">
                        <input type="checkbox" name="user_info_agree" id="user_info_agree" class="check-box__check" value="1" title="개인정보 수집 및 이용 동의" required>
                        <span class="check-box__span"></span>
                        <span class="check-box__label">개인정보 수집 및 이용 동의(필수)</span>
                        <a href="<?=get_url(PAVE_LEGAL_URL, "privacy")?>" target="_blank" class="check-box__more"><span class="skip">더보기</span><span class="icon-right icon-20"></span></a>
                    </label>
                </div>
            </div>

            <div class="form-group mgb-36">
                <div class="form-group__box">
                    <label id="reg_agree-event" for="user_event_agree" class="check-box">
                        <input type="checkbox" name="user_event_agree" id="user_event_agree" class="check-box__check" value="1" title="이벤트 마케팅 정보 수신 동의">
                        <span class="check-box__span"></span>
                        <span class="check-box__label">이벤트 마케팅 정보 수신 동의(선택)</span>
                        <a href="<?=get_url(PAVE_LEGAL_URL, "service")?>" target="_blank" class="check-box__more"><span class="skip">더보기</span><span class="icon-right icon-20"></span></a>
                    </label>
                </div>
            </div>

            <button type="submit" id="reg_step4_button" class="button-t1 button-s1 disabled" disabled>가입완료</button>
        </fieldset>
    </form>
</section>
<script>
function change_tab(){
    let hash = location.hash;

    let type = hash.substring(1);
    if(type == ""){
        show_first_step();
    }else if(type == "step2"){
        show_second_step();
    }else if(type == "step3"){
        show_third_step();
    }else if(type == "step4"){
        show_fourth_step();
    }
}

function show_first_step(){
    $("#reg__step-title").text("계정가입");
    $("#reg_step1").show();
    $("#reg_step2").hide();
    $("#reg_step3").hide();
    $("#reg_step4").hide();

    $("#reg__step-line").removeClass("step2 step3 step4");
    $("#reg__step-msg-box").removeClass("step2 step3 step4");
    $("#reg__step-line").addClass("step1");
    $("#reg__step-msg-box").addClass("step1");
    $("#user_id").focus();
}

function show_second_step(){
    if(reg_first_step_check()){
        $("#reg__step-title").text("계정가입");
        $("#reg_step1").hide();
        $("#reg_step2").show();
        $("#reg_step3").hide();
        $("#reg_step4").hide();

        $("#reg__step-line").removeClass("step1 step3 step4");
        $("#reg__step-msg-box").removeClass("step1 step3 step4");
        $("#reg__step-line").addClass("step2");
        $("#reg__step-msg-box").addClass("step2");
        $("#user_cp").focus();
    }else{
        window.location.hash = "";
    }
}

function show_third_step(){
    if(reg_second_step_check()){
        $("#reg__step-title").text("보호자(법정대리인) 동의");
        $("#reg_step1").hide();
        $("#reg_step2").hide();
        $("#reg_step3").show();
        $("#reg_step4").hide();

        $("#reg__step-line").removeClass("step1 step2 step4");
        $("#reg__step-msg-box").removeClass("step1 step2 step4");
        $("#reg__step-line").addClass("step3");
        $("#reg__step-msg-box").addClass("step3");
        $("#user_rel_cp").focus();
    }else{
        window.location.hash = "";
    }
}


function show_fourth_step(){
    if($("#user_kid_cert_state").val() === "0"){
        if(reg_second_step_check()){
            $("#reg__step-title").text("계정가입");
            $("#reg_step1").hide();
            $("#reg_step2").hide();
            $("#reg_step3").hide();
            $("#reg_step4").show();


            $("#reg__step-line").removeClass("step1 step2 step3");
            $("#reg__step-msg-box").removeClass("step1 step2 step3");
            $("#reg__step-line").addClass("step4");
            $("#reg__step-msg-box").addClass("step4");
        }else{
            window.location.hash = "";
        }
    }else{
        if(reg_third_step_check()){
            $("#reg__step-title").text("계정가입");
            $("#reg_step1").hide();
            $("#reg_step2").hide();
            $("#reg_step3").hide();
            $("#reg_step4").show();


            $("#reg__step-line").removeClass("step1 step2 step3");
            $("#reg__step-msg-box").removeClass("step1 step2 step3");
            $("#reg__step-line").addClass("step4");
            $("#reg__step-msg-box").addClass("step4");
        }else{
            window.location.hash = "";
        }
    }

    
}

/* 사이트정보 검사 */
function reg_first_step_check(){
    if($("#user_id").closest(".input-box").hasClass("valid")){
        $("#user_pwd").closest(".input-box").show();
        $("#user_pwd_re").closest(".input-box").hide();

        if($("#user_pwd").closest(".input-box").hasClass("valid")){
            $("#user_pwd_re").closest(".input-box").show();

            if($("#user_pwd_re").closest(".input-box").hasClass("valid")){
                $("#reg_step1_button").show();
            }else{
                $("#reg_step1_button").hide();
            }
        }else{
            $("#user_pwd_re").closest(".input-box").hide();
            $("#reg_step1_button").hide();
        }

    }else{
        $("#user_pwd").closest(".input-box").hide();
        $("#user_pwd_re").closest(".input-box").hide();
        $("#reg_step1_button").hide();
    }

    

    if($("#user_id").closest(".input-box").hasClass("valid")
    && $("#user_pwd").closest(".input-box").hasClass("valid")
    && $("#user_pwd_re").closest(".input-box").hasClass("valid")){
        $("#reg_step1_button").removeClass("disabled");
        $("#reg_step1_button").prop("disabled",false);
        return true;
    }else{
        $("#reg_step1_button").addClass("disabled");
        $("#reg_step1_button").prop("disabled",true);
        return false;
    }
}


/* 개인정보 검사 */
function reg_second_step_check(){
    if($("#user_cp").closest(".input-box").hasClass("complete")){
        $("#reg_step2_button").show();
    }else{
        $("#reg_step2_button").hide();
    }


    if($("#user_cp").closest(".input-box").hasClass("complete")
    && $("#user_cp_cert_state").val() == "1"){
        $("#reg_step2_button").removeClass("disabled");
        $("#reg_step2_button").prop("disabled",false);
        return true;
    }else{
        $("#reg_step2_button").addClass("disabled");
        $("#reg_step2_button").prop("disabled",true);
        return false;
    }
}

/* 법적대리인정보 검사 */
function reg_third_step_check(){
    if($("#user_kid_cert_state").val() == "0"){
        return true;
    }

    if($("#user_rel_cp").closest(".input-box").hasClass("complete")){
        $("#user_rel").closest(".select-box").show();
        if($("#user_rel").closest(".select-box").hasClass("valid")){
            $("#reg_step3_button").show();
        }else{
            $("#reg_step3_button").hide();
        }
    
    }else{
        $("#user_rel").closest(".select-box").hide();
        $("#reg_step3_button").hide();
    }

    
    if($("#user_rel_cp").closest(".input-box").hasClass("complete")
    && $("#user_rel_cp_cert_state").val() == "1"
    && $("#user_rel").closest(".select-box").hasClass("valid")){
        $("#reg_step3_button").removeClass("disabled");
        $("#reg_step3_button").prop("disabled",false);
        return true;
    }else{
        $("#reg_step3_button").addClass("disabled");
        $("#reg_step3_button").prop("disabled",true);
        return false;
    }
}

/* 기타정보 검사 */
function reg_fourth_step_check(){
    if($("#user_sex").closest(".select-box").hasClass("valid")
    && $("#user_term_agree").prop("checked")
    && $("#user_info_agree").prop("checked")){
        $("#reg_step4_button").removeClass("disabled");
        $("#reg_step4_button").prop("disabled",false);
        return true;
    }else{
        $("#reg_step4_button").addClass("disabled");
        $("#reg_step4_button").prop("disabled",true);
        return false;
    }
}
$(document).ready(function(){
    change_tab();
    $(window).on('hashchange', function() {
        change_tab();
    });


    $("#reg__form").on("submit", async function(e){
        e.preventDefault();

        if(!reg_first_step_check()){
            return false;
        }

        if(!reg_second_step_check()){
            return false;
        }
            
        if(!reg_third_step_check()){
            return false;
        }

        if(!reg_fourth_step_check()){
            return false;
        }
        
        await check_reg_form($(this));

        return false;
    });

    $("#reg_step1_button").on("click", function(){
        if(reg_first_step_check()){
            window.location.hash = "#step2";
        }
    });

    
    $("#reg_step1").on("keyup", async function(e){
        e.preventDefault();
        let result;

        if (e.target === $("#user_id")[0]){
            result = await check_user_id($(e.target).val(), true);
            if(result.status == "success"){
                $("#user_id").closest(".input-box").addClass("valid").removeClass("invalid");
                $("#user_id_msg").text("");
            }else{
                $("#user_id_msg").text(result.msg);
                $("#user_id").closest(".input-box").addClass("invalid").removeClass("valid");
            }
        }else if (e.target === $("#user_pwd")[0]){
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

        if (e.keyCode == 13){
            $("#reg_step1_button").trigger("click");
        }else{
            reg_first_step_check();
        }
    });

    $("#reg_step2_button").on("click", function(){
        if(reg_second_step_check()){
            if($("#user_kid_cert_state").val() === "0"){
                window.location.hash = "step4";
            }else{
                window.location.hash = "#step3";
            }
        }
    });

    $("#reg_step2").on("keyup", async function(e){
        e.preventDefault();
        if (e.target === $("#user_cp")[0]){
            result = await check_user_cp($(e.target).val(), true, "", true);
            if(result.status == "success"){
                $("#user_cp").closest(".input-box").addClass("valid").removeClass("invalid");
                $("#user_cp_msg").text("");
                $("#user_cp_cert_button").prop("disabled", false);
            }else{
                $("#user_cp_msg").text(result.msg);
                $("#user_cp").closest(".input-box").addClass("invalid").removeClass("valid");
                $("#user_cp_cert_button").prop("disabled", true);
            }
        }

        if (e.keyCode == 13){
            $("#reg_step2_button").trigger("click");
        }else{
            reg_second_step_check();
        }
    });

    $("#reg_step3_button").on("click", function(){
        if(reg_third_step_check()){
            window.location.hash = "#step4";
        }
    });

    $("#reg_step3").on("keyup change", async function(e){
        e.preventDefault();

        if (e.target === $("#user_rel_cp")[0]){
            result = await check_user_cp($(e.target).val(), true, "", true);
            if(result.status == "success"){
                $("#user_rel_cp").closest(".input-box").addClass("valid").removeClass("invalid");
                $("#user_rel_cp_msg").text("");
                $("#user_rel_cp_cert_button").prop("disabled", false);
            }else{
                $("#user_rel_cp_msg").text(result.msg);
                $("#user_rel_cp").closest(".input-box").addClass("invalid").removeClass("valid");
                $("#user_rel_cp_cert_button").prop("disabled", true);
            }
        }else if (e.target === $("#user_rel")[0]){
            result = await check_user_rel($(e.target).val(), true);
            if(result.status == "success"){
                $("#user_rel").closest(".select-box").addClass("valid").removeClass("invalid");
                $("#user_rel_msg").text("");
            }else{
                $("#user_rel_msg").text(result.msg);
                $("#user_rel").closest(".select-box").addClass("invalid").removeClass("valid");
            }
        }

        if (e.keyCode == 13){
            $("#reg_step3_button").trigger("click");
        }else{
            reg_third_step_check();
        }
    });

    //step4
    $("#user_term_agree, #user_info_agree, #user_event_agree").on("change", function(){
        if(!$("#user_term_agree").prop("checked") || !$("#user_info_agree").prop("checked") || !$("#user_event_agree").prop("checked")){
            $("#user_all_agree").prop("checked", false);
        }
    
        if($("#user_term_agree").prop("checked") && $("#user_info_agree").prop("checked") && $("#user_event_agree").prop("checked")){
            $("#user_all_agree").prop("checked", true);
        }
    })

    $("#reg_step4").on("keyup change", async function(e){
        if (e.target === $("#user_sex")[0]){
            result = await check_user_sex($(e.target).val(), true);
            if(result.status == "success"){
                $("#user_sex").closest(".select-box").addClass("valid").removeClass("invalid");
                $("#user_sex_msg").text("");
            }else{
                $("#user_sex_msg").text(result.msg);
                $("#user_sex").closest(".select-box").addClass("invalid").removeClass("valid");
            }
        }else if(e.target === $("#user_all_agree")[0]){
            if($("#user_all_agree").prop("checked")){
                $("#user_term_agree, #user_info_agree, #user_event_agree").prop("checked", true);
            }else{
                $("#user_term_agree, #user_info_agree, #user_event_agree").prop("checked", false);
            }
        }else if(e.target === $("#user_term_agree")[0] || e.target === $("#user_info_agree")[0] || e.target === $("#user_event_agree")[0]){
            if(!$("#user_term_agree").prop("checked") || !$("#user_info_agree").prop("checked") || !$("#user_event_agree").prop("checked")){
                $("#user_all_agree").prop("checked", false);
            }
        
            if($("#user_term_agree").prop("checked") && $("#user_info_agree").prop("checked") && $("#user_event_agree").prop("checked")){
                $("#user_all_agree").prop("checked", true);
            }
        }

        if (e.keyCode == 13){
            $("#reg_step4_button").trigger("click");
        }else{
            reg_fourth_step_check();
        }
    });


});
</script>