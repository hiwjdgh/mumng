<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column gap-row-24">
    <form class="adm-list__form" action="<?=$action_url?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
        <input type="hidden" name="calc_id" id="calc_id" value="<?=$calc["calc_id"]?>">

        <div class="flex flex-column mxw-5 gap-row-24">

            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">회원 ID</p>
                <div class="input-box input-box-t4">
                    <input type="text" name="user_id" id="user_id" class="input-box-t4__input" value="<?=$calc["user_id"]?>" placeholder="회원 ID">
                </div>
            </div>

            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">신청상태</p>
                <div class="select-box">
                    <select name="calc_status" id="calc_status" class="select-box__select" title="신청상태" required>
                        <option value="calc_ready" <?=get_selected("calc_ready", $calc["calc_status"])?>>신청대기</option>
                        <option value="calc_wait" <?=get_selected("calc_wait", $calc["calc_status"])?>>신청완료</option>
                        <option value="calc_complete" <?=get_selected("calc_complete", $calc["calc_status"])?>>입금완료</option>
                        <option value="calc_cancel" <?=get_selected("calc_cancel", $calc["calc_status"])?>>신청취소</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">정산 EXP</p>
                <div class="input-box input-box-t4">
                    <input type="number" name="calc_exp" id="calc_exp" class="input-box-t4__input" value="<?=$calc["calc_exp"]?>" placeholder="정산 EXP">
                </div>
            </div>

            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">정산금액</p>
                <div class="input-box input-box-t4">
                    <input type="number" name="calc_real_price" id="calc_real_price" class="input-box-t4__input" value="<?=$calc["calc_real_price"]?>" placeholder="정산금액">
                </div>
            </div>

            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">정산 수수료</p>
                <div class="input-box input-box-t4">
                    <input type="number" name="calc_fee_price" id="calc_fee_price" class="input-box-t4__input" value="<?=$calc["calc_fee_price"]?>" placeholder="정산 수수료">
                </div>
            </div>

            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">원천징수세</p>
                <div class="input-box input-box-t4">
                    <input type="number" name="calc_tax_price" id="calc_tax_price" class="input-box-t4__input" value="<?=$calc["calc_tax_price"]?>" placeholder="원천징수세">
                </div>
            </div>

            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">부가세</p>
                <div class="input-box input-box-t4">
                    <input type="number" name="calc_vat_price" id="calc_vat_price" class="input-box-t4__input" value="<?=$calc["calc_vat_price"]?>" placeholder="부가세">
                </div>
            </div>

            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">은행</p>
                <div class="select-box">
                    <select name="calc_bank" id="calc_bank" class="select-box__select" title="은행" required>
                        <option value="" disabled selected>선택안함</option>
                        <?php foreach ($user_cf["user_bank_list"] as $key => $bank) { ?>
                        <option value="<?=$key?>" <?=get_selected($key, $calc["calc_bank"])?>><?=$bank?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
           
            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">계좌번호</p>
                <div class="input-box input-box-t2">
                    <input type="number" name="calc_bank_number" id="calc_bank_number" class="input-box-t2__input" value="<?=$calc["calc_bank_number"]?>" title="계좌번호" placeholder="계좌번호(숫자만 입력)" required>
                </div>
            </div>
            
            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">예금주</p>
                <div class="input-box input-box-t2">
                    <input type="text" name="calc_bank_owner" id="calc_bank_owner" class="input-box-t2__input" value="<?=$calc["calc_bank_owner"]?>" title="예금주" placeholder="예금주" required>
                </div>
            </div>


            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">사업자여부</p>
                <div class="select-box">
                    <select name="calc_bsns" id="calc_bsns" class="select-box__select" title="사업자여부" required>
                        <option value="1" <?=get_selected("1", $calc["calc_bsns"])?>>여</option>
                        <option value="0" <?=get_selected("0", $calc["calc_bsns"])?>>부</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">대표자</p>
                <div class="input-box input-box-t2">
                    <input type="text" name="calc_bsns_owner" id="calc_bsns_owner" class="input-box-t2__input" value="<?=$calc["calc_bsns_owner"]?>" title="대표자" placeholder="대표자" required>
                </div>
            </div>
              
            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">상호명</p>
                <div class="input-box input-box-t2">
                    <input type="text" name="calc_bsns_name" id="calc_bsns_name" class="input-box-t2__input" value="<?=$calc["calc_bsns_name"]?>" title="상호명" placeholder="상호명" required>
                </div>
            </div>

            <div class="flex flex-column gap-row-12">
                <p class="text-weight-medium text-color-g10 text-size-normal">사업자번호</p>
                <div class="input-box input-box-t2">
                    <input type="text" name="calc_bsns_number" id="calc_bsns_number" class="input-box-t2__input" value="<?=$calc["calc_bsns_number"]?>" title="사업자번호" placeholder="사업자번호" required>
                </div>
            </div>

            <div class="flex gap-column-12">
                <a href="<?=get_url(PAVE_ADM_URL,"commerce/calc/list")?>" class="button-t2 button-s1">취소</a>
                <button type="submit" class="button-t1 button-s1"><?=$submit_text?></button>
            </div>
        </div>
    </form>
</div>
