<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($creation_list)){ ?>
    <?php foreach ($creation_list as $i => $creation) { ?>
    <div class="creation-item">
        <div class="creation-item__info">
            <a href="<?=get_url(PAVE_CREATION_URL, "detail/{$creation["creation_no"]}")?>" class="creation-item__top">
                <div class="creation-item__badge">
                    <?php if($creation["creation_field"] == "commission"){ ?>
                    <button type="button" class="badge badge--t1">커미션</button>
                    <?php } ?>
                    <button type="button" class="badge badge--t1"><?=$creation["creation_ratio"]?></button>
                    <button type="button" class="badge badge--t1"><?=$creation["creation_size"]?></button>
                    <?php if($creation["creation_background"]){ ?>
                    <button type="button" class="badge badge--t3">배경화면</button>
                    <?php } ?>
                    <?php if($creation["creation_accessory"]){ ?>
                    <button type="button" class="badge badge--t3">소품</button>
                    <?php } ?>
                    <?php if($creation["creation_adult"]){ ?>
                    <button type="button" class="badge badge--t3">성인</button>
                    <?php } ?>
                </div>
        
                <p class="creation-item__name text-truncate">
                    <?=$creation["creation_name"]?>
                </p>
                <div class="creation-item__date">
                    <dl class="creation-item__date-row">
                        <dt class="creation-item__date-text">시작일</dt>
                        <dd class="creation-item__date-text2"><?=Converter::display_time($creation["creation_end_dt"])?></dd>
                    </dl>
                    <dl class="creation-item__date-row">
                        <dt class="creation-item__date-text">완료일</dt>
                        <dd class="creation-item__date-text2"><?=Converter::display_time($creation["creation_end_dt"])?></dd>
                    </dl>
                </div>
            </a>
        </div>
        <div class="creation-item__info2">
            <dl class="creation-item__info2-row">
                <dt  class="creation-item__info2-text"><span class="icon-exp icon-24"></span></dt>
                <dd  class="creation-item__info2-text2"><?=Converter::display_number($creation["creation_exp"], " EXP") ?></dd>
            </dl>
            <dl  class="creation-item__info2-row">
                <dt  class="creation-item__info2-text">모집 마감</dt>
                <dd  class="creation-item__info2-text2"><?=$creation["is_end"] ? "마감" : Converter::display_time_ago($creation["creation_end_dt"], "Y-m-d", true)?></dd>
            </dl>
            <dl  class="creation-item__info2-row">
                <dt  class="creation-item__info2-text">신청자수</dt>
                <dd  class="creation-item__info2-text2">1</dd>
            </dl>
        </div>
    </div>
    <?php } ?>
<?php }else{ ?>
    <?php if($page == 1){ ?>
    <div class="creation-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default_640px.png")?>" alt="작품없음 이미지" width="360" height="360" usemap="#author" class="creation-item-empty__img">
        <map name="author">
        <area shape="rect" coords="63,306,136,320" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="creation-item-empty__text">등록된 의뢰가 없습니다.</p>
    </div>
    <?php } ?>
<?php } ?>
