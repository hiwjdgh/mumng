<?php
if (!defined('_PAVE_')) exit;
?>
<section class="charge">
    <div class="charge__header">
        <div class="charge__header-tab">
            <ul class="charge__header-tab-list">
                <li class="charge__header-tab-item">
                    <a href="<?=get_url(PAVE_CHARGE_URL, "payment")?>" class="charge__header-tab-item-link <?=defined("_CHARGE_PAYMENT_") ? "current" : ""?>">충전하기</a>
                </li>
                <li class="charge__header-tab-item">
                    <a href="<?=get_url(PAVE_CHARGE_URL, "receipt/list/1")?>" class="charge__header-tab-item-link <?=defined("_CHARGE_RECEIPT_") ? "current" : ""?>">충전내역</a>
                </li>
                <li class="charge__header-tab-item">
                    <a href="<?=get_url(PAVE_CHARGE_URL, "pay/list/1")?>" class="charge__header-tab-item-link <?=defined("_CHARGE_PAY_") ? "current" : ""?>">구매내역</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="charge__content">
        <div class="flex flex-column mgb-12">
            <div class="flex flex-justify-content-space-between flex-align-item-center">
                <span class="text-weight-regular text-color-g7 text-size-xsmall">현재보유중인 EXP</span>
                <span class="text-weight-regular text-color-g12 text-size-xsmall">EXP 구매
                    <a href="<?=get_url(PAVE_LEGAL_URL, "charge")?>" class="text-weight-bold text-color-g12 text-size-xsmall mgl-6" target="_blank">이용안내</a>
                </span>
            </div>
            <div class="flex flex-align-item-center">
                <span class="text-weight-bold text-color-g12 text-size-large mgr-4"><?=Converter::display_number($pave_user["user_exp"])?></span>
                <span class="text-weight-bold text-color-g10 text-size-large">EXP</span>
            </div>
        </div>
<script>
$(window).on("scroll", function(event){
    if($(window).scrollTop() > 0) {
        $(".charge__header").addClass("scroll");
    }else{
        $(".charge__header").removeClass("scroll");
    }
});
</script>