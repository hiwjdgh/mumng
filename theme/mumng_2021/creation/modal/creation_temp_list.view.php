<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals creation_temp_list_modal" data-target="creation_temp_list_modal">
    <div class="modals__box">
        <div class="modals__header">
            <h2 class="modals__title"><?=$modal_title?></h2>
            <button type="button" class="modal-close-button modals__close-button" data-anchor="creation_temp_list_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div class="modals__content">
            <div class="creation_temp__box">
                <div class="creation_temp__list">
                    <?php include_once($pave_theme["thm_path"]."/creation_temp_item.view.php")?>
                </div>
            </div>
        </div>
    </div>
</div>