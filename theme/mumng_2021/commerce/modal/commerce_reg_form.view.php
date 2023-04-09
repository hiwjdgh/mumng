<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals commerce_reg_modal" data-target="commerce_reg_modal">
    <div id="modal__box" class="modal__box--sm">
        <div id="modal__header" class="modal__header--lg">
            <h2 id="modal__header-title"><?=$title?>
            </h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="commerce_reg_modal"><span class="icon-x icon-20"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div class="commerce_reg__box">
                <form id="commerce_reg__form" class="commerce_reg__form" enctype="multipart/form-data" novalidate autocomplete="off">
                    <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">

                    <div class="commerce_reg__user">
                        <h3 class="commerce_reg__user-label">작가정보</h3>
                        
                        <div class="commerce_reg__user-email input-box input-box-t2">
                            <label for="user_email" class="input-box-t2__label">이메일</label>
                            <input type="email" name="user_email" class="input-box-t2__input" id="user_email" value="" title="이메일" placeholder="이메일" spellcheck="false">
                        </div>
                    </div>

                    <div class="bdb-5-solid-g3 mgb-16"></div>

                    <div class="commerce_reg__deposit">
                        <h3 class="commerce_reg__deposit-label">정산계좌</h3>

                        <div class="commerce_reg__deposit-bank select-box">
                            <label for="user_bank_name" class="select-box__label">은행</label>
                            <select name="user_bank_name" id="user_bank_name" class="select-box__select" title="은행" required>
                                <option value="" disabled selected>선택안함</option>
                                <?php foreach ($user_config["user_bank_list"] as $key => $bank) { ?>
                                <option value="<?=$key?>"><?=$bank?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="commerce_reg__deposit-account-number input-box-t2">
                            <label for="user_bank_number" class="input-box-t2__label">계좌번호</label>
                            <input type="text" name="user_bank_number" id="user_bank_number" class="input-box-t2__input" value="" title="계좌번호" placeholder="계좌번호(숫자만 입력)" required>
                        </div>

                        <div class="commerce_reg__deposit-owner input-box-t2">
                            <label for="user_bank_owner" class="input-box-t2__label">예금주</label>
                            <input type="text" name="user_bank_owner" id="user_bank_owner" class="input-box-t2__input" value="" title="예금주" placeholder="예금주" required>
                        </div>
                    </div>

                    <div class="bdb-5-solid-g3 mgb-16"></div>


                    <div class="commerce_reg__bsns">
                        <div class="commerce_reg__bsns-box">
                            <h3 class="commerce_reg__bsns-label">사업자</h3>

                            <div class="commerce_reg__bsns-check">
                                <label for="user_bsns_state_y" class="radio-box">
                                    <input type="radio" name="user_bsns_state" id="user_bsns_state_y" class="radio-box__radio" value="1">
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">선택</span>
                                </label>
                                <label for="user_bsns_state_n" class="radio-box">
                                    <input type="radio" name="user_bsns_state" id="user_bsns_state_n" class="radio-box__radio" value="0" checked>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">미선택</span>
                                </label>
                            </div>
                        </div>

                        <div class="commerce_reg__bsns-owner input-box-t2" style="display: none;">
                            <label for="user_bsns_owner" class="input-box-t2__label">대표자명</label>
                            <input type="text" name="user_bsns_owner" id="user_bsns_owner" class="input-box-t2__input" value="" title="대표자명" placeholder="대표자명">
                        </div>

                        <div class="commerce_reg__bsns-name input-box-t2" style="display: none;">
                            <label for="user_bsns_name" class="input-box-t2__label">상호명</label>
                            <input type="text" name="user_bsns_name" id="user_bsns_name" class="input-box-t2__input" value="" title="상호명" placeholder="상호명">
                        </div>
                        <div class="commerce_reg__bsns-number input-box-t2" style="display: none;">
                            <label for="user_bsns_number" class="input-box-t2__label">사업자등록번호</label>
                            <input type="text" name="user_bsns_number" id="user_bsns_number" class="input-box-t2__input" value="" title="사업자등록번호" placeholder="사업자등록번호(숫자만 입력)">
                        </div>
                    </div>

                    <div class="bdb-5-solid-g3 mgb-16"></div>

                    <div class="commerce_reg__agree">
                        <label for="commerce_agree" class="check-box">
                            <input type="checkbox" name="commerce_agree" id="commerce_agree" class="check-box__check" value="1" title="커머스 이용약관 동의" required>
                            <span class="check-box__span"></span>
                            <span class="check-box__label">커머스 이용약관 동의(필수)</span>
                            <a href="<?=get_url(PAVE_LEGAL_URL, "commerce")?>" target="_blank" class="check-box__more"><span class="skip">더보기</span><span class="icon-right icon-20"></span></a>
                        </label>
                    </div>
                    <div class="commerce_reg__submit">
                        <button type="submit" class="button-t1 button-s1">커머스 작가등록</button>
                    </div>

                </form>
            </div>
        </div>
        <div id="modal__footer"></div>
    </div>
<script>
$(function(){
    $(document).off("change", "input[name='user_bsns_state']");
    $(document).off("submit", "#commerce_reg__form");

    $(document).on("submit", "#commerce_reg__form", function(){
        let f = this;
        if(f.user_email.value == ""){
            alert("이메일을 입력해주세요.");
            return false;
        }

        if(f.user_bank.value == ""){
            alert("은행을 선택해주세요.");
            return false;
        }

        if(f.user_bank_number.value == ""){
            alert("계좌번호를 입력해주세요.");
            return false;
        }

        if(f.user_bank_owner.value == ""){
            alert("예금주를 입력해주세요.");
            return false;
        }

        if($("input[name='user_bsns_state']:checked").length == 0){
            alert("사업자 여부를 선택해주세요.");
            return false;
        } 


        if(f.user_bsns_state.value == "1"){
            if(f.user_bsns_owner.value == ""){
                alert("대표자명을 입력해주세요.");
                return false;
            }

            if(f.user_bsns_name.value == ""){
                alert("상호명을 입력해주세요.");
                return false;
            }

            if(f.user_bsns_number.value == ""){
                alert("사업자등록번호를 입력해주세요.");
                return false;
            }
        }

        if(!$("#commerce_agree").is(":checked")){
            alert("커머스 이용약관에 동의해주세요.");
            return false;
        }

       pave_async_ajax("/api/commerce/reg","POST", $(f))
       .then(function(result){
            if(result.status == "success"){
                alert("커머스 등록이 완료 되었습니다!");
                location.reload();
            }else{
                if(result.msg){
                    if(result.redirect_url){
                        if(confirm(result.msg)){
                            location.href = result.redirect_url;
                        }
                    }else{
                        alert(result.msg);
                    }
                }else{
                    alert("에러가 발생하였습니다. 다시 시도해주시기 바랍니다.");
                }
            }
       });


        return false;
    })
    $(document).on("change", "input[name='user_bsns_state']", function(){
        if($(this).val() == "1"){
            $(".commerce_reg__bsns-owner").show();
            $(".commerce_reg__bsns-name").show();
            $(".commerce_reg__bsns-number").show();

        }else{
            $(".commerce_reg__bsns-owner").hide();
            $(".commerce_reg__bsns-name").hide();
            $(".commerce_reg__bsns-number").hide();
        }

        $("#user_bsns_owner").val("");
        $("#user_bsns_name").val("");
        $("#user_bsns_owner").val("");
    });
});
</script>
</div>