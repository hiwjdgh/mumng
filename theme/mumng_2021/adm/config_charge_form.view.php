<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column gap-row-24">
    <form class="adm-config__form flex flex-column gap-row-12" action="<?=get_url(PAVE_ADM_URL,"config/charge/update")?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">

        <div class="adm-content__header flex flex-justify-content-flex-start flex-align-item-center">
            <h1 class="adm-content__header__title"><?=$adm_title?></h1>

            <div class="flex mgl-auto gap-column-12">
                <button type="submit" class="button-t1 button-s3">수정</button>
            </div>
        </div>


        <div class="flex flex-wrap gap-24 mg-20">
            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">결제충전 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">결제충전 설정</h3>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">만료기간</p>

                        <div class="flex flex-align-item-center">
                            <div class="input-box input-box-t2">
                                <input type="number" name="charge_payment_expire_no" id="charge_payment_expire_no" class="input-box-t2__input" value="<?=$charge_config["charge_payment_expire_no"]?>" title="만료기간" placeholder="만료기간">
                            </div>
                            <div class="select-box">
                                <select name="charge_payment_expire_unit" id="charge_payment_expire_unit" class="select-box__select" title="만료기간 단위">
                                    <option value="" disabled selected>선택해주세요.</option>
                                    <option value="days" <?=get_selected("days", $charge_config["charge_payment_expire_unit"])?>>일</option>
                                    <option value="weeks" <?=get_selected("weeks", $charge_config["charge_payment_expire_unit"])?>>주</option>
                                    <option value="months" <?=get_selected("months", $charge_config["charge_payment_expire_unit"])?>>월</option>
                                    <option value="years" <?=get_selected("years", $charge_config["charge_payment_expire_unit"])?>>년</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</div>