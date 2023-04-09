<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals user_major_modal" data-target="user_major_modal">
    <div id="modal__box" class="modal__box--sm">
        <div id="modal__header" class="modal__header-line">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="user_major_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div id="user_major__box">
                <ul id="user_major__list">
                    <?php if(pave_is_array($work_list)){ ?>
                        <li class="user_major__item">
                            <label for="user_major_n" class="check-box">
                                <input type="radio" name="user_major_tmp" id="user_major_n" class="check-box__check" value="" checked>
                                <span class="check-box__span"></span>
                                <span class="check-box__label">등록안함</span>
                            </label>
                        </li>
                        <?php foreach ($work_list as $i => $work) { ?>
                        <li class="user_major__item">
                            <label for="user_major_<?=$i?>" class="check-box">
                                <input type="radio" name="user_major_tmp" id="user_major_<?=$i?>" class="check-box__check" value="<?=htmlspecialchars(json_encode($work))?>" <?=get_checked($work["work_id"], $data)?>>
                                <span class="check-box__span"></span>
                                <span class="check-box__label"><?=$work["work_name"]?></span>
                            </label>
                        </li>
                        <?php } ?>
                    <?php }else{ ?>
                    <li class="user_major__item-empty">
                        <a href="<?=get_url(PAVE_UPLOAD_URL, "home")?>" id="user_major__upload" target="_blank">
                            <span id="user_major__upload-icon" class="icon-plus icon-24"></span>
                            <span id="user_major__upload-text">작품 등록</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div id="modal__footer">
            <button type="button" id="user_major__save-button" class="button-t1 button-s3">확인</button>
        </div>
    </div>
</div>