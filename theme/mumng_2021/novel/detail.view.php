
<section id="work_modal">
<div id="work__box">
    <input type="hidden" name="work_id" id="work_id" value="<?=$work["work_id"]?>">
    <div id="work__header">
        <a href="<?=get_url(PAVE_PAGE_URL, $work_user["user_id"])?>" id="work__user">
            <img src="<?=$work_user["user_img"]?>" alt="대표작가 프로필 이미지" width="40" height="40" id="work__user-img">
            <div>
                <span id="work__user-nick" class="text-truncate"><?=$work_user["user_nick"]?></span>
                <span id="work__user-field"><?=$work_user["user_field"]?></span>
            </div>
        </a>
        <h3>작품</h3>
        <button type="button" id="work__close" class="icon-button icon-button-28"><span class="icon-x icon-28"></span></button>
    </div>
    <div id="work__content">
        <div id="work__info">
        
            <div id="work__img">
                <img src="<?=$work["work_img"]?>" alt="작품 대표 이미지">
            </div>
            <ul id="work__count">
                <li>
                    <span class="work__count-icon icon-like icon-like--active icon-16"></span>
                    <span class="work__count-text"><?=Converter::display_number_format($work_total["total_like"])?></span>
                </li>
                <li>
                    <span class="work__count-icon icon-subscribe icon-active icon-16"></span>
                    <span class="work__count-text"><?=Converter::display_number_format($work_total["total_subscribe"])?></span>
                </li>
                <li>
                    <span class="work__count-icon icon-display icon-display--active icon-16"></span>
                    <span class="work__count-text"><?=Converter::display_number_format($work_total["total_hit"])?></span>
                </li>
            </ul>
            <div id="work__info01">
                <span id="work__info-day"><?=str_replace(",", " ", $work["work_day"])?></span>
                <span id="work__info-time"><?=$work["work_time"]?>시</span>
                <span id="work__info-epsd">총 <?=Converter::display_number($work["work_epsd_cnt"], "화")?></span>
            </div>

            <div id="work__info02">
                <span id="work__info-name" class="text-truncate"><?=$work["work_name"]?></span>
                <p id="work__info-description" class="text-truncate"><?=$work["work_description"]?></p>
                <ul id="work__info-tag" class="scrollbar-macosx">
                    <?php foreach ($work_obj->get_work_genre_array() as $i => $genre) { ?>
                    <li class="work__info-tag-genre"><?=$genre?></li>
                    <?php } ?>
                    <?php foreach ($work_obj->get_work_hashtag_array() as $i => $hashtag) { ?>
                    <li class="work__info-tag-hash"><?=$hashtag?></li>
                    <?php } ?>
                </ul>
            </div>
            <div id="work__share">
                <span>SNS 공유</span>
                <ul>
                    <li><a href=""><span class="icon-instragram icon-instagram--active icon-22"></a></span></li>
                    <li><a href=""><span class="icon-facebook icon-facebook--active icon-22"></a></span></li>
                    <li><a href=""><span class="icon-twitter icon-twitter--active icon-22"></a></span></li>
                    <li><a href=""><span class="icon-naver icon-naver--active icon-22"></a></span></li>
                    <li><a href=""><span class="icon-kakao icon-kakao--active icon-22"></a></span></li>
                </ul>
            </div>
            <div id="work__license">
                <span>저작권 정보</span>
                <button type="button" id="work__penalty_button">신고</button>
            </div>
        </div>
        <div id="work__epsd">
            <ul id="work__epsd-list">
                <?php foreach ((array)$work_epsd as $i => $epsd) { ?>
                    <?php 
                        $item_css = "";
                        if($epsd["epsd_reserve"]) $item_css = "preview";
                        if($epsd["epsd_pay"]) $item_css = "";
                        if($epsd["epsd_visit"]) $item_css .= " visit"
                    ?>
                <li class="work__epsd-item <?=$item_css?>" data-epsd="<?=$epsd["epsd_id"]?>">
                    <div class="work__epsd-img">
                        <div class="work__epsd-img-overlay">
                            <span class="work__epsd-img-overlay-icon icon-preview icon-24"></span>
                        </div>
                        <img src="<?=$epsd["epsd_img"]?>" alt="회차 이미지" width="222" height="222">
                    </div>
                    <div class="work__epsd-info">
                        <div class="work__epsd-info01">
                            <span class="work__epsd-name text-truncate"><?=$epsd["epsd_name"]?></span>
                            <?php if($epsd["epsd_pay"]){ ?>
                                <span class="work__epsd-upload"><?=Converter::display_time("Y-m-d", $epsd["epsd_upload_dt"]) ?></span>
                            <?php }else{ ?>
                                <?php if($epsd["epsd_after_free"] ){ ?>
                                <span class="work__epsd-upload"><?=Converter::display_number($epsd["epsd_diff_day"] , "일 후 무료")?></span>
                                <?php }else if($epsd["epsd_after_exp"] ){ ?>
                                <span class="work__epsd-upload"><?=Converter::display_number($epsd["epsd_diff_day"] , "일 후 {$work["work_rent_exp"]} EXP") ?></span>
                                <?php }else{ ?>
                                <span class="work__epsd-upload"><?=Converter::display_time("Y-m-d", $epsd["epsd_upload_dt"]) ?></span>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="work__epsd-info02">
                            <?php if($epsd["epsd_pay"]){ ?> 
                                <?php if($epsd["epsd_is_keep"]){ ?>
                                <span class="work__epsd-keep"><?=$epsd["epsd_expire_dt"]?></span>
                                <?php }else{ ?>
                                <div class="work__epsd-rent">
                                    <span>남은대여시간</span>
                                    <span><?=$epsd["epsd_expire_dt"]?></span>
                                </div>
                                <?php } ?>
                            <?php }else{ ?>
                                <?php if($epsd["epsd_reserve"] ){ ?>
                                    <?php if($epsd["epsd_after_free"] ){ ?>
                                    <span class="work__epsd-exp"><?=Converter::display_number($work["work_preview2_exp"] , " EXP")?></span>
                                    <?php }else if($epsd["epsd_after_exp"] ){ ?>
                                    <span class="work__epsd-exp"><?=Converter::display_number($work["work_preview_exp"] , " EXP")?></span>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <?php if($work["work_rent_exp"] ){ ?>
                                    <span class="work__epsd-exp"><?=Converter::display_number($work["work_rent_exp"] , " EXP")?></span>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <span class="work__epsd-like">
                                <span class="work__epsd-like-icon icon-like icon-like--active icon-16"></span>
                                <span class="work__epsd-like-cnt"><?=Converter::display_number_format($epsd["epsd_like"])?></span>
                            </span>
                            <span class="work__epsd-hit">
                                <span class="work__epsd-hit-icon icon-display icon-display--active icon-16"></span>
                                <span class="work__epsd-hit-cnt"><?=Converter::display_number_format($epsd["epsd_hit"])?></span>
                            </span>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php if($work_epsd_pagination["total_page"] > 1){?>
            <ul id="work__epsd-pagination">
                <?php if($work_epsd_pagination["prev_page"]){ ?>
                <li><button type="button" class="work__epsd-pagination-prev" data-page="<?=$work_epsd_pagination["prev_page"]?>">이전</button></li>
                <?php } ?>
                <?php for ($i=$work_epsd_pagination["from_page"]; $i <= $work_epsd_pagination["to_page"]; $i++) { ?>
                <li><button type="button" class="work__epsd-pagination-link <?=$work_epsd_pagination["page"] == $i ? "active" : ""?>" data-page="<?=$i?>"><?=$i?></button></li>
                <?php } ?>
                <?php if($work_epsd_pagination["next_page"]){ ?>
                <li><button type="button" class="work__epsd-pagination-next" data-page="<?=$work_epsd_pagination["next_page"]?>">다음</button></li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
        <div id="work__more">
            <ul id="work__more-link">
                <li>
                    <a href="<?=get_url(PAVE_PAGE_URL, $work_user["user_id"])?>" id="work__more-page">
                        <img src="<?=$work_user["user_img"]?>" alt="대표작가 프로필 이미지" width="48" height="48">
                    </a>
                    <span>페이지</span>
                </li>
                <li>
                    <button type="button" id="work__more-subscribe" class="icon-button icon-button-48 icon-button-circle">
                        <span class="icon-subscribe <?=$work_obj->is_subscribe() ? "icon-active" : "icon-inactive" ?> icon-20"></span>
                    </button>
                    <span>구독</span>
                </li>
                <li>
                    <button type="button" id="work__more-save" class="icon-button icon-button-48 icon-button-circle">
                        <span class="icon-save icon-20"></span>
                    </button>
                    <span>저장</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    $('.scrollbar-macosx').scrollbar();
</script>
</section>