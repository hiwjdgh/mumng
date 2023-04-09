<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-config">
    <form class="amd-config__form" action="<?=get_url(PAVE_ADM_URL,"config/sns/update")?>" method="post" onsubmit="return adm_config_cert_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
    <?php foreach ($sns_config as $i => $sns) { ?>
    <fieldset class="flex flex-column">
        <h2 class="text-weight-bold text-color-g12 text-size-large"><?=$sns["sns_real_name"]?> 설정</h2>
        <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
            <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$sns["sns_real_name"]?> 사용</h3>
            <label for="sns_use" class="switch-box">
                <input type="checkbox" name="sns_use" value="1" id="sns_use" class="switch-box__check" <?=get_checked(1, $sns["sns_use"])?>>
                <span class="switch-box__slider"></span>
            </label>
        </div>

        <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
            <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$sns["sns_real_name"]?> 주소</h3>
            <div class="flex flex-align-item-center">
                <div class="input-box input-box-t4">
                    <input type="text" name="sns_url" id="sns_url" class="input-box-t4__input" value="<?=$sns["sns_url"]?>" placeholder="<?=$sns["sns_real_name"]?> 주소">
                </div>
            </div>
        </div>
        <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
            <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$sns["sns_real_name"]?> 자리 표시명</h3>
            <div class="flex flex-align-item-center">
                <div class="input-box input-box-t4">
                    <input type="text" name="sns_placeholder" id="sns_placeholder" class="input-box-t4__input" value="<?=$sns["sns_placeholder"]?>" placeholder="<?=$sns["sns_real_name"]?> 자리 표시명">
                </div>
            </div>
        </div>
    </fieldset>
    <?php } ?>

    </form>
</div>