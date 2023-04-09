<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-config">
    <form class="amd-config__form" action="<?=get_url(PAVE_ADM_URL,"config/sitemap/update")?>" method="post" onsubmit="return adm_config_cert_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
    <fieldset class="flex flex-column">
        <h2 class="text-weight-bold text-color-g12 text-size-large">사이트맵 설정</h2>
            <?php foreach ($sitemap_cf as $i => $sitemap) { ?>
                    
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal"><?=$sitemap["site_name"]?> 사용</h3>
                <label for="site_use" class="switch-box">
                    <input type="checkbox" name="site_use" value="1" id="site_use" class="switch-box__check" <?=get_checked(1, $sitemap["site_use"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <?php } ?>
        </fieldset>

    </form>
</div>