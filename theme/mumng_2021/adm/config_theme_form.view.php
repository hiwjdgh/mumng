<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-config">
    <form class="amd-config__form" action="<?=get_url(PAVE_ADM_URL,"config/theme/update")?>" method="post" onsubmit="return adm_config_cert_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
        <?php foreach ($theme_cf as $i => $theme) { ?>
        <fieldset class="flex flex-column">
            <h2 class="text-weight-bold text-color-g12 text-size-large"><?=$theme["thm_name"]?> 테마 설정</h2>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">테마명</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="thm_name" id="thm_name" class="input-box-t4__input" value="<?=$theme["thm_name"]?>" placeholder="테마명">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">테마 경로</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="thm_path" id="thm_path" class="input-box-t4__input" value="<?=$theme["thm_path"]?>" placeholder="테마 경로">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">테마 모바일 경로</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="thm_m_path" id="thm_m_path" class="input-box-t4__input" value="<?=$theme["thm_m_path"]?>" placeholder="테마 모바일 경로">
                    </div>
                </div>
            </div>
        </fieldset>
        <?php } ?>
    </form>
</div>