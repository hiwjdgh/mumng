<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals charge_receipt_modal" data-target="charge_receipt_modal">
    <div id="modal__box" class="modal__box--sm">
        <div id="modal__header" class="modal__header--lg">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="charge_receipt_modal"><span class="icon-x icon-20"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div class="charge_receipt__box">
                <div class="charge_receipt__info">
                    <div class="charge_receipt__info-inner-box">
                        <span class="charge_receipt__info-text"><?=Converter::display_number($receipt["rcpt_exp"]["exp_amount"])?></span>
                        <span class="charge_receipt__info-text2">EXP</span>
                    </div>
                    <span class="charge_receipt__info-text3"><?=$receipt["rcpt_exp"]["exp_type_text"]?></span>
                </div>

                <div class="charge_receipt__infos">
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">결제상태</dt>
                        <dd class="charge_receipt__infos-text2"><?=$receipt["rcpt_status_text"]?></dd>
                    </dl>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">결제번호</dt>
                        <dd class="charge_receipt__infos-text2"><?=$receipt["rcpt_id"]?></dd>
                    </dl>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">결제일</dt>
                        <?php if(is_time_null($receipt["rcpt_success_dt"])){ ?>
                        <dd class="charge_receipt__infos-text2">-</dd>
                        <?php }else{ ?>
                        <dd class="charge_receipt__infos-text2"><?=$receipt["rcpt_success_dt"]?></dd>
                        <?php } ?>
                    </dl>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">충전일</dt>
                        <?php if(is_time_null($receipt["rcpt_charge_dt"])){ ?>
                        <dd class="charge_receipt__infos-text2">-</dd>
                        <?php }else{ ?>
                        <dd class="charge_receipt__infos-text2"><?=$receipt["rcpt_charge_dt"]?></dd>
                        <?php } ?>
                    </dl>
                </div>

                <?php if($receipt["rcpt_exp"]["exp_type"] == "payment"){ ?>
                <div class="charge_receipt__infos">
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">상품명</dt>
                        <dd class="charge_receipt__infos-text2"><?=$receipt["item"]["it_name"]?></dd>
                    </dl>
                </div>

                <div class="charge_receipt__infos">
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">결제자</dt>
                        <dd class="charge_receipt__infos-text3"><?=$receipt["rcpt_customer"]?></dd>
                    </dl>
                </div>

                <div class="charge_receipt__infos">
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">결제금액</dt>
                        <dd class="charge_receipt__infos-text3"><?=Converter::display_number($receipt["rcpt_price"], "원")?></dd>
                    </dl>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">결제방법</dt>
                        <dd class="charge_receipt__infos-text3"><?=$receipt["rcpt_settle_case"]?></dd>
                    </dl>
                    <?php if($receipt["rcpt_virtual"]){ ?>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">가상계좌</dt>
                        <dd class="charge_receipt__infos-text3">
                            <?=$receipt["rcpt_virtual"]["bank"]?>
                            <?=$receipt["rcpt_virtual"]["accountNumber"]?>
                        </dd>
                    </dl>
                    <?php if(strtotime($receipt["rcpt_virtual"]["dueDate"]) > PAVE_TIME){ ?>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">입금만료일</dt>
                        <dd class="charge_receipt__infos-text2">
                            <?=Converter::display_time("Y-m-d H:i:s", $receipt["rcpt_virtual"]["dueDate"]) ?>
                        </dd>
                    </dl>
                    <?php } ?>
                    <?php } ?>

                    <?php if($receipt["rcpt_card"]){ ?>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">결제방법 상세</dt>
                        <dd class="charge_receipt__infos-text2">
                            <?php if($receipt["rcpt_payment_type"] == "kakaopay"){ ?>
                                <?=$receipt["rcpt_card"]["purchase_corp"]?>
                            <?php }else{ ?>
                                <?=$receipt["rcpt_card"]["company"]?>
                                <?=$receipt["rcpt_card"]["number"]?>
                            <?php } ?>
                        </dd>
                    </dl>
                    <?php } ?>
                </div>

                <?php if($receipt["rcpt_status"] == "payment_complete"){ ?>
                <?php if($receipt["rcpt_payment_type"] != "kakaopay"){ ?>
                <div class="charge_receipt__infos">
                    <?php if($receipt["rcpt_virtual"]){ ?>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">현금영수증</dt>
                        <?php if($receipt["rcpt_cash"]){ ?>
                        <dd class="charge_receipt__infos-text2"><a href="<?=$receipt["rcpt_cash"]["receiptUrl"]?>" target="_blank">확인</a></dd>
                        <?php }else{ ?>
                        <dd class="charge_receipt__infos-text2"><button type="button" id="charge_receipt_detail__cash-button" data-receipt="<?=$receipt["rcpt_id"]?>">발급하기</button></dd>
                        <?php } ?>
                    </dl>
                    <?php } ?>
                    <?php if($receipt["rcpt_card"]){ ?>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">카드영수증</dt>
                        <dd class="charge_receipt__infos-text2"><a href="<?=$receipt["rcpt_card"]["receiptUrl"]?>" target="_blank">확인</a></dd>
                    </dl>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php } ?>

                <?php if($receipt["rcpt_cancel"]){ ?>
                <div class="charge_receipt__infos">
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">취소수단</dt>
                        <dd class="charge_receipt__infos-text2"><?=$receipt["rcpt_settle_case"]?> 결제 취소</dd>
                    </dl>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">취소금액</dt>
                        <?php if($receipt["rcpt_payment_type"] != "kakaopay"){ ?>
                        <dd class="charge_receipt__infos-text2"><?=Converter::display_number($receipt["rcpt_cancel"]["cancelAmount"], "원") ?></dd>
                        <?php }else{ ?>
                        <dd class="charge_receipt__infos-text2"><?=Converter::display_number($receipt["rcpt_cancel"]["total"], "원") ?></dd>
                        <?php } ?>

                    </dl>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">취소일</dt>
                        <dd class="charge_receipt__infos-text2"><?=$receipt["rcpt_cancel_dt"]?></dd>
                    </dl>
                    <?php if($receipt["rcpt_virtual"]){ ?>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">환불은행</dt>
                        <dd class="charge_receipt__infos-text2"><?=$receipt["rcpt_refund_bank"]?></dd>
                    </dl>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">환불계좌번호</dt>
                        <dd class="charge_receipt__infos-text2"><?=$receipt["rcpt_refund_account_number"]?></dd>
                    </dl>
                    <dl class="charge_receipt__infos-inner-box">
                        <dt class="charge_receipt__infos-text">환불예금주</dt>
                        <dd class="charge_receipt__infos-text2"><?=$receipt["rcpt_refund_bank_owner"]?></dd>
                    </dl>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php } ?>

                <div class="charge_receipt__action">
                    <button type="button" class="charge_receipt__action-delete-button receipt-delete-button" data-receipt="<?=$receipt["rcpt_id"]?>">내역삭제</button>
                    <?php if($receipt["is_cancelable"]){ ?>
                        <button type="button" class="charge_receipt__action-cancel-button charge-cancel-button" data-receipt="<?=$receipt["rcpt_id"]?>" data-settle="<?=$receipt["rcpt_payment_type"] == "kakaopay" ? "kakaopay" : "toss" ?>">결제취소</button>
                    <?php } ?>
                </div>

            </div>
        </div>
        <div id="modal__footer">
        </div>
    </div>
</div>