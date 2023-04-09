<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals work_detail_modal" data-target="work_detail_modal">
    <div class="modals__box">
        <div class="modals__content">
            <div class="work_detail">
                <div class="work_detail__header">
                    <div class="work_detail__header-container">
                        <a href="javascript:window.history.back();" class="icon-button icon-button-24">
                            <span class="icon-back icon-24"></span>
                        </a>
            
                        <ul class="header__gnb">
                            <li class="header__gnb-item">
                                <a href="<?=get_url(PAVE_NOTIFY_URL, "list")?>" class="header__gnb-item-link">
                                    <span class="header__gnb-item-link-icon icon-notify icon-24 <?=defined("__NOTIFY__") ? "icon-active" : "icon-inactive"?>"></span>
                                </a>
                            </li>
                            <li class="header__gnb-item">
                                <?php if($is_user){ ?>
                                <a href="<?=$pave_user["user_page_url"]?>" class="header__gnb-item-link">
                                    <img src="<?=$pave_user["user_img"]?>" alt="프로필이미지" class="header__gnb-item-link-img" width="24" height="24">
                                </a>
                                <?php }else{ ?>
                                <a href="<?=get_url(PAVE_ACCOUNT_URL, "login")?>" class="header__gnb-item-link">
                                    <span class="header__gnb-item-link-icon icon-page icon-24 icon-inactive"></span>
                                </a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
            
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
            
                    <img src="<?=$work["work_img"]?>" alt="작품 대표 이미지" width="290" height="360" class="work_detail__side-img" >
            
                    <div class="work_detail__side-total">
                        <p class="work_detail__side-total-like">
                            <span class="work_detail__side-total-like-text"><?=Converter::display_number_format($work["work_total"]["total_like"], "명")?></span>
                            이 작품을 좋아합니다.
                        </p>
                        <div class="work_detail__side-total-action">
                            <button type="button" class="share-button icon-button icon-button-20" data-id="<?=$work["work_id"]?>">
                                <span class="icon-share icon-20"></span>
                            </button>
                
                            <button type="button" class="subscribe-button icon-button icon-button-20" data-id="<?=$work["work_id"]?>">
                                <?php if($work["is_subscribe"]){ ?>
                                <span class="icon-subscribe icon-active icon-20"></span>
                                <?php }else{ ?>
                                <span class="icon-subscribe icon-inactive icon-20"></span>
                                <?php } ?>
                            </button>
                        </div>
                    </div>
            
                    <div class="work_detail__side-info">
                        <span class="work_detail__side-info-day"><?=str_replace(",", " ",   $work["work_day"])?></span>
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
                        </p>
                        <?php if($work["work_first_epsd"]){ ?>
                        <button type="button" class="work_detail__side-info2-first-button button-s1 button-t2 epsd-detail" data-id="<?=$work["work_id"]?>" data-epsd="<?=$work["work_first_epsd"]?>">
                            첫회보기 
                        </button>
                        <?php } ?>
                    </div>
                </div>
            
                <div class="work_detail__epsd">
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
            </div>
        </div>
    </div>
</div>