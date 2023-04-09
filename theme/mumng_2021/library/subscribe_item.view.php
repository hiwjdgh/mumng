<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($work_list)){ ?>
    <?php foreach ($work_list as $i => $subscribe) { ?>
    <li class="library__content-item work-detail" data-id="<?=$subscribe["subscribe_work"]["work_id"]?>">
        <div class="library__content-item-box">
            <div class="library__content-img">
                <img src="<?=$subscribe["subscribe_work"]["work_img"]?>" alt="구독작품 이미지" width="123" height="143">
            </div>
            <div class="library__content-info">
                <div class="library__content-state-box">
                    <?php if($subscribe["subscribe_work"]["work_state"] == "stop"){ ?>
                    <span class="library__content-state text-badge-t2">휴재</span>
                    <?php }else if($subscribe["subscribe_work"]["work_state"] == "end"){ ?>
                    <span class="library__content-state text-badge-t3">완결</span>
                    <?php }else{ ?>
                    <span class="library__content-state text-badge-t1">연재중</span>
                    <?php } ?>
                    
                    <span class="library__content-group">웹툰</span>
                    <span class="library__content-day"><?=str_replace(",", " ", $subscribe["subscribe_work"]["work_day"])?></span>
                    <span class="library__content-time"><?=$subscribe["subscribe_work"]["work_time"]?>시</span>
                </div>
                <p class="library__content-name"><?=$subscribe["subscribe_work"]["work_name"]?></p>
                <div class="library__content-user-box">
                    <div class="user-dropdown">
                        <?php if(pave_is_array($subscribe["subscribe_work"]["work_with_user"])){ ?>
                        <button type="button" class="user-dropdown__button dropdown-anchor" data-anchor="user-dropdown-<?=$i?>">
                            <div class="user-dropdown__img-box">
                                <?php for ($j=0; $j < min(2, count($subscribe["subscribe_work"]["work_with_user"])); $j++) { ?>
                                    <img src="<?=$subscribe["subscribe_work"]["work_with_user"][$j]["user_img"]?>" alt="함께한작가 프로필" class="user-dropdown__img">
                                <?php } ?>
                            </div>
                            <span class="user-dropdown__text">여러작가</span>
                            <span class="user-dropdown__icon icon-arrow icon-10"></span>
                        </button>
                        <div class="dropdown-box user-dropdown-<?=$i?>">
                            <div class="user-dropdown__content dropdown-box__dropdown">
                                <ul class="user-dropdown__list">
                                    <li class="user-dropdown__item">
                                        <a href="<?=$subscribe["subscribe_work"]["work_user"]["user_page_url"]?>" class="user-dropdown__item-link-box">
                                            <img src="<?=$subscribe["subscribe_work"]["work_user"]["user_img"]?>" alt="대표작가 프로필" class="user-dropdown__item-img">

                                            <div class="user-dropdown__item-nick-box">
                                                <span class="user-dropdown__item-nick text-truncate"><a href="<?=$subscribe["subscribe_work"]["work_user"]["user_page_url"]?>"><?=$subscribe["subscribe_work"]["work_user"]["user_nick"]?></a></span>
                                                <span class="user-dropdown__item-field"><?=$subscribe["subscribe_work"]["work_user"]["user_field"]?></span>
                                            </div>
                                        </a>

                                        <?php if($subscribe["subscribe_work"]["work_user"]["is_follow_display"]){ ?>
                                            <?php if($subscribe["subscribe_work"]["work_user"]["is_follow"]){ ?>
                                            <button type="button" class="button-t3 button-s4 follow-button" data-user="<?=$subscribe["subscribe_work"]["work_user"]["user_no"]?>">팔로우 취소</button>
                                            <?php }else{ ?>
                                            <button type="button" class="button-t1 button-s4 follow-button" data-user="<?=$subscribe["subscribe_work"]["work_user"]["user_no"]?>">팔로우</button>
                                            <?php } ?>
                                        <?php } ?>
                                    </li>

                                    <?php foreach ($subscribe["subscribe_work"]["work_with_user"] as $j => $with) { ?>
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
                        <a href="<?=$subscribe["subscribe_work"]["work_user"]["user_page_url"]?>" class="user-dropdown__single">
                            <img src="<?=$subscribe["subscribe_work"]["work_user"]["user_img"]?>" alt="대표작가 프로필" class="user-dropdown__single-img">
                            <span class="user-dropdown__single-nick text-truncate"><?=$subscribe["subscribe_work"]["work_user"]["user_nick"]?></span>
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <?php if($subscribe["subscribe_latest_epsd"]){ ?>
                <span class="library__content-epsd-name"><?=$subscribe["subscribe_latest_epsd"]["epsd_name"]?></span>
                <span class="library__content-epsd-upload"><?=Converter::display_time($subscribe["subscribe_latest_epsd"]["epsd_upload_dt"], "Y-m-d")?></span>
                <?php } ?>
                <button type="button" class="library__content-more-button helper__button" data-anchor="subscribe_more_<?=$i?>">
                    <span class="icon-more icon-24"></span>
                </button>

                <div class="helper" data-target="subscribe_more_<?=$i?>">
                    <div class="helper__container">
                        <div id="helper__more-box" class="helper__action-box">
                            <button type="button" class="helper__action-button clipboard-button" data-url="<?=$subscribe["subscribe_work"]["work_url"]?>">링크복사</button>
                            <a href="<?=$subscribe["subscribe_work"]["work_user"]["user_page_url"]?>" class="helper__action-button" target="_blank">페이지</a>
                        </div>
                        <div class="helper__close-box">
                            <button type="button" class="helper__close-button" data-anchor="subscribe_more_<?=$i?>">취소</button>
                        </div>
                    </div>
                </div>
            
                <?php if($subscribe["subscribe_work_new_epsd"] > 0){ ?>
                <div class="library__content-new-box">
                    <span class="library__content-new-text">새로운회차</span>
                    <span class="library__content-new-cnt"><?=Converter::display_number($subscribe["subscribe_work_new_epsd"], "개")?></span>
                </div>
                <?php } ?>
            </div> 
        </div>
        <button type="button" class="library__content-notify-button icon-button icon-button-circle icon-button-48" data-subscribe="<?=$subscribe["subscribe_no"]?>">
            <?php if($subscribe["subscribe_notify"]){ ?>
            <span class="icon-alarm icon-alarm--active icon-20"></span>
            <?php }else{ ?>
            <span class="icon-alarm icon-alarm--inactive icon-20"></span>
            <?php } ?>
        </button>
        <button type="button" class="library__content-del-button icon-button icon-button-circle icon-button-48" data-id="<?=$subscribe["subscribe_work"]["work_id"]?>">
            <span class="icon-x icon-20"></span>
        </button>
    </li>
    <?php } ?>
<?php }else{ ?>
    <?php if($page == 1){ ?>
    <li class="library__content-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_subscribe_640px.png")?>" alt="구독없음 이미지" width="360" height="360" usemap="#author" class="library__content-item-empty-img">
        <map name="author">
        <area shape="rect" coords="224,207,289,237" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="library__content-item-empty-text">구독한 작품이 없습니다.</p>
        <a href="<?=get_url(PAVE_URL)?>" class="library__content-item-empty-text">작품보러가기</a>
    </li>
    <?php } ?>
<?php } ?>
