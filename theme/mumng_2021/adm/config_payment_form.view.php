<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-config">
    <form class="amd-config__form" action="<?=get_url(PAVE_ADM_URL,"config/payment/update")?>" method="post" onsubmit="return adm_config_cert_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
        <fieldset class="flex flex-column">
            <h2 class="text-weight-bold text-color-g12 text-size-large">결제 설정</h2>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">토스 클라이언트키</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="payment_toss_client_key" id="payment_toss_client_key" class="input-box-t4__input" value="<?=$payment_cf["payment_toss_client_key"]?>" placeholder="대여 만료기간">
                    </div>
                </div>
            </div>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">토스 시크릿키</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="payment_toss_secret_key" id="payment_toss_secret_key" class="input-box-t4__input" value="<?=$payment_cf["payment_toss_secret_key"]?>" placeholder="대여 만료기간">
                    </div>
                </div>
            </div>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">결제모듈 스크립트</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="payment_toss_module_url" id="payment_toss_module_url" class="input-box-t4__input" value="<?=$payment_cf["payment_toss_module_url"]?>" placeholder="대여 만료기간">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">결제은행</h3>
                <div class="flex flex-wrap gap-8">
                    <?php foreach ((array)$payment_cf["payment_bank_list"] as $i => $bank) { ?>
                    <label for="payment_bank_<?=$i?>" class="chip-check-box <?=get_checked($bank, $payment_cf["payment_bank_list"])?>">
                        <input type="checkbox" name="payment_bank[<?=$i?>]" id="payment_bank_<?=$i?>" class="chip-check-box__check" value="<?=$bank?>" <?=get_checked($bank, $payment_cf["payment_bank_list"])?>>
                        <span class="chip-check-box__label"><?=$bank?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">가상계좌은행</h3>
                <div class="flex flex-wrap gap-8">
                    <?php foreach ((array)$payment_cf["payment_virtual_bank_list"] as $i => $virtual) { ?>
                    <label for="payment_virtual_bank_<?=$i?>" class="chip-check-box <?=get_checked($virtual, $payment_cf["payment_virtual_bank_list"])?>">
                        <input type="checkbox" name="payment_virtual_bank[<?=$i?>]" id="payment_virtual_bank_<?=$i?>" class="chip-check-box__check" value="<?=$virtual?>" <?=get_checked($virtual, $payment_cf["payment_virtual_bank_list"])?>>
                        <span class="chip-check-box__label"><?=$virtual?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">결제카드</h3>
                <div class="flex flex-wrap gap-8">
                    <?php foreach ((array)$payment_cf["payment_card_list"] as $i => $card) { ?>
                    <label for="payment_card_<?=$i?>" class="chip-check-box <?=get_checked($card, $payment_cf["payment_card_list"])?>">
                        <input type="checkbox" name="payment_card[<?=$i?>]" id="payment_card_<?=$i?>" class="chip-check-box__check" value="<?=$card?>" <?=get_checked($card, $payment_cf["payment_card_list"])?>>
                        <span class="chip-check-box__label"><?=$card?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">가상계좌 만료기간</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="payment_virtual_expire_no" id="payment_virtual_expire_no" class="input-box-t4__input" value="<?=$payment_cf["payment_virtual_expire_no"]?>" placeholder="가상계좌 만료기간">
                    </div>

                    <div class="select-box">
                        <select name="payment_virtual_expire_unit" id="payment_virtual_expire_unit" class="select-box__select" title="가상계좌 만료기간 단위">
                            <option value="" disabled selected>선택해주세요.</option>
                            <option value="days" <?=get_selected("days", $payment_cf["payment_virtual_expire_unit"])?>>일</option>
                            <option value="weeks" <?=get_selected("weeks", $payment_cf["payment_virtual_expire_unit"])?>>주</option>
                            <option value="months" <?=get_selected("months", $payment_cf["payment_virtual_expire_unit"])?>>달</option>
                            <option value="years" <?=get_selected("years", $payment_cf["payment_virtual_expire_unit"])?>>년</option>
                        </select>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="flex flex-column">
            <h2 class="text-weight-bold text-color-g12 text-size-large">결제방식 설정</h2>
            <?php foreach ($payment_cf["payment_settle_type_list"] as $i => $settle) { ?>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$settle["settle_value"]?> 사용</h3>
                <label for="payment_settle_type_show_<?=$i?>" class="switch-box">
                    <input type="checkbox" name="payment_settle_type[<?=$i?>][settle_show]" value="1" id="payment_settle_type_show_<?=$i?>" class="switch-box__check" <?=get_checked(1, $settle["settle_show"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$settle["settle_value"]?> key</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="payment_settle_type[<?=$i?>][settle_key]" id="payment_settle_type_key<?=$i?>" class="input-box-t4__input" value="<?=$settle["settle_key"]?>" placeholder="<?=$settle["settle_value"]?> key">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$settle["settle_value"]?> value</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="payment_settle_type[<?=$i?>][settle_value]" id="payment_settle_type_value<?=$i?>" class="input-box-t4__input" value="<?=$settle["settle_value"]?>" placeholder="<?=$settle["settle_value"]?> value">
                    </div>
                </div>
            </div>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$settle["settle_value"]?> 순서</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="payment_settle_type[<?=$i?>][settle_order]" id="payment_settle_type_order<?=$i?>" class="input-box-t4__input" value="<?=$settle["settle_order"]?>" placeholder="<?=$settle["settle_value"]?> 순서">
                    </div>
                </div>
            </div>
            <?php } ?>
        </fieldset>

        <fieldset class="flex flex-column">
            <h2 class="text-weight-bold text-color-g12 text-size-large">결제취소사유 설정</h2>
            <?php foreach ($payment_cf["payment_cancel_reason_list"] as $i => $reason) { ?>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$reason["cancel_value"]?> 사용</h3>
                <label for="pay_cancel_reason_show_<?=$i?>" class="switch-box">
                    <input type="checkbox" name="pay_cancel_reason[cancel_show]" value="1" id="pay_cancel_reason_show_<?=$i?>" class="switch-box__check" <?=get_checked(1, $reason["cancel_show"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$reason["cancel_value"]?> key</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="pay_cancel_reason[cancel_key]" id="pay_cancel_reason_key<?=$i?>" class="input-box-t4__input" value="<?=$reason["cancel_key"]?>" placeholder="<?=$reason["cancel_value"]?> key">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$reason["cancel_value"]?> value</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="pay_cancel_reason[cancel_value]" id="pay_cancel_reason_value<?=$i?>" class="input-box-t4__input" value="<?=$reason["cancel_value"]?>" placeholder="<?=$reason["cancel_value"]?> value">
                    </div>
                </div>
            </div>
            <?php } ?>
        </fieldset>

        <button type="submit">수정</button>
    </form>
</div>