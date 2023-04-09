<?php
if (!defined('_PAVE_')) exit;
?>
<?php foreach ($list as $i => $follow) { ?>
<li class="follow-item">
    <a href="<?=$follow["user_page_url"]?>" class="follow-item__link" target="_blank">
        <img src="<?=$follow["user_img"]?>" alt="프로필 이미지" width="48" height="48" class="follow-item__img">
    </a>
    <div class="follow-item__inner-box">
        <span class="follow-item__nick">
            <a href="<?=$follow["user_page_url"]?>" target="_blank"><?=$follow["user_nick"]?></a>
        </span>
        <span class="follow-item__field"><?=$follow["user_field"]?></span>
    </div>
    <?php if($follow["is_follow_display"]){ ?>
    <button type="button" class="follow-item__follow-button <?=$follow["is_follow"] ? "button-t3" : "button-t1" ?> button-s4 follow-button" data-user="<?=$follow["user_code"]?>"><?=$follow["follow_text"]?></button>
    <?php } ?>
</li>
<?php }?>