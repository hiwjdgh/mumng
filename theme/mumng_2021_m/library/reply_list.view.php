
<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($list)){ ?>
    <?php foreach ($list as $i => $reply) { ?>
    <li class="library__content-item3">
        <div class="library__content-item3-box">
            <div class="library__content-item3-info">
                <a href="<?=$reply["cmt_user"]["user_page_url"]?>" class="library__content-item3-user-box" target="_blank">
                    <img src="<?=$reply["cmt_user"]["user_img"]?>" alt="의견 작성자 프로필" class="library__content-item3-user-img" width="20" height="20">
                    <span class="library__content-item3-user-nick"><?=$reply["cmt_user"]["user_nick"]?></span>
                </a>
                <div class="library__content-item3-content-box">
                    <p class="library__content-item3-content-text"><?=nl2br($reply["cmt_content"])?></p>
                </div>
                <div class="library__content-item3-total">
                    <span class="library__content-item3-date"><?=$reply["cmt_insert_dt_text"]?></span>
                    <span class="library__content-item3-like">좋아요 <?=Converter::display_number_format($reply["cmt_like"], "개")?></span>
                </div>
                <button type="button" class="library__content-item3-more-button" data-more="<?=$reply["cmt_id"]?>" data-type="cmt">
                    <span class="icon-more icon-24"></span>
                </button>
            </div>
        </div>
    </li>
    <?php } ?>
<?php } ?>