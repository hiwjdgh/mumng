const subscribe_obj = {
    init: function(){
      
        subscribe_obj.add_event();
    },
    add_event : function(){
        $(document).on("click", ".subscribe-button", function(e){
            subscribe_obj.change_work_subscribe($(this));
        });
    
    },

    change_work_subscribe: function(elmt){
        return pave_async_ajax("/api/subscribe/work", "POST", {work_id: $(elmt).data("id")})
        .then(function(result){
            if(result.status == "success"){
                if($(elmt).find(".icon-subscribe").hasClass("icon-inactive")){
                    $(elmt).find(".icon-subscribe").removeClass("icon-inactive").addClass("icon-active");
                }else{
                    $(elmt).find(".icon-subscribe").removeClass("icon-active").addClass("icon-inactive");
                }
                
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

    change_subscribe_notify: function(elmt){
        pave_async_ajax("/api/subscribe/notify", "POST", {subscribe_no: $(elmt).data("subscribe")})
        .then(function(result){
            if(result.status == "success"){
                if($(elmt).find(".icon-alarm").hasClass("icon-alarm--inactive")){
                    $(elmt).find(".icon-alarm").removeClass("icon-alarm--inactive").addClass("icon-alarm--active");
                }else{
                    $(elmt).find(".icon-alarm").removeClass("icon-alarm--active").addClass("icon-alarm--inactive");
                }
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
    subscribe_obj.init();
})