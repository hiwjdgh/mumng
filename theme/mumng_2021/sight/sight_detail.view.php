<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals sight_detail_modal" data-target="sight_detail_modal">
    <div class="modals__box">
        <div class="modals__header">
            <h2 class="modals__title"><?=$sight["sight_name"]?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button modals__close-button" data-anchor="sight_detail_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content" class="modals__content">
            <div class="sight_detail__box">
                <div class="sight_detail__info">
                    <?php if($sight["sight_img_use"]){ ?>
                    <img src="<?=$sight["sight_img"]?>" alt="창작물 이미지" class="sight_detail__img">
                    <?php }else{ ?>
                    <div class="sight_detail__none">
                        <p class="sight_detail__none-grp">
                            <?php
                            if($sight["sight_grp_id"] == "webtoon"){
                                echo "그림";
                            }else{
                                echo "글";
                            }
                            ?>
                        </p>
                        <p class="sight_detail__none-title text-truncate"><?=$sight["sight_name"]?></p>
                        <p class="sight_detail__none-name"><?=$sight["sight_user"]["user_nick"]?></p>
                    </div>
                    <?php } ?>
                    <div class="sight_detail__user">
                        <span class="sight_detail__user-label">작가</span>

                        <a href="<?=$sight["sight_user"]["user_page_url"]?>" target="_blank" class="sight_detail__user-link">
                            <img src="<?=$sight["sight_user"]["user_img"]?>" alt="대표작가 프로필" width="32" height="32" class="sight_detail__user-img">
                            <div class="sight_detail__user-inner-box">
                                <span class="sight_detail__user-nick text-truncate"><?=$sight["sight_user"]["user_nick"]?></span>
                                <span class="sight_detail__user-field"><?=$sight["sight_user"]["user_field"]?></span>
                            </div>
                        </a>
                    </div>
                    <div class="sight_detail__tag">
                        <span class="sight_detail__tag-label">해시태그</span>

                        <ul class="sight_detail__tag-list">
                            <?php foreach ($sight["sight_hashtag_list"] as $i => $hashtag) { ?>
                            <li class="sight_detail__tag-item">
                                <a href="<?=get_url(PAVE_SEARCH_URL, "hashtag/{$hashtag}")?>" class="sight_detail__tag-item-link" target="_blank"><?=$hashtag?></a>
                            </li>
                            <?php } ?>
                        </ul>
                        
                    </div>
                    <div class="sight_detail__age">
                        <span class="sight_detail__age-label">연령</span>
                        <span class="sight_detail__age-text"><?=$sight["sight_age"]?></span>
                    </div>

                    <?php if($sight["is_own"]){ ?>
                    <div class="sight_detail__action">
                        <span class="sight_detail__action-label">수정하기</span>
                        <button type="button" class="sight_detail__action-button upload-sight-button button-t2 button-s4" data-sight="<?=$sight["sight_no"]?>" data-action="update">수정</button>
                    </div>
                    <?php } ?>

                    <div class="sight_detail__license">
                        <span class="sight_detail__license-label">&copy;<?=PAVE_TIME_Y?> <?=$sight["sight_user"]["user_nick"]?> All rights reserved</span>
                        <button type="button" class="sight_detail__license-penalty-button penalty-button">신고</button>
                    </div>
                 
                </div>

                <div class="sight_detail__right">
                    <?=$sight["sight_content"]?>
                </div>
            </div>
        </div>
    </div>
</div>