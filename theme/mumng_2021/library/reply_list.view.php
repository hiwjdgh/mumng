
<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($list)){ ?>
    <?php foreach ($list as $i => $reply) { ?>
    <li class="library__content-cmt-item">
        <div class="library__content-cmt-item-box">
            <div class="library__content-cmt-info">
                <a href="<?=$reply["cmt_user"]["user_page_url"]?>" class="library__content-user-box" target="_blank">
                    <img src="<?=$reply["cmt_user"]["user_img"]?>" alt="의견 작성자 프로필" class="library__content-user-img" width="20" height="20">
                    <span class="library__content-user-nick"><?=$reply["cmt_user"]["user_nick"]?></span>
                </a>
                <div class="library__content-cmt-content-box text-truncate-line3">
                    <p class="library__content-cmt-content"><?=$reply["cmt_content"]?></p>
                </div>
                <div class="library__content-cmt-date-box">
                    <span class="library__content-cmt-date"><?=$reply["cmt_insert_dt_text"]?></span>
                    <span class="library__content-cmt-like">좋아요 <?=Converter::display_number_format($reply["cmt_like"], "개")?></span>
                    <button type="button" class="library__content-cmt-like-button icon-button icon-button-32 icon-button-circle" data-like="<?=$reply["cmt_like"]?>" data-cmt="<?=$reply["cmt_id"]?>">
                        <?php if($reply["is_like"]){ ?>
                        <span class="icon-like icon-like--active icon-16"></span>
                        <?php }else{ ?>
                        <span class="icon-like icon-like--inactive icon-16"></span>
                        <?php } ?>
                    </button>
                </div>
                <button type="button" class="library__content-cmt-more-button" data-more="<?=$reply["cmt_id"]?>" data-type="cmt">
                    <span class="icon-more icon-24"></span>
                </button>
            </div>
        </div>
    </li>
    <?php } ?>
<?php } ?>