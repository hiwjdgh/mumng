<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="commerce_calc_modal">
    <div id="modal__box" class="modal__box--620">
        <div id="modal__header" class="modal__header--lg">
            <h2 id="modal__header-title"><?=$title?>
                <div class="tooltip-box">
                    <span class="tooltip-box__icon icon-help icon-12"></span>
                    <div class="tooltip-box__content">
                        <p>정산신청</p>
                        <p>- 매월 1일부터 7일간 가능</p>
                        <p>- 15일 이내 등록 계좌로 입금</p>
                    </div>
                </div>
            </h2>
            <button type="button" id="modal__header-close-button"><span class="icon-x icon-20"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div class="commerce_calc__box">
                <div class="commerce_calc__hold">
                    <span class="commerce_calc__hold-text">현재보유중인 EXP</span>
                    <div class="commerce_calc__hold-box">
                        <span class="commerce_calc__hold-exp"><?=Converter::display_number($hold_exp)?></span>
                        <span class="commerce_calc__hold-text2">EXP</span>
                    </div>
                </div>
                <form action="<?=get_url(PAVE_COMMERCE_URL, "calc/create")?>" class="commerce_calc__form" onsubmit="return commerce_calc_form_check(this);" enctype="multipart/form-data" method="POST" novalidate autocomplete="off">
                    <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">
                    <input type="hidden" name="calc_hold_exp" id="calc_hold_exp" value="<?=$hold_exp?>">
                    <?php if($latest_calc["calc_id"]){ ?>
                    <input type="hidden" name="calc_latest" id="calc_latest" value="<?=htmlspecialchars(json_encode($latest_calc, JSON_UNESCAPED_UNICODE))?>">
                    <?php }?>

                    <div class="commerce_calc__withdraw">
                        <div class="commerce_calc__withdraw-box">
                            <h3 class="commerce_calc__withdraw-label">출금 EXP</h3>
                            <button type="button" class="commerce_calc__withdraw-all-button button-t2 button-s4" >보유 EXP모두</button>
                        </div>
                        <div id="commerce__calc-withdrawal-exp" class="input-box input-box-t5">
                            <input type="number" name="calc_exp" id="calc_exp" class="input-box-t5__input" value="" title="출금할 EXP" placeholder="출금할 EXP(숫자만 입력)" min="10000" step="1000" required>
                        </div>
                    </div>

                    <div class="bdb-5-solid-g3 mgb-16"></div>

                    <div class="commerce_calc__deposit">
                        <h3 class="commerce_calc__deposit-label">정산계좌</h3>

                        <div class="commerce_calc__deposit-bank select-box">
                            <label for="calc_bank" class="select-box__label">은행</label>
                            <select name="calc_bank" id="calc_bank" class="select-box__select" title="은행" required>
                                <option value="" disabled selected>선택안함</option>
                                <?php foreach ($user_cf["user_bank_list"] as $key => $bank) { ?>
                                <option value="<?=$key?>" <?=get_selected($key, $pave_user["user_bank"])?>><?=$bank?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="commerce_calc__deposit-account-number input-box-t2">
                            <label for="calc_bank_number" class="input-box-t2__label">계좌번호</label>
                            <input type="text" name="calc_bank_number" id="calc_bank_number" class="input-box-t2__input" value="<?=$pave_user["user_bank_number"]?>" title="계좌번호" placeholder="계좌번호(숫자만 입력)" required>
                        </div>

                        <div class="commerce_calc__deposit-owner input-box-t2">
                            <label for="calc_bank_owner" class="input-box-t2__label">예금주</label>
                            <input type="text" name="calc_bank_owner" id="calc_bank_owner" class="input-box-t2__input" value="<?=$pave_user["user_bank_owner"]?>" title="예금주" placeholder="예금주" required>
                        </div>
                    </div>

                    <div class="bdb-5-solid-g3 mgb-16"></div>


                    <div class="commerce_calc__bsns">
                        <div class="commerce_calc__bsns-box">
                            <h3 class="commerce_calc__bsns-label">사업자</h3>

                            <div class="commerce_calc__bsns-check">
                                <label for="calc_bsns_y" class="radio-box">
                                    <input type="radio" name="calc_bsns" id="calc_bsns_y" class="radio-box__radio" value="1" <?=get_checked(1, $pave_user["user_bsns_state"])?>>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">선택</span>
                                </label>
                                <label for="calc_bsns_n" class="radio-box">
                                    <input type="radio" name="calc_bsns" id="calc_bsns_n" class="radio-box__radio" value="0" <?=get_checked(0, $pave_user["user_bsns_state"])?>>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">미선택</span>
                                </label>
                            </div>
                        </div>

                        <div class="commerce_calc__bsns-owner input-box-t2" style="display:<?=$pave_user["user_bsns_state"] ? "" : "none" ?>;">
                            <label for="calc_bsns_owner" class="input-box-t2__label">대표자명</label>
                            <input type="text" name="calc_bsns_owner" id="calc_bsns_owner" class="input-box-t2__input" value="<?=$pave_user["user_bsns_owner"]?>" title="대표자명" placeholder="대표자명">
                        </div>

                        <div class="commerce_calc__bsns-name input-box-t2" style="display:<?=$pave_user["user_bsns_state"] ? "" : "none" ?>;">
                            <label for="calc_bsns_name" class="input-box-t2__label">상호명</label>
                            <input type="text" name="calc_bsns_name" id="calc_bsns_name" class="input-box-t2__input" value="<?=$pave_user["user_bsns_name"]?>" title="상호명" placeholder="상호명">
                        </div>
                        <div class="commerce_calc__bsns-number input-box-t2" style="display:<?=$pave_user["user_bsns_state"] ? "" : "none" ?>;">
                            <label for="calc_bsns_number" class="input-box-t2__label">사업자등록번호</label>
                            <input type="text" name="calc_bsns_number" id="calc_bsns_number" class="input-box-t2__input" value="<?=$pave_user["user_bsns_number"]?>" title="사업자등록번호" placeholder="사업자등록번호(숫자만 입력)">
                        </div>
                    </div>

                    <div class="bdb-5-solid-g3 mgb-16"></div>

                    <div class="commerce_calc__agree">
                        <label for="calc_agree" class="check-box">
                            <input type="checkbox" name="calc_agree" id="calc_agree" class="check-box__check" value="1" title="커머스 이용약관 동의" required>
                            <span class="check-box__span"></span>
                            <span class="check-box__label">커머스 이용약관 동의(필수)</span>
                            <a href="<?=get_url(PAVE_LEGAL_URL, "commerce")?>" target="_blank" class="check-box__more"><span class="skip">더보기</span><span class="icon-right icon-20"></span></a>
                        </label>
                    </div>
                    <div class="commerce_calc__submit">
                        <button type="submit" class="button-t1 button-s1">정산신청</button>
                    </div>

                </form>
            </div>
        </div>
        <div id="modal__footer"></div>
    </div>
<script>
function commerce_calc_form_check(f){
    if(f.calc_exp.value == ""){
        alert("출금 EXP를 입력해주세요.");
        $("#calc_exp").focus();
        return false;
    }

    if(f.calc_bank.value == ""){
        alert("은행을 선택해주세요.");
        $("#calc_bank").focus();
        return false;
    }

    if(f.calc_bank_number.value == ""){
        alert("계좌번호를 입력해주세요.");
        $("#calc_bank_number").focus();
        return false;
    }

    if(f.calc_bank_owner.value == ""){
        alert("예금주를 입력해주세요.");
        $("#calc_bank_owner").focus();
        return false;
    }

    if($("input[name='calc_bsns']:checked").length == 0){
        alert("사업자 여부를 선택해주세요.");
        return false;
    } 


    if(f.calc_bsns.value == "1"){
        if(f.calc_bsns_owner.value == ""){
            alert("대표자명을 입력해주세요.");
            $("#calc_bsns_owner").focus();
            return false;
        }

        if(f.calc_bsns_name.value == ""){
            alert("상호명을 입력해주세요.");
            $("#calc_bsns_name").focus();
            return false;
        }

        if(f.calc_bsns_number.value == ""){
            alert("사업자등록번호를 입력해주세요.");
            $("#calc_bsns_number").focus();
            return false;
        }
    }

    if(!$("#calc_agree").is(":checked")){
        alert("커머스 이용약관에 동의해주세요.");
        return false;
    }

    if(!confirm("정보를 다시 확인해주세요.\n정산상태가 \"신청완료\"일 경우 취소가 불가 합니다.\n진행하시겠습니까?")){
        return false;
    }

    return true;
}
$(document).ready(function(){
    $(document).off("click", ".commerce_calc__withdraw-all-button");
    $(document).off("change", "input[name='calc_bsns']");

    $(document).on("click", ".commerce_calc__withdraw-all-button", function(){
        $("#calc_exp").val($("#calc_hold_exp").val()).trigger("focus");
    });
 
    $(document).on("change", "input[name='calc_bsns']", function(){
        if($(this).val() == "1"){
            $(".commerce_calc__bsns-owner").show();
            $(".commerce_calc__bsns-name").show();
            $(".commerce_calc__bsns-number").show();

        }else{
            $(".commerce_calc__bsns-owner").hide();
            $(".commerce_calc__bsns-name").hide();
            $(".commerce_calc__bsns-number").hide();
        }
    });

});
</script>
</div>