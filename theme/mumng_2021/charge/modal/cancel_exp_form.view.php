<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals charge_cancel_modal" data-target="charge_cancel_modal">
    <div id="modal__box" class="modal__box--sm">
        <div id="modal__header" class="modal__header--lg">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="charge_cancel_modal"><span class="icon-x icon-20"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div id="charge_cancel__box">
                <form action="" id="charge_cancel__form" class="flex flex-column" enctype="multipart/form-data" novalidate autocomplete="off">
                    <input type="hidden" name="rcpt_id" value="<?=$receipt["rcpt_id"]?>">
                    <input type="hidden" name="settle_type" value="<?=$settle_type?>">

                    <div class="flex flex-column bdb-1-solid-g12 mghz-16 pdb-12 mgb-12">
                        <h3 class="text-weight-regular text-color-g7 text-size-xsmall">무명</h3>
                        <p class="text-weight-bold text-color-g12 text-size-large"><?=$receipt["item"]["it_name"]?></p>
                    </div>

                    <div class="flex flex-column mghz-16">
                        <div class="flex-align-self-flex-start mgb-12">
                            <img src="<?=$receipt["item"]["it_img"]?>" alt="EXP 이미지" width="65" height="65">
                        </div>
                        <dl class="flex flex-justify-content-space-between flex-align-item-center mgb-12">
                            <dt class="text-weight-regular text-color-g12 text-size-small">상품금액</dt>
                            <dd class="text-weight-bold text-color-g12 text-size-small"><?=Converter::display_number($receipt["item"]["it_price"], "원")?></dd>
                        </dl>
                        <dl class="flex flex-justify-content-space-between flex-align-item-center mgb-12">
                            <dt class="text-weight-regular text-color-g12 text-size-small">부가세</dt>
                            <dd class="text-weight-bold text-color-g12 text-size-small"><?=Converter::display_number($receipt["item"]["it_vat_price"], "원")?></dd>
                        </dl>
                        <dl class="flex flex-justify-content-space-between flex-align-item-center bdb-1-solid-g12 mgb-12 pdb-12">
                            <dt class="text-weight-regular text-color-g12 text-size-small">상품수</dt>
                            <dd class="text-weight-bold text-color-g12 text-size-small">1개</dd>
                        </dl>
                        <dl class="flex flex-justify-content-space-between flex-align-item-center mgb-16">
                            <dt class="text-weight-regular text-color-g12 text-size-small">총 상품 금액</dt>
                            <dd class="text-weight-bold text-color-g12 text-size-small"><?=Converter::display_number($receipt["item"]["it_real_price"], "원")?></dd>
                        </dl>
                    </div>

                    <div class="bdb-1-solid-g4"></div>
                    <div class="bdb-5-solid-g3 mgb-16"></div>

                    <div id="charge_cancel__reason-box" class="flex flex-column mghz-16 mgb-16">
                        <h3 class="text-weight-regular text-color-g12 text-size-small mgb-12">취소사유</h3>
                        <div class="flex flex-column gap-row-8">
                            <?php foreach ($payment_config["payment_cancel_reason_list"] as $i => $reason) { ?>
                                <?php if(!$reason["cancel_show"]) continue; ?>
                            <div class="flex flex-column pd-12 bdrd-2 bd-1-solid-g4">
                                <label for="rcpt_cancel_reason_<?=$reason["cancel_key"]?>" class="radio-box">
                                    <input type="radio" name="rcpt_cancel_reason" id="rcpt_cancel_reason_<?=$reason["cancel_key"]?>" class="radio-box__radio" value="<?=$reason["cancel_key"]?>" title="<?=$reason["cancel_value"]?>" required>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label"><?=$reason["cancel_value"]?></span>
                                </label>
                                <?php if($reason["cancel_key"] == "etc"){ ?>
                                <div id="charge_cancel__etc-box" class="mgt-12" style="display: none;">
                                    <div class="textarea-box">
                                        <textarea name="rcpt_cancel_reason_text" id="rcpt_cancel_reason_text" class="textarea-box__textarea" placeholder="기타사유" maxlength="500"></textarea>
                                        <div class="textarea-box__counter">
                                            <span class="textarea-box__counter-now">0</span>
                                            <span class="textarea-box__counter-max">/ 500자</span>
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

                    <?php if($receipt["rcpt_settle_case"] == "가상계좌"){ ?>
                    <div id="charge_cancel__refund-box" class="flex flex-column mghz-16">
                        <h3 class="text-weight-regular text-color-g12 text-size-small mgb-16">환불계좌</h3>
                        
                        <div class="mgb-34">
                            <div class="select-box">
                                <label for="rcpt_refund_bank" class="select-box__label">은행</label>
                                <select name="rcpt_refund_bank" id="rcpt_refund_bank" class="select-box__select" title="은행" required>
                                    <option value="" disabled selected>선택해주세요.</option>
                                    <?php foreach ($payment_config["payment_virtual_bank_list"] as $i => $bank) { ?>
                                    <option value="<?=$i?>"><?=$bank?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="mgb-34">
                            <div class="input-box input-box-t2">
                                <label for="rcpt_refund_account_number" class="input-box-t2__label">계좌번호</label>
                                <input type="text" name="rcpt_refund_account_number" id="rcpt_refund_account_number" class="input-box-t2__input" value="" title="계좌번호" required>
                            </div>
                        </div>
                        <div class="mgb-34">
                            <div class="input-box input-box-t2">
                                <label for="rcpt_refund_bank_owner" class="input-box-t2__label">예금주</label>
                                <input type="text" name="rcpt_refund_bank_owner" id="rcpt_refund_bank_owner" class="input-box-t2__input" value="" title="예금주" required>
                            </div>
                        </div>
                    </div>
                    <div class="bdb-1-solid-g4"></div>
                    <div class="bdb-5-solid-g3 mgb-16"></div>
                    <?php } ?>
                        
                    <div class="flex flex-column mghz-16 mgb-24">
                        <div class="mgb-24">
                            <label for="rcpt_privacy_agree" class="check-box">
                                <input type="checkbox" name="rcpt_privacy_agree" id="rcpt_privacy_agree" class="check-box__check" value="1" title="결제 밎 개인정보 제3자 제공 동의" required>
                                <span class="check-box__span"></span>
                                <span class="check-box__label">결제 밎 개인정보 제3자 제공 동의(필수)</span>
                                <a href="<?=get_url(PAVE_LEGAL_URL, "privacy")?>" target="_blank" class="check-box__more"><span class="skip">더보기</span><span class="icon-right icon-20"></span></a>
                            </label>
                        </div>
                        <div class="mgb-24">
                            <label for="rcpt_charge_agree" class="check-box">
                                <input type="checkbox" name="rcpt_charge_agree" id="rcpt_charge_agree" class="check-box__check" value="1" title="유료서비스 이용약관 동의" required>
                                <span class="check-box__span"></span>
                                <span class="check-box__label">유료서비스 이용약관 동의(필수)</span>
                                <a href="<?=get_url(PAVE_LEGAL_URL, "charge")?>" target="_blank" class="check-box__more"><span class="skip">더보기</span><span class="icon-right icon-20"></span></a>
                            </label>
                        </div>
                        <button type="submit" class="button-t1 button-s1">결제하기</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="modal__footer">
        </div>
    </div>
</div>