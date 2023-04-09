<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals pay_cancel_modal" data-target="pay_cancel_modal">
    <div id="modal__box" class="modal__box--sm">
        <div id="modal__header" class="modal__header--lg">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="pay_cancel_modal"><span class="icon-x icon-20"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div id="pay_cancel__box">
                <form id="pay_cancel__form" class="flex flex-column" enctype="multipart/form-data" novalidate autocomplete="off">
                    <input type="hidden" name="pay_id" value="<?=$pay["pay_id"]?>">

                    <div class="flex bdb-1-solid-g4 mghz-16 pdb-12 mgb-24">
                        <?php if($pay["pay_work"]["work_img"]){ ?>
                        <div class="mgr-12 mxw-60">
                            <img src="<?=$pay["pay_work"]["work_img"]?>" alt="작품 이미지" width="60" height="60">
                        </div>
                        <?php } ?>
                        <div class="flex flex-column text-truncate">
                            <span class="text-weight-regular text-color-g7 text-size-xsmall text-truncate"><?=$pay["pay_work"]["work_name"]?></span>
                            <span class="text-weight-medium text-color-g12 text-size-large text-truncate"><?=$pay["pay_epsd"]["epsd_name"]?></span>
                        </div>
                    </div>

                    <div class="bdb-1-solid-g4"></div>
                    <div class="bdb-5-solid-g3 mgb-16"></div>

                    <div id="pay_cancel__reason-box" class="flex flex-column mghz-16 mgb-16">
                        <h3 class="text-weight-regular text-color-g12 text-size-small mgb-12">취소사유</h3>
                        <div class="flex flex-column gap-row-8">
                            <?php foreach ($pay_config["pay_cancel_reason_list"] as $i => $reason) { ?>
                                <?php if(!$reason["cancel_show"]) continue; ?>
                            <div class="flex flex-column pd-12 bdrd-2 bd-1-solid-g4">
                                <label for="pay_cancel_reason_<?=$reason["cancel_key"]?>" class="radio-box">
                                    <input type="radio" name="pay_cancel_reason" id="pay_cancel_reason_<?=$reason["cancel_key"]?>" class="radio-box__radio" value="<?=$reason["cancel_key"]?>" title="<?=$reason["cancel_value"]?>" required>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label"><?=$reason["cancel_value"]?></span>
                                </label>
                                <?php if($reason["cancel_key"] == "etc"){ ?>
                                <div id="pay_cancel__etc-box" class="mgt-12" style="display: none;">
                                    <div class="textarea-box">
                                        <textarea name="pay_cancel_reason_text" id="pay_cancel_reason_text" class="textarea-box__textarea" placeholder="기타사유" maxlength="<?=$pay_config["pay_reason_text_max_len"]?>"></textarea>
                                        <div class="textarea-box__counter">
                                            <span class="textarea-box__counter-now">0</span>
                                            <span class="textarea-box__counter-max">/ <?=$pay_config["pay_reason_text_max_len"]?>자</span>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="bdb-1-solid-g4"></div>
                    <div class="bdb-5-solid-g3 mgb-16"></div>

                    <div class="flex flex-column mghz-16 mgb-24">
                        <div class="mgb-24">
                            <label for="pay_agree" class="check-box">
                                <input type="checkbox" name="pay_agree" id="pay_agree" class="check-box__check" value="1" title="유료서비스 이용약관 동의" required>
                                <span class="check-box__span"></span>
                                <span class="check-box__label">유료서비스 이용약관 동의(필수)</span>
                                <a href="<?=get_url(PAVE_LEGAL_URL, "charge")?>" target="_blank" class="check-box__more"><span class="skip">더보기</span><span class="icon-right icon-20"></span></a>
                            </label>
                        </div>
                        <button type="submit" class="button-t1 button-s1">구매취소</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="modal__footer">
        </div>
    </div>
</div>