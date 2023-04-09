<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals upload_work_guide_modal" data-target="upload_work_guide_modal">
    <div id="modal__box" class="modal__box--normal">
        <div id="modal__content">
            <div class="upload_work_guide__box">
                <div class="upload_work_guide__img-box">
                    <img src="<?=get_url(PAVE_IMG_URL, "img_empty_guide_640px.png")?>" alt="업로드 가이드 이미지" width="360" height="360" usemap="#author" class="upload_work_guide__img">
                    <map name="author">
                    <area shape="rect" coords="250,310,320,330" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
                    </map>
                </div>
                <p class="upload_work_guide__text">연재가 처음이시라면 가이드를 보고 진행하세요</p>
                <div class="upload_work_guide__button-box">
                    <button type="button" class="upload_work_guide__button" data-anchor="upload_work_guide_modal">싫어요</button>
                    <a href="<?=get_url(PAVE_GUIDE_URL, "group/upload")?>" class="upload_work_guide__button button-t1 button-s2" target="_blank">가이드보기</a>
                </div>
            </div>
        </div>
    </div>
</div>