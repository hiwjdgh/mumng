<?php
if (!defined('_PAVE_')) exit;
?>
<div class="notify-item__pay">
    <div class="notify-item__pay-link">
        <img src="<?=$notify["sender"]["user_img"]?>" alt="프로필 이미지" class="notify-item__pay-img" width="32" height="32">
        <p class="notify-item__pay-inner-box">
            <span class="notify-item__pay-content"><?=$notify["notify_content"]?></span>
            <span class="notify-item__pay-dt"><?=$notify["notify_insert_dt_text"]?></span>
        </p>
    </div>

    <a href="<?=$notify["notify_url"]?>" class="notify-item__pay-link2">
        <img src="<?=$notify["notify_img"]?>" alt="회차 이미지" class="notify-item__pay-img2" width="40" height="40">
    </a>
</div>