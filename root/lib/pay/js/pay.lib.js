const pay_obj = {
    init: function(){
      
        pay_obj.add_event();
    },

    add_event: function(){
        $(document).on("click", ".pay-delete-button", function(){
            if(confirm("구매내역 삭제 시 구매 취소가 불가합니다. 진행하시겠습니까?")){
                pay_obj.delete_pay($(this))
                .then(function(){
                    location.reload();
                });
            }
        });

        $(document).on("click", ".pay-cancel-button", function(){
            modals.load("cancel_pay", "구매취소", JSON.stringify({pay_id: $(this).data("pay")}));
        });

        $(document).on("submit", "#pay_cancel__form", function(){
            let f = this;
            
            if($("input[name='pay_cancel_reason']:checked").length == 0){
                alert("취소사유를 선택해주세요.");
                return false;
            } 
        
            if($("input[name='pay_cancel_reason']:checked").val() == "etc"){
                if($("#pay_cancel_reason_text").val() == ""){
                    alert("기타사유를 작성해주세요.");
                    $("#pay_cancel_reason_text").focus();
                    return false;
                }
            }
        
            if(!$("#pay_agree").is(":checked")){
                alert("유료서비스 이용약관 동의해주세요.");
                return false;
            }
        
            pave_async_ajax("/api/pay/cancel", "POST", $(f))
            .then(function(result){
                if(result.status == "success"){
                    alert("구매 취소되었습니다.");
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

        $(document).on("change", "input[name='pay_cancel_reason']", function(e){
            if($(this).val() == "etc"){
                $("#pay_cancel__etc-box").show();
            }else{
                $("#pay_cancel__etc-box").hide();
            }
        });
    },

    check_pay_epsd: async function(data){
        return await pave_async_ajax("/api/pay/check", "POST", data)
        .then(function(result){
            if(result.status == "success"){
                return result;
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

    create_pay: async function(elmt){
        return await pave_async_ajax("/api/pay/create", "POST", {work_id: elmt.data("id"), epsd_id: elmt.data("epsd"), type: elmt.data("type")})
        .then(function(result){
            if(result.status == "success"){
                modals.hide("work_pay_modal");
                return result;
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

    delete_pay: function(elmt){
        return pave_async_ajax("/api/pay/delete", "POST", {pay_id: $(elmt).data("pay")})
        .then(function(result){
            if(result.status == "success"){
                alert("구매한 회차가 삭제 되었습니다.");
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
    }

}


$(function(){
    pay_obj.init();
})