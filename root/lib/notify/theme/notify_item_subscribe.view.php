<?php
if (!defined('_PAVE_')) exit;
?>
<div class="notify-item__subscribe">
    <a href="<?=$notify["sender"]["user_page_url"]?>" class="notify-item__subscribe-link">
        <img src="<?=$notify["sender"]["user_img"]?>" alt="프로필 이미지" class="notify-item__subscribe-img" width="32" height="32">
        <p class="notify-item__subscribe-inner-box">
            <span class="notify-item__subscribe-content"><?=$notify["notify_content"]?></span>
            <span class="notify-item__subscribe-dt"><?=$notify["notify_insert_dt_text"]?></span>
        </p>
    </a>

    <a href="<?=$notify["notify_url"]?>" class="notify-item__subscribe-link3">
        <img src="<?=$notify["notify_img"]?>" alt="작품 이미지" class="notify-item__subscribe-img3" width="40" height="50">
    </a>
</div>