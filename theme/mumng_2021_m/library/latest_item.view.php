<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($latest_list)){ ?>
    <?php foreach ($latest_list as $i => $latest) { ?>
    <li class="library__content-item2 epsd-detail" data-id="<?=$latest["latest_work"]["work_id"]?>" data-epsd="<?=$latest["latest_epsd"]["epsd_id"]?>">
        <div class="library__content-item2-box">
            <div class="library__content-item2-info">
                <span class="library__content-item2-work text-truncate"><?=$latest["latest_work"]["work_name"]?></span>
                <span class="library__content-item2-epsd text-truncate"><?=$latest["latest_epsd"]["epsd_name"]?></span>
                <div class="library__content-item2-total">
                    <div class="library__content-item2-like">
                        <span class="library__content-item2-like-icon icon-like icon-like--active icon-16"></span>
                        <span class="library__content-item2-like-text"><?=Converter::display_number_format($latest["latest_epsd"]["epsd_like"])?></span>
                    </div>
                    <div class="library__content-item2-hit">
                        <span class="library__content-item2-hit-icon icon-display icon-display--active icon-16"></span>
                        <span class="library__content-item2-hit-text"><?=Converter::display_number_format($latest["latest_epsd"]["epsd_hit"])?></span>
                    </div>
                    <span class="library__content-item2-upload"><?=Converter::display_time($latest["latest_epsd"]["epsd_upload_dt"]) ?></span>
                </div>
                <button type="button" class="library__content-item2-more-button" data-more="<?=$latest["latest_epsd"]["epsd_id"]?>" data-type="epsd">
                    <span class="icon-more icon-24"></span>
                </button>

                <button type="button" class="library__content-item2-check-button icon-button" data-hit="<?=$latest["hit_no"]?>">
                    <span class="icon-check icon-24 icon-inactive"></span>
                </button>
            </div>
        </div>
    </li>
    <?php } ?>
<?php }else{ ?>
    <?php if($page == 1){ ?>
    <li class="library__content-item2-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default_640px.png")?>" alt="최근없음 이미지" width="240" height="240" usemap="#author" class="library__content-item2-empty-img">
        <map name="author">
        <area shape="rect" coords="40,200,92,212" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="library__content-item2-empty-text">최근에 본 작품이 없습니다.</p>
        <a href="<?=get_url(PAVE_URL)?>" class="library__content-item2-empty-text">작품보러가기</a>
    </li>
    <?php } ?>
<?php } ?>