<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals work_description_modal" data-target="work_description_modal">
    <div id="modal__box" class="modal__box--480">
        <div id="modal__header">
            <h2 id="modal__header-title"></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="work_description_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div class="work_description__box">
                <h3 class="work_description__title"><?=$work["work_name"]?></h3>
                <p class="work_description__content"><?=nl2br($work["work_description"])?></p>
                <?php if($work["work_first_epsd"]){ ?>
                <button type="button" class="work_description__first-button epsd-detail modal-close-button" data-anchor="work_description_modal" data-id="<?=$work["work_id"]?>" data-epsd="<?=$work["work_first_epsd"]?>">
                    첫회보기 
                    <span class="icon-right icon-20"></span>
                </button>
                <?php } ?>
            </div>
        </div>
        <div id="modal__footer">
           
        </div>
    </div>
</div>