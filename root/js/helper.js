(function(){
    var helper_obj,
        helper_button_obj,
        helper_close_button_obj,
        helper_handler = {
        init: function(){
            helper_obj = $(".helper");
            helper_button_obj = $(".helper__button");
            helper_close_button_obj = $(".helper__close-button");
            helper_handler.add_event();
        },


        
        add_event: function(){
            $(document).on("click", ".helper", function(e){
                e.stopPropagation();
                helper_handler.hide($(this).data("target"));
            });

            $(document).on("click", ".helper__button", function(e){
                e.stopPropagation();
                let target = $(this).data("anchor");
                helper_handler.show(target);
            });


            $(document).on("click", ".helper__close-button", function(e){
                e.stopPropagation();
                let target = $(this).data("anchor");
                helper_handler.hide(target);

            });

        },

        show: function(target){
            $(".helper").filter("[data-target='"+target+"']").addClass("show");
            $("body").css({
                overflowY: "hidden",
                paddingRight: "17px",
            })
        },

        hide: function(target){
            $(".helper").filter("[data-target='"+target+"']").removeClass("show");
            $("body").css({
                overflowY: "",
                paddingRight: "",
            })
        }
    }

    $(function () {
        helper_handler.init();
    });
}());