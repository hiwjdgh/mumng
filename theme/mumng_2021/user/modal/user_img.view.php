<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals user_img_modal" data-target="user_img_modal">
    <div id="modal__box" class="modal__box--sm">
        <div id="modal__header" class="modal__header-line">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="user_img_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div id="user_img__crop-box">
                <img src="<?=$data["url"]?>" alt="프로필 이미지" id="user_img__crop-img" data-tmp="<?=htmlspecialchars(json_encode($data))?>">
            </div>
        </div>
        <div id="modal__footer">
            <button type="button" id="user_img__save-button" class="button-t1 button-s3">확인</button>
        </div>
    </div>
<script>
$("#user_img__crop-img").cropper({
    dragMode : "move",
    aspectRatio : 1,
    viewMode: 3,
    cropBoxMovable: false,
    cropBoxResizable: false,
    minContainerWidth: 320,
    minContainerHeight: 320,
    minCropBoxWidth: 320,
    minCropBoxHeight: 320,
    toggleDragModeOnDblclick : false
});
</script>
</div>