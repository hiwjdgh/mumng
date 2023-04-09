<?php
if (!defined('_PAVE_')) exit;
?>
<div class="notify-item__mumng">
    <div class="notify-item__mumng-link">
        <img src="<?=$notify["sender"]["user_img"]?>" alt="프로필 이미지" class="notify-item__mumng-img" width="32" height="32">
        <p class="notify-item__mumng-inner-box">
            <span class="notify-item__mumng-content"><?=$notify["notify_content"]?></span>
            <span class="notify-item__mumng-dt"><?=Converter::display_time_ago($notify["notify_insert_dt"])."전"?></span>
        </p>
    </div>
</div>