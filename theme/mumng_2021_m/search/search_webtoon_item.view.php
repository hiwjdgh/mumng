<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($search_list)){ ?>
    <?php foreach ($search_list as $i => $work) { ?>
        <?php if($work["is_block"]){ ?>
        <a href="<?=get_url(PAVE_SETTING_URL, "account/content")?>" class="webtoon-item adult-webtoon">
            <img src="<?=get_url(PAVE_IMG_URL, "img_content_block_290px.png")?>" alt="성인물 제한 이미지" width="290" height="360" class="webtoon-item__img">
        </a>
        <?php }else{ ?>
        <li class="work-detail webtoon-item" data-id="<?=$work["work_id"]?>">
            <img src="<?=$work["work_img"]?>" alt="작품 대표 이미지" width="290" height="360" class="webtoon-item__img">

            <div class="webtoon-item__info-box">
                <div class="webtoon-item__info">

                    <div class="webtoon-item__name-box">
                        <?php if($work["work_state"] == "stop"){ ?>
                        <span class="webtoon-item__state stop-badge">휴재</span>
                        <?php }else if($work["work_state"] == "end"){ ?>
                        <span class="webtoon-item__state end-badge">완결</span>
                        <?php }else{ ?>
                            <?php if($work["is_new"] ){ ?>
                            <span class="webtoon-item__state new-badge small">NEW</span>
                            <?php }else{ ?>
                                <?php if($work["is_upload"] ){ ?>
                                <span class="webtoon-item__state update-badge">UP</span>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                        <span class="webtoon-item__name text-truncate"><?=$work["work_name"]?></span>
                    </div>

                    <div class="webtoon-item__user-box">
                        <span class="webtoon-item__nick text-truncate"><?=$work["work_user"]["user_nick"]?></span>

                        <div class="webtoon-item__total-box">
                            <span class="webtoon-item__total-like">
                                <span class="webtoon-item__total-like-icon icon-like icon-like--active icon-8"></span>
                                <span class="webtoon-item__total-like-cnt"><?=Converter::display_number_format($work["work_total"]["total_like"])?></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php } ?>
    <?php } ?>

<?php }else{ ?>
    <?php if($search_page == 1){ ?>
    <li class="webtoon-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default_640px.png")?>" alt="검색없음 이미지" width="240" height="240" usemap="#author" class="webtoon-item-empty-img">
        <map name="author">
        <area shape="rect" coords="40,200,92,212" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="webtoon-item-empty-text">"<?=$search_keyword?>" 작품이 없습니다.</p>
    </li>
    <?php } ?>
<?php } ?>
