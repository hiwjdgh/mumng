let detail_work = {};
let detail_epsd = {};
$(document).ready(function() {    
    
    $(window).on('popstate', function(e) {
        if(e.originalEvent.state){
            let type = e.originalEvent.state.type;

            if(type == "epsd"){
                show_epsd_detail(e.originalEvent.state.data, false);
                return;
            }

            if(type == "detail"){
                hide_epsd_detail(false);
                show_work_modal(e.originalEvent.state.data, false);
                return;
            }
        }else{
            if($("#epsd_modal").is(":visible")){
                hide_epsd_detail(false);
                return;
            }
            if($("#work_modal").is(":visible")){
                hide_work_modal(false);
                return;
            }
            window.location.reload();
        }
    });

    /* 작품 리스트 */
    $(document).on("click", ".work__day-item", function(){
        $("#work_page").val(1);
        $("#work_end").val(0);
        $("#work_day").val($(this).data("day"));
        $("#work_state").val($(this).data("state"));
        load_work_list($(".work__list"));
        $(".work__day-item").removeClass("current");
        $(this).addClass("current");
    });

    $(document).on("click", ".work__type-item", function(){
        $("#work_page").val(1);
        $("#work_end").val(0);
        $("#work_type").val($(this).data("type"));
        load_work_list($(".work__list"));
        $(".work__type-item").removeClass("current");
        $(this).addClass("current");
    });

    $(document).on("click", ".work__genre-item", function(){
        $("#work_page").val(1);
        $("#work_end").val(0);
        $("#work_genre").val($(this).data("genre"));
        load_work_list($(".work__list"));
        $(".work__genre-item").removeClass("current");
        $(this).addClass("current");
    });

    /* 작품 상세 */
    $(document).on("click", ".work-detail", function(e){
        show_work_detail($(this).data("id"));
    });

    $(document).on("click", ".work_detail__close-button", function(e){
        hide_work_modal();
    });

    $(document).on("click", ".work_detail__side-info2-description-more-button", function(e){
        load_modal("work_description", "작품 줄거리", JSON.stringify({work_id: $(this).data("id")}), false);
    });

    $(document).on("click", ".epsd-pagination", function(e){
        load_work_epsd_list(detail_work.work_id, $(this).data("page"), "work_detail", function(result){
            $(".work_detail__epsd-box").html(result.data.html);
        });
     });


     $(document).on("click", ".epsd-detail", function(e){
        check_epsd_detail($(this));
     });

     $(document).on("click", ".work_pay__type-pay-button", function(e){
        pay_work_epsd($(this));
     });

     $(document).on("click", ".epsd_detail__header-close-button", function(e){
        hide_epsd_detail();
    });

   
    /* 댓글 */
    $(document).on("click",".epsd_detail__cmt-type-button", function(){
        $("#cmt_type").val($(this).data("type"));
        $("#cmt_page").val(1);
        $("#cmt_end").val(0);
        $(".epsd_detail__cmt-list").html();
        $(".epsd_detail__cmt-type-button").removeClass("current");
        $(this).addClass("current");
        load_epsd_cmt_list($(this).data("id"), $(this).data("epsd"));
    });
     
     $(document).on("click",".cmt-item__reply-list-button", function(){
        if(Number($(this).data("remain")) == 0){
            $(this).next(".cmt-item__reply-list").html("");
            $(this).data("page", 1);
            $(this).data("remain", $(this).data("reply"));
            $(this).text("의견 " +display_number($(this).data("reply"),"개 보기"));
            return;
        }
        load_epsd_cmt_reply_list($(this));
     });


     $(document).on("keyup keypress keydown","#cmt_content", function(){
        if($(this).val().includes($("#cmt_mention").val()) == -1){
            $("#cmt_parent_id").val("");
            $("#cmt_mention").val("");
       }
    });

     $(document).on("click",".cmt-item__info-reply-button", function(e){
        init_epsd_reply_form($(this));
     });


    $(document).on("click", ".cmt-item__like-button", function(e){
        let elmt = $(this);
        change_cmt_like($(this), true, function(result){
            let like = Number($(elmt).data("like"));
            let change_elmt = $(elmt).siblings(".cmt-item__info").find(".cmt-item__info-like");
         
            if($(elmt).find(".icon-like").hasClass("icon-like--inactive")){
                like--;
            }else{
                like++;
            }
            $(change_elmt).text("좋아요 " + display_number_format(like, "개"));
            $(elmt).data("like", like);
        });
     });

    $(document).on("click",".cmt-delete", function(){
        delete_epsd_cmt($(this), function(result){
            alert("해당 의견이 삭제되었습니다.");
            $(".epsd_detail__cmt-type-button[data-type='all']").trigger("click");
        });
    });

    /* 작품 상세 FAB */
    $(document).on("click",".epsd_detail__fab-item-cmt-button", function(e){
        $("html,body").animate({scrollTop:$(".epsd_detail__footer").offset().top - 24});
    });

    $(document).on("click",".epsd_detail__fab-item-preview-button", function(e){
        $("html,body").animate({scrollTop:$(".epsd_detail__preview").offset().top - 24});
    });
    
    $(document).on("click", "#epsd__footer-prev-button, #epsd__footer-next-button", function(e){
        e.stopPropagation();
        check_epsd_detail($(this).data("epsd"));
     });
});

