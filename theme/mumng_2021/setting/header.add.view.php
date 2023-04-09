<?php
if (!defined('_PAVE_')) exit;
?>
<section id="account">
    <div id="account__side">
        <h2 id="account__title">설정</h2>
        <ul id="account__nav">
            <li>
                <a href="<?=get_url(PAVE_SETTING_URL,"profile")?>" class="account__nav-link <?=defined("__PROFILE__") ? "current" : ""?>">프로필</a>
                <div class="account__nav2 empty">
                </div>
            </li>
            <li>
                <a href="<?=get_url(PAVE_SETTING_URL,"notify")?>" class="account__nav-link <?=defined("__NOTIFY__") ? "current" : ""?>">알림</a>
                <div class="account__nav2">
                    <div id="notify__side-all">
                        <h3 id="notify__side-all-label">모든활동</h3>
                        <label for="notify_all" class="switch-box">
                            <input type="checkbox" name="notify_all" value="1" id="notify_all" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_all"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>
                    <ul id="notify__side-nav">
                        <li><a href="<?=get_url(PAVE_SETTING_URL, "notify")?>" class="account__nav2-link notify__side-nav-link current">일반활동</a></li>
                        <li><a href="<?=get_url(PAVE_SETTING_URL, "notify#work")?>" class="account__nav2-link notify__side-nav-link">작품활동</a></li>
                        <li><a href="<?=get_url(PAVE_SETTING_URL, "notify#subscribe")?>" class="account__nav2-link notify__side-nav-link">구독</a></li>
                        <li><a href="<?=get_url(PAVE_SETTING_URL, "notify#pay")?>" class="account__nav2-link notify__side-nav-link">구매</a></li>
                        <li><a href="<?=get_url(PAVE_SETTING_URL, "notify#charge")?>" class="account__nav2-link notify__side-nav-link">충전</a></li>
                        <li><a href="<?=get_url(PAVE_SETTING_URL, "notify#commerce")?>" class="account__nav2-link notify__side-nav-link">커머스</a></li>
                        <li><a href="<?=get_url(PAVE_SETTING_URL, "notify#login")?>" class="account__nav2-link notify__side-nav-link">로그인</a></li>
                        <li><a href="<?=get_url(PAVE_SETTING_URL, "notify#mumng")?>" class="account__nav2-link notify__side-nav-link">무명</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="<?=get_url(PAVE_SETTING_URL,"account/privacy")?>" class="account__nav-link <?=defined("__ACCOUNT__") ? "current" : ""?>">계정</a>
                <div class="account__nav2">
                    <div id="setting__side">
                        <ul id="setting__side-nav">
                            <li><a href="<?=get_url(PAVE_SETTING_URL, "account/privacy")?>" class="account__nav2-link setting__side-nav-link <?=defined("__ACCOUNT_PRIVACY__") ? "current" : ""?>">개인정보 설정</a></li>
                            <li><a href="<?=get_url(PAVE_SETTING_URL, "account/cert")?>" class="account__nav2-link setting__side-nav-link <?=defined("__ACCOUNT_CERT__") ? "current" : ""?>">본인인증 설정</a></li>
                            <li><a href="<?=get_url(PAVE_SETTING_URL, "account/content")?>" class="account__nav2-link setting__side-nav-link <?=defined("__ACCOUNT_CONTENT__") ? "current" : ""?>">게시물 설정</a></li>
                            <li><a href="<?=get_url(PAVE_SETTING_URL, "account/pwd")?>" class="account__nav2-link setting__side-nav-link <?=defined("__ACCOUNT_PWD__") ? "current" : ""?>">비밀번호 변경</a></li>
                        </ul>
                    </div>
                </div>

            </li>
        </ul>
    </div>
    <div id="account__content">