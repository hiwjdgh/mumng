<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals work_pay_modal" data-target="work_pay_modal">
    <div id="modal__box" class="modal__box--sm">
        <div id="modal__header">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="work_pay_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div class="work_pay__box">
                <div class="work_pay__info">
                    <img src="<?=$work["work_img"]?>" alt="작품 이미지" width="60" height="60" class="work_pay__info-img">
                    <div class="work_pay__info-inner-box">
                        <span class="work_pay__info-work"><?=$work["work_name"]?></span>
                        <span class="work_pay__info-epsd text-truncate"><?=$epsd["epsd_name"]?></span>
                    </div>
                </div>
              
                <div class="work_pay__type">
                    <?php if($work["work_free"]){ ?>
                        <?php if($epsd["is_preview"] && $work["work_preview2_exp"] > 0){ ?>
                        <div class="work_pay__type-item">
                            <span class="work_pay__type-text">미리보기</span>
                            <span class="work_pay__type-expire">3일</span>
                            <div class="work_pay__type-exp-box"> 
                                <span class="work_pay__type-exp-text1"><?=Converter::display_number($work["work_preview2_exp"])?></span>
                                <span class="work_pay__type-exp-text2">EXP</span>
                            </div>
                            <button type="button" class="work_pay__type-pay-button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="preview2">구매</button>
                        </div>    
                        <?php } ?>

                        <?php if($work["work_keep2_exp"] > 0){ ?>
                        <div class="work_pay__type-item">
                            <span class="work_pay__type-text">소장</span>
                            <span class="work_pay__type-expire"></span>
                            <div class="work_pay__type-exp-box"> 
                                <span class="work_pay__type-exp-text1"><?=Converter::display_number($work["work_keep2_exp"])?></span>
                                <span class="work_pay__type-exp-text2">EXP</span>
                            </div>
                            <button type="button" class="work_pay__type-pay-button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="keep2">구매</button>
                        </div>  
                        <?php } ?>

                        <?php if($work["work_state"] == "end" && $work["work_end2_exp"] > 0){ ?>
                        <div class="work_pay__type-item">
                            <span class="work_pay__type-text">완결소장</span>
                            <span class="work_pay__type-expire"></span>
                            <div class="work_pay__type-exp-box"> 
                                <span class="work_pay__type-exp-text1"><?=Converter::display_number($work["work_end2_exp"])?></span>
                                <span class="work_pay__type-exp-text2">EXP</span>
                            </div>
                            <button type="button" class="work_pay__type-pay-button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="end2">구매</button>
                        </div>  
                        <?php } ?>
                    <?php }else{ ?>
                        <?php if($epsd["is_preview"]  && $work["work_preview_exp"] > 0){ ?>
                        <div class="work_pay__type-item">
                            <span class="work_pay__type-text">미리보기</span>
                            <span class="work_pay__type-expire">3일</span>
                            <div class="work_pay__type-exp-box"> 
                                <span class="work_pay__type-exp-text1"><?=Converter::display_number($work["work_preview_exp"])?></span>
                                <span class="work_pay__type-exp-text2">EXP</span>
                            </div>
                            <button type="button" class="work_pay__type-pay-button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="preview">구매</button>
                        </div>  
                        <?php } ?>

                        <?php if($work["work_rent_exp"] > 0){ ?>
                        <div class="work_pay__type-item">
                            <span class="work_pay__type-text">대여</span>
                            <span class="work_pay__type-expire">3일</span>
                            <div class="work_pay__type-exp-box"> 
                                <span class="work_pay__type-exp-text1"><?=Converter::display_number($work["work_rent_exp"])?></span>
                                <span class="work_pay__type-exp-text2">EXP</span>
                            </div>
                            <button type="button" class="work_pay__type-pay-button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="rent">구매</button>
                        </div>  
                        <?php } ?>

                        <?php if($work["work_keep_exp"] > 0){ ?>
                        <div class="work_pay__type-item">
                            <span class="work_pay__type-text">소장</span>
                            <span class="work_pay__type-expire"></span>
                            <div class="work_pay__type-exp-box"> 
                                <span class="work_pay__type-exp-text1"><?=Converter::display_number($work["work_keep_exp"])?></span>
                                <span class="work_pay__type-exp-text2">EXP</span>
                            </div>
                            <button type="button" class="work_pay__type-pay-button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="keep">구매</button>
                        </div>
                        <?php } ?>
                         
                        <?php if($work["work_state"] == "end" && $work["work_end_exp"] > 0){ ?>
                        <div class="work_pay__type-item">
                            <span class="work_pay__type-text">완결소장</span>
                            <span class="work_pay__type-expire"></span>
                            <div class="work_pay__type-exp-box"> 
                                <span class="work_pay__type-exp-text1"><?=Converter::display_number($work["work_end_exp"])?></span>
                                <span class="work_pay__type-exp-text2">EXP</span>
                            </div>
                            <button type="button" class="work_pay__type-pay-button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="end">구매</button>
                        </div>  
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="work_pay__ad mumng-ad">
                    <img src="<?=get_url(PAVE_IMG_URL, "img_page_ad_376px.png")?>" alt="무명 내부 광고 이미지">
                </div>
            </div>
        </div>
        <div id="modal__footer">
        </div>
    </div>
</div>