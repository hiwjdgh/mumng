<?php
if (!defined('_PAVE_')) exit;
?>
<section class="commerce">
    <div class="commerce__header">
        <div class="commerce__header-container">
            <a href="javascript:history.back();" class="commerce__header-close-button icon-button icon-button-24">
                <span class="icon-back icon-24"></span>
            </a>
            <h1 class="commerce__header-title">커머스</h1>
        </div>
        <div class="commerce__header-tab">
            <ul class="commerce__header-tab-list">
                <li class="commerce__header-tab-item">
                    <a href="<?=get_url(PAVE_COMMERCE_URL, "home")?>" class="commerce__header-tab-item-link <?=$request[1] == "home" ? "current" : ""?>">홈</a>
                </li>
                <li class="commerce__header-tab-item">
                    <a href="<?=get_url(PAVE_COMMERCE_URL, "profit")?>" class="commerce__header-tab-item-link <?=$request[1] == "profit" ? "current" : ""?>">수익</a>
                </li>
                <li class="commerce__header-tab-item">
                    <a href="<?=get_url(PAVE_COMMERCE_URL, "calc")?>" class="commerce__header-tab-item-link <?=$request[1] == "calc" ? "current" : ""?>">정산</a>
                </li>
                <li class="commerce__header-tab-item">
                    <a href="<?=get_url(PAVE_COMMERCE_URL, "profile")?>" class="commerce__header-tab-item-link <?=$request[1] == "profile" ? "current" : ""?>">정보</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="commerce__content">