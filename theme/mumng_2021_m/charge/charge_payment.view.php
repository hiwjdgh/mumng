<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column">
    <div class="bdt-1-solid-g4 pdvt-24">
        <ul class="flex flex-column gap-row-8 mgb-24">
            <?php foreach ($item_list as $i => $item) { ?>
            <li class="flex flex-align-item-center flex-justify-content-space-between bd-1-solid-g4 bdrd-6 pd-6">
                <div class="flex flex-align-item-center">
                    <img src="<?=$item["it_img"]?>" class="pd-6 mgr-10" alt="EXP 이미지" width="20" height="20">
                    <div class="flex flex-align-item-center">
                        <span class="text-weight-bold text-color-g12 text-size-small mgr-4"><?=Converter::display_number($item["it_exp"])?></span>
                        <span class="text-weight-bold text-color-g10 text-size-small">EXP</span>
                    </div>
                </div>
                <div class="flex flex-align-item-center">
                    <span class="text-weight-medium text-color-g10 text-size-small mgr-2"><?=Converter::display_number($item["it_real_price"])?></span>
                    <span class="text-weight-regular text-color-g10 text-size-small">원</span>
                </div>
                <button type="button" class="charge-button button-t1 button-s4" data-item="<?=$item["it_no"]?>">구매</button>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="charge__ad mumng-ad">
        <img src="<?=get_url(PAVE_IMG_URL, "img_page_ad_376px.png")?>" alt="무명 내부 광고 이미지">
    </div>
</div>