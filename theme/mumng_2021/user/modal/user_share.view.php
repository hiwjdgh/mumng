<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals user_share_modal" data-target="user_share_modal">
    <div class="modals__box">
        <div class="modals__header">
            <h2 class="modals__title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button modals__close-button" data-anchor="user_share_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div class="modals__content">
            <div class="user_share__box">
                <form class="user-form user_share__form flex flex-column gap-row-16" novalidate autocomplete="off">
                    <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
                    <div class="input-box input-box-t6">
                        <span class="input-box-t6__prefix"><?=get_url(PAVE_PAGE_URL)?></span>
                        <input type="text" name="user_share" id="user_share" class="input-box-t6__input" value="<?=$pave_user["user_share"]?>" title="URL 설정" minlength="<?=$user_config["user_share_min_len"]?>" maxlength="<?=$user_config["user_share_max_len"]?>" spellcheck="false" required>
                    </div>
                    <button type="submit" id="user_share__submit-button" class="user_share__submit-button button-t1 button-s3">저장</button>
                </form>
            </div>
        </div>
    </div>
</div>