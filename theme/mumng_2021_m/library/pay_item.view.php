<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($pay_list)){ ?>
    <?php foreach ($pay_list as $i => $pay) { ?>
    <li class="library__content-item work-detail" data-url="<?=$pay["pay_work"]["work_url"]?>">
        <div class="library__content-item-box">
            <img src="<?=$pay["pay_work"]["work_img"]?>" class="library__content-item-img" alt="구매작품 이미지">
            <div class="library__content-item-info">
                <div class="library__content-item-state-box">
                    <?php if($pay["pay_work"]["work_state"] == "stop"){ ?>
                    <span class="library__content-item-state text-badge-t2">휴재</span>
                    <?php }else if($pay["pay_work"]["work_state"] == "end"){ ?>
                    <span class="library__content-item-state text-badge-t3">완결</span>
                    <?php }else{ ?>
                    <span class="library__content-item-state text-badge-t1">연재중</span>
                    <?php } ?>
                    <span class="library__content-item-day"><?=str_replace(",", " ", $pay["pay_work"]["work_day"])?></span>
                    <span class="library__content-item-time"><?=$pay["pay_work"]["work_time"]?>시</span>
                </div>
                <p class="library__content-item-name text-truncate"><?=$pay["pay_work"]["work_name"]?></p>


                <span class="library__content-item-epsd-name text-truncate"><?=$pay["pay_epsd"]["epsd_name"]?></span>
                <span class="library__content-item-epsd-upload"><?=Converter::display_time($pay["pay_epsd"]["epsd_upload_dt"])?></span>

                <div class="library__content-item-remain-box">
                    <?php if($pay["is_expired"]){ ?>
                        <span class="library__content-item-remain-text">남은대여시간</span>
                        <span class="library__content-item-remain-text2">만료</span>
                    <?php }else{ ?>
                        <?php if($pay["is_keep"]){ ?>
                        <span class="library__content-item-remain-text"></span>
                        <?php }else{ ?>
                        <span class="library__content-item-remain-text">남은대여시간</span>
                        <?php } ?>
                        <span class="library__content-item-remain-text2"><?=$pay["pay_remain_text"]?></span>
                    <?php } ?>
                </div>

                <button type="button" class="library__content-item-check-button icon-button" data-pay="<?=$pay["pay_id"]?>">
                    <span class="icon-check icon-24 icon-inactive"></span>
                </button>
            </div> 
        </div> 
    </li>
    <?php } ?>
<?php }else{ ?>
    <?php if($page == 1){ ?>
    <li class="library__content-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default_640px.png")?>" alt="구매없음 이미지" width="240" height="240" usemap="#author" class="library__content-item-empty-img">
        <map name="author">
        <area shape="rect" coords="63,306,136,320" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="library__content-item-empty-text">구매한 작품이 없습니다.</p>
        <a href="<?=get_url(PAVE_URL)?>" class="library__content-item-empty-text">작품보러가기</a>
    </li>
    <?php } ?>
<?php } ?>
