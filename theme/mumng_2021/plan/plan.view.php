<?php
if (!defined('_PAVE_')) exit;
?>
<section class="plan">
    <div class="plan__container">
        <div class="plan__box1">
            <div class="plan__box1-inner-box">
                <div class="plan__box1-img-box">
                    <img src="<?=get_url(PAVE_IMG_URL,"img_empty_plan_640px.png")?>" alt="플랜 이미지" width="416" height="416" usemap="#author" class="plan__box1-img">
                    <map name="author">
                    <area shape="rect" coords="300,332,390,352" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
                    </map>
                </div>

                <div class="plan__box1-description-box">
                    <p class="plan__box1-text">웹툰작가의 독립을 응원합니다</p>
                    <p class="plan__box1-text2">커머스를 통해 수익을 창출해보세요</p>
                    <p class="plan__box1-text3">첫 시작 7% 부터 점진적으로 0%까지 오로지 웹툰 작가를 위한 무명의 작품 유료 판매 수수료 정책입니다.</p>
                    <a href="<?=get_url(PAVE_COMMERCE_URL,"home")?>" class="plan__box1-button button-t1 button-s2">시작하기</a>
                </div>
            </div>
        </div>

        <div class="plan__box2">
            <div class="plan__box2-inner-box">
                <img src="<?=get_url(PAVE_IMG_URL,"img_commerce_plan_311px.png")?>" alt="플랜 이미지" class="plan__box2-img">
                <div>
                    <img src="<?=get_url(PAVE_IMG_URL,"img_commerce_plan2_480px.png")?>" alt="플랜 이미지" usemap="#author2" class="plan__box2-img2">
                    <map name="author2">
                    <area shape="rect" coords="247,452,330,474" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
                    </map>
                </div>
            </div>
            <img src="<?=get_url(PAVE_IMG_URL,"img_commerce_plan3_324px.png")?>" alt="플랜 이미지" class="plan__box2-img3">
            <img src="<?=get_url(PAVE_IMG_URL,"img_commerce_plan4_226px.png")?>" alt="플랜 이미지" class="plan__box2-img4">
            <img src="<?=get_url(PAVE_IMG_URL,"img_commerce_plan5_498px.png")?>" alt="플랜 이미지" class="plan__box2-img5">
        </div>

        <div class="plan__box3">
            <div>
                <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default2_640px.png")?>" alt="커머스 이미지" width="416" height="416" usemap="#author3" class="plan__box3-img">
                <map name="author3">
                <area shape="rect" coords="258,282,288,370" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
                </map>
            </div>
            <img src="<?=get_url(PAVE_IMG_URL,"img_commerce_plan6_346px.png")?>" alt="플랜 이미지" class="plan__box3-img2">
            <a href="<?=get_url(PAVE_COMMERCE_URL,"home")?>" class="plan__box3-button button-t1 button-s1">무명 커머스 시작하기</a>
        </div>

        <div class="plan__box4">
            <div class="plan__box4-inner-box">
                <span class="plan__box4-text">&copy; 2022 MUMYEONG All RIGHTS RESERVED</span>

                <div class="plan__box4-button-box">
                    <a href="<?=get_url(PAVE_GUIDE_URL,"home")?>" class="plan__box4-button">커머스 이용가이드</a>
                    <a href="<?=get_url(PAVE_LEGAL_URL,"commerce")?>" class="plan__box4-button">커머스 서비스이용약관</a>
                </div>
            </div>
        </div>
    </div>
</section>