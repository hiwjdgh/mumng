<?php
if (!defined('_PAVE_')) exit;
?>
<div class="notify-item__user">
    <a href="<?=$notify["sender"]["user_page_url"]?>" class="notify-item__user-link">
        <img src="<?=$notify["sender"]["user_img"]?>" alt="프로필 이미지" class="notify-item__user-img" width="32" height="32">
        <p class="notify-item__user-inner-box">
            <span class="notify-item__user-name"><?=$notify["sender"]["user_nick"]?></span>
            <span class="notify-item__user-content"><?=$notify["notify_content"]?></span>
            <span class="notify-item__user-dt"><?=$notify["notify_insert_dt_text"]?></span>
        </p>
    </a>

    <?php if($notify["notify_type"] == "notify_user_follow"){ ?>
        <?php if($notify["sender"]["is_follow"]){ ?>
        <button type="button" class="notify-item__user-follow-button button-t3 button-s4 follow-button" data-user="<?=$notify["sender"]["user_code"]?>">팔로우 취소</button>
        <?php }else{ ?>
        <button type="button" class="notify-item__user-follow-button button-t1 button-s4 follow-button" data-user="<?=$notify["sender"]["user_code"]?>">팔로우</button>
        <?php } ?>
    <?php }else{ ?>
        <a href="<?=$notify["notify_url"]?>" class="notify-item__user-link2">
            <img src="<?=$notify["notify_img"]?>" alt="회차 이미지" class="notify-item__user-img2" width="40" height="40">
        </a>
    <?php } ?>
</div>