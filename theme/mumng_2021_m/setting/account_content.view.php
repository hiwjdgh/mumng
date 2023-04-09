<?php
if (!defined('_PAVE_')) exit;
?>
<div class="setting__account">
    <div class="switch-group">
        <h3 class="switch-group__label">성인물 차단</h3>
        <div class="switch-group__box">
            <label for="user_adult_content" class="switch-box">
                <input type="checkbox" name="user_adult_content" value="1" id="user_adult_content" class="content-change-button switch-box__check" <?=get_checked(1, $pave_user["user_adult_content"])?>>
                <span class="switch-box__slider"></span>
            </label>
        </div>
        <small class="switch-group__description">무명 성인 컨텐츠를 차단합니다.</small>
    </div>
</div>