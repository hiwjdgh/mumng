<?php
if (!defined('_PAVE_')) exit;
?>
<section class="creation-detail__header">
    <h1 class="creation-detail__title"><?=$creation["creation_name"]?></h1>
    <span class="creation-detail__date"><?=Converter::display_time($creation["creation_insert_dt"])?></span>
</section>
<section class="creation-detail__content">
    <div class="creation-detail__left">
        <div class="creation-detail__require">
            <p class="creation-detail__require-title">상세내용</p>
            <div class="creation-detail__require-content"><?=nl2br($creation["creation_content"])?></div>
        </div>
        <div class="creation-detail__require">
            <p class="creation-detail__require-title">데포르메</p>
            <div class="creation-detail__require-content">
                <span class="badge badge--t1"><?=$creation["creation_ratio"]?></span>
            </div>
        </div>

        <div class="creation-detail__require">
            <p class="creation-detail__require-title">크기</p>
            <div class="creation-detail__require-content">
                <span class="badge badge--t1"><?=$creation["creation_size"]?></span>
            </div>
        </div>

        <div class="creation-detail__require">
            <p class="creation-detail__require-title">배경화면</p>
            <div class="creation-detail__require-content">
                <span class="badge badge--t1">사용</span>
                <?=nl2br($creation["creation_background_content"])?>
            </div>
        </div>

        <div class="creation-detail__require">
            <p class="creation-detail__require-title">소품</p>
            <div class="creation-detail__require-content">
                <span class="badge badge--t1">사용</span>
                <?=nl2br($creation["creation_accessory_content"])?>
            </div>
        </div>

        <div class="creation-detail__require">
            <p class="creation-detail__require-title">추가사항</p>
            <div class="creation-detail__require-content">
                <span class="badge badge--t1">성인</span>
            </div>
        </div>
    </div>
    <div class="creation-detail__right">
        <?php if($already_request["creation_no"]){ ?>
        <div class="creation-detail__card">
            <p class="creation-detail__card-title">신청정보</p>
                <p><?=$already_request["creation_request_exp"]?> EXP</p>
           
        </div>
        <?php } ?>

        <div class="creation-detail__card">
            <p class="creation-detail__card-title">정보</p>
            <div class="description-list">
                <dl class="description-list__row">
                    <dt class="description-list__left"><span class="icon-exp icon-24"></span></dt>
                    <dd class="description-list__right"><?=Converter::display_number($creation["creation_exp"], " EXP") ?></dd>
                </dl>
                <dl class="description-list__row">
                    <dt class="description-list__left">남은 시간</dt>
                    <dd class="description-list__right"><?=$creation["is_end"] ? "마감" : Converter::display_time_ago($creation["creation_end_dt"], "Y-m-d", true)?></dd>
                </dl>
                <dl class="description-list__row">
                    <dt class="description-list__left">등록일</dt>
                    <dd class="description-list__right"><?=Converter::display_time($creation["creation_insert_dt"])?></dd>
                </dl>
                <dl class="description-list__row">
                    <dt class="description-list__left">마감일</dt>
                    <dd class="description-list__right"><?=Converter::display_time($creation["creation_end_dt"])?></dd>
                </dl>
            </div>
           
            <?php if($creation["is_end"]){ ?>
            <button type="button" class="button-t1 button-s1 disabled">마감된 의뢰</button>
            <?php }else{ ?>
            <?php if(!$already_request["creation_no"]){ ?>
            <form class="creation-request__form" novalidate autocomplete="off">
                <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
                <input type="hidden" name="creation_no" id="creation_no" value="<?=$creation["creation_no"]?>">
                <div class="list gap-8">
                    <?php if($creation["creation_exp_request"]){ ?>
                    <button type="button" class="button-t1 button-s1 collapse-button" data-collapse="hide" data-anchor="exp_request">EXP 제안하기</button>
                    <div class="collapse-content" data-target="exp_request">
                        <div class="input-t2">
                            <div class="input-t2__box">
                                <input type="number" name="creation_request_exp" id="creation_request_exp" class="input-t2__input" value="<?=$creation["creation_exp"]?>" title="창작 제안 EXP" min="<?=$creation["creation_exp"]?>" step="<?=$creation_config["creation_exp_step"]?>" required>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <input type="hidden" name="creation_request_exp" id="creation_request_exp" value="<?=$creation["creation_exp"]?>">
                    <?php } ?>

                    <button type="submit" class="button-t1 button-s1 creation-request-button">신청하기</button>
                </div>
            </form>
            <?php } ?>

            <?php } ?>
        </div>

        <div class="creation-detail__card">
            <p class="creation-detail__card-title">공유</p>
          
            <ul class="list horizontal gap-8">
                <li>
                    <a href="<?=$creation["creation_share_url"]["facebook"]?>" target="_blank">
                        <span class="icon-facebook icon-active icon-22"></span>
                    </a>
                </li>
                <li>
                    <a href="<?=$creation["creation_share_url"]["twitter"]?>" target="_blank">
                        <span class="icon-twitter icon-active icon-22"></span>
                    </a>
                </li>
                <li>
                    <a href="<?=$creation["creation_share_url"]["naverblog"]?>" target="_blank">
                        <span class="icon-naver icon-active icon-22"></span>
                    </a>
                </li>
                <li>
                    <a href="<?=$creation["creation_share_url"]["kakaostory"]?>" target="_blank">
                        <span class="icon-kakao icon-active icon-22"></span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="creation-detail__card">
            <p class="creation-detail__card-title">주의사항</p>
            <small class="creation-detail__card-description text-color-error"> 
                <?php if($creation["creation_field"] == "commission"){ ?>
                해당 의뢰의 작업물 저작권은 "작업자" 분에게 있습니다. 상업적 목적 사용의 경우
                <?php }else{ ?>
                해당 의뢰의 작업물 저작권은 "의뢰자" 분에게 있습니다. 비상업적 목적 사용의 경우
                <?php } ?>
            </small>
            <a href="<?=get_url(PAVE_CREATION_URL, "list")?>" class="button-t1 button-s1">
                <?php if($creation["creation_field"] == "commission"){ ?>
                외주 의뢰 보기
                <?php }else{ ?>
                커미션 의뢰 보기
                <?php } ?>
            </a>
        </div>
    </div>
</section>
<script>
    $(function(){
        creation_request_obj.init();
    });
</script>