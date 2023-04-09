<?php
if (!defined('_PAVE_')) exit;
?>
<div class="calendar-popup">
    <div class="calendar-popup__header">
        <span class="calendar-popup__header-icon icon-calendar icon-20"></span> 
        <h3 class="calendar-popup__header-title"><?=$calendar_date." ". $calendar_date_yoil?></h3>
        <button type="button" class="calendar-popup__header-close-button icon-button icon-button-20">
            <span class="icon-x icon-20"></span>
        </button>
    </div>

    <div class="calendar-popup__content">
        <div class="calendar-popup__work">

        </div>
        <ul class="calendar-popup__work-list">
            <?php if(pave_is_array($work_list)){ ?>
                <?php foreach ($work_list as $i => $work) { ?>
                <li class="calendar-popup__work-item">
                    <div class="calendar-popup__work-item-badge">
                        <span class="calendar-popup__work-item-badge-circle" style="background-color: <?=$work["work_color"]?>;"></span>

                        <?php if($work["epsd"]["epsd_state_text"]){ ?>
                        <span class="calendar-popup__work-item-badge-state"><?=$work["epsd"]["epsd_state_text"]?></span>
                        <?php } ?>

                        <?php if($work["epsd"]["epsd_name"]){ ?>
                        <span class="calendar-popup__work-item-badge-epsd text-truncate"><?=$work["epsd"]["epsd_name"]?></span>
                        <?php } ?>
                    </div>

                    <div class="calendar-popup__work-item-info">
                        <img src="<?=$work["work_img"]?>" alt="작품 이미지" class="calendar-popup__work-item-info-img">
                        <div class="calendar-popup__work-item-info-box">
                            <span class="calendar-popup__work-item-info-name"><?=$work["work_name"]?></span>
                            <div class="calendar-popup__work-item-info-user">
                                <div class="user-dropdown">
                                    <?php if(pave_is_array($work["work_with_user"])){ ?>
                                    <button type="button" class="user-dropdown__button dropdown-anchor" data-anchor="user-dropdown-<?=$i?>">
                                        <div class="user-dropdown__img-box">
                                            <?php for ($j=0; $j < min(2, count($work["work_with_user"])); $j++) { ?>
                                                <img src="<?=$work["work_with_user"][$j]["user_img"]?>" alt="함께한작가 프로필" class="user-dropdown__img">
                                            <?php } ?>
                                            <img src="<?=$work["work_user"]["user_img"]?>" alt="함께한작가 프로필" class="user-dropdown__img">
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
                                                            <span class="user-dropdown__item-nick text-truncate"><?=$work["work_user"]["user_nick"]?></span>
                                                            <span class="user-dropdown__item-field"><?=$work["work_user"]["user_field"]?></span>
                                                        </div>
                                                    </a>

                                                    <?php if($work["work_user"]["is_follow_display"]){ ?>
                                                        <?php if(User::is_follow_user($pave_user, $work["work_user"])){ ?>
                                                        <button type="button" class="button-t3 button-s4 follow-button" data-user="<?=$work["work_user"]["user_no"]?>">팔로우 취소</button>
                                                        <?php }else{ ?>
                                                        <button type="button" class="button-t1 button-s4 follow-button" data-user="<?=$work["work_user"]["user_no"]?>">팔로우</button>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </li>

                                                <?php foreach ($work["work_with_user"] as $j => $with) { ?>
                                                <li class="user-dropdown__item">
                                                    <a href="<?=$with["user_page_url"]?>" class="user-dropdown__item-link-box">
                                                        <img src="<?=$with["user_img"]?>" alt="대표작가 프로필" class="user-dropdown__item-img">

                                                        <div class="user-dropdown__item-nick-box">
                                                            <span class="user-dropdown__item-nick text-truncate"><?=$with["user_nick"]?></span>
                                                            <span class="user-dropdown__item-field"><?=$with["user_field"]?></span>
                                                        </div>
                                                    </a>

                                                    <?php if($with["is_follow_display"]){ ?>
                                                        <?php if(User::is_follow_user($pave_user, $with)){ ?>
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
                                        <span class="user-dropdown__single-nick text-truncate"><?=$work["work_user"]["user_nick"]?></span>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="calendar-popup__work-item-edit">
                                <div class="calendar-popup__work-item-edit-date">
                                    <?php if($work["is_own"]){ ?>
                                        <?php if($work["epsd"]["epsd_state"] == "reserve"){ ?>
                                        <span class="calendar-popup__work-item-edit-date-text">등록일</span>
                                        <span class="calendar-popup__work-item-edit-date-text2"><?=Converter::display_time($work["epsd"]["epsd_insert_dt"])?></span>
                                        <?php }else if($work["epsd"]["epsd_state"] == "save"){ ?>
                                            <span class="calendar-popup__work-item-edit-date-text">임시저장일</span>
                                            <span class="calendar-popup__work-item-edit-date-text2"><?=Converter::display_time($work["epsd"]["epsd_insert_dt"])?></span>
                                        <?php }else if($work["epsd"]["epsd_state"] == "success"){ ?>
                                        <span class="calendar-popup__work-item-edit-date-text">연재일</span>
                                        <span class="calendar-popup__work-item-edit-date-text2"><?=Converter::display_time($work["epsd"]["epsd_upload_dt"])?></span>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php if($work["epsd"]["epsd_state"]){ ?>
                                            <span class="calendar-popup__work-item-edit-date-text">최근저장일</span>
                                            <?php if($work["epsd"]["epsd_state"] == "success"){ ?>
                                            <span class="calendar-popup__work-item-edit-date-text2"><?=Converter::display_time($work["epsd"]["epsd_upload_dt"])?></span>
                                            <?php }else{ ?>
                                            <span class="calendar-popup__work-item-edit-date-text2"><?=Converter::display_time($work["epsd"]["epsd_insert_dt"])?></span>
                                            <?php } ?>
                                        <?php }?>
                                    <?php } ?>
                                </div>
                                <div class="calendar-popup__work-item-edit-box">
                                    <?php if($work["is_own"]){ ?>
                                        <?php if($work["epsd"]["epsd_id"]){ ?>
                                        <button type="button" class="upload-epsd-button button-t2 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$work["epsd"]["epsd_id"]?>" data-action="update" data-cate="<?=$work["epsd"]["epsd_cate"]?>" data-date="<?=$calendar_date?>">편집</button>
                                        <?php }else{ ?>
                                        <button type="button" class="upload-epsd-button button-t2 button-s4" data-id="<?=$work["work_id"]?>" data-action="create" data-cate="rest" data-date="<?=$calendar_date?>">휴재</button>
                                        <button type="button" class="upload-epsd-button button-t2 button-s4" data-id="<?=$work["work_id"]?>" data-action="create" data-cate="notice" data-date="<?=$calendar_date?>">공지</button>
                                        <button type="button" class="upload-epsd-button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-action="create" data-cate="epsd" data-date="<?=$calendar_date?>">연재</button>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <div class="tooltip-box">
                                            <span class="tooltip-box__icon icon-help icon-12"></span>
                                            <div class="tooltip-box__content">작품 연재/공지/휴재는 대표작가만 등록이 가능합니다.</div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php } ?>
            <?php }else{ console(Converter::display_time_elapse($calendar_date, PAVE_TIME_YMD)); ?>
                <?php if(Converter::display_time_elapse($calendar_date, PAVE_TIME_YMD) < 0){ ?>
                <li class="calendar-popup__work-item-past">
                    <span class="calendar-popup__work-item-past-text">해당 날짜에는 더이상<br>연재할수 있는 작품이 없습니다.</span>
                </li>
                <?php }else{ ?>
                <li class="calendar-popup__work-item-empty">
                    <a href="<?=get_url(PAVE_UPLOAD_URL, "work/form")?>" class="work-upload-button button button--vertical">
                        <span class="button__icon icon-24 icon-plus"></span>
                        <span class="calendar-popup__work-item-empty-text button__text">작품을 등록하고<br>연재를 시작하세요 !</span>
                    </a>
                </li>
                <?php } ?>
            <?php } ?>
        </ul>
        <div class="calendar-popup__memo">
            <input type="hidden" name="calendar_date" id="calendar_date" value="<?=$calendar_date?>">
            <textarea name="calendar_memo" id="calendar_memo" class="calendar-popup__memo-input" cols="30" rows="10" placeholder="메모(400자 이내)"><?=$memo["calendar_memo"]?></textarea>
        </div>
    </div>
</div>