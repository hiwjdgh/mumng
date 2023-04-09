<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($comment_list)){ ?>
    <?php foreach ($comment_list as $i => $comment) { ?>
    <li class="library__content-cmt-item">
        <div class="library__content-cmt-item-box">
            <div class="library__content-cmt-info">
                <span class="library__content-cmt-work-name"><?=$comment["work_name"]?></span>
                <span class="library__content-cmt-name"><?=$comment["epsd_name"]?></span>
                <div class="library__content-cmt-content-box text-truncate-line3">
                    <?php if($comment["is_best"]){ ?>
                    <span class="best-badge">BEST</span>
                    <?php } ?>
                    <p class="library__content-cmt-content"><?=$comment["comment_content"]?></p>
                </div>
                <div class="library__content-cmt-date-box">
                    <span class="library__content-cmt-date"><?=Converter::display_time($comment["comment_insert_dt"])?></span>
                    <span class="library__content-cmt-like">좋아요 <?=Converter::display_number_format($comment["comment_like"], "개")?></span>
                    <span class="library__content-cmt-reply">의견 <?=Converter::display_number_format($comment["comment_reply"], "개")?></span>
                </div>
                <button type="button" class="library__content-cmt-more-button helper__button" data-anchor="comment_more<?=$i?>">
                    <span class="icon-more icon-24"></span>
                </button>

                <div class="helper" data-target="comment_more<?=$i?>">
                    <div class="helper__container">
                        <div id="helper__more-box" class="helper__action-box">
                            <a href="<?=$comment["comment_user"]["user_page_url"]?>" class="helper__action-button" target="_blank">페이지</a>
                        </div>
                        <div class="helper__close-box">
                            <button type="button" class="helper__close-button" data-anchor="comment_more<?=$i?>">취소</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="library__content-del-button icon-button icon-button-circle icon-button-48" data-id="<?=$comment["work_id"]?>" data-epsd="<?=$comment["epsd_id"]?>" data-comment="<?=$comment["comment_no"]?>">
            <span class="icon-x icon-20"></span>
        </button>
    </li>
    <?php } ?>
<?php }else{ ?>
    <?php if($page == 1){ ?>
    <li class="library__content-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_comment_640px.png")?>" alt="의견없음 이미지" width="360" height="360" usemap="#author" class="library__content-item-empty-img">
        <map name="author">
        <area shape="rect" coords="254,312,324,330" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="library__content-item-empty-text">작성한 의견이 없습니다.</p>
        <a href="<?=get_url(PAVE_URL)?>" class="library__content-item-empty-text">작품보러가기</a>
    </li>
    <?php } ?>
<?php } ?>