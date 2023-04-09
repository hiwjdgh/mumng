<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-config">
    <form class="amd-config__form" action="<?=get_url(PAVE_ADM_URL,"config/notify/update")?>" method="post" onsubmit="return adm_config_cert_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
        <?php foreach ($notify_cf as $i => $notify) { ?>
        <fieldset class="flex flex-column">
            <h2 class="text-weight-bold text-color-g12 text-size-large"><?=$notify["notify_name"]?>알림 설정</h2>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$notify["notify_name"]?> 알림명</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="notify_name" id="notify_name" class="input-box-t4__input" value="<?=$notify["notify_name"]?>" placeholder="<?=$notify["notify_name"]?>알림명">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal mgb-12"><?=$notify["notify_name"]?>알림 내용</h3>
                <div class="textarea-box">
                    <textarea name="notify_content" id="notify_content" class="textarea-box__textarea" placeholder="<?=$notify["notify_name"]?>알림 내용를 입력해주세요." spellcheck="false" maxlength="500"><?=$notify["notify_content"]?></textarea>
                    <div class="textarea-box__counter">
                        <span class="textarea-box__counter-now">0</span>
                        <span class="textarea-box__counter-max">/ 500자</span>
                    </div>
                </div>
            </div>
        </fieldset>
        <?php } ?>
    </form>
</div>