<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals user_follow_modal" data-target="user_follow_modal">
    <div id="modal__box" class="modal__box--normal">
        <div id="modal__header" class="modal__header-line">
            <div id="modal__header-tab">
                <ul id="modal__header-tab-list">
                    <li class="modal__header-tab-item <?=$type == "follower" ? "current" : ""?>">
                        <button type="button" class="follower-button" data-user="<?=$user_no?>">팔로워</button>
                    </li>
                    <li class="modal__header-tab-item <?=$type == "following" ? "current" : ""?>">
                        <button type="button" class="following-button" data-user="<?=$user_no?>">팔로잉</button>
                    </li>
                </ul>
            </div>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="user_follow_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>

        </div>
        <div id="modal__content">
            <div class="user_follow__box">
                <div class="user_follow__title">
                    <span class="user_follow__title-text"><?=$title?></span>
                    <span class="user_follow__title-text2">0</span>
                </div>

                <div class="user_follow__search input-box input-box-t5">
                    <input type="text" id="follow_keyword" class="input-box-t5__input" value="" placeholder="필명 입력">
                    <button type="button" id="follow_search_button" class="input-box-t5__action button-t1 button-s4">검색</button>
                </div>

                <ul class="user_follow__list">
                </ul>
            </div>
        </div>
        <div id="modal__footer">
        </div>
    </div>
<script>
$(document).ready(function(){
    follow_obj.get_user_follow_list();
});
</script>
</div>