<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-config">
    <form class="amd-config__form" action="<?=get_url(PAVE_ADM_URL,"config/pay/update")?>" method="post" onsubmit="return adm_config_cert_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
        <fieldset class="flex flex-column">
            <h2 class="text-weight-bold text-color-g12 text-size-large">구매 설정</h2>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">대여 만료기간</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="pay_rent_expire_no" id="pay_rent_expire_no" class="input-box-t4__input" value="<?=$pay_config["pay_rent_expire_no"]?>" placeholder="대여 만료기간">
                    </div>

                    <div class="select-box">
                        <select name="pay_rent_expire_unit" id="charge_rcmnd_expire_no" class="select-box__select" title="대여 만료기간 단위">
                            <option value="" disabled selected>선택해주세요.</option>
                            <option value="days" <?=get_selected("days", $pay_config["pay_rent_expire_unit"])?>>일</option>
                            <option value="weeks" <?=get_selected("weeks", $pay_config["pay_rent_expire_unit"])?>>주</option>
                            <option value="months" <?=get_selected("months", $pay_config["pay_rent_expire_unit"])?>>달</option>
                            <option value="years" <?=get_selected("years", $pay_config["pay_rent_expire_unit"])?>>년</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">소장 만료기간</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="pay_keep_expire_dt" id="pay_keep_expire_dt" class="input-box-t4__input" value="<?=$pay_config["pay_keep_expire_dt"]?>" placeholder="추천인 충전 EXP">
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="flex flex-column">
            <h2 class="text-weight-bold text-color-g12 text-size-large">구매취소사유 설정</h2>
            <?php foreach ($pay_config["pay_cancel_reason_list"] as $i => $reason) { ?>
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
    </form>
</div>