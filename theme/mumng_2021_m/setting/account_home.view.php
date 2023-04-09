<?php
if (!defined('_PAVE_')) exit;
?>
<div class="setting__home">
    <div class="setting__home-lnb">
        <ul class="setting__home-lnb-list">
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL,"account/privacy")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">개인정보 설정</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                    
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "account/cert")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">본인인증 설정</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "account/content")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">게시물 설정</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <li class="setting__home-lnb-item">
                <a href="<?=get_url(PAVE_SETTING_URL, "account/pwd")?>" class="setting__home-lnb-item-link">
                    <span class="setting__home-lnb-item-link-text">비밀번호 변경</span>
                    <span class="setting__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
        </ul>
    </div>
</div>