<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals charge_modal" data-target="charge_modal">
    <div id="modal__box" class="modal__box--sm">
        <div id="modal__header" class="modal__header--lg">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button" data-anchor="charge_modal"><span class="icon-x icon-20"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div id="charge__box">
                <form id="charge__form"  class="flex flex-column" novalidate autocomplete="off">
                    <input type="hidden" name="it_no" value="<?=$item["it_no"]?>">
                    <input type="hidden" name="rcpt_id" value="<?=$rcpt_id?>">
                    <input type="hidden" name="card_no" id="card_no" value="">
                    <input type="hidden" name="customer_key" id="customer_key" value="<?=$pave_user["user_code"]?>">
                    <input type="hidden" name="rcpt_price" value="<?=$item["it_real_price"]?>">
                    <input type="hidden" name="rcpt_name" value="<?=$item["it_name"]?>">

                    <div class="flex flex-column bdb-1-solid-g12 mghz-16 pdb-12 mgb-12">
                        <h3 class="text-weight-regular text-color-g7 text-size-xsmall">무명</h3>
                        <p class="text-weight-bold text-color-g12 text-size-large"><?=$item["it_name"]?></p>
                    </div>

                    <div class="flex flex-column mghz-16">
                        <div class="flex-align-self-flex-start mgb-12">
                            <img src="<?=$item["it_img"]?>" alt="EXP 이미지" width="65" height="65">
                        </div>
                        <dl class="flex flex-justify-content-space-between flex-align-item-center mgb-12">
                            <dt class="text-weight-regular text-color-g12 text-size-small">상품금액</dt>
                            <dd class="text-weight-bold text-color-g12 text-size-small"><?=Converter::display_number($item["it_price"], "원")?></dd>
                        </dl>
                        <dl class="flex flex-justify-content-space-between flex-align-item-center mgb-12">
                            <dt class="text-weight-regular text-color-g12 text-size-small">부가세</dt>
                            <dd class="text-weight-bold text-color-g12 text-size-small"><?=Converter::display_number($item["it_vat_price"], "원")?></dd>
                        </dl>
                        <dl class="flex flex-justify-content-space-between flex-align-item-center bdb-1-solid-g12 mgb-12 pdb-12">
                            <dt class="text-weight-regular text-color-g12 text-size-small">상품수</dt>
                            <dd class="text-weight-bold text-color-g12 text-size-small">1개</dd>
                        </dl>
                        <dl class="flex flex-justify-content-space-between flex-align-item-center mgb-16">
                            <dt class="text-weight-regular text-color-g12 text-size-small">총 상품 금액</dt>
                            <dd class="text-weight-bold text-color-g12 text-size-small"><?=Converter::display_number($item["it_real_price"], "원")?></dd>
                        </dl>
                    </div>

                    <div class="bdb-1-solid-g4"></div>
                    <div class="bdb-5-solid-g3 mgb-16"></div>

                    <div id="charge__settle-box" class="flex flex-column mghz-16 mgb-16">
                        <h3 class="text-weight-regular text-color-g12 text-size-small mgb-12">결제방법</h3>
                        <div class="flex flex-column gap-row-8">
                            <?php foreach ($payment_config["payment_settle_type_list"] as $i => $settle) { ?>
                            <?php if(!$settle["settle_show"]) continue; ?>
                            <div class="flex flex-column pd-12 bdrd-2 bd-1-solid-g4">
                                <label for="rcpt_settle_case_<?=$settle["settle_key"]?>" class="radio-box">
                                    <input type="radio" name="rcpt_settle_case" id="rcpt_settle_case_<?=$settle["settle_key"]?>" class="radio-box__radio" value="<?=$settle["settle_key"]?>" title="<?=$settle["settle_value"]?>" required>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">
                                        <?php if($settle["settle_key"] == "kakaopay"){ ?>
                                        <img src="<?=get_url(PAVE_IMG_URL, "icon_kakaopay_97px.png")?>" alt="카카오페이 이미지" width="48">
                                        <?php }else{ ?>
                                        <?=$settle["settle_value"]?>
                                        <?php } ?>
                                    </span>
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="bdb-1-solid-g4"></div>
                    <div class="bdb-5-solid-g3 mgb-16"></div>

                    <div id="charge__card-box" class="flex flex-column" style="display: none;">
                        <div class="flex flex-column mghz-16 mgb-16">
                            <div class="flex flex-justify-content-space-between flex-align-item-center mgb-12">
                                <h3 class="text-weight-regular text-color-g12 text-size-small">간편카드</h3>
                                <button type="button" id="charge_card-edit-button" class="button-t2 button-s4">편집</button>
                            </div>
                            <div id="charge__card-list-box" class="swiper-container bd-1-solid-g4 bdrd-2 mgb-12">
                                <ul id="charge__card-list" class="swiper-wrapper flex flex-align-item-center">
                                    <?php if(pave_is_array($pave_user["user_card"])){ ?>
                                        <?php foreach ($pave_user["user_card"] as $i => $card) { ?>
                                        <li class="charge__card-item swiper-slide mgb-12" data-card="<?=$card["card_no"]?>">
                                            <div class="charge__card-item-box flex flex-column pd-12 bd-1-solid-g4 bdrd-6 bg-g2 bx-shadow">
                                                <span class="text-weight-bold text-color-g12 text-size-small"><?=$card["card_number"]?></span>
                                                <span class="flex-align-self-flex-end mgt-auto text-weight-bold text-color-g12 text-size-small"><?=$card["card_company"]?></span>
                                            </div>
                                            <div class="charge__card-item-overlay-box">
                                                <button type="button" class="charge__card-item-delete-button icon-button icon-button-circle icon-button-40" data-card="<?=$card["card_no"]?>">
                                                    <span class="icon-x icon-20"></span>
                                                </button>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    <?php } ?>
                                    <li class="charge__card-item swiper-slide mgb-12">
                                        <div class="charge__card-item-box flex flex-column flex-justify-content-center pd-12 bd-1-solid-g4 bdrd-6 bg-g2 bx-shadow">
                                            <button type="button" class="payment_card_button flex flex-column flex-justify-content-center flex-align-item-center">
                                                <span class="icon-plus icon-24 mgb-12"></span>
                                                <span class="text-weight-regular text-color-g7 text-size-small">카드를 등록해주세요.</span>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                                <div id="charge__card-item-pagination" class="swiper-pagination"></div>
                                <button type="button" id="charge__card-item-prev" class="icon-button icon-button-20" style="display: none;"><span class="icon icon-20 icon-left-circle"></span></button>
                                <button type="button" id="charge__card-item-next" class="icon-button icon-button-20" style="display: none;"><span class="icon icon-20 icon-right-circle"></span></button>
                            </div>
                        </div>
                        
                        <div class="bdb-1-solid-g4"></div>
                        <div class="bdb-5-solid-g3 mgb-16"></div>
                    </div>
                    
                    <div id="charge__virtual-box" class="flex flex-column" style="display: none;">
                        <div class="flex flex-column mghz-16 mgb-16">
                            <h3 class="text-weight-regular text-color-g12 text-size-small mgb-12">가상계좌은행</h3>
                            <div class="select-box">
                                <select name="rcpt_virtual_bank" id="rcpt_virtual_bank" class="select-box__select" title="가상계좌은행">
                                    <option value="" disabled selected>선택해주세요.</option>
                                    <?php foreach ($payment_cf["payment_virtual_bank_list"] as $i => $bank) { ?>
                                    <option value="<?=$i?>"><?=$bank?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="bdb-1-solid-g4"></div>
                        <div class="bdb-5-solid-g3 mgb-16"></div>
                    </div>

                    <div id="charge__cash-box" class="flex flex-column" style="display: none;">
                        <div class="flex flex-column mghz-16 mgb-16">
                            <h3 class="text-weight-regular text-color-g12 text-size-small mgb-12">현금영수증</h3>
                            <div class="flex flex-column gap-row-8">
                                <div class="flex flex-align-item-center pd-12 bdrd-2 bd-1-solid-g4">
                                    <label for="rpct_cash_type_none" class="radio-box">
                                        <input type="radio" name="rcpt_cash_type" id="rpct_cash_type_none" class="radio-box__radio" value="미발급" title="현금영수증구분" checked>
                                        <span class="radio-box__span"></span>
                                        <span class="radio-box__label">미발급</span>
                                    </label>
                                </div>
                                <div class="flex flex-justify-content-space-between flex-align-item-center pd-12 bdrd-2 bd-1-solid-g4">
                                    <label for="rpct_cash_type_cp" class="radio-box">
                                        <input type="radio" name="rcpt_cash_type" id="rpct_cash_type_cp" class="radio-box__radio" value="소득공제,휴대폰번호" title="현금영수증구분">
                                        <span class="radio-box__span"></span>
                                        <span class="radio-box__label">휴대폰번호</span>
                                    </label>
                                    <div class="charge__cash-no-box mxw-5" style="display: none;">
                                        <div class="input-box input-box-t4">
                                            <input type="tel" name="rcpt_cash_cp_number" id="rcpt_cash_cp_number" class="input-box-t4__input" value="" title="휴대폰번호" placeholder="숫자만 입력해 주세요.">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-justify-content-space-between flex-align-item-center pd-12 bdrd-2 bd-1-solid-g4">
                                    <label for="rpct_cash_type_card" class="radio-box">
                                        <input type="radio" name="rcpt_cash_type" id="rpct_cash_type_card" class="radio-box__radio" value="소득공제,현금영수증카드" title="현금영수증구분">
                                        <span class="radio-box__span"></span>
                                        <span class="radio-box__label">현금영수증카드</span>
                                    </label>
                                    <div class="charge__cash-no-box mxw-5" style="display: none;">
                                        <div class="input-box input-box-t4">
                                            <input type="text" name="rcpt_cash_card_number" id="rcpt_cash_card_number" class="input-box-t4__input" value="" title="현금영수증카드번호" placeholder="숫자만 입력해 주세요.">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-justify-content-space-between flex-align-item-center pd-12 bdrd-2 bd-1-solid-g4">
                                    <label for="rpct_cash_type_spend" class="radio-box">
                                        <input type="radio" name="rcpt_cash_type" id="rpct_cash_type_spend" class="radio-box__radio" value="지출증빙,사업자등록번호" title="현금영수증구분">
                                        <span class="radio-box__span"></span>
                                        <span class="radio-box__label">지출증빙</span>
                                    </label>
                                    <div class="charge__cash-no-box mxw-5" style="display: none;">
                                        <div class="input-box input-box-t4">
                                            <input type="text" name="rcpt_cash_business_number" id="rcpt_cash_business_number" class="input-box-t4__input" value="" title="사업자번호" placeholder="숫자만 입력해 주세요.">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bdb-1-solid-g4"></div>
                        <div class="bdb-5-solid-g3 mgb-16"></div>
                    </div>
                    
                    <div class="flex flex-column mghz-16 mgb-24">
                        <div class="flex flex-justify-content-space-between flex-align-item-center bdb-1-solid-g12 mgb-16 pdb-16">
                            <span class="text-weight-bold text-color-g12 text-size-small">총 결제금액</span>
                            <span class="text-weight-bold text-color-g12 text-size-small"><?=Converter::display_number($item["it_real_price"], "원")?></span>
                        </div>
                        
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
<script>
var payment_card_swiper = new Swiper('#charge__card-list-box',{
    slidesPerView: "1",
    allowTouchMove: false,
    navigation: {
    nextEl: "#charge__card-item-next",
    prevEl: "#charge__card-item-prev",
    },
     pagination: {
        el: '#charge__card-item-pagination',
        clickable: true
    },
    on:{
        "update": function(info){
            if(info.slides.length > 1) {
                if(info.isEnd){
                    $("#charge__card-item-next").hide();
                }else{
                    $("#charge__card-item-next").show();
                }
                if(info.isBeginning){
                    $("#charge__card-item-prev").hide();
                }else{
                    $("#charge__card-item-prev").show();
                }
            }else{
                $("#charge__card-item-next").hide();
                $("#charge__card-item-prev").hide();

            }

            if($(info.slides[0]).data("card") == ""){
                $("#card_no").val("");
                return;
            }

            $("#card_no").val($(info.slides[0]).data("card"));
        },
        "slideChange": function(info){
            if(info.slides.length > 1) {
                if(info.isEnd){
                    $("#charge__card-item-next").hide();
                }else{
                    $("#charge__card-item-next").show();
                }
                if(info.isBeginning){
                    $("#charge__card-item-prev").hide();
                }else{
                    $("#charge__card-item-prev").show();
                }
            }

           if($(info.slides[info.realIndex]).data("card") == ""){
               $("#card_no").val("");
                return;
            }

            $("#card_no").val($(info.slides[info.realIndex]).data("card"));
        }
    }
});
</script>
</div>