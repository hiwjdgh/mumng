<?php
if (!defined('_PAVE_')) exit;
?>
<div class="setting__home">
    <div class="setting__home-lnb">
        <ul class="setting__home-lnb-list">
            <li class="setting__home-lnb-item">
                <a href="javascript:void(0);" class="setting__home-lnb-item-button">
                    <span class="setting__home-lnb-item-button-text">모든활동</span>

                    <label for="notify_all" class="setting__home-lnb-item-button-icon switch-box">
                        <input type="checkbox" name="notify_all" value="1" id="notify_all" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_all"])?>>
                        <span class="switch-box__slider"></span>
                    </label>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "notify")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">일반활동</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "notify#work")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">작품활동</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "notify#subscribe")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">구독</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "notify#pay")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">구매</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "notify#charge")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">충전</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "notify#commerce")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">커머스</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "notify#login")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">로그인</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "notify#mumng")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">무명</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
        </ul>
    </div>
</div>