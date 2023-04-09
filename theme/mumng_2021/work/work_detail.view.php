<?php
if (!defined('_PAVE_')) exit;
?>
<div class="work_detail">
    <div class="work_detail__side">
        <div class="work_detail__side-user">
            <div class="user-dropdown user-dropdown--work-detail">
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
                                    <button type="button" class="button-t3 button-s4 follow-button" data-user="<?=$work["work_user"]["user_no"]?>">팔로우 취소</button>
                                    <?php }else{ ?>
                                    <button type="button" class="button-t1 button-s4 follow-button" data-user="<?=$work["work_user"]["user_no"]?>">팔로우</button>
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
                                    <button type="button" class="button-t3 button-s4 follow-button" data-user="<?=$with["user_no"]?>">팔로우 취소</button>
                                    <?php }else{ ?>
                                    <button type="button" class="button-t1 button-s4 follow-button" data-user="<?=$with["user_no"]?>">팔로우</button>
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
                    <div class="user-dropdown__single-box">
                        <span class="user-dropdown__single-nick text-truncate"><?=$work["work_user"]["user_nick"]?></span>
                        <span class="user-dropdown__single-field text-truncate"><?=$work["work_user"]["user_field"]?></span>
                    </div>
                </a>
                <?php } ?>
            </div>
            <?php if($work["work_user"]["is_follow_display"]){ ?>
                <?php if($work["work_user"]["is_follow"]){ ?>
                <button type="button" class="work_detail__side-nowith-follow-button button-t3 button-s4 follow-button" data-user="<?=$work["work_user"]["user_no"]?>">팔로우 취소</button>
                <?php }else{ ?>
                <button type="button" class="work_detail__side-nowith-follow-button button-t1 button-s4 follow-button" data-user="<?=$work["work_user"]["user_no"]?>">팔로우</button>
                <?php } ?>
            <?php } ?>
        </div>

        <img src="<?=$work["work_img"]?>" alt="작품 대표 이미지" class="work_detail__side-img work-detail" data-id="<?=$work["work_id"]?>">

        <div class="work_detail__side-total">
            <div class="work_detail__side-total-like">
                <span class="work_detail__side-total-like-icon icon-like icon-like--active icon-16"></span>
                <span class="work_detail__side-total-like-text"><?=Converter::display_number_format($work["work_total"]["total_like"])?></span>
            </div>
            <div class="work_detail__side-total-hit">
                <span class="work_detail__side-total-hit-icon icon-display icon-display--active icon-16"></span>
                <span class="work_detail__side-total-hit-text"><?=Converter::display_number_format($work["work_total"]["total_hit"])?></span>
            </div>
            <div class="work_detail__side-total-comment">
                <span class="work_detail__side-total-comment-icon icon-comment icon-16"></span>
                <span class="work_detail__side-total-comment-text"><?=Converter::display_number_format($work["work_total"]["total_cmt"])?></span>
            </div>
            <div class="work_detail__side-total-subscribe">
                <span class="work_detail__side-total-subscribe-icon icon-subscribe icon-active icon-16"></span>
                <span class="work_detail__side-total-subscribe-text"><?=Converter::display_number_format($work["work_total"]["total_subscribe"])?></span>
            </div>
        </div>

        <div class="work_detail__side-info">
            <span class="work_detail__side-info-day"><?=str_replace(",", " ", $work["work_day"])?></span>
            <span class="work_detail__side-info-time"><?=$work["work_time"]?>시</span>
            <span class="work_detail__side-info-epsd">총 <?=Converter::display_number($work["work_total"]["total_upload"], "화")?></span>
        </div>

        <div class="work_detail__side-info2">
            <p class="work_detail__side-info2-name"><?=$work["work_name"]?></p>
            <p class="work_detail__side-info2-description">
                <?php if (mb_strlen($work["work_description"], "UTF-8") > 50) { ?>
                <?=mb_substr($work["work_description"], 0, 50, "UTF-8")?>
                <button class="work_detail__side-info2-description-more-button" data-id="<?=$work["work_id"]?>">...더보기</button>
                <?php }else{ ?>
                <?=$work["work_description"]?>
                <?php } ?>
            <?php if($work["work_first_epsd"]){ ?>
            <button type="button" class="work_detail__side-info2-first-button epsd-detail" data-id="<?=$work["work_id"]?>" data-epsd="<?=$work["work_first_epsd"]?>">
                첫회보기 
                <span class="icon-right icon-20"></span>
            </button>
            <?php } ?>
        </div>

        <ul class="work_detail__side-tag">
            <?php foreach ((array)$work["work_genre_list"] as $i => $genre) { ?>
            <li class="work_detail__side-tag-item">
                <a href="<?=get_url(PAVE_SEARCH_URL, "hashtag/{$genre}")?>" class="work_detail__side-tag-item-genre-link" target="_blank"><?=$genre?></a>
            </li>
            <?php } ?>
            <?php foreach ((array)$work["work_hashtag_list"] as $i => $hashtag) { ?>
            <li class="work_detail__side-tag-item">
                <a href="<?=get_url(PAVE_SEARCH_URL, "hashtag/{$hashtag}")?>" class="work_detail__side-tag-item-hash-link" target="_blank"><?=$hashtag?></a>
            </li>
            <?php } ?>
        </ul>

        <div class="work_detail__side-share">
            <span class="work_detail__side-share-label">SNS 공유</span>
            <ul class="work_detail__side-share-list">
                <li class="work_detail__side-share-item">
                    <a href="<?=$work["work_share_link"]["facebook"]?>" target="_blank" class="work_detail__side-share-link">
                        <span class="icon-facebook icon-active icon-22"></span>
                    </a>
                </li>
                <li class="work_detail__side-share-item">
                    <a href="<?=$work["work_share_link"]["twitter"]?>" target="_blank" class="work_detail__side-share-link">
                        <span class="icon-twitter icon-active icon-22"></span>
                    </a>
                </li>
                <li class="work_detail__side-share-item">
                    <a href="<?=$work["work_share_link"]["naverblog"]?>" target="_blank" class="work_detail__side-share-link">
                        <span class="icon-naver icon-active icon-22"></span>
                    </a>
                </li>
                <li class="work_detail__side-share-item">
                    <a href="<?=$work["work_share_link"]["kakaostory"]?>" target="_blank" class="work_detail__side-share-link">
                        <span class="icon-kakao icon-active icon-22"></span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="work_detail__side-license">
            <span class="work_detail__side-license-label">&copy;<?=PAVE_TIME_Y?> <?=$work["work_user"]["user_nick"]?> All rights reserved</span>
            <button type="button" class="work_detail__side-license-button penalty-button" data-type="work" data-target="<?=$work["work_id"]?>">신고</button>
        </div>
    </div>

    <div class="work_detail__epsd">
        <span class="work_detail__epsd-label">작품</span>
        <ul class="work_detail__epsd-list">
            <?php if(pave_is_array($epsd_list)){ ?>
                <?php include_once($pave_theme["thm_path"]."/epsd_item.view.php"); ?>
            <?php }else { ?> 
                <?php include_once($pave_theme["thm_path"]."/epsd_item_empty.view.php"); ?>
            <?php } ?>
        </ul>

        <?php if(pave_is_array($epsd_list)){ ?>
        <?php include_once($pave_theme["thm_path"]."/epsd_pagination.view.php"); ?>
        <?php } ?>

        
    </div>
    <ul class="work_detail__fab">
        <li class="work_detail__fab-item">
            <a href="<?=$work["work_user"]["user_page_url"]?>" class="work_detail__fab-item-link" target="_blank">
                <img src="<?=$work["work_user"]["user_img"]?>" alt="대표작가 프로필 이미지" width="48" height="48" class="work_detail__fab-item-img">
            </a>
            <span class="work_detail__fab-item-text">페이지</span>
        </li>
        <li class="work_detail__fab-item">
            <button type="button" id="work__more-subscribe" class="work_detail__fab-item-subscribe-button subscribe-button icon-button icon-button-48 icon-button-circle" data-id="<?=$work["work_id"]?>">
                <?php if($work["is_subscribe"]){ ?>
                <span class="icon-subscribe icon-active icon-20"></span>
                <?php }else{ ?>
                <span class="icon-subscribe icon-inactive icon-20"></span>
                <?php } ?>
            </button>
            <span class="work_detail__fab-item-text">구독</span>
        </li>
    </ul>

</div>