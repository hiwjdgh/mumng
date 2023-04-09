(function(){
    $(document).on("change", "input[type='number']",function(){
        let val = $(this).val(); 
        let step = $(this).prop("step");
        let min = $(this).prop("min");
        let max = $(this).prop("max");

        val = Math.floor(val/step) * step; 

        if(val < min || val == ""){
            val = min;
        }

        if(val > max && max != ""){
            val = max;
        }
        $(this).val(val);
    });
})()
$(document).ready(function() {
    $(window).on("scroll", function(){
        //tooltip init
        $(".tooltip-box").find(".tooltip-box__content").hide();

    });

    $(document).on("focus", ".input-box-t2 .input-box-t2__input",function(){
        $(this).closest(".input-box-t2").addClass("focus");
    }).on("blur", ".input-box-t2 .input-box-t2__input", function(){
        if($(this).val() == ""){
            $(this).closest(".input-box-t2").removeClass("focus");
        }
    });

    $(document).on("focus", ".input-box-t3 .input-box-t3__input", function(){
        $(this).closest(".input-box-t3").addClass("focus");
    }).on("blur", ".input-box-t3 .input-box-t3__input", function(){
        if($(this).val() == ""){
            $(this).closest(".input-box-t3").removeClass("focus");
        }
    });

    $(document).on("focus", ".input-box-t4 .input-box-t4__input", function(){
        $(this).closest(".input-box-t4").addClass("focus");

    }).on("blur", ".input-box-t4 .input-box-t4__input", function(){
        if($(this).val() == ""){
            $(this).closest(".input-box-t4").removeClass("focus");
        }
    });

    $(document).on("focus", ".input-box-t5 .input-box-t5__input", function(){
        $(this).closest(".input-box-t5").addClass("focus");

    }).on("blur propertychange change keyup paste input", ".input-box-t5 .input-box-t5__input", function(){
        if($(this).val() == ""){
            $(this).closest(".input-box-t5").removeClass("focus");
        }
    });

    $(document).on("focus", ".input-box-t6 .input-box-t6__input", function(){
        $(this).closest(".input-box-t6").addClass("focus");

    }).on("blur", ".input-box-t6 .input-box-t6__input", function(){
        if($(this).val() == ""){
            $(this).closest(".input-box-t6").removeClass("focus");
        }
    });

    $(document).on("blur propertychange change keyup paste input", ".hashtag-input__input", function(){
        if($(this).val() == ""){
            $(this).closest(".hashtag-input").removeClass("focus");
        }else{
            $(this).closest(".hashtag-input").addClass("focus");
        }
    });

    $(document).on("blur propertychange change keyup paste input", ".search-input__input", function(){
        if($(this).val() == ""){
            $(this).closest(".search-input").removeClass("focus");
        }else{
            $(this).closest(".search-input").addClass("focus");
        }
    });

    $(document).on("focus", ".select-box .select-box__select", function(){
        $(this).closest(".select-box").addClass("focus");
    }).on("blur change", ".select-box .select-box__select", function(){
        if($(this).val() == "" || $(this).val() == null){
            $(this).closest(".select-box").removeClass("focus");
        }else{
            $(this).closest(".select-box").addClass("focus");
        }
    });

    $(document).on("focus", ".textarea-box .textarea-box__textarea", function(){
        $(this).closest(".textarea-box").addClass("focus");
    }).on("blur", ".textarea-box .textarea-box__textarea", function(e){
        e.stopPropagation();
        if($(this).val() == ""){
            $(this).closest(".textarea-box").removeClass("focus");
        }
    }).on("load keyup keypress keydown", ".textarea-box .textarea-box__textarea", function(e){
        e.stopPropagation();
        let content = $(this).val();
        $(this).closest(".textarea-box").find(".textarea-box__counter-now").text(content.length.toLocaleString());
    });
  

    $(document).on("mouseover", ".chip-check-box", function(){
        $(this).addClass("focus");
    }).on("mouseleave", ".chip-check-box", function(e){
        $(this).removeClass("focus");
    }).on("change", ".chip-check-box", function(e){
        $(this).toggleClass("checked");
    });

    
    /* input-t1 */
    $(document).on("focus", ".input-t1:not(.readonly)",function(){
        $(this).addClass("focus");
    }).on("blur", ".input-t1:not(.readonly)", function(){
        if($(this).find(".input-t1__input").val() == ""){
            $(this).removeClass("focus");
        }
    });
    

    /* input-t2 */
    $(document).on("focus", ".input-t2:not(.readonly)",function(){
        $(this).addClass("focus");
    }).on("blur", ".input-t2:not(.readonly)", function(){
        if($(this).find(".input-t2__input").val() == ""){
            $(this).removeClass("focus");
        }
    });

    /* 셀렉트 박스 t1 */
    $(document).on("focus", ".select-t1:not(.readonly)", function(){
        $(this).addClass("focus");
    }).on("blur change", ".select-t1:not(.readonly)", function(){
        if($(this).find(".select-t1__select").val() == "" || $(this).find(".select-t1__select").val() == null){
            $(this).removeClass("focus");
        }else{
            $(this).addClass("focus");
        }
    });

     /* 셀렉트 박스 t2 */
     $(document).on("focus", ".select-t2:not(.readonly)", function(){
        $(this).addClass("focus");
    }).on("blur change", ".select-t2:not(.readonly)", function(){
        if($(this).find(".select-t2__select").val() == "" || $(this).find(".select-t2__select").val() == null){
            $(this).removeClass("focus");
        }else{
            $(this).addClass("focus");
        }
    });

    /* 텍스트에어리아 t1 */
    $(document).on("focus", ".textarea-t1:not(.readonly)",function(){
        $(this).addClass("focus");
    }).on("blur", ".textarea-t1:not(.readonly)", function(){
        if($(this).find(".textarea-t1__textarea").val() == ""){
            $(this).removeClass("focus");
        }
    }).on("load keyup keypress keydown", ".textarea-t1:not(.readonly)", function(e){
        e.stopPropagation();
        let content = $(this).find(".textarea-t1__textarea").val();
        $(this).find(".textarea-t1__counter-now").text(content.length.toLocaleString());
    });
    

    /* 칩 */
    $(document).on("click", ".chip", function(e){
        $(this).toggleClass("checked");
    });

    /* 칩 체크 */
    $(document).on("change", ".chip-check", function(e){
        $(this).toggleClass("checked");
    });

    /* 칩 라디오 */
    $(document).on("change", ".chip-radio", function(e){
        $("input[name='"+$(this).find(".chip-radio__input").prop("name")+"']").closest(".chip-radio").removeClass("checked");
        $(this).addClass("checked");
    });
  
    /* 칩 그룹 */
    $(document).on("mouseover", ".chip-group:not(.readonly)", function(){
        $(this).addClass("focus");
    }).on("mouseleave", ".chip-group:not(.readonly)", function(e){
        if($(this).hasClass("chip-group--check")){ // 칩 체크
            if($(this).find(".chip-group__input:checked").val() === undefined){
                $(this).removeClass("focus");
            }
        }else if($(this).hasClass("chip-group--radio")){ //칩 라디오
            if($(this).find(".chip-group__input:checked").val() === undefined){
                $(this).removeClass("focus");
            }
        }else{// 칩
            if($(this).find(".chip-group__input.checked").length == 0){
                $(this).removeClass("focus");
            }
        }
    })

    /* 스텝퍼 */
    $(document).on("click", ".step__item", function(){
        let target = $(this).data("anchor");
        $(".step__item").removeClass("current");
        $(this).addClass("current");
        $(".step__content").hide().filter("[data-target='"+target+"']").show();
    }).on("click", ".step__prev-button, .step__next-button", function(){
        let target = $(this).data("anchor");

        $(".step__item").removeClass("current").filter("[data-anchor='"+target+"']").addClass("current");
        $(".step__content").hide().filter("[data-target='"+target+"']").show();
    });

    /* collapse */
    $(document).on("click", ".collapse-button", function(){
        let target = $(this).data("anchor");
        let collapse = $(this).data("collapse");

        if(collapse == "hide"){
            $(this).hide();
            $(".collapse-content").filter("[data-target='"+target+"']").show();
        }else if(collapse == "toggle"){
            $(".collapse-content").filter("[data-target='"+target+"']").toggle();
        }
    });

    //tooltip
    $(document).on("mouseover", ".tooltip-box", function(e){
        let content = $(this).find(".tooltip-box__content");

        //초기화
        content.css({
            top : "",
            left : "",
            right : "",
            bottom : "",
        });

        //x축
        let x_pos = 0;
        if($(window).width() < ($(this).offset().left + $(this).width() + content.width())){
            x_pos = $(window).width() - $(this).offset().left ;
            content.css("right", x_pos + "px");
        }else{
            x_pos = $(this).offset().left + $(this).width();
            content.css("left", x_pos + "px");
        }

        //y축
        let y_pos = 0;
        if($(window).height() < ($(this).offset().top + $(this).height() + content.height() + 36)){
            y_pos = $(window).height() - $(this).offset().top + $(window).scrollTop();
            content.css("bottom", y_pos + "px");
        }else{
            y_pos = $(this).offset().top + $(this).height() - $(window).scrollTop();
            content.css("top", y_pos + "px");
        }

        content.show();
    }).on("mouseout", ".tooltip-box", function(e){
        let content = $(this).find(".tooltip-box__content");

        content.hide();
    });

    //data-table
    $(document).on("click", ".data-table .data-table__head-col:not(.nosort)", function(e){
        let table = $(this).closest(".data-table");
        let head = table.find(".data-table__head");
        let body = table.find(".data-table__body");
        let index = $(this).index();
        let array = null;

        table.find(".data-table__head-col:not(:eq("+index+"))").removeClass("asc desc").addClass("default");


        if($(this).hasClass("default")){
            //desc do
            array = body.find(".data-table__body-row").toArray().sort(function(a, b){ 
                let a_order = $(a).find(".data-table__body-col").eq(index).data("value");
                let b_order = $(b).find(".data-table__body-col").eq(index).data("value");

                return $.isNumeric(a_order) && $.isNumeric(b_order) ? a_order - b_order : a_order.toString().localeCompare(b_order);
            });

            $(this).removeClass("default asc");
            $(this).addClass("desc");
            array.reverse();
        }else{
            if($(this).hasClass("desc")){
                //asc do
                array = body.find(".data-table__body-row").toArray().sort(function(a, b){ 
                    let a_order = $(a).find(".data-table__body-col").eq(index).data("value");
                    let b_order = $(b).find(".data-table__body-col").eq(index).data("value");

                    return $.isNumeric(a_order) && $.isNumeric(b_order) ? a_order - b_order : a_order.toString().localeCompare(b_order);
                });
                $(this).removeClass("default desc");
                $(this).addClass("asc");
            }else{
                //default do
                array = body.find(".data-table__body-row").toArray().sort(function(a, b){ 
                    let a_order = $(a).data("order");
                    let b_order = $(b).data("order");

                    return $.isNumeric(a_order) && $.isNumeric(b_order) ? a_order - b_order : a_order.toString().localeCompare(b_order);
                });

                $(this).removeClass("desc asc");
                $(this).addClass("default");
            }
        }

        for (var i = 0; i < array.length; i++){table.append(array[i])}
       
    });

    //date autocomplete
    $(document).on("keyup", ".date-autocomplete", function(){
        let value = $(this).val().split("-").join("");

        value = value.replace(/[^0-9]/g, "");
        if(value == ""){
            value = "";
        }else{
            if(value.length > 0) {
                if(value.length > 8){
                    value = value.substr(0,8);
                }

                matches = value.match(/[\d]{1,4}/g);
                if(matches.length == 2 && matches[1].length > 2){
                    matches_tmp = matches[1];
                    matches[1] = matches_tmp.substr(0,2);
                    matches[2] = matches_tmp.substr(2,2);
                }

                value = matches.join("-");
            }
        }
        $(this).val(value);
    });

  


});