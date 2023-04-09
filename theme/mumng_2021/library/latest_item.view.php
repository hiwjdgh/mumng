<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($latest_list)){ ?>
    <?php foreach ($latest_list as $i => $latest) { ?>
    <li class="library__content-epsd-item epsd-detail" data-id="<?=$latest["latest_work"]["work_id"]?>" data-epsd="<?=$latest["latest_epsd"]["epsd_id"]?>">
        <div class="library__content-epsd-item-box">
            <div class="library__content-epsd-info">
                <span class="library__content-work-name"><?=$latest["latest_work"]["work_name"]?></span>
                <span class="library__content-name"><?=$latest["latest_epsd"]["epsd_name"]?></span>
                <div class="library__content-like-count-box">
                    <div class="library__content-like">
                        <span class="library__content-like-icon icon-like icon-like--active icon-16"></span>
                        <span class="library__content-like-text"><?=Converter::display_number_format($latest["latest_epsd"]["epsd_like"])?></span>
                    </div>
                    <div class="library__content-hit">
                        <span class="library__content-hit-icon icon-display icon-display--active icon-16"></span>
                        <span class="library__content-hit-text"><?=Converter::display_number_format($latest["latest_epsd"]["epsd_hit"])?></span>
                    </div>
                    <span class="library__content-upload"><?=Converter::display_time($latest["latest_epsd"]["epsd_upload_dt"]) ?></span>
                </div>
                <button type="button" class="library__content-epsd-more-button helper__button" data-anchor="latest_more_<?=$i?>">
                    <span class="icon-more icon-24"></span>
                </button>

                <div class="helper" data-target="latest_more_<?=$i?>">
                    <div class="helper__container">
                        <div id="helper__more-box" class="helper__action-box">
                            <button type="button" class="helper__action-button clipboard-button" data-url="<?=$latest["latest_work"]["work_url"]?>">작품 링크 복사</button>
                            <a href="<?=$latest["latest_work"]["work_user"]["user_page_url"]?>" class="helper__action-button" target="_blank">페이지</a>
                        </div>
                        <div class="helper__close-box">
                            <button type="button" class="helper__close-button" data-anchor="latest_more_<?=$i?>">취소</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="library__content-del-button icon-button icon-button-circle icon-button-48" data-hit="<?=$latest["hit_no"]?>">
            <span class="icon-x icon-20"></span>
        </button>
    </li>
    <?php } ?>
<?php }else{ ?>
    <?php if($page == 1){ ?>
    <li class="library__content-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default_640px.png")?>" alt="최근없음 이미지" width="360" height="360" usemap="#author" class="library__content-item-empty-img">
        <map name="author">
        <area shape="rect" coords="63,306,136,320" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="library__content-item-empty-text">최근에 본 작품이 없습니다.</p>
        <a href="<?=get_url(PAVE_URL)?>" class="library__content-item-empty-text">작품보러가기</a>
    </li>
    <?php } ?>
<?php } ?>