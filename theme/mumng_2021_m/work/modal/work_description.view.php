<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="work_description_modal2 bottom-sheet">
    <div id="modal__box2" class="modal__box--480">
        <div id="modal__header2" class="modal__header2--lg">
            <h2 id="modal__header2-title"><?=$work["work_name"]?></h2>
        </div>
        <div id="modal__content">
            <div class="work_description__box">
                <p class="work_description__content"><?=nl2br($work["work_description"])?></p>
                <?php if($work["work_first_epsd"]){ ?>
                <button type="button" class="work_description__first-button epsd-detail" data-id="<?=$work["work_id"]?>" data-epsd="<?=$work["work_first_epsd"]?>">
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