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
                <span class="webtoon-item__epsd">총 <?=$work["work_epsd_cnt"]?>화</span>

                <div class="webtoon-item__name-box">
                    <?php if($work["work_state"] == "stop"){ ?>
                    <span class="webtoon-item__state stop-badge">휴재</span>
                    <?php }else if($work["work_state"] == "end"){ ?>
                    <span class="webtoon-item__state end-badge">완결</span>
                    <?php }else{ ?>
                        <?php if($work["is_new"] ){ ?>
                        <span class="webtoon-item__state new-badge">NEW</span>
                        <?php }else{ ?>
                            <?php if($work["is_upload"] ){ ?>
                            <span class="webtoon-item__state update-badge">UP</span>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <span class="webtoon-item__name text-truncate"><?=$work["work_name"]?></span>
                </div>

                <div class="webtoon-item__user-box">
                    <div class="user-dropdown">
                        <?php if(pave_is_array($work["work_with_user"])){ ?>
                        <button type="button" class="user-dropdown__button dropdown-anchor" data-anchor="user-dropdown-<?=$i?>">
                            <div class="user-dropdown__img-box">
                                <?php for ($j=0; $j < min(2, count($work["work_with_user"])); $j++) { ?>
                                    <img src="<?=$work["work_with_user"][$j]["user_img"]?>" alt="함께한작가 프로필" class="user-dropdown__img">
                                <?php } ?>
                            </div>
                            <span class="user-dropdown__text">여러작가</span>
                            <span class="user-dropdown__icon icon-arrow icon-10"></span>
                        </button>
                        <div class="dropdown-box user-dropdown-<?=$i?>">
                            <div class="user-dropdown__content dropdown-box__dropdown">
                                <ul class="user-dropdown__list">
                                    <li class="user-dropdown__item">
                                        <a href="<?=$work["work_user"]["user_page_url"]?>" class="user-dropdown__item-link-box">
                                            <img src="<?=$work["work_user"]["user_img"]?>" alt="대표작가 프로필" class="user-dropdown__item-img">

                                            <div class="user-dropdown__item-nick-box">
                                                <span class="user-dropdown__item-nick text-truncate"><a href="<?=$work["work_user"]["user_page_url"]?>"><?=$work["work_user"]["user_nick"]?></a></span>
                                                <span class="user-dropdown__item-field"><?=$work["work_user"]["user_field"]?></span>
                                            </div>
                                        </a>

                                        <?php if($work["work_user"]["is_follow_display"]){ ?>
                                            <?php if($work["work_user"]["is_follow"]){ ?>
                                            <button type="button" class="button-t3 button-s4 follow-button" data-user="<?=$work["work_user"]["user_code"]?>">팔로우 취소</button>
                                            <?php }else{ ?>
                                            <button type="button" class="button-t1 button-s4 follow-button" data-user="<?=$work["work_user"]["user_code"]?>">팔로우</button>
                                            <?php } ?>
                                        <?php } ?>
                                    </li>

                                    <?php foreach ($work["work_with_user"] as $j => $with) { ?>
                                    <li class="user-dropdown__item">
                                        <a href="<?=$with["work_user"]["user_page_url"]?>" class="user-dropdown__item-link-box">
                                            <img src="<?=$with["work_user"]["user_img"]?>" alt="대표작가 프로필" class="user-dropdown__item-img">

                                            <div class="user-dropdown__item-nick-box">
                                                <span class="user-dropdown__item-nick text-truncate"><a href="<?=$with["user_page_url"]?>"><?=$with["user_nick"]?></a></span>
                                                <span class="user-dropdown__item-field"><?=$with["user_field"]?></span>
                                            </div>
                                        </a>

                                        <?php if($with["is_follow_display"]){ ?>
                                            <?php if($with["is_follow"]){ ?>
                                            <button type="button" class="button-t3 button-s4 follow-button" data-user="<?=$with["user_code"]?>">팔로우 취소</button>
                                            <?php }else{ ?>
                                            <button type="button" class="button-t1 button-s4 follow-button" data-user="<?=$with["user_code"]?>">팔로우</button>
                                            <?php } ?>
                                        <?php } ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <a href="<?=$work["work_user"]["user_page_url"]?>" class="user-dropdown__single">
                            <img src="<?=$work["work_user"]["user_img"]?>" alt="대표작가 프로필" class="user-dropdown__single-img">
                            <span class="user-dropdown__single-nick text-truncate"><?=$work["work_user"]["user_nick"]?></span>
                        </a>
                        <?php } ?>
                    </div>

                    <div class="webtoon-item__total-box">
                        <span class="webtoon-item__total-like">
                            <span class="webtoon-item__total-like-icon icon-like icon-like--active icon-16"></span>
                            <span class="webtoon-item__total-like-cnt"><?=Converter::display_number_format($work["work_total"]["total_like"])?></span>
                        </span>
                        <span class="webtoon-item__total-hit">
                            <span class="webtoon-item__total-hit-icon icon-display icon-display--active icon-16"></span>
                            <span class="webtoon-item__total-hit-cnt"><?=Converter::display_number_format($work["work_total"]["total_hit"])?></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <?php } ?>
<?php } ?>
<?php }else{ ?>
    <?php if($page == 1){ ?>
    <li class="webtoon-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default_640px.png")?>" alt="검색없음 이미지" width="360" height="360" usemap="#author" class="webtoon-item-empty-img">
        <map name="author">
        <area shape="rect" coords="63,306,136,320" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="webtoon-item-empty-text">"<?=$search_keyword?>" 작품이 없습니다.</p>
    </li>
    <?php } ?>
<?php } ?>