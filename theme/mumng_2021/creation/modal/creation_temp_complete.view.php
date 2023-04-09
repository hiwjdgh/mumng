<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals creation_temp_complete_modal" data-target="creation_temp_complete_modal">
    <div class="modals__box">
        <div class="modals__header">
            <h2 class="modals__title"><?=$modal_title?></h2>
            <button type="button" class="modal-close-button modals__close-button" data-anchor="creation_temp_complete_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div class="modals__content">
            <div class="creation_temp__box">
                <h3 class="creation_temp__text">의뢰 내용이 임시저장되었습니다.<br>[내 창작 > 의뢰 관리]에서 확인가능합니다.</h3>
                <div class="creation_temp__action">
                    <button type="button" class="modal-close-button button-s1 button-t3" data-anchor="creation_temp_complete_modal">아니요</button>
                    <button type="button" class="modal-close-button load-creation-temp-button button-s1 button-t1" data-anchor="creation_temp_modal">불러오기</button>
                </div>
            </div>
        </div>
    </div>
</div>