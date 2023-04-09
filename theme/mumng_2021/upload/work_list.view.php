<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($work_list)){ ?>
<div class="upload__work-list-box swiper-container">
    <ul class="upload__work-list swiper-wrapper">
        <?php foreach ($work_list as $i => $work) { ?>
        <li class="upload__work-item swiper-slide" data-id="<?=$work["work_id"]?>">
            <span class="upload__work-item-color" style="background-color:<?=$work["work_color"]?>;"></span>
            <img src="<?=$work["work_img"]?>" alt="대표 이미지" class="upload__work-item-img" width="121" height="141">
            <button type="button" class="upload-work-button upload__work-item-edit-button button-t2 button-s4" data-id="<?=$work["work_id"]?>" data-action="update">
                <span class="button__text">편집</span>
            </button>
        </li>
        <?php } ?>
    </ul>
    <button type="button" class="js-work-prev-button upload__work-prev-button">
        <span class="icon-20 icon-left-circle"></span>
    </button>
    <button type="button" class="js-work-next-button upload__work-next-button">
        <span class="icon-20 icon-right-circle"></span>
    </button>
</div>
<script>
    var upload_work_swiper = new Swiper('.upload-work',{
        slidesPerView: "auto",
        slideToClickedSlide: true,
        preventClicksPropagation: true,
        preventInteractionOnTransition:true,
        navigation: {
        nextEl: ".js-work-next-button",
        prevEl: ".js-work-prev-button",
        },
        observer:true,
        on:{
            "activeIndexChange":function(info){
                if(info.slides.length - info.activeIndex < 3){
                    $(info.$wrapperEl).css({
                        "transform": "translate3d(-"+ (info.snapGrid[info.slides.length-3]+(info.slides.length - info.activeIndex)) + "px,0px, 0px)"
                    });
                }
                load_work_info(info.slides[info.activeIndex]);
            
            },
            "slideChange": function(info){
                if(info.slides.length > 3) {
                    if(info.isEnd){
                        $(".js-work-next-button").hide();
                    }else{
                        $(".js-work-next-button").show();
                    }
                    if(info.isBeginning){
                        $(".js-work-prev-button").hide();
                    }else{
                        $(".js-work-prev-button").show();
                    }
                }
            
            },
            "update": function(info){
                if(info.slides.length > 3) {
                    if(info.isEnd){
                        $(".js-work-next-button").hide();
                    }else{
                        $(".js-work-next-button").show();
                    }
                    if(info.isBeginning){
                        $(".js-work-prev-button").hide();
                    }else{
                        $(".js-work-prev-button").show();
                    }
                }
            },
        "snapGridLengthChange":function(){
                if( this.snapGrid.length != this.slidesGrid.length ){
                    this.snapGrid = this.slidesGrid.slice(0);
                }
            }
        }
    });
</script>

<?php }else { ?>
<div class="upload__empty">
    <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default2_640px.png")?>" alt="작품없음 이미지" width="360" height="360" usemap="#author" class="upload__empty-img">
    <map name="author">
    <area shape="rect" coords="224,249,248,313" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
    </map>
    <span class="upload__empty-text">작품을 등록하고<br>연재를 시작하세요 !</span>
</div>
<?php } ?>