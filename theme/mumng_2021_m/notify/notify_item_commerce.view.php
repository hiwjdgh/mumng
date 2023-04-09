<?php
if (!defined('_PAVE_')) exit;
?>
<div class="notify-item__commerce">
    <div class="notify-item__commerce-link">
        <img src="<?=$notify["sender"]["user_img"]?>" alt="프로필 이미지" class="notify-item__commerce-img" width="32" height="32">
        <p class="notify-item__commerce-inner-box">
            <span class="notify-item__commerce-content"><?=$notify["notify_content"]?></span>
            <span class="notify-item__commerce-dt"><?=$notify["notify_insert_dt_text"]?></span>
        </p>
    </div>
</div>