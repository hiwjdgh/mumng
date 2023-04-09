<?php
if (!defined('_PAVE_')) exit;
?>
<?php 
    foreach ($epsd_list as $i => $epsd) { 
        if($work["work_user"]["user_commerce"]){ //커머스 작가
            if($work["work_free"]){ // 무료커머스 작가
                if($epsd["is_preview"] && $work["work_preview2_exp"] == 0){ //미리보기 금액이 0원이면 노출안함
                    continue;
                }
            }else{ // 유료커머스 작가
                if($epsd["is_preview"] && $work["work_preview_exp"] == 0){ //미리보기 금액이 0원이면 노출안함
                    continue;
                }
            }
        }
?> 
<li class="epsd-item epsd-detail <?=$epsd["is_hit"] ? "visit" : ""?>" data-id="<?=$epsd["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>">
    <div class="epsd-item__img-box">
        <img src="<?=$epsd["epsd_img"]?>" alt="회차 이미지" class="epsd-item__img">
        <?php if($epsd["is_preview"]){ ?>
        <div class="epsd-item__preview-box">
            <span class="epsd-item__preview-icon icon-preview icon-24"></span>
        </div>
        <?php }else{ ?>
        <?php if($epsd["is_hit"]){ ?>
        <div class="epsd-item__visit-box"></div>
        <?php } ?>
        <?php } ?>
    </div>

    <div class="epsd-item__info">
        <p class="epsd-item__info-name text-truncate"><?=$epsd["epsd_name"]?></p>
        <p class="epsd-item__info-upload">
            <?php 
            if($epsd["epsd_pay_info"] && !$epsd["epsd_pay_info"]["is_expired"]){
                echo Converter::display_time_ago($epsd["epsd_upload_dt"], "Y-m-d") ;
            }else{
                if($work["work_user"]["user_commerce"]){
                    if($work["work_free"]){
                        if($epsd["is_preview"]){
                            echo Converter::display_time_ago($epsd["epsd_upload_dt"], "Y-m-d")."후 무료";
                        }else{
                            echo Converter::display_time_ago($epsd["epsd_upload_dt"], "Y-m-d") ;
                        }
                    }else{
                        if($epsd["is_preview"] && ($work["work_preview_exp"] > $work["work_rent_exp"])){
                            echo Converter::display_time_ago($epsd["epsd_upload_dt"], "Y-m-d"). "후 ".Converter::display_number($work["work_rent_exp"])."EXP";
                        }else{
                            echo Converter::display_time_ago($epsd["epsd_upload_dt"], "Y-m-d") ;
                        }
                    }
                }else{
                    echo Converter::display_time_ago($epsd["epsd_upload_dt"], "Y-m-d") ;
                }
            }
            ?>
        </p>
        <div class="epsd-item__info-inner-box">
            <?php if($epsd["epsd_pay_info"] && !$epsd["epsd_pay_info"]["is_expired"]) {  ?>
                <?php if($epsd["epsd_pay_info"]["is_keep"]) {  ?>
                <span class="epsd-item__info-keep"><?=$epsd["epsd_pay_info"]["pay_expire_text"]?></span>
                <?php }else{ ?>
                <div class="epsd-item__info-rent">
                    <span class="epsd-item__info-rent-text">남은대여시간</span>
                    <span class="epsd-item__info-rent-time"><?=$epsd["epsd_pay_info"]["pay_expire_text"]?></span>
                </div>
                <?php } ?>
            <?php }else{ ?>
                <?php if($work["work_user"]["user_commerce"]){ ?>
                    <?php if($work["work_free"]){ ?>
                        <?php if(!$epsd["is_notice"] && $epsd["is_preview"] && $work["work_preview2_exp"] > 0){ ?>
                            <span class="epsd-item__info-exp"><?=Converter::display_number($work["work_preview2_exp"], "EXP")?></span>
                        <?php } ?>
                    <?php }else{ ?>
                        <?php if(!$epsd["is_notice"]){ ?>
                            <?php if($epsd["is_preview"] && $work["work_preview_exp"] > 0){ ?>
                                <span class="epsd-item__info-exp"><?=Converter::display_number($work["work_preview_exp"], "EXP")?></span>
                            <?php }else if($work["work_rent_exp"] > 0){ ?>
                                <span class="epsd-item__info-exp"><?=Converter::display_number($work["work_rent_exp"], "EXP")?></span>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            <?php if(($epsd["epsd_pay_info"] && !$epsd["epsd_pay_info"]["is_expired"]) || $epsd["is_notice"] || !$epsd["is_preview"]) { /* 현재 구매상태, 공지회차, 미리보기가 아닌경우 */ ?>
            <div class="epsd-item__info-total">
                <span class="epsd-item__info-total-like">
                    <span class="epsd-item__info-total-like-icon icon-like icon-like--active icon-16"></span>
                    <span class="epsd-item__info-total-like-cnt"><?=Converter::display_number_format($epsd["epsd_like"])?></span>
                </span>
                <span class="epsd-item__info-total-hit">
                    <span class="epsd-item__info-total-hit-icon icon-display icon-display--active icon-16"></span>
                    <span class="epsd-item__info-total-hit-cnt"><?=Converter::display_number_format($epsd["epsd_hit"])?></span>
                </span>
            </div>
            <?php } ?>
        </div>
    </div>
</li>
<?php } ?>