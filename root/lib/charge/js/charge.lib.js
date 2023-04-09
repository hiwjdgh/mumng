const tossPayments = TossPayments(pave_toss_client_key);

const charge_obj = {
    init: function(){
        charge_obj.add_event();
    },
    add_event: function(){
        $(document).on("click", ".charge-button", function(){
            charge_obj.charge($(this))
        });
        $(document).on("submit", "#charge__form", function(e){
            let f = this;

            if($("input[name='rcpt_settle_case']:checked").length == 0){
                alert("결제방식을 선택해주세요.");
                return false;
            } 
        
            if(f.rcpt_settle_case.value == "easy"){
                if(f.card_no.value == ""){
                    if(confirm("간편카드결제 시 카드등록이 필요합니다.\n신용카드를 등록하시겠습니까?")){
                        charge_obj.toss_payment_card();
                        return false;
                    }
                    return false;
                }
            }else if(f.rcpt_settle_case.value == "virtual"){
                if(f.rcpt_virtual_bank.value == ""){
                    alert("가상계좌 은행을 선택해주세요.");
                    return false;
                }
                if($("input[name='rcpt_cash_type']:checked").length == 0){
                    alert("현금영수증 발급여부를 선택해주세요.");
                    return false;
                } 
        
                if(f.rcpt_cash_type.value == "소득공제,휴대폰번호"){
                    if($("#rcpt_cash_cp_number").val() == ""){
                        alert("휴대폰번호를 입력해주세요.");
                        $("#rcpt_cash_cp_number").focus();
                        return false;
                    }
                }else if(f.rcpt_cash_type.value == "소득공제,현금영수증카드"){
                    if($("#rcpt_cash_card_number").val() == ""){
                        alert("현금영수증카드를 입력해주세요.");
                        $("#rcpt_cash_card_number").focus();
                        return false;
                    }
                }else if(f.rcpt_cash_type.value == "지출증빙,사업자등록번호"){
                    if($("#rcpt_cash_business_number").val() == ""){
                        alert("사업자등록번호를 입력해주세요.");
                        $("#rcpt_cash_business_number").focus();
                        return false;
                    }
                }
        
            }
        
            if(!$("#rcpt_privacy_agree").is(":checked")){
                alert("결제 밎 개인정보 제3자 제공 동의해주세요.");
                return false;
            }
            if(!$("#rcpt_charge_agree").is(":checked")){
                alert("유료서비스 이용약관 동의해주세요.");
                return false;
            }
        
        
            if(f.rcpt_settle_case.value == "easy"){
                f.action = window.location.origin + "/charge/toss/card/billing";
                return true;
            }else if(f.rcpt_settle_case.value == "kakaopay"){
                f.action = window.location.origin + "/charge/kakaopay/load";
                return true;
            }else{
                //신용카드 결제
                if(!charge_obj.toss_payment(f)){
                    alert("비정상적인 접근입니다.");
                    location.reload();
                    return false;
                }
            }

            return false;
        });
        
        $(document).on("click", ".charge-cancel-button", function(){
            charge_obj.cancel($(this))
        });
        $(document).on("submit", "#charge_cancel__form", function(e){
            let f = this;
            if($("input[name='rcpt_cancel_reason']:checked").length == 0){
                alert("취소사유를 선택해주세요.");
                return false;
            } 
        
            if($("input[name='rcpt_cancel_reason']:checked").val() == "etc"){
                if($("#rcpt_cancel_reason_text").val() == ""){
                    alert("기타사유를 작성해주세요.");
                    return false;
                }
            }
        
            if($("#charge_cancel__refund-box").length > 0){
                if(!$("#rcpt_refund_bank").val()){
                    alert("은행을 선택해주세요.");
                    return false;
                }
        
                if($("#rcpt_refund_account_number").val() == ""){
                    alert("계좌번호를 입력해주세요.");
                    return false;
                }
        
                if($("#rcpt_refund_bank_owner").val() == ""){
                    alert("예금주를 입력해주세요.");
                    return false;
                }
            }
        
            if(!$("#rcpt_privacy_agree").is(":checked")){
                alert("결제 밎 개인정보 제3자 제공 동의해주세요.");
                return false;
            }
            if(!$("#rcpt_charge_agree").is(":checked")){
                alert("유료서비스 이용약관 동의해주세요.");
                return false;
            }
    
            pave_async_ajax("/api/charge/"+f.settle_type.value+"/cancel", "POST", $(f))
            .then(function(result){
                if(result.status == "success"){
                    alert("결제 취소가 요청되었습니다.\n취소 요청날짜 기준으로 3~5일(주말 제외) 후 환불 처리됩니다.");
                    location.reload();
                }else{
                    if(result.msg){
                        if(result.redirect_url){
                            if(confirm(result.msg)){
                                location.href = result.redirect_url;
                            }
                        }else{
                            alert(result.msg);
                        }
                    }else{
                        alert("에러가 발생하였습니다. 다시 시도해주시기 바랍니다.");
                    }
                }
            });
    
            return false;
        });

        $(document).on("change", "input[name='rcpt_settle_case']", function(event){
            $("#charge__card-list").removeClass("edit");
            $("#charge__card-box").hide();
            $("#card_no").val("");
    
            $("#charge__virtual-box").hide();
    
            $("#charge__cash-box").hide();
            $("#rcpt_virtual_bank").val("").trigger("change");
    
            if($(this).val() == "easy"){
                $("#charge__card-box").show();
                payment_card_swiper.update();
    
            }else if($(this).val() == "virtual"){
                $("#rpct_cash_type_none").trigger("click");
                $("#charge__cash-box").show();
                $("#charge__virtual-box").show();
            }
        });
    
        $(document).on("change", "input[name='rcpt_cash_type']", function(event){
            $(".charge__cash-no-box").hide();
            $(this).closest(".radio-box").siblings(".charge__cash-no-box").find("input").val("");
            $(this).closest(".radio-box").siblings(".charge__cash-no-box").show();
        });
    
        $(document).on("click", "#charge_card-edit-button", function(){
            if($(".charge__card-item").length == 1){
                return;
            }
    
            if($("#charge__card-list").hasClass("edit")){
                $("#charge_card-edit-button").text("편집");
            }else{
                $("#charge_card-edit-button").text("취소");
            }
            $("#charge__card-list").toggleClass("edit");
        });
    
        $(document).on("click", ".charge__card-item-delete-button", function(e){
            let elmt = $(this);
            charge_obj.delete_card($(elmt).data("card"))
            .then(function(){
                $("#charge_card-edit-button").trigger("click");
                $(elmt).closest(".charge__card-item").remove();
                payment_card_swiper.update();
            });
        });
    
        $(document).on("click", ".payment_card_button", function(e){
            charge_obj.toss_payment_card();
        });


        $(document).on("click", ".receipt_detail_button", function(){
            modals.load("charge_receipt_detail", "충전 상세내역", JSON.stringify({rcpt_id: $(this).data("receipt")}));
        });
        
        $(document).on("click", ".receipt-delete-button", function(){
            charge_obj.delete_receipt($(this).data("receipt"));
        });

        $(document).on("change", "input[name='rcpt_cancel_reason']", function(e){
            if($(this).val() == "etc"){
                $("#charge_cancel__etc-box").show();
            }else{
                $("#charge_cancel__etc-box").hide();
            }
        });

        $(document).on("click", ".pay-detail-button", function(){
            modals.load("charge_pay_detail", "구매 상세내역", JSON.stringify({pay_id: $(this).data("pay")}));
        })
    },
    charge: function(elmt){
        modals.load("charge_exp", "충전하기", JSON.stringify({it_no: $(elmt).data("item")}));
    },
    cancel: function(elmt){
        modals.load("cancel_exp", "충전취소", JSON.stringify({rcpt_id: $(elmt).data("receipt"), settle_type: $(elmt).data("settle")}));
    },


    toss_payment: function(f){
        let payment_data = {
            amount: f.rcpt_price.value,
            orderId: f.rcpt_id.value,
            orderName: f.rcpt_name.value,
            successUrl: window.location.origin + "/charge/toss/success",
            failUrl: window.location.origin + "/charge/toss/fail",
        };
    
        let settle_case = f.rcpt_settle_case.value;
    
        if(f.rcpt_settle_case.value == "card"){
            settle_case = "카드";
            
        }else if(f.rcpt_settle_case.value == "cp"){
            settle_case = "휴대폰";
        }else{
            return false;
        }
    
        tossPayments.requestPayment(settle_case, payment_data).catch(function (error) {
            if (error.code === 'USER_CANCEL') {
                alert("결제를 취소하셨습니다.");
            }else{
                alert("현재 결제를 이용할 수 없습니다.\n사유 : " + error.message);
            }
            location.reload();
        });
        return true;
    },

    toss_payment_card: function(){
        let billing_data = {
            successUrl: window.location.origin + "/charge/toss/card/success",
            failUrl: window.location.origin + "/charge/toss/card/fail",
            customerKey: $("#customer_key").val()
        };
    
        tossPayments.requestBillingAuth("카드", billing_data).catch(function (error) {
            if (error.code === 'USER_CANCEL') {
                alert("간편카드 등록을 취소하셨습니다.");
            }else{
                alert("현재 결제를 이용할 수 없습니다.\n사유 : " + error.message);
            }
        });
    },

    delete_card: async function(card_no){
        return await pave_async_ajax("/api/charge/card/delete", "POST", {card_no: card_no})
        .then(function(result){
            if(result.status == "success"){
                alert("간편카드가 삭제되었습니다.");
            }else{
                if(result.msg){
                    if(result.redirect_url){
                        if(confirm(result.msg)){
                            location.href = result.redirect_url;
                        }
                    }else{
                        alert(result.msg);
                    }
                }else{
                    alert("에러가 발생하였습니다. 다시 시도해주시기 바랍니다.");
                }
            }
        });
    },

    delete_receipt: async function(rcpt_id){
        return await pave_async_ajax("/api/charge/receipt/delete", "POST", {rcpt_id: rcpt_id})
        .then(function(result){
            if(result.status == "success"){
                alert("결제내역이 삭제되었습니다.");
                location.reload();
            }else{
                if(result.msg){
                    if(result.redirect_url){
                        if(confirm(result.msg)){
                            location.href = result.redirect_url;
                        }
                    }else{
                        alert(result.msg);
                    }
                }else{
                    alert("에러가 발생하였습니다. 다시 시도해주시기 바랍니다.");
                }
            }
        });
    },
}

$(function(){
    charge_obj.init();
});


/* 
//커머스 폼 검사
function commerce_payment_form_check(f){
    if($("input[name='rcpt_settle_case']:checked").length == 0){
        alert("결제방식을 선택해주세요.");
        return false;
    } 

    if(!$("#rcpt_agree").is(":checked")){
        alert("결제 밎 개인정보 제3자 제공 동의해주세요.");
        return false;
    }

    if(!$("#rcpt_commerce_agree").is(":checked")){
        alert("커머스서비스 이용약관 동의해주세요.");
        return false;
    }

    
    if($("input[name='rcpt_settle_case']:checked").val() == "easy"){
        if($("#card_id").val() == ""){
            if(confirm("커머스플랜은 매월 정기결제로 진행됩니다. 신용카드를 등록하시겠습니까?")){
                load_card_payment(f.customer_key.value);
                return false;
            }
            return false;
        }
          
        f.type.value = "success";
        f.action = window.location.origin + "/payment/billing/";
        return true;
    }

    return false;
} */