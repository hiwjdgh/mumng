<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals charge_pay_modal" data-target="charge_pay_modal">
    <div id="modal__box" class="modal__box--sm">
        <div id="modal__header" class="modal__header--lg">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="charge_pay_modal"><span class="icon-x icon-20"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div class="charge_pay__box">
                <div class="charge_pay__info">
                    <div class="charge_pay__info-inner-box">
                        <span class="charge_pay__info-text"><?=Converter::display_number($pay["pay_exp"])?></span>
                        <span class="charge_pay__info-text2">EXP</span>
                    </div>
                    <span class="charge_pay__info-text3">구매</span>
                </div>

                <div class="charge_pay__infos">
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">구매상태</dt>
                        <dd class="charge_pay__infos-text2"><?=$pay["pay_status_text"]?></dd>
                    </dl>
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">구매번호</dt>
                        <dd class="charge_pay__infos-text2"><?=$pay["pay_id"]?></dd>
                    </dl>
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">구매일</dt>
                        <dd class="charge_pay__infos-text2"><?=$pay["pay_insert_dt"]?></dd>
                    </dl>
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">만료일</dt>
                        <dd class="charge_pay__infos-text2"><?=$pay["pay_expire_text"]?></dd>
                    </dl>
                </div>

                <div class="charge_pay__infos">
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">작품명</dt>
                        <dd class="charge_pay__infos-text2"><?=$pay["pay_work"]["work_name"]?></dd>
                    </dl>
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">회차명</dt>
                        <dd class="charge_pay__infos-text2"><?=$pay["pay_epsd"]["epsd_name"]?></dd>
                    </dl>
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">작가명</dt>
                        <dd class="charge_pay__infos-text2"><?=$pay["pay_work"]["work_user"]["user_nick"]?></dd>
                    </dl>
                </div>

                <div class="charge_pay__infos">
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">사용 EXP</dt>
                        <dd class="charge_pay__infos-text3"><?=Converter::display_number($pay["pay_exp"], "EXP")?></dd>
                    </dl>
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">구분</dt>
                        <dd class="charge_pay__infos-text3"><?=$pay["pay_type_text"]?></dd>
                    </dl>
                </div>

                <?php if($pay["pay_status"] == "cancel"){ ?>
                <div class="charge_pay__infos">
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">구매취소일</dt>
                        <dd class="charge_pay__infos-text3"><?=$pay["pay_cancel_dt"]?></dd>
                    </dl>
                    <dl class="charge_pay__infos-inner-box">
                        <dt class="charge_pay__infos-text">반환 EXP</dt>
                        <dd class="charge_pay__infos-text3"><?=Converter::display_number($pay["pay_cancel_exp"], "EXP")?></dd>
                    </dl>
                </div>
                <?php }?>

                <div class="charge_pay__action">
                    <button type="button" class="charge_pay__action-delete-button pay-delete-button" data-pay="<?=$pay["pay_id"]?>">내역삭제</button>
                    <?php if($pay["is_cancelable"]){ ?>
                    <button type="button" class="charge_pay__action-cancel-button pay-cancel-button" data-pay="<?=$pay["pay_id"]?>">구매취소</button>
                    <?php }?>
                </div>
            </div>
        </div>
        <div id="modal__footer">
        </div>
    </div>
</div>
