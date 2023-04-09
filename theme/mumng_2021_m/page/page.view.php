<?php
if (!defined('_PAVE_')) exit;
?>
<section class="page">
    <div class="page__content">
        <div class="page__card">
            <div class="page__card-commerce tooltip-box">
                <span class="icon-commerce icon-30 <?=$page_user["user_commerce"] ? "icon-active" : "icon-inactive"?>"></span>
                <div class="tooltip-box__content">
                    <?php 
                    if($page_user["user_commerce"]){ 
                        echo "무명 커머스 작가";
                    }else{
                        echo "무명 작가";
                    }
                    ?>
                </div>
            </div>

            <button type="button" class="page__card-more-button helper__button" data-anchor="page_more" data-user="<?=$page_user["user_no"]?>">
                <span class="icon-more icon-24"></span>
            </button>
            <div class="helper" data-target="page_more">
                <div class="helper__container">
                    <div id="helper__more-box" class="helper__action-box">
                        <button type="button" class="helper__action-button clipboard-button" data-url="<?=$page_user["user_page_url"]?>">링크복사</button>
                        <?php if($page_user["user_no"] == $pave_user["user_no"]){ ?>
                            <button type="button" class="helper__action-button url-change-button">URL 설정</button>
                            <a href="<?=get_url(PAVE_SETTING_URL, "profile")?>" class="helper__action-button">프로필 편집</a>
                        <?php }else{ ?>
                            <button type="button" class="helper__action-button penalty-button" style="color:#E34850;" data-type="user" data-target="<?=$page_user["user_code"]?>">작가 신고</button>
                            <?php if($page_user["user_follow"]["is_follow"]){ ?>
                            <button type="button" class="helper__action-button follow-button" data-user="<?=$page_user["user_code"]?>">팔로우 취소</button>
                            <?php }else{ ?>
                            <button type="button" class="helper__action-button follow-button" data-user="<?=$page_user["user_code"]?>">팔로우</button>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="helper__close-box">
                        <button type="button" class="helper__close-button" data-anchor="page_more">취소</button>
                    </div>
                </div>
            </div>

            <img src="<?=$page_user["user_img"]?>" alt="프로필 이미지" class="page__card-img" width="160" height="160">

            <span class="page__card-nick"><?=$page_user["user_nick"]?></span>
            <?php if($page_user["user_field"]){ ?>
            <span class="page__card-field"><?=$page_user["user_field"]?></span>
            <?php } ?>
            <?php if($page_user["user_introduce"]){ ?>
            <p class="page__card-introduce"><?=nl2br($page_user["user_introduce"])?></p>
            <?php } ?>

            <div class="page__card-follow-box">
                <button type="button" class="page__card-follower-button follower-button" data-user="<?=$page_user["user_code"]?>">
                    <span class="page__card-follower-text">팔로워</span>
                    <?=Converter::display_number_format($page_user["user_follow"]["follower_cnt"])?>
                </button>

                <div class="line-vertical-g7-mhz-10"></div>

                <button type="button" class="page__card-following-button following-button" data-user="<?=$page_user["user_code"]?>">
                    <span class="page__card-following-text">팔로잉</span>
                    <?=Converter::display_number_format($page_user["user_follow"]["following_cnt"])?>
                </button>

                <?php if($page_user["user_id"] == $pave_user["user_id"]){ ?>
                <a href="<?=get_url(PAVE_SETTING_URL, "profile")?>" class="page__card-setting-link button-t2 button-s2">프로필 편집</a>
                <?php }else{ ?>
                    <?php if($page_user["user_follow"]["is_follow"]){ ?>
                    <button type="button" class="page__card-follow-button button-t3 button-s2 follow-button" data-user="<?=$page_user["user_code"]?>">팔로우 취소</button>
                    <?php }else{ ?>
                    <button type="button" class="page__card-follow-button button-t1 button-s2 follow-button" data-user="<?=$page_user["user_code"]?>">팔로우</button>
                    <?php } ?>
                <?php } ?>
            </div>

            <div class="page__card-total">
                <h3 class="page__card-total-label">작품</h3>
                <dl class="page__card-total-upload">
                    <dt>업로드</dt>
                    <dd><?=Converter::display_number($page_work_total["total_upload"])?></dd>
                </dl>
                <dl class="page__card-total-like">
                    <dt>좋아요</dt>
                    <dd><?=Converter::display_number($page_work_total["total_like"])?></dd>
                </dl>
                <dl class="page__card-total-hit">
                    <dt>조회수</dt>
                    <dd><?=Converter::display_number($page_work_total["total_hit"])?></dd>
                </dl>
            </div>

            <?php if(pave_is_array($page_user["user_genre_list"])){ ?>
            <div class="page__card-genre">
                <h3 class="page__card-genre-label">관심장르</h3>
                <ul class="page__card-genre-list">
                    <?php foreach ((array)$page_user["user_genre_list"] as $i => $genre) { ?>
                    <li class="page__card-genre-item">
                        <a href="<?=get_url(PAVE_SEARCH_URL, "hashtag/{$genre}")?>" class="page__card-genre-item-link">
                            <span class="page__card-genre-item-text"><?=$genre?></span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
            
            <?php if($page_user["user_major"]){ ?>
            <div class="page__card-major">
                <h3 class="page__card-major-label">대표작품</h3>
                <div class="page__card-major-box work-detail" data-id="<?=$page_user["user_major"]["work_id"]?>">
                    <img src="<?=$page_user["user_major"]["work_img"]?>" alt="대표작품 이미지" width="90" height="112" class="page__card-major-img">
                    <div class="page__card-major-inner-box">
                        <span class="page__card-major-epsd">총 <?=Converter::display_number($page_user["user_major"]["work_epsd_cnt"], "화") ?></span>
                        <span class="page__card-major-name text-truncate" ><?=$page_user["user_major"]["work_name"]?></span>
                        <p class="page__card-major-description text-truncate-line3"><?=$page_user["user_major"]["work_description"]?></p>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if($page_user["user_sns"]){ ?>
            <div class="page__card-sns">
                <ul class="page__card-sns-list">
                    <?php foreach ((array)$page_user["user_sns"] as $i => $sns) { if(!$sns["user_sns_id"]) continue; ?>
                    <li class="page__card-sns-item">
                        <a href="<?=$sns["sns_url"]?>" class="page__card-sns-item-link" target="_blank">
                            <span class="page__card-sns-item-icon icon-active icon-<?=$sns["sns_name"]?> icon-24"></span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>
    <div class="page__tab">
            <ul class="page__tab-list">
                <li class="page__tab-item current" data-target="webtoon">웹툰</li>
                <li class="page__tab-item" data-target="sight">발견</li>
            </ul>
        </div>
    
        <div class="page__work">
            <ul class="page__work-list">
            </ul>
        </div>
    </div>
</section>
<script>
$(function(){
    $(".page__tab-item").on("click", function(){
        $(".page__tab-item").removeClass("current");
        $(this).addClass("current");
   
        let target = $(this).data("target");
        if(target == "webtoon"){
            works_list_obj.init($(".page__work-list"));
            works_list_obj.list_request = {
                type: "",
                user_no: "<?=$page_user["user_no"]?>",
                work_day: "",
                work_state: "",
                work_age: "",
                work_genre: "",
                page: 1,
                work_end: false,
                work_request: false,
            }
            works_list_obj.get_work_list();
        }else{
            sight_obj.init($(".page__work-list"));
            sight_obj.get_sight_list();
        }
     });

    $(document).on("click", ".webtoon-item.adult-webtoon", function(e){
        if(!confirm("성인 컨텐츠 노출을 위해선 게시물 설정을 변경하셔야 합니다.\n이동하시겠습니까?")){
            return false;
        }
    });
});

setTimeout(function(){
    $(".page__tab-item.current").trigger("click");
},200);
</script>