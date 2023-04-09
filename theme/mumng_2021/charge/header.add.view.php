<?php
if (!defined('_PAVE_')) exit;
?>
<section id="charge">
    <div id="charge__box">
        <div id="charge__header">
            <div class="flex flex-justify-content-space-between flex-align-item-center pdb-16 mgb-12 bdb-1-solid-g4">
                <ul class="tab">
                    <li class="tab__item <?=defined("_CHARGE_PAYMENT_") ? "current" : ""?>">
                        <a href="<?=get_url(PAVE_CHARGE_URL, "payment")?>" class="charge__tab-item-link">충전하기</a>
                    </li>
                    <li class="tab__item <?=defined("_CHARGE_RECEIPT_") ? "current" : ""?>">
                        <a href="<?=get_url(PAVE_CHARGE_URL, "receipt/list/1")?>" class="charge__tab-item-link">충전내역</a>
                    </li>
                    <li class="tab__item <?=defined("_CHARGE_PAY_") ? "current" : ""?>">
                        <a href="<?=get_url(PAVE_CHARGE_URL, "pay/list/1")?>" class="charge__tab-item-link">구매내역</a>
                    </li>
                </ul>
                <a href="<?=get_url(PAVE_URL)?>"><span class="icon-x icon-20"></span></a>
            </div>            
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
        </div>
        <div id="charge__content" class="flex flex-column">