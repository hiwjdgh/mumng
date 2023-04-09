<?php
if (!defined('_PAVE_')) exit;
?>
<div class="notify-item__charge">
    <div class="notify-item__charge-link">
        <img src="<?=$notify["sender"]["user_img"]?>" alt="프로필 이미지" class="notify-item__charge-img" width="32" height="32">
        <p class="notify-item__charge-inner-box">
            <span class="notify-item__charge-content"><?=$notify["notify_content"]?></span>
            <span class="notify-item__charge-dt"><?=$notify["notify_insert_dt_text"]?></span>
        </p>
    </div>
</div>