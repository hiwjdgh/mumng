<?php
if (!defined('_PAVE_')) exit;
?>
<div class="epsd_detail">
    <div class="epsd_detail__header">
        <div class="epsd_detail__header-box">
            <p class="epsd_detail__header-work"><?=$work["work_name"]?></p>
            <div class="epsd_detail__header-inner-box">
                <span class="epsd_detail__header-epsd"><?=$epsd["epsd_name"]?></span>
                <span class="epsd_detail__header-date"><?=$epsd["epsd_upload_dt_text"]?></span> 
                <div class="epsd_detail__header-like">
                    <span class="epsd_detail__header-like-icon icon-like icon-like--active icon-16"></span>
                    <span class="epsd_detail__header-like-text" ><?=Converter::display_number_format($epsd["epsd_like"])?></span>
                </div>
                <div class="epsd_detail__header-hit">
                    <span class="epsd_detail__header-hit-icon icon-display icon-display--active icon-16"></span>
                    <span class="epsd_detail__header-hit-text"><?=Converter::display_number_format($epsd["epsd_hit"])?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="epsd_detail__box">

        <div class="epsd_detail__copy">
            <img src="<?=$work["work_age_img"]?>" alt="연령제한 이미지">
            <?=$epsd["epsd_content"]?>
        </div>

        <ul class="epsd_detail__action">
            <li class="epsd_detail__action-item">
                <button type="button" id="epsd__more-share" class="epsd_detail__action-item-share-button clipboard-button icon-button icon-button-48 icon-button-circle" data-url="<?=$epsd["epsd_url"]?>">
                    <span class="icon-share icon-20"></span>
                </button>
                <span class="epsd_detail__action-item-text">공유</span>
            </li>
            <li class="epsd_detail__action-item">
                <button type="button" id="epsd__more-subscribe" class="epsd_detail__action-item-subscribe-button subscribe-button icon-button icon-button-48 icon-button-circle" data-id="<?=$work["work_id"]?>">
                    <?php if($work["is_subscribe"]){ ?>
                    <span class="icon-subscribe icon-active icon-20"></span>
                    <?php }else{ ?>
                    <span class="icon-subscribe icon-inactive icon-20"></span>
                    <?php } ?>
                </button>
                <span class="epsd_detail__action-item-text">구독</span>

            </li>
            <li class="epsd_detail__action-item">
                <button type="button" id="epsd__more-like" class="epsd_detail__action-item-like-button epsd-like-button icon-button icon-button-48 icon-button-circle" data-epsd="<?=$epsd["epsd_id"]?>">
                    <?php if($epsd["is_like"]){ ?>
                    <span class="icon-like icon-like--active icon-20"></span>
                    <?php }else{ ?>
                    <span class="icon-like icon-like--inactive icon-20"></span>
                    <?php } ?>
                </button>
                <span class="epsd_detail__action-item-text">좋아요</span>
            </li>
        </ul>
        
        <div class="epsd_detail__eplg">
            <span class="epsd_detail__eplg-label">작가 에필로그</span>
            <p class="epsd_detail__eplg-content"><?=nl2br($epsd["epsd_eplg"])?></p>
        </div>

        <div class="epsd_detail__preview">
            <div class="epsd_detail__preview-inner-box">
                <span class="epsd_detail__preview-label">회차목록</span>
                <button type="button" class="epsd_detail__preview-first-button epsd-detail" data-id="<?=$work["work_id"]?>" data-epsd="<?=$work["work_first_epsd"]?>">첫회보기</button>
                <button type="button" class="epsd_detail__preview-main-button work-detail" data-id="<?=$work["work_id"]?>">작품메인</button>
            </div>

            <div class="epsd_detail__preview-box swiper-container">
                <ul class="epsd_detail__preview-list swiper-wrapper">
                    <?php if(pave_is_array($epsd_list)){ ?>
                        <?php foreach (array_reverse($epsd_list) as $i => $preview) { ?> 
                        <li class="epsd-item2 epsd-detail swiper-slide <?=!$preview["is_hit"] ? "visit" : "" ?> <?=$preview["epsd_id"] == $epsd["epsd_id"] ? "current" : "" ?>" data-id="<?=$preview["work_id"]?>" data-epsd="<?=$preview["epsd_id"]?>">
                            <div class="epsd-item2__box">
                                <div class="epsd-item2__img-box">
                                    <img src="<?=$preview["epsd_img"]?>" alt="회차 이미지" class="epsd-item2__img">
                                    <?php if($preview["is_preview"]){ ?>
                                    <div class="epsd-item2__preview-box">
                                        <span class="epsd-item2__preview-icon icon-preview icon-24"></span>
                                    </div>
                                    <?php }else{ ?>
                                    <?php if(!$preview["is_hit"]){ ?>
                                    <div class="epsd-item2__visit-box"></div>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                                <div class="epsd-item2__info-box">
                                    <p class="epsd-item2__name text-truncate"><?=$preview["epsd_name"]?></p>
                                </div>
                            </div>

                        </li>
                        <?php } ?>
                        <?php for ($i; $i < 4; $i++) { ?>
                        <li class="epsd-item2 swiper-slide">
                            <div class="epsd-item2__box"></div>
                        </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <button type="button" class="epsd_detail__preview-prev-button icon-button icon-button-36">
                    <span class="icon-36 icon-left-circle"></span>
                </button>
                <button type="button" class="epsd_detail__preview-next-button icon-button icon-button-36">
                    <span class="icon-36 icon-right-circle"></span>
                </button>
                <script>
                var epsd_preview_swiper = new Swiper('.epsd_detail__preview-box',{
                    slidesPerView: "5",
                    spaceBetween: 20,
                    navigation: {
                    nextEl: ".epsd_detail__preview-next-button",
                    prevEl: ".epsd_detail__preview-prev-button",
                    },
                    on:{
                        "slideChange": function(info){
                            if(info.slides.length > 5) {
                                if(info.isEnd){
                                    $(".epsd_detail__preview-next-button").hide();
                                }else{
                                    $(".epsd_detail__preview-next-button").show();
                                }
                                if(info.isBeginning){
                                    $(".epsd_detail__preview-prev-button").hide();
                                }else{
                                    $(".epsd_detail__preview-prev-button").show();
                                }
                            }
                        
                        },
                        "update": function(info){
                            if(info.slides.length > 5) {
                                if(info.isEnd){
                                    $(".epsd_detail__preview-next-button").hide();
                                }else{
                                    $(".epsd_detail__preview-next-button").show();
                                }
                                if(info.isBeginning){
                                    $(".epsd_detail__preview-prev-button").hide();
                                }else{
                                    $(".epsd_detail__preview-prev-button").show();
                                }
                            }else{
                                $(".epsd_detail__preview-prev-button").hide();
                                $(".epsd_detail__preview-next-button").hide();
                            }
                        }
                    }
                    
                });
                </script>
            </div>
        </div>

        <div class="epsd_detail__footer">
            <div class="epsd_detail__footer-left">
                <div class="epsd_detail__info">
                    <span class="epsd_detail__info-work"><?=$work["work_name"]?></span>
                    <p class="epsd_detail__info-epsd"><?=$epsd["epsd_name"]?></p>
                    <span class="epsd_detail__info-upload"><?=$epsd["epsd_upload_dt_text"]?></span>
                    <div class="epsd_detail__info-total">
                        <div class="epsd_detail__info-total-like">
                            <span class="epsd_detail__info-total-like-icon icon-like icon-like--active icon-16"></span>
                            <span class="epsd_detail__info-total-like-cnt"><?=Converter::display_number_format($epsd["epsd_like"])?></span>
                        </div>
                        <div class="epsd_detail__info-total-hit">
                            <span class="epsd_detail__info-total-hit-icon icon-display icon-display--active icon-16"></span>
                            <span class="epsd_detail__info-total-hit-cnt"><?=Converter::display_number_format($epsd["epsd_hit"])?></span>
                        </div>
                        <div class="epsd_detail__info-total-cmt">
                            <span class="epsd_detail__info-total-cmt-icon icon-comment icon-16"></span>
                            <span class="epsd_detail__info-total-cmt-cnt"><?=Converter::display_number_format($epsd["epsd_cmt"])?></span>
                        </div>
                    </div>
                </div>

                <div class="epsd_detail__user">
                    <span class="epsd_detail__user-label">작가</span>
                    <ul class="epsd_detail__user-list">
                        <li class="epsd_detail__user-item">
                            <a href="<?=$work["work_user"]["user_page_url"]?>" target="_blank" class="epsd_detail__user-item-link">
                                <img src="<?=$work["work_user"]["user_img"]?>" alt="대표작가 프로필" width="32" height="32" class="epsd_detail__user-item-img">
                                <div class="epsd_detail__user-item-inner-box">
                                    <span class="epsd_detail__user-item-nick text-truncate"><?=$work["work_user"]["user_nick"]?></span>
                                    <span class="epsd_detail__user-item-field"><?=$work["work_user"]["user_field"]?></span>
                                </div>
                            </a>
                            <?php if($work["work_user"]["is_follow_display"]){ ?>
                                <?php if($work["work_user"]["is_follow"]){ ?>
                                <button type="button" class="epsd_detail__user-item-follow-button button-t3 button-s4 follow-button" data-user="<?=$work["work_user"]["user_code"]?>">팔로우 취소</button>
                                <?php }else{ ?> 
                                <button type="button" class="epsd_detail__user-item-follow-button button-t1 button-s4 follow-button" data-user="<?=$work["work_user"]["user_code"]?>">팔로우</button>
                                <?php } ?>
                            <?php } ?>
                        </li>
                        <?php foreach ((array)$work["work_with_user"] as $i => $with) { ?>
                        <li class="epsd_detail__user-item">
                            <a href="<?=$with["user_page_url"]?>" target="_blank" class="epsd_detail__user-item-link">
                                <img src="<?=$with["user_img"]?>" alt="함께한작가 프로필" width="32" height="32" class="epsd_detail__user-item-img">
                                <div class="epsd_detail__user-item-inner-box">
                                    <span class="epsd_detail__user-item-nick text-truncate"><?=$with["user_nick"]?></span>
                                    <span class="epsd_detail__user-item-field"><?=$with["user_field"]?></span>
                                </div>
                            </a>
                            <?php if($with["is_follow_display"]){ ?>
                                <?php if($with["is_follow"]){ ?>
                                <button type="button" class="epsd_detail__user-item-follow-button button-t3 button-s4 follow-button" data-user="<?=$with["user_code"]?>">팔로우 취소</button>
                                <?php }else{ ?> 
                                <button type="button" class="epsd_detail__user-item-follow-button button-t1 button-s4 follow-button" data-user="<?=$with["user_code"]?>">팔로우</button>
                                <?php } ?>
                            <?php } ?>
                        </li>
                        <?php } ?>
                    </ul>
                </div>

                <ul class="epsd_detail__tag">
                    <?php foreach ($work["work_genre_list"] as $i => $genre) { ?>
                    <li class="epsd_detail__tag-item">
                        <a href="<?=get_url(PAVE_SEARCH_URL, "hashtag/{$genre}")?>" class="epsd_detail__tag-item-genre-link" target="_blank"><?=$genre?></a>
                    </li>
                    <?php } ?>
                    <?php foreach ($work["work_hashtag_list"] as $i => $hashtag) { ?>
                    <li class="epsd_detail__tag-item">
                        <a href="<?=get_url(PAVE_SEARCH_URL, "hashtag/{$hashtag}")?>" class="epsd_detail__tag-item-hash-link" target="_blank"><?=$hashtag?></a>
                    </li>
                    <?php } ?>
                </ul>
                <div class="epsd_detail__license">
                    <span class="epsd_detail__license-label">&copy;<?=PAVE_TIME_Y?> <?=$work["work_user"]["user_nick"]?> All rights reserved</span>
                    <button type="button" class="epsd_detail__license-penalty-button penalty-button" data-type="epsd" data-target="<?=$epsd["epsd_id"]?>">신고</button>
                </div>
                <div class="epsd_detail__ad mumng-ad">
                    <img src="<?=get_url(PAVE_IMG_URL, "img_page_ad_376px.png")?>" alt="무명 페이지 내부 광고 이미지">
                </div>
            </div>

            <div class="epsd_detail__footer-right">
                <div class="epsd_detail__cmt">
                    <div class="epsd_detail__cmt-header">
                        <span class="epsd_detail__cmt-header-label">의견</span>
                        <span class="epsd_detail__cmt-header-cnt">총 <?=Converter::display_number($epsd["epsd_cmt"], "개")?></span>
                    </div>
                    
                    <div class="epsd_detail__cmt-type">
                        <button type="button" class="epsd_detail__cmt-type-button current" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="best">BEST의견</button>
                        <button type="button" class="epsd_detail__cmt-type-button" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="all">전체의견</button>
                    </div>

                    <?php if($is_user){ ?>
                    <form id="epsd-comment__form" class="epsd_detail__cmt-form" novalidate autocomplete="off">
                        <legend class="skip">의견정보</legend>
                        <input type="hidden" name="work_id" id="work_id" value="<?=$work["work_id"]?>">
                        <input type="hidden" name="epsd_id" id="epsd_id" value="<?=$epsd["epsd_id"]?>">
                        <input type="hidden" name="comment_parent_no" id="comment_parent_no" value="">
                        <input type="hidden" name="comment_mention" id="comment_mention" value="">

                        <div class="epsd_detail__cmt-form-inner-box">
                            <div class="epsd_detail__cmt-form-user">
                                <a href="<?=$pave_user["user_page_url"]?>" class="epsd_detail__cmt-form-user-link">
                                    <img src="<?=$pave_user["user_img"]?>" alt="프로필 이미지" width="32" height="32" class="epsd_detail__cmt-form-user-img">
                                </a>
                            </div>
                            <div class="epsd_detail__cmt-form-content textarea-box">
                                <textarea name="comment_content" id="comment_content" class="textarea-box__textarea" placeholder="의견을 입력해주세요." maxlength="500"></textarea>
                                <div class="textarea-box__counter">
                                    <span class="textarea-box__counter-now">0</span>
                                    <span class="textarea-box__counter-max">/ 500자</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="epsd_detail__cmt-form-submit-button button-t2 button-s2">의견쓰기</button>
                    </form>
                    <?php }else{ ?>
                    <div class="epsd_detail__cmt-login">
                        <div class="epsd_detail__cmt-login-inner-box">
                            <a href="<?=get_url(PAVE_ACCOUNT_URL, "login")?>" class="button-t1 button-s2">로그인</a>
                        </div>
                    </div>
                    <?php } ?>

                    <ul class="epsd_detail__cmt-list">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <ul class="epsd_detail__fab">
        <li class="epsd_detail__fab-item">
            <button type="button" class="epsd_detail__fab-item-prev-button epsd-detail" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>">
                <span class="icon-left-circle icon-36"></span>
            </button>
        </li>
        <li class="epsd_detail__fab-item">
            <button type="button" class="epsd_detail__fab-item-cmt-button">
                <span class="icon-comment-circle icon-36"></span>
            </button>
        </li>
        <li class="epsd_detail__fab-item">
            <button type="button" class="epsd_detail__fab-item-preview-button">
                <span class="icon-hamburger-circle icon-36"></span>
            </button>
        </li>
        <li class="epsd_detail__fab-item">
            <button type="button" class="epsd_detail__fab-item-next-button epsd-detail" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>">
                <span class="icon-right-circle icon-36"></span>
            </button>
        </li>
    </ul>
</div>