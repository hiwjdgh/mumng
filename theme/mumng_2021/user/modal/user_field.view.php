<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals user_field_modal" data-target="user_field_modal">
    <div id="modal__box" class="modal__box--sm">
        <div id="modal__header" class="modal__header-line">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="user_field_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div id="user_field__box">
                <ul id="user_field__list">
                    <?php foreach ($user_config["user_field_list"] as $i => $field) { ?>
                    <li>
                        <label for="user_field_<?=$i?>" class="check-box">
                            <input type="checkbox" name="user_field_tmp[]" id="user_field_<?=$i?>" class="check-box__check" value="<?=$field?>" <?=get_checked($field, $data)?>>
                            <span class="check-box__span"></span>
                            <span class="check-box__label"><?=$field?></span>
                        </label>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div id="modal__footer">
            <button type="button" id="user_field__save-button" class="button-t1 button-s3">확인</button>
        </div>
    </div>
</div>