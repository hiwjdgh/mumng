<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column gap-row-24">
    <form class="adm-config__form flex flex-column gap-row-12" action="<?=get_url(PAVE_ADM_URL,"config/commerce/update")?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">

        <div class="adm-content__header flex flex-column gap-row-24">
            <div class="flex flex-justify-content-flex-start flex-align-item-center">
                <h1 class="adm-content__header__title"><?=$adm_title?></h1>

                <div class="flex mgl-auto gap-column-12">
                    <button type="submit" class="button-t1 button-s3">수정</button>
                </div>
            </div>

            <div class="adm-content__tab">
                <ul class="adm-content__tab-list">
                    <?php foreach ($commerce_cf as $i => $commerce) { ?>
                    <li class="adm-content__tab-item">
                        <button type="button" class="adm-content__tab-button" data-anchor="<?=$commerce["commerce_id"]?>"><?=$commerce["commerce_id"]?> 커머스 설정</button>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>


        <?php foreach ($commerce_cf as $i => $commerce) { ?>
        <div class="flex flex-wrap gap-24 mg-20 adm-content__tab-content" data-anchor="<?=$commerce["commerce_id"]?>">
            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$commerce["commerce_id"]?> 커머스 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$commerce["commerce_id"]?> 커머스 설정</h3>


                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">커머스 수수료</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="commerce[<?=$commerce["commerce_id"]?>][commerce_fee]" id="commerce_fee_<?=$i?>" class="input-box-t2__input" value="<?=$commerce["commerce_fee"]?>" title="커머스 수수료" placeholder="커머스 수수료(숫자만 입력)">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">커머스 기본점수</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="commerce[<?=$commerce["commerce_id"]?>][commerce_base_score]" id="commerce_base_score_<?=$i?>" class="input-box-t2__input" value="<?=$commerce["commerce_base_score"]?>" title="커머스 기본점수" placeholder="커머스 기본점수(숫자만 입력)">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">커머스 등업점수</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="commerce[<?=$commerce["commerce_id"]?>][commerce_score]" id="commerce_score_<?=$i?>" class="input-box-t2__input" value="<?=$commerce["commerce_score"]?>" title="커머스 등업점수" placeholder="커머스 등업점수(숫자만 입력)">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">좋아요 환산비율</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="commerce[<?=$commerce["commerce_id"]?>][commerce_like_ratio]" id="commerce_like_ratio_<?=$i?>" class="input-box-t2__input" value="<?=$commerce["commerce_like_ratio"]?>" title="좋아요 환산비율" placeholder="좋아요 환산비율">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">구독 환산비율</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="commerce[<?=$commerce["commerce_id"]?>][commerce_subscribe_ratio]" id="commerce_subscribe_ratio_<?=$i?>" class="input-box-t2__input" value="<?=$commerce["commerce_subscribe_ratio"]?>" title="구독 환산비율" placeholder="구독 환산비율">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">조회수 환산비율</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="commerce[<?=$commerce["commerce_id"]?>][commerce_hit_ratio]" id="commerce_hit_ratio_<?=$i?>" class="input-box-t2__input" value="<?=$commerce["commerce_hit_ratio"]?>" title="조회수 환산비율" placeholder="조회수 환산비율">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">지각 패널티</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="commerce[<?=$commerce["commerce_id"]?>][commerce_hit_ratio]" id="commerce_hit_ratio_<?=$i?>" class="input-box-t2__input" value="<?=$commerce["commerce_hit_ratio"]?>" title="지각 패널티" placeholder="지각 패널티">
                        </div>
                    </div>

                </fieldset>
            </div>
        </div>
        <?php } ?>
    </form>
</div>