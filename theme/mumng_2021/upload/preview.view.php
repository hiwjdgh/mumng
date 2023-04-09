<?php
if (!defined('_PAVE_')) exit;
?>
<div class="epsd_detail">
    <div class="epsd_detail__header">
        <div class="epsd_detail__header-box">
            <p class="epsd_detail__header-work"><?=$work["work_name"]?></p>
            <div class="epsd_detail__header-inner-box">
                <span class="epsd_detail__header-epsd"><?=$epsd["epsd_name"]?></span>
                <span class="epsd_detail__header-date"><?=$epsd["epsd_upload_dt_text"]?></span> 
                <div class="epsd_detail__header-like">
                    <span class="epsd_detail__header-like-icon icon-like icon-like--active icon-16"></span>
                    <span class="epsd_detail__header-like-text">0</span>
                </div>
                <div class="epsd_detail__header-hit">
                    <span class="epsd_detail__header-hit-icon icon-display icon-display--active icon-16"></span>
                    <span class="epsd_detail__header-hit-text">0</span>
                </div>
            </div>
        </div>
        <button type="button" class="epsd_detail__header-close-button icon-button icon-button-28"><span class="icon-x icon-28"></span></button>
    </div>

    <div class="epsd_detail__box">
        <div class="epsd_detail__copy">
        </div>

        <ul class="epsd_detail__action">
            <li class="epsd_detail__action-item">
                <button type="button" id="epsd__more-share" class="epsd_detail__action-item-share-button icon-button icon-button-48 icon-button-circle">
                    <span class="icon-share icon-20"></span>
                </button>
                <span class="epsd_detail__action-item-text">공유</span>
            </li>
            <li class="epsd_detail__action-item">
                <button type="button" id="epsd__more-subscribe" class="epsd_detail__action-item-subscribe-button icon-button icon-button-48 icon-button-circle">
                    <span class="icon-subscribe icon-inactive icon-20"></span>
                </button>
                <span class="epsd_detail__action-item-text">구독</span>

            </li>
            <li class="epsd_detail__action-item">
                <button type="button" id="epsd__more-like" class="epsd_detail__action-item-like-button icon-button icon-button-48 icon-button-circle">
                    <span class="icon-like icon-like--inactive icon-20"></span>
                </button>
                <span class="epsd_detail__action-item-text">좋아요</span>
            </li>
        </ul>
        
        <div class="epsd_detail__eplg">
            <span class="epsd_detail__eplg-label">작가 에필로그</span>
            <p class="epsd_detail__eplg-content"><?=nl2br($epsd["epsd_eplg"])?></p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        let epsd_tmp = opener.$(".upload__epsd-form").serializeObject();

        $(".epsd_detail__header-work").text(epsd_tmp.work_name);
        $(".epsd_detail__header-epsd").text(epsd_tmp.epsd_name ? epsd_tmp.epsd_name : "회차명");
        $(".epsd_detail__header-date").text(epsd_tmp.upload_date);

      
        if(epsd_tmp.work_age == "전체"){
            $(".epsd_detail__copy").append('<img src="/root/img/img_age_all_960px.png" alt="연령제한 이미지">');
        }else if(epsd_tmp.work_age == "12세"){
            $(".epsd_detail__copy").append('<img src="/root/img/img_age_12_960px.png" alt="연령제한 이미지">');
        }else if(epsd_tmp.work_age == "15세"){
            $(".epsd_detail__copy").append('<img src="/root/img/img_age_15_960px.png" alt="연령제한 이미지">');
        }else if(epsd_tmp.work_age == "19세"){
            $(".epsd_detail__copy").append('<img src="/root/img/img_age_19_960px.png" alt="연령제한 이미지">');
        }
        
        epsd_tmp.epsd_tmp_copy.forEach(function(item,i){
            let item_tmp = JSON.parse(item);

            if(item_tmp.name == "copyright"){
                $(".epsd_detail__copy").append('<img src="/root/img/img_copyright_960px.png" alt="저작권 이미지">');
            }else{
                $(".epsd_detail__copy").append('<img src="'+item_tmp.url+'" alt="회차원고">');
            }

        });

        $(".epsd_detail__eplg-content").html(nl2br(epsd_tmp.epsd_eplg ? epsd_tmp.epsd_eplg : "작가 에필로그"));
    });
</script>