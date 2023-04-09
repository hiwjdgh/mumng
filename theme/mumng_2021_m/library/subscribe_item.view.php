<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($work_list)){ ?>
    <?php foreach ($work_list as $i => $subscribe) { ?>
    <li class="library__content-item work-detail" data-id="<?=$subscribe["subscribe_work"]["work_id"]?>">
        <div class="library__content-item-box">
            <img src="<?=$subscribe["subscribe_work"]["work_img"]?>" class="library__content-item-img" alt="구독작품 이미지" width="123" height="143">
            <div class="library__content-item-info">
                <div class="library__content-item-state-box">
                    <?php if($subscribe["subscribe_work"]["work_state"] == "stop"){ ?>
                    <span class="library__content-item-state text-badge-t2">휴재</span>
                    <?php }else if($subscribe["subscribe_work"]["work_state"] == "end"){ ?>
                    <span class="library__content-item-state text-badge-t3">완결</span>
                    <?php }else{ ?>
                    <span class="library__content-item-state text-badge-t1">연재중</span>
                    <?php } ?>
                    <span class="library__content-item-day"><?=str_replace(",", " ", $subscribe["subscribe_work"]["work_day"]) ?></span>
                    <span class="library__content-item-time"><?=$subscribe["subscribe_work"]["work_time"]?>시</span>
                </div>
                <p class="library__content-item-name text-truncate"><?=$subscribe["subscribe_work"]["work_name"]?></p>
                <?php if($subscribe["subscribe_latest_epsd"]){ ?>
                <span class="library__content-item-epsd-name text-truncate"><?=$subscribe["subscribe_latest_epsd"]["epsd_name"]?></span>
                <span class="library__content-item-epsd-upload"><?=Converter::display_time($subscribe["subscribe_latest_epsd"]["epsd_upload_dt"])?></span>
                <?php } ?>
                <?php if($subscribe["subscribe_work_new_epsd"] > 0){ ?>
                <div class="library__content-item-new-box">
                    <span class="library__content-item-new-text">새로운회차</span>
                    <span class="library__content-item-new-text2"><?=Converter::display_number($subscribe["subscribe_work_new_epsd"], "개")?></span>
                </div>
                <?php } ?>

                <button type="button" class="library__content-item-notify-button icon-button icon-button-24" data-subscribe="<?=$subscribe["subscribe_no"]?>">
                    <?php if($subscribe["subscribe_notify"]){ ?>
                    <span class="icon-alarm icon-alarm--active icon-24"></span>
                    <?php }else{ ?>
                    <span class="icon-alarm icon-alarm--inactive icon-24"></span>
                    <?php } ?>
                </button>
                
                <button type="button" class="library__content-item-check-button icon-button" data-id="<?=$subscribe["subscribe_work"]["work_id"]?>">
                    <span class="icon-check icon-24 icon-inactive"></span>
                </button>
            </div> 
        </div> 
    </li>
    <?php } ?>
<?php }else{ ?>
    <?php if($page == 1){ ?>
    <li class="library__content-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_subscribe_640px.png")?>" alt="구독없음 이미지" width="240" height="240" usemap="#author" class="library__content-item-empty-img">
        <map name="author">
        <area shape="rect" coords="146,138,192,158" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="library__content-item-empty-text">구독한 작품이 없습니다.</p>
        <a href="<?=get_url(PAVE_URL)?>" class="library__content-item-empty-text">작품보러가기</a>
    </li>
    <?php } ?>
<?php } ?>
