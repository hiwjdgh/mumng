const modals = {
    modal_obj: {},
    current_scroll_top : 0,
    init: function(){
        modals.add_event();
    },

    add_event: function(){
        $(document).on("click", ".modal-close-button", function(e){
            e.stopPropagation();
            let target = $(this).data("anchor");
            modals.hide(target);
        });


          //bottom sheet
        $(document).on("click", ".bottom-sheet", function(e){
            e.stopPropagation();

            if(e.target ==  $(".bottom-sheet")[0]){
                let target = $(this).data("target");
                modals.hide(target);
            }
        });

        $(document).on("mousedown touchstart", ".bottom-sheet__header", function(e){
            e.stopPropagation();
            let currentY = $(".bottom-sheet").data("currentY") == "" ? $(".bottom-sheet").data("currentY") : 0;

            if (e.type === "touchstart") {
                $(".bottom-sheet").data("initialY", e.touches[0].clientY);
            } else {
                $(".bottom-sheet").data("initialY", e.clientY);
            }

            $(".bottom-sheet").data("currentY", currentY);
            $(".bottom-sheet").find(".bottom-sheet__box").css("transition", "none");

        }).on("mouseleave mouseup touchend", ".bottom-sheet__header", function(e){
            e.stopPropagation();
            let currentY = $(".bottom-sheet").data("currentY");
            let bottom_sheet_box = $(".bottom-sheet").find(".bottom-sheet__box");

            if (currentY >= ($(".bottom-sheet").height() /2)) {
                modals.hide($(".bottom-sheet").data("target"));
            }else{
                bottom_sheet_box.css("transform", "");
                $(".bottom-sheet").find(".bottom-sheet__box").css("transition", "");
            }
            

        }).on("mousemove touchmove", ".bottom-sheet__header", function(e){
            e.stopPropagation();

            if (e.type === "touchmove") {
                $(".bottom-sheet").data("currentY", e.touches[0].clientY - $(".bottom-sheet").data("initialY"));
            } else {
                $(".bottom-sheet").data("currentY", e.clientY - $(".bottom-sheet").data("initialY"));
            }

            let currentY = $(".bottom-sheet").data("currentY");

            if (currentY >= 0) {
                $(".bottom-sheet").find(".bottom-sheet__box").css("transform", "translateY("+currentY+"px)");
            }
        
        });
    },

    load: function(id, title, data){
        return pave_async_ajax("/api/modal2/content", "POST", $.extend({id: id, title: title}, {data: data}))
        .then(function(result){
            if(result.status == "success"){
                modals.show(result.data.html);
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

    show: function(content){
        $(".modals").filter("[data-target='"+$(content).data("target")+"']").remove();
        $("#wrap").append(content);
        setTimeout(function(){
            $(".modals").addClass("show");
        },200);

        if(!$("body").hasClass("modal-open")){
            $("body").addClass("modal-open");

            modals.current_scroll_top = $(window).scrollTop();

        }
    },

    hide: function(target){
        $(".modals").filter("[data-target='"+target+"']").removeClass("show");
        $(".modals").filter("[data-target='"+target+"']").remove();

        if($(".modals").filter(":visible").length == 0){
            $("body").removeClass("modal-open");
            
            $(window).scrollTop(modals.current_scroll_top);
        }
        
       
    }
}
$(function(){
    modals.init();
});