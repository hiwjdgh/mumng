<?php
if (!defined('_PAVE_')) exit;
?>
<div id="epsd_pay-box">
    <div id="epsd_pay__header-box">
        <h2 id="epsd_pay__header-title">구매하기</h2>
        <button type="button" id="epsd_pay__header-close-button"><span class="icon-x icon-20"></span></button>
    </div>
    <div id="epsd_pay__content-box">
        <div id="epsd_pay__info-box">
            <div id="epsd_pay__info-img">
                <img src="<?=$work["work_img"]?>" alt="작품 이미지" width="60" height="60">
            </div>
            <div id="epsd_pay__info-name">
                <span id="epsd_pay__info-work"><?=$work["work_name"]?></span>
                <span id="epsd_pay__info-epsd" class="text-truncate"><?=$epsd["epsd_name"]?></span>
            </div>
        </div>
        <div id="epsd_pay__info-type-box">
            <?php if($work["work_free"]){ ?>
                <?php if($epsd["epsd_state"] == "reserve"){ ?>
                <div id="epsd_pay__info-rent">
                    <span class="pay__type-text">미리보기</span>
                    <span class="pay__type-expire">3일</span>
                    <div class="pay__type-exp-box"> 
                        <span class="pay__type-exp1"><?=Converter::display_number($work["work_preview2_exp"])?></span>
                    <span class="pay__type-exp2">EXP</span>
                    </div>
                    <button type="button" class="pay__button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="preview2">구매</button>
                </div>      
                <?php } ?>
                <div id="epsd_pay__info-keep">
                    <span class="pay__type-text">소장</span>
                    <div class="pay__type-exp-box"> 
                        <span class="pay__type-exp1"><?=Converter::display_number($work["work_keep2_exp"])?></span>
                        <span class="pay__type-exp2">EXP</span>
                    </div>
                    <button type="button" class="pay__button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="keep2">구매</button>
                </div>    
                <?php if($work["work_state"] == "end"){ ?>
                <div id="epsd_pay__info-end">
                    <span class="pay__type-text">완결소장</span>
                    <div class="pay__type-exp-box"> 
                        <span class="pay__type-exp1"><?=Converter::display_number($work["work_end2_exp"])?></span>
                        <span class="pay__type-exp2">EXP</span>
                    </div>
                    <button type="button" class="pay__button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="end2">구매</button>
                </div>    
                <?php } ?>
            <?php }else{ ?>
                <?php if($epsd["epsd_state"] == "reserve"){ ?>
                <div id="epsd_pay__info-rent">
                    <span class="pay__type-text">미리보기</span>
                    <span class="pay__type-expire">3일</span>
                    <div class="pay__type-exp-box"> 
                        <span class="pay__type-exp1"><?=Converter::display_number($work["work_preview_exp"])?></span>
                        <span class="pay__type-exp2">EXP</span>
                    </div>
                    <button type="button" class="pay__button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="preview">구매</button>
                </div>                
                <?php }else{ ?>
                <div id="epsd_pay__info-rent">
                    <span class="pay__type-text">대여</span>
                    <span class="pay__type-expire">3일</span>
                    <div class="pay__type-exp-box"> 
                        <span class="pay__type-exp1"><?=Converter::display_number($work["work_rent_exp"])?></span>
                        <span class="pay__type-exp2">EXP</span>
                    </div>
                    <button type="button" class="pay__button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="rent">구매</button>
                </div>   
                <?php } ?>

                <div id="epsd_pay__info-keep">
                    <span class="pay__type-text">소장</span>
                    <div class="pay__type-exp-box"> 
                        <span class="pay__type-exp1"><?=Converter::display_number($work["work_keep_exp"])?></span>
                        <span class="pay__type-exp2">EXP</span>
                    </div>
                    <button type="button" class="pay__button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="keep">구매</button>
                </div>    
                <?php if($work["work_state"] == "end"){ ?>
                <div id="epsd_pay__info-end">
                    <span class="pay__type-text">완결소장</span>
                    <div class="pay__type-exp-box"> 
                        <span class="pay__type-exp1"><?=Converter::display_number($work["work_end_exp"])?></span>
                        <span class="pay__type-exp2">EXP</span>
                    </div>
                    <button type="button" class="pay__button button-t1 button-s4" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-type="end">구매</button>
                </div>    
                <?php } ?>
            <?php } ?>
        </div>            
    </div>
    <div id="epsd_pay__footer-box">
        <div id="epsd_pay__ad"></div>
    </div>
</div>