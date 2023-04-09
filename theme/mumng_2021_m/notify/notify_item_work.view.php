<?php
if (!defined('_PAVE_')) exit;
?>
<div class="notify-item__work">
    <?php if($notify["notify_type"] == "notify_work_complete" || $notify["notify_type"] == "notify_work_reserve" || $notify["notify_type"] == "notify_work_deadline" || $notify["notify_type"] == "notify_work_late"){ ?>
    <div class="notify-item__work-link">
        <img src="<?=$notify["sender"]["user_img"]?>" alt="프로필 이미지" class="notify-item__work-img" width="32" height="32">
        <p class="notify-item__work-inner-box">
            <span class="notify-item__work-content"><?=$notify["notify_content"]?></span>
            <span class="notify-item__work-dt"><?=$notify["notify_insert_dt_text"]?></span>
        </p>
    </div>
    <?php }else if($notify["notify_type"] == "notify_work_subscribe" || $notify["notify_type"] == "notify_work_with"){ ?>
    <a href="<?=$notify["sender"]["user_page_url"]?>" class="notify-item__work-link">
        <img src="<?=$notify["sender"]["user_img"]?>" alt="프로필 이미지" class="notify-item__work-img" width="32" height="32">
        <p class="notify-item__work-inner-box">
            <span class="notify-item__work-name"><?=$notify["sender"]["user_nick"]?></span>
            <span class="notify-item__work-content"><?=$notify["notify_content"]?></span>
            <span class="notify-item__work-dt"><?=$notify["notify_insert_dt_text"]?></span>
        </p>
    </a>
    <?php } ?>
    <a href="<?=$notify["notify_url"]?>" class="notify-item__work-link3">
        <img src="<?=$notify["notify_img"]?>" alt="작품 이미지" class="notify-item__work-img3" width="40" height="50">
    </a>
</div>