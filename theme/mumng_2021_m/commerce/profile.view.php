<?php
if (!defined('_PAVE_')) exit;
?>
<div class="commerce__home">
    <h2 class="commerce__home-title"><a href="<?=get_url(PAVE_COMMERCE_URL, "profile")?>">정보</a></h2>


    <div class="commerce__row">
        <div class="commerce__col commerce__col-50">
            <div class="commerce__card">
                <div class="commerce__card-header">
                    <h3 class="commerce__card-header-title">정산은행정보</h3>
                    <div class="commerce__card-header-more">
                        <a href="<?=get_url(PAVE_GUIDE_URL)?>" target="_blank">정산가이드</a>
                    </div>
                </div>

                <div class="commerce__card-content">
                    <form id="commerce-bank__form" class="flex flex-column gap-row-24" enctype="multipart/form-data" novalidate autocomplete="off">
                        <div class="select-box">
                            <label for="user_bank_name" class="select-box__label">은행</label>
                            <select name="user_bank_name" id="user_bank_name" class="select-box__select" title="은행" required>
                                <option value="" disabled selected>선택안함</option>
                                <?php foreach ($user_config["user_bank_list"] as $key => $bank) { ?>
                                <option value="<?=$key?>" <?=get_selected($key, $pave_user["user_bank"]["user_bank_name"])?>><?=$bank?></option>
                                <?php } ?>
                            </select>
                        </div>
    
                        <div class="input-box-t2">
                            <label for="user_bank_number" class="input-box-t2__label">계좌번호</label>
                            <input type="text" name="user_bank_number" id="user_bank_number" class="input-box-t2__input" value="<?=$pave_user["user_bank"]["user_bank_number"]?>" title="계좌번호" placeholder="계좌번호(숫자만 입력)" required>
                        </div>
    
                        <div class="input-box-t2">
                            <label for="user_bank_owner" class="input-box-t2__label">예금주</label>
                            <input type="text" name="user_bank_owner" id="user_bank_owner" class="input-box-t2__input" value="<?=$pave_user["user_bank"]["user_bank_owner"]?>" title="예금주" placeholder="예금주" required>
                        </div>
    
                        <button type="submit" class="button-t1 button-s1">수정</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="commerce__row">
        <div class="commerce__col commerce__col-50">
            <div class="commerce__card">
                <div class="commerce__card-header">
                    <h3 class="commerce__card-header-title">사업자 정보</h3>
                </div>

                <div class="commerce__card-content">
                    <form id="commerce-bsns__form" class="flex flex-column gap-row-24" enctype="multipart/form-data" novalidate autocomplete="off">
                        <div class="radio-group">
                            <p class="radio-group__label">사업자 여부</p>

                            <div class="radio-group__box">
                                <label for="user_bsns_state_y" class="radio-box">
                                    <input type="radio" name="user_bsns_state" id="user_bsns_state_y" class="radio-box__radio" value="1" <?=get_checked("1", $pave_user["user_bsns_state"])?>>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">여</span>
                                </label>
                                <label for="user_bsns_state_n" class="radio-box">
                                    <input type="radio" name="user_bsns_state" id="user_bsns_state_n" class="radio-box__radio" value="0" <?=get_checked("0", $pave_user["user_bsns_state"])?>>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">부</span>
                                </label>
                            </div>
                        </div>

                        <div class="commerce_reg__bsns-owner input-box-t2">
                            <label for="user_bsns_owner" class="input-box-t2__label">대표자명</label>
                            <input type="text" name="user_bsns_owner" id="user_bsns_owner" class="input-box-t2__input" value="<?=$pave_user["user_bsns"]["user_bsns_owner"]?>" title="대표자명" placeholder="대표자명">
                        </div>

                        <div class="commerce_reg__bsns-name input-box-t2">
                            <label for="user_bsns_name" class="input-box-t2__label">상호명</label>
                            <input type="text" name="user_bsns_name" id="user_bsns_name" class="input-box-t2__input" value="<?=$pave_user["user_bsns"]["user_bsns_name"]?>" title="상호명" placeholder="상호명">
                        </div>
                        <div class="commerce_reg__bsns-number input-box-t2">
                            <label for="user_bsns_number" class="input-box-t2__label">사업자등록번호</label>
                            <input type="text" name="user_bsns_number" id="user_bsns_number" class="input-box-t2__input" value="<?=$pave_user["user_bsns"]["user_bsns_number"]?>" title="사업자등록번호" placeholder="사업자등록번호(숫자만 입력)">
                        </div>
    
                        <button type="submit" class="button-t1 button-s1">수정</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>