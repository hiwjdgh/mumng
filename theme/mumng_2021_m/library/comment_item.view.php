<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($comment_list)){ ?>
    <?php foreach ($comment_list as $i => $comment) { ?>
    <li class="library__content-item3">
        <div class="library__content-item3-box">
            <div class="library__content-item3-info">
                <span class="library__content-item3-work text-truncate"><?=$comment["work_name"]?></span>
                <span class="library__content-item3-epsd text-truncate"><?=$comment["epsd_name"]?></span>
                <div class="library__content-item3-content-box">
                    <?php if($comment["is_best"]){ ?>
                    <span class="library__content-item3-content-badge best-badge">BEST</span>
                    <?php } ?>
                    <p class="library__content-item3-content-text"><?=nl2br($comment["comment_content"])?></p>
                </div>
                <div class="library__content-item3-total">
                    <span class="library__content-item3-date"><?=Converter::display_time($comment["comment_insert_dt"])?></span>
                    <span class="library__content-item3-like">좋아요 <?=Converter::display_number_format($comment["comment_like"], "개")?></span>
                    <span class="library__content-item3-reply">의견 <?=Converter::display_number_format($comment["comment_reply"], "개")?></span>
                </div>

                <button type="button" class="library__content-item3-check-button icon-button" data-id="<?=$comment["work_id"]?>" data-epsd="<?=$comment["epsd_id"]?>" data-comment="<?=$comment["comment_no"]?>">
                    <span class="icon-check icon-24 icon-inactive"></span>
                </button>
            </div>
        </div>
    </li>
    <?php } ?>
<?php }else{ ?>
    <?php if($page == 1){ ?>
    <li class="library__content-item3-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_comment_640px.png")?>" alt="의견없음 이미지" width="240" height="240" usemap="#author" class="library__content-item3-empty-img">
        <map name="author">
        <area shape="rect" coords="169,207,215,221" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="library__content-item3-empty-text">작성한 의견이 없습니다.</p>
        <a href="<?=get_url(PAVE_URL)?>" class="library__content-item3-empty-text">작품보러가기</a>
    </li>
    <?php } ?>
<?php } ?>