<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals work_with_modal" data-target="work_with_modal">
    <div id="modal__box" class="modal__box--normal">
        <div id="modal__header" class="modal__header-line">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="work_with_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div class="work_with__box">
                <ul class="work_with__select-list">
                    <?php foreach ((array)$with_list as $i => $with) { ?>
                    <li class="work_with__select-item" data-json="<?=htmlspecialchars(stripslashes(json_encode($with, JSON_UNESCAPED_UNICODE)))?>">
                        <img src="<?=$with["user_img"]?>" alt="프로필 이미지" class="work_with__select-img" width="50" height="50">
                        <small class="work_with__select-nick"><?=$with["user_nick"]?></small>
                        <div class="work_with__select-overlay">
                            <button type="button" class="work_with__select-delete-button icon-button icon-20" data-user="<?=$with["user_no"]?>">
                            <span class="icon-x icon-20"></span>
                        </button>
                        </div>
                    </li>
                    <?php } ?>
                </ul>

                <div class="work_with__form input-box-t5">
                    <input type="text" name="user_nick" id="user_nick" class="input-box-t5__input" value="" placeholder="필명" autocomplete="off">
                    <button type="button" class="work_with__search-form-submit input-box-t5__action button button-t1 button-s4">
                        <span class="button-text">검색</span>
                    </button>
                </div>
                <ul class="work_with__list" onscroll="work_upload_obj.get_with_list();"></ul>
                <button type="button" class="work_with__add-button">확인</button>
            </div>
        </div>
        <div id="modal__footer">
        </div>
    </div>
</div>