<?php
if (!defined('_PAVE_')) exit;
?>
<section class="upload">
    <div class="upload__left">
        <div class="upload__header">
            <h2 class="upload__text">연재 캘린더</h2>
            <div class="upload__action upload__action--center">
                <button class="js-prev-button button">
                    <span class="icon-left-circle icon-20"></span>
                    <span class="skip">이전달</span>
                </button>
                <span class="js-now upload__now"><?=PAVE_YEAR.".".PAVE_MONTH?></span>
                <button class="js-next-button button">
                    <span class="icon-right-circle icon-20"></span>
                    <span class="skip">다음달</span>
                </button>
            </div>
        </div>
        <div class="upload__calendar"></div>
    </div>
    <div class="upload__right">
        <div class="upload__header">
            <h2 class="upload__text">내 작품</h2>
            <div class="upload__action upload__action--right">
                <button type="button" class="upload-work-button work-upload-button button button-t2 button-s2" data-action="create">
                    <span class="button__icon icon-plus icon-16"></span>
                    <span class="button__text">작품 등록</span>
                </button>
            </div>
        </div>

        <div class="upload__work"></div>
    </div>
</section>
<script>
$(document).ready(function(){
    <?php if($is_guide_show){ ?>
    modals.load("upload_work_guide", "연재 가이드", JSON.stringify({}));
    <?php } ?>
});
</script>