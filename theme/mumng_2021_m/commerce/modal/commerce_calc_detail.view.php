<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="commerce_calc_detail_modal bottom-sheet">
    <div id="modal__box2" class="modal__box--480">
        <div id="modal__header2">
            <h2 id="modal__header2-title"><?=$title?></h2>
        </div>
        <div id="modal__content">
            <div class="commerce_calc_detail__box">
                <div class="commerce_calc_detail__info">
                    <span class="commerce_calc_detail__info-label">정산현황</span>
                    <dl class="commerce_calc_detail__info-inner-box">
                        <dt class="commerce_calc_detail__info-text">정산번호</dt>
                        <dd class="commerce_calc_detail__info-text2"><?=$calc_detail["calc_id"]?></dd>
                    </dl>
                    <dl class="commerce_calc_detail__info-inner-box">
                        <dt class="commerce_calc_detail__info-text">정산신청일</dt>
                        <dd class="commerce_calc_detail__info-text2"><?=$calc_detail["calc_ready_dt_text"]?></dd>
                    </dl>
                    <dl class="commerce_calc_detail__info-inner-box">
                        <dt class="commerce_calc_detail__info-text">정산상태</dt>
                        <dd class="commerce_calc_detail__info-text2"><?=$calc_detail["calc_status_text"]?></dd>
                    </dl>
                    <dl class="commerce_calc_detail__info-inner-box">
                        <dt class="commerce_calc_detail__info-text">정산EXP</dt>
                        <dd class="commerce_calc_detail__info-text2"><?=Converter::display_number($calc_detail["calc_exp"], "EXP")?></dd>
                    </dl>
                    <dl class="commerce_calc_detail__info-inner-box">
                        <dt class="commerce_calc_detail__info-text">정산금액</dt>
                        <dd class="commerce_calc_detail__info-text2"><?=Converter::display_number($calc_detail["calc_real_price"], "원")?></dd>
                    </dl>
                </div>
                <div class="commerce_calc_detail__info">
                    <span class="commerce_calc_detail__info-label">정산계좌</span>
                    <dl class="commerce_calc_detail__info-inner-box">
                        <dt class="commerce_calc_detail__info-text">은행</dt>
                        <dd class="commerce_calc_detail__info-text2"><?=$calc_detail["calc_bank"]?></dd>
                    </dl>
                    <dl class="commerce_calc_detail__info-inner-box">
                        <dt class="commerce_calc_detail__info-text">계좌번호</dt>
                        <dd class="commerce_calc_detail__info-text2"><?=$calc_detail["calc_bank_number"]?></dd>
                    </dl>
                    <dl class="commerce_calc_detail__info-inner-box">
                        <dt class="commerce_calc_detail__info-text">예금주</dt>
                        <dd class="commerce_calc_detail__info-text2"><?=$calc_detail["calc_bank_owner"]?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div id="modal__footer"></div>
    </div>
</div>
