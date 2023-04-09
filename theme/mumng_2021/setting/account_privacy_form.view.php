<?php
if (!defined('_PAVE_')) exit;
?>
<div id="setting">
    <h2 id="setting__title">계정 설정</h2>
    
    <div id="setting__content" class="mxw-316">
        <div id="setting__content-header">
            <h3 id="setting__content-label">개인정보 설정</h3>
            <button type="button" id="setting_update_button" class="button-t2 button-s4">수정</button>
        </div>

        <form id="account_privacy__form" novalidate autocomplete="off">
            <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">

            <legend class="skip">개인정보 설정</legend>

            <div class="form-group mgb-34">
                <div class="form-group__box">
                    <div id="account_info__id" class="input-box-t2 readonly">
                        <label for="user_id" class="input-box-t2__label">아이디</label>
                        <span id="user_id" class="input-box-t2__input"><?=$pave_user["user_id"]?></span>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-34">
                <div class="form-group__box">
                    <div id="account_info__name" class="input-box-t2 readonly">
                        <label for="user_name" class="input-box-t2__label">이름</label>
                        <span id="user_name_text" class="input-box-t2__input"><?=$pave_user["user_name"]?></span>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-34">
                <div class="form-group__box">
                    <div id="account_info__cp" class="input-box-t2 readonly">
                        <label for="user_cp" class="input-box-t2__label">휴대폰번호</label>
                        <span class="input-box-t2__input"><?=$pave_user["user_cp"]?></span>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-34">
                <div class="form-group__box">
                    <div id="account_info__birth" class="input-box-t3 readonly">
                        <label for="user_birth_year" class="input-box-t3__label">생년월일</label>
                        <span id="user_birth_year" class="input-box-t3__input" ><?=$pave_user["user_birth_list"][0]?></span>
                        <span id="user_birth_month" class="input-box-t3__input" ><?=$pave_user["user_birth_list"][1]?></span>
                        <span id="user_birth_day" class="input-box-t3__input" ><?=$pave_user["user_birth_list"][2]?></span>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-34">
                <div class="form-group__box">
                    <div id="account_info__sex" class="select-box readonly">
                        <label for="user_sex" class="select-box__label">성별</label>
                        <select name="user_sex" id="user_sex" class="select-box__select">
                            <option value="m" <?=get_selected("m", $pave_user["user_sex"])?>>남</option>
                            <option value="f" <?=get_selected("f", $pave_user["user_sex"])?>>여</option>
                            <option value="n" <?=get_selected("n", $pave_user["user_sex"])?>>선택안함</option>
                            <option value="a" <?=get_selected("a", $pave_user["user_sex"])?>>해당없음</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group mgb-34">
                <div class="form-group__box">
                    <div class="radio-group readonly">
                        <h3 class="radio-group__label">이벤트 수신동의</h3>
                        <div class="radio-group__box">
                            <label for="user_event_agree_y" class="radio-box">
                                <input type="radio" name="user_event_agree" id="user_event_agree_y" class="radio-box__radio" value="1" <?=get_checked(1, $pave_user["user_event_agree_state"])?>>
                                <span class="radio-box__span"></span>
                                <span class="radio-box__label">동의</span>
                            </label>
                            <label for="user_event_agree_n" class="radio-box">
                                <input type="radio" name="user_event_agree" id="user_event_agree_n" class="radio-box__radio" value="0" <?=get_checked(0, $pave_user["user_event_agree_state"])?>>
                                <span class="radio-box__span"></span>
                                <span class="radio-box__label">미동의</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="account_delete_box" class="form-group2">
                <h3 class="form-group2__label">계정삭제</h3>
                <div class="form-group2__action">
                    <button type="button" id="account_delete_button" class="button-t3 button-s4"> 삭제</button>
                </div>
                <small class="form_group2__description">계정삭제 시 다시 복구할 수 없습니다.</small>
            </div>

            <button type="submit" id="account_submit_button" class="button-t1 button-s1" style="display: none;">저장</button>
        </form>
    </div>
</div>
<script>

$(document).ready(function(){
    $("#account_privacy__form").on("submit", async function(e){
        e.preventDefault();
      
        await check_privacy_form($(this));

        return false;
    });

    $("#setting_update_button").on("click", function(){
        $("#user_sex").closest(".select-box").removeClass("readonly");
        $("#user_sex").closest(".select-box").addClass("focus");
        $("input[name='user_event_agree']").closest(".radio-group").removeClass("readonly");
        $("#account_submit_button").show();
        $("#account_delete_box").hide();
        $("#setting_update_button").hide();
    });

   
    $("#account_delete_button").on("click", async function(e){
        if(confirm("정말 삭제하시겠습니까? 복구할 수 없습니다.")){
            let result = await pave_async_ajax("/api/user/delete", "POST", {});

            if(result.status == "success"){
                location.href = result.redirect_url;
            }
        }
    });

});
</script>