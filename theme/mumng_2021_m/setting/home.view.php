<?php
if (!defined('_PAVE_')) exit;
?>
<div class="setting__home">
    <div class="setting__home-lnb">
        <ul class="setting__home-lnb-list">
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL,"profile")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">프로필</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                    
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "notify/home")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">알림</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "account/home")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">계정</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
        </ul>
    </div>
</div>