function show_work_modal(data, is_modal = true){
    detail_work = data.work;

    $("#work_modal").addClass("show");
    $("#work_modal").html(data.html);
    $("html,body").css("overflow-y", "hidden");
    if(is_modal){
        document.title = detail_work.work_name;
        window.history.pushState({"type": "detail", "data": data}, "",  detail_work.work_url);
    }
}

function hide_work_modal(is_modal = true){
    $("#work_modal").html("");
    $("#work_modal").removeClass("show");
    $("html,body").css("overflow-y", "");
    if(is_modal){
        window.history.back();
    }
}

function load_work_list(elmt){
    pave_ajax(
        "/api/work/list",
        $(".work__form"),
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    if(result.data == null || result.data.list.length < 1){
                        $("#work_end").val(1);

                        if($("#work_page").val() == "1"){
                            $(elmt).html(result.data.html);
                        }
                        return;
                    }

                    if($("#work_page").val() == "1"){
                        $(elmt).html(result.data.html);
                    }else{
                        $(elmt).append(result.data.html);
                    }
                    $("#work_page").val(Number($("#work_page").val())+1);
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
        },
        function(error){
            alert(error);
        }
    );
}


function show_work_detail(work_id){
    pave_ajax(
        "/api/work/detail",
        {work_id : work_id},
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    show_work_modal(result.data);
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
        },
        function(error){
            alert(error);
        }
    );
}

function load_work_epsd_list(work_id, page, view, callback = null){
    pave_ajax(
        "/api/work/epsd/list",
        {work_id: work_id, page:page, view: view},
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    if(callback){
                        callback(result);
                    }
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
        },
        function(error){
            alert(error);
        }
    );
}

function check_epsd_detail(elmt){
    check_epsd_pay($(elmt).data("id"), $(elmt).data("epsd"), function(result){
        if(result.data.is_pay_need){
            load_modal("work_epsd_pay", "구매하기", JSON.stringify({work_id: $(elmt).data("id"), epsd_id: $(elmt).data("epsd")}), false);
        }else{
            load_epsd_detail($(elmt).data("id"), $(elmt).data("epsd"), true);
        }
    });
}

function pay_work_epsd(elmt){
    create_pay(elmt, function(){
        load_epsd_detail($(elmt).data("id"), $(elmt).data("epsd"));
    });
}

function load_epsd_detail(work_id, epsd_id, is_caution_skip = false){
    if(!is_caution_skip){
        load_modal("work_epsd_caution", "저작권 주의", JSON.stringify({work_id: work_id, epsd_id: epsd_id}));
        return;
    }else{
        hide_modal();
    }

    pave_ajax(
        "/api/work/epsd/detail",
        {work_id: work_id, epsd_id: epsd_id},
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    show_epsd_detail(result.data);
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
        }
    );
}

function show_epsd_detail(data, is_modal= true){
    detail_work = data.work;
    detail_epsd = data.epsd;
    
    $("#epsd_modal").addClass("show");
    $("#epsd_modal").html(data.html);
    $('html,body').scrollTop(0);
    $('html,body').css("overflow-y", "");

    $(".epsd_detail__header").show(); 
    $(".epsd_detail__fab").show(); 

    if(is_modal){
        document.title = detail_epsd.epsd_name;
        window.history.pushState({"type": "epsd", "data": data}, "",  detail_epsd.epsd_url);
    }
}

function hide_epsd_detail(is_modal = true){
    $("#epsd_modal").html("");
    $("#epsd_modal").removeClass("show");
    
    if(is_modal){
        window.history.back();
    }
/* 
    if(window.history && window.history.state){
        if(window.history.state.type == "epsd"){

            //다시 앞으로 간경우
            console.log("epsd");
        }

        if(window.history.state.type == "detail"){
              window.history.pushState(null, null,  window.location.href);

            console.log("detail");
        }
        //window.history.back();
    } */
}

/* 댓글 */
function load_epsd_cmt_list(work_id, epsd_id){
    init_epsd_cmt_form();
    pave_ajax(
        "/api/work/comment/list",
        {work_id: work_id, epsd_id: epsd_id, page: $("#cmt_page").val(), type: $("#cmt_type").val()},
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    if(result.data == null || result.data.list.length < 1){
                        $("#cmt_end").val(1);

                        if($("#cmt_page").val() == "1"){
                            $(".epsd_detail__cmt-list").html(result.data.html);
                        }
                        return;
                    }

                    if($("#cmt_page").val() == "1"){
                        $(".epsd_detail__cmt-list").html(result.data.html);
                    }else{
                        $(".epsd_detail__cmt-list").append(result.data.html);
                    }
                    $("#cmt_page").val(Number($("#cmt_page").val())+1);
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
        },
        function(error){
            alert(error);
        }
    );  
}

function load_epsd_cmt_reply_list(elmt){
    pave_ajax(
        "/api/work/reply/list",
        {work_id: $(elmt).data("id"), epsd_id: $(elmt).data("epsd"), cmt_id: $(elmt).data("cmt"), page: $(elmt).data("page")},
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    if(result.data == null || result.data.list.length < 1){
                        return;
                    }

                    if($(elmt).data("page") == 1){
                        $(elmt).next(".cmt-item__reply-list").html(result.data.html);
                    }else{
                        $(elmt).next(".cmt-item__reply-list").prepend(result.data.html);
                    }

                    $(elmt).data("page", Number($(elmt).data("page")) + 1);

                    let remain_cnt = Number($(elmt).data("remain")) - result.data.list.length;
                    $(elmt).data("remain", remain_cnt);

                    if(remain_cnt == 0){
                        $(elmt).text("의견 숨기기");
                    }else{
                        $(elmt).text("의견 " +display_number(remain_cnt,"개 보기"));
                    }
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
        },
        function(error){
            alert(error);
        }
    ); 
}

function init_epsd_cmt_form(){
    $("#cmt_parent_id").val("");
    $("#cmt_mention").val("");
    $("#cmt_content").val("");
    $("#cmt_content").trigger("keyup");
}

function init_epsd_reply_form(elmt){
    let cmt_mention = "@" + $(elmt).data("mention");
    
    $("#cmt_parent_id").val($(elmt).data("cmt"));
    $("#cmt_mention").val($(elmt).data("mention"));
    $("#cmt_content").val(cmt_mention);
    $("#cmt_content").trigger("focus").trigger("keyup");
}

function epsd_cmt_form_check(f){
    if(f.cmt_content.value == ""){
        alert("의견을 입력해주세요");
        return false;
    } 

    pave_ajax(
        "/api/work/comment/create",
        $(f),
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    $(".epsd_detail__cmt-type-button[data-type='all']").trigger("click");
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
        },
        function(error){
            alert(error);
        }
    );
    return false;
}

function delete_epsd_cmt(elmt, callback){
    pave_ajax(
        "/api/work/comment/delete",
        {work_id: $(elmt).data("id"), epsd_id: $(elmt).data("epsd"), cmt_id: $(elmt).data("cmt")},
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    if(callback){
                        callback(result);
                    }
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
        },
        function(error){
            alert(error);
        }
    );
}