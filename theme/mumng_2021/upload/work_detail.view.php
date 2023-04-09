<?php
if (!defined('_PAVE_')) exit;
?>
<div class="upload__info">
    <div class="upload__info-state-box">
        <?php if($work["work_display"]) { ?>
            <?php if($work["work_state"] == "publish") { ?>
            <span class="upload__info-state text-badge-t1">연재중</span>
            <?php }else if($work["work_state"] == "end") { ?>
            <span class="upload__info-state text-badge-t1">완결</span>
            <?php }else if($work["work_state"] == "stop") { ?>
            <span class="upload__info-state text-badge-t1">휴재</span>
            <?php } ?>
        <?php }else { ?>
            <span class="upload__info-state text-badge-t2">비공개</span>
        <?php } ?>

        <span class="upload__info-group">웹툰</span>
        <span class="upload__info-day"><?=str_replace(",", " ", $work["work_day"])?></span>
        <span class="upload__info-time"><?=$work["work_time"]?>시</span>
        <?php if($work["is_own"]) { ?>
        <div class="upload__info-color">
            <input type="color" id="work_color" class="upload__info-color-input" value="<?=$work["work_color"]?>" data-id="<?=$work["work_id"]?>">
            <label for="work_color" class="upload__info-color-label">색상변경</label>
        </div>
        <?php } ?>
    </div>
    <p class="upload__info-name"><?=$work["work_name"]?></p>

    <div class="upload__info-user">
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

    <div class="upload__info-exp-box">
        <?php if($work["work_user"]["user_commerce"]) { ?>
            <div class="upload__info-exp">
                <span class="upload__info-exp-text">미리보기</span>
                <?php if($work["work_free"]) { ?>
                <span class="upload__info-exp-text2"><?=Converter::display_number($work["work_preview2_exp"], "EXP")?></span>
                <?php }else { ?>
                <span class="upload__info-exp-text2"><?=Converter::display_number($work["work_preview_exp"], "EXP")?></span>
                <?php } ?>
            </div>
            <?php if(!$work["work_free"]) { ?>
            <div class="upload__info-exp">
                <span class="upload__info-exp-text">대여</span>
                <span class="upload__info-exp-text2"><?=Converter::display_number($work["work_rent_exp"], "EXP")?></span>
            </div>
            <?php } ?>

            <div class="upload__info-exp">
                <span class="upload__info-exp-text">소장</span>
                <?php if($work["work_free"]) { ?>
                <span class="upload__info-exp-text2"><?=Converter::display_number($work["work_keep2_exp"], "EXP")?></span>
                <?php }else { ?>
                <span class="upload__info-exp-text2"><?=Converter::display_number($work["work_keep_exp"], "EXP")?></span>
                <?php } ?>
            </div>

            <?php if($work["work_state"] == "end") { ?>
            <div class="upload__info-exp">
                <span class="upload__info-exp-text">완결소장</span>
                <?php if($work["work_free"]) { ?>
                <span class="upload__info-exp-text2"><?=Converter::display_number($work["work_end2_exp"], "EXP")?></span>
                <?php }else { ?>
                <span class="upload__info-exp-text2"><?=Converter::display_number($work["work_end_exp"], "EXP")?></span>
                <?php } ?>
            </div>
            <?php } ?>
        <?php }else { ?>
            <div class="upload__info-exp">
                <span class="upload__info-exp-text">무료 작품</span>
            </div>
        <?php } ?>
    </div>
</div>
<div class="upload__epsd">
    <div class="upload__epsd-header">
        <h3 class="upload__epsd-title">등록된 회차</h3>
        <span class="upload__epsd-title2">총 <?=Converter::display_number($work["work_epsd_cnt"], "화")?></span>

        <div class="upload__epsd-cnt">
            <span class="upload__epsd-cnt-text">
                업로드
                <span class="upload__epsd-cnt-text2"><?=Converter::display_number($work["work_upload_cnt"])?></span>
            </span>  
            <span class="upload__epsd-cnt-text">
                예약
                <span class="upload__epsd-cnt-text2"><?=Converter::display_number($work["work_reserve_cnt"])?></span>
            </span>  
            <span class="upload__epsd-cnt-text">
                지각
                <span class="upload__epsd-cnt-text2"><?=Converter::display_number($work["work_delay_cnt"])?></span>
            </span>  
        </div>
    </div>

    <div class="upload__epsd-content">
        <table class="upload__epsd-list">
            <thead>
                <th>no</th>
                <th>회차명</th>
                <th>상태</th>
                <th><span style="color:#999999;">등록일</span>/연재일</th>
            </thead>
            <tbody>
            <?php if(pave_is_array($epsd_list)){ ?>
                <?php foreach ($epsd_list as $i => $epsd) { ?>
                <tr class="upload__epsd-item epsd-detail" data-id="<?=$epsd["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>">
                    <td>
                        <?php 
                        if($epsd["epsd_no"] > 0){ 
                            echo $epsd["epsd_no"];
                        }else{ 
                            if($epsd["epsd_no"] == 0){ 
                                echo "프롤로그";
                            }else if($epsd["epsd_no"] == -1){ 
                                if($epsd["epsd_cate"] == "notice"){ 
                                    echo "공지";
                                }else if($epsd["epsd_cate"] == "rest"){ 
                                    echo "휴재";
                                }
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <div class="upload__epsd-item-img-box">
                            <?php if($epsd["epsd_img"]){ ?>
                            <img src="<?=$epsd["epsd_img"]?>" alt="회차 이미지" class="upload__epsd-item-img">
                            <?php } ?>
                            <span class="upload__epsd-item-name text-truncate-line2"><?=$epsd["epsd_name"]?></span>
                        </div>
                    </td>
                    <td>
                        <span class="upload__epsd-item-state">
                            <?php if($epsd["epsd_state"] == "reserve"){ ?>
                            예약
                            <?php }else if($epsd["epsd_state"] == "success"){ ?>
                            연재
                            <?php }else if($epsd["epsd_state"] == "save"){ ?>
                            임시저장
                            <?php } ?>
                        </span>
                    </td>
                    <td>
                        <p class="upload__epsd-item-date"><?=Converter::display_time($epsd["epsd_insert_dt"])?></p>
                        <p class="upload__epsd-item-date2"><?=Converter::display_time($epsd["epsd_upload_dt"])?></p>
                    </td>
                </tr>
                <?php } ?>

            <?php }else { ?>
            <tr class="upload__epsd-item-empty">
                <td colspan="4">
                    등록된 회차가 없습니다.
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>