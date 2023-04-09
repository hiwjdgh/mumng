const works_list_obj = {
    scroll_top: 0,
    list_elmt: {},
    list_request: {},
    init: function(elmt){
        works_list_obj.list_elmt = elmt
        works_list_obj.add_event();
    },

    add_event: function(){
          //작품 리스트
        $(".work__header-day-item").on("click", async function(){
            $(".work__header-day-item").removeClass("current");
            $(this).addClass("current");

            works_list_obj.list_request.work_page = 1;
            works_list_obj.list_request.work_end = 0;
            works_list_obj.list_request.work_day = $(this).data("day");
            works_list_obj.list_request.work_state = $(this).data("state");
            works_list_obj.get_work_list();
        });

        $(".work__type-item").on("click", async function(){
            $(".work__type-item").removeClass("current");
            $(this).addClass("current");

            works_list_obj.list_request.work_page = 1;
            works_list_obj.list_request.work_end = 0;
            works_list_obj.list_request.type = $(this).data("type");
            works_list_obj.get_work_list();
        });

        $(".work_genre_filter_button").on("click", async function(){
            $(".work_genre_filter_button").removeClass("current");
            $(this).addClass("current");

        
            works_list_obj.list_request.work_page = 1;
            works_list_obj.list_request.work_end = 0;
            works_list_obj.list_request.work_genre = $(this).data("genre");
            works_list_obj.get_work_list();
        });

        
        $(window).off("scroll").on("scroll", function(e){
            if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                if($(this).scrollTop() > works_list_obj.scroll_top) {
                    works_list_obj.get_work_list();

                }
    
            }
            works_list_obj.scroll_top = $(this).scrollTop(); 
        });
    },

    get_work_list: async function(){
        if(works_list_obj.list_request.work_request == true){
            return;
        }
        if(works_list_obj.list_request.work_end == true){
            return;
        }

        works_list_obj.list_request.work_request = true;
        await pave_async_ajax("/api/work2/list", "GET", works_list_obj.list_request)
        .then(function(result){
            works_list_obj.list_request.work_request = false;

            if(result.data.list.length < 1){
                works_list_obj.list_request.work_end = true;
                if(works_list_obj.list_request.page == 1){
                    works_list_obj.list_elmt.html(result.data.html);
                }
                return;
            }

            if(works_list_obj.list_request.page == 1){
                works_list_obj.list_elmt.html(result.data.html);
            }else{
                works_list_obj.list_elmt.append(result.data.html);
            }


            works_list_obj.list_request.page++;
        });
    }
}

const works_obj = {
    epsd_scroll_top : 0,
    pop_obj : {},
    init: function(){
        works_obj.init_url();
        works_obj.add_event();   
    },
    init_url: function(){
        let urls = window.location.pathname.split('/');

        pop_obj = {
            url: "/work/list",
            type: "work_list",
            data: null
        };
        console.log(urls);
    },
    add_event: function(){
        $(document).on("click", "#work-modal__close-button", function(){
            works_obj.hide_work_modal();
        });

        $(document).on("click", ".work-detail", function(){
            let work_id = $(this).data("id"),
                page = $(this).data("page") ? $(this).data("page") : "1";
            pop_obj.url = "/work/detail/"+ work_id+"?page="+ page;
            pop_obj.type = "work_detail";
            pop_obj.data = {
                work_id : work_id,
                page : page,
            }

            works_obj.domain_setting(pop_obj, true);
        });

        $(document).on("click", ".work_detail__side-info2-description-more-button", function(){
            modals.load("work_description", "작품 줄거리", JSON.stringify({work_id: $(this).data("id")}));
        });

        $(document).on("click", ".epsd-detail", function(){
            let work_id = $(this).data("id"),
                epsd_id = $(this).data("epsd");
            pop_obj.url = "/work/epsd/"+work_id+"/"+ epsd_id;
            pop_obj.type = "epsd_detail";
            pop_obj.data = {
                work_id : work_id,
                epsd_id : epsd_id,
            }

            pay_obj.check_pay_epsd(pop_obj.data)
            .then(function(result){
                if(result.data.is_pay_need){
                    modals.load("work_epsd_pay", "구매하기", JSON.stringify(pop_obj.data));
                }else{
                    works_obj.domain_setting(pop_obj, true);
                    cmts_obj.set(pop_obj.data.work_id, pop_obj.data.epsd_id);
                }
            });
        });

        
        //저작권 보호
        $(document).on("click", ".work_epsd_caution__button", function(){
            let work_id = $(this).data("id"),
                epsd_id = $(this).data("epsd");
            pop_obj.url = "/work/epsd/"+work_id+"/"+ epsd_id;
            pop_obj.type = "epsd_detail";
            pop_obj.data = {
                work_id : work_id,
                epsd_id : epsd_id,
            }
            modals.hide("work_epsd_caution_modal");
            works_obj.domain_setting(pop_obj, true);
            cmts_obj.set(pop_obj.data.work_id, pop_obj.data.epsd_id);
        });


        /* 작품 상세 */
        $(document).on("click",".epsd_detail__fab-item-cmt-button", function(e){
            if($("#work-modal").is(":visible")){
                $("#work-modal").animate({scrollTop: $("#work-modal").scrollTop() + $(".epsd_detail__footer").offset().top - 24});
            }else{
                $("html,body").animate({scrollTop: $(".epsd_detail__footer").offset().top - 24});
            }
        });
        
        
        $(document).on("click",".epsd_detail__fab-item-cmt2-button", function(e){
            modals.load("work_comment", "작품 의견", JSON.stringify({work_id: $(this).data("id"), epsd_id: $(this).data("epsd")}));
            cmts_obj.get_cmt_list(cmts_obj.cmt_request);
        });

        $(document).on("click",".epsd_detail__fab-item-preview-button", function(e){
            if($("#work-modal").is(":visible")){
                $("#work-modal").animate({scrollTop: $("#work-modal").scrollTop() + $(".epsd_detail__preview").offset().top - 24});
            }else{
                $("html,body").animate({scrollTop: $(".epsd_detail__preview").offset().top - 50});
            }
        });


        $("#work-modal").on("scroll", function(e){
            if($("#work-modal .epsd_detail").length > 0){
                if($(this).scrollTop() > works_obj.epsd_scroll_top) {
                    //down
                    $(".epsd_detail__fab").removeClass("show").addClass("hidden"); 
                }else{
                    //up
                    $(".epsd_detail__fab").removeClass("hidden").addClass("show"); 
                }
            }
            works_obj.epsd_scroll_top = $(this).scrollTop(); 
        });

        $(window).on("scroll", function(e){
            if($(".epsd_detail").length > 0){
                if($(this).scrollTop() > works_obj.epsd_scroll_top) {
                    //down
                    $(".epsd_detail__fab").removeClass("show").addClass("hidden"); 
                }else{
                    //up
                    $(".epsd_detail__fab").removeClass("hidden").addClass("show"); 
                }
            }
            works_obj.epsd_scroll_top = $(this).scrollTop(); 
        });

        window.addEventListener("popstate", function (e) {
            works_obj.domain_setting(e.state, false);
        });
    },

    domain_setting: function(state, pop){
        if (pop == true) {
            history.pushState(state, null, state.url);
        }

        if(state == null){
            location.replace(window.location.href);
        }else{
            if(state.type == "work_detail"){
                works_obj.get_work_detail(state.data);
            }else if(state.type == "epsd_detail"){
                works_obj.get_epsd_detail(state.data);
            } 
        }
    },

    get_work_detail: async function(data){
        await pave_async_ajax("/api/work2/detail", "GET", data)
        .then(function(result){
            works_obj.show_work_modal(result.data.html);
        });
    },
    show_work_modal: function(content){
        $("#work-modal").scrollTop(0);
        if(!$("body").hasClass("modal-open")){
            $("body").addClass("modal-open");
        }
        $("#work-modal").addClass("show");
        $("#work-modal__container").html(content);
    },
    hide_work_modal: function(){
        $("#work-modal").removeClass("show");
        $("#work-modal__container").html("");

        if($(".modals").filter(":visible").length == 0){
            $("body").removeClass("modal-open");
        }
        
       history.back();
    },

    get_epsd_detail: async function(data){
        await pave_async_ajax("/api/work2/epsd/detail", "GET", data)
        .then(function(result){
            works_obj.show_work_modal(result.data.html);
        });
    }
};

const cmts_obj = {
    epsd_scroll_top : 0,
    cmt_request : {},
    reply_request : {},
    init: function(){
        cmts_obj.cmt_request = {
            work_id : "",
            epsd_id : "",
            type : "best",
            page : 1,
            end : false,
            load : false
        };

        cmts_obj.reply_request = {
            work_id : "",
            epsd_id : "",
            comment_no : "",
            page : 1,
            end : false,
            load : false
        };

        cmts_obj.add_event();   
    },
    set: function(work_id, epsd_id){
        cmts_obj.cmt_request = {
            work_id : work_id,
            epsd_id : epsd_id,
            type : "best",
            page : 1,
            end : false,
            load : false
        };
    },
    add_event: function(){
        /* 댓글 */
        $(document).on("click",".work_cmt__tab-item", async function(){
            cmts_obj.cmt_request = {
                work_id : $(this).data("id"),
                epsd_id : $(this).data("epsd"),
                type : $(this).data("type"),
                page : 1,
                end : false,
                load : false
            };

            cmts_obj.reply_request = {
                work_id : "",
                epsd_id : "",
                comment_no : "",
                page : 1,
                end : false,
                load : false
            };
            
            $(".work_cmt__list").html("");
            $(".work_cmt__tab-item").removeClass("current");
            $(this).addClass("current");

            cmts_obj.get_cmt_list(cmts_obj.cmt_request);
        });


        
    
        //답변 
        $(document).on("click",".cmt-item__reply-list-button", function(){
            if($(this).hasClass("end")){
                $(this).removeClass("end");
                $(this).next(".cmt-item__reply-list").html("");
                $(this).text("의견 " +display_number($(this).data("reply"),"개 보기"));
                cmts_obj.reply_request = {
                    work_id : "",
                    epsd_id : "",
                    comment_no : "",
                    page : 1,
                    end : false,
                    load : false
                }; 
            }else{
                cmts_obj.reply_request.work_id = $(this).data("id");
                cmts_obj.reply_request.epsd_id = $(this).data("epsd");
                cmts_obj.reply_request.comment_no = $(this).data("comment");
                cmts_obj.get_reply_list($(this), cmts_obj.reply_request);
            }

        });

        //댓글 생성
        $(document).on("submit", "#epsd-comment__form", function(e){
            e.stopPropagation();
            cmts_obj.create_comment($(this));

            return false;
        })

        //댓글 삭제
        $(document).on("click", ".comment-delete-button", function(e){
            cmts_obj.delete_comment($(this));
        })

        //댓글 타이핑
        $(document).on("keyup keypress keydown","#comment_content", function(e){
            if($("#comment_mention").val() == ""){
                return;
            }
            let key = e.keyCode || e.charCode;
            let value = "@"+$("#comment_mention").val();
            if(key == 8 || key == 46){
                let s_index = $(this).val().indexOf(value);
                let e_index = s_index + value.length;

                if($(this).prop("selectionStart") >= s_index && $(this).prop("selectionStart") <= e_index){
                    $(this).val($(this).val().replace(/\@[가-힣|a-z|A-Z|0-9|\_\-]+/g, ""));
                    $("#comment_parent_no").val("");
                    $("#comment_mention").val("");
                }
            }
        });

        
        //언급 작성
        $(document).on("click",".cmt-item__reply-button", function(e){
            cmts_obj.init_comment_form($(this).data("comment"), $(this).data("mention"));
        });

        $("#work-modal").on("scroll", function(e){
            if($("#work-modal .epsd_detail").length > 0){
                if($(this).scrollTop() > cmts_obj.epsd_scroll_top) {
                    if($(this).scrollTop() + $(this).height() > $(".epsd_detail").prop('scrollHeight') - 100){
                        cmts_obj.get_cmt_list(cmts_obj.cmt_request);
                    }
                }
            }
            cmts_obj.epsd_scroll_top = $(this).scrollTop(); 
        });

        $(window).on("scroll", function(e){
            if($(".epsd_detail").length > 0){
                if($(this).scrollTop() > cmts_obj.epsd_scroll_top) {
                    if($(this).scrollTop() + $(this).height() > $(".epsd_detail").prop('scrollHeight') - 100){
                        cmts_obj.get_cmt_list(cmts_obj.cmt_request);
                    }
                }
            }
            cmts_obj.epsd_scroll_top = $(this).scrollTop(); 
        });
        
    },
    get_cmt_list: async function(data){
        if(cmts_obj.cmt_request.load == true){
            return;
        }
        if(cmts_obj.cmt_request.end == true){
            return;
        }

        cmts_obj.cmt_request.load = true;
        await pave_async_ajax("/api/work2/comment/list", "GET", data)
        .then(function(result){
            cmts_obj.cmt_request.load = false;

            if(result.data.list.length < 1){
                cmts_obj.cmt_request.end = true;
                if(cmts_obj.cmt_request.page == 1){
                    $(".work_cmt__list").html(result.data.html);
                }
                return;
            }

            if(cmts_obj.cmt_request.page == 1){
                $(".work_cmt__list").html(result.data.html);
            }else{
                $(".work_cmt__list").append(result.data.html);
            }

            cmts_obj.cmt_request.page++;
        });
    },

    init_comment_form: function(comment_parent_no = "", comment_mention = ""){
        $("#comment_parent_no").val(comment_parent_no);
        $("#comment_mention").val(comment_mention);
        if(comment_mention){
            $("#comment_content").val("@" + comment_mention);
            
        }else{
            $("#comment_content").val("");
        }
        $("#comment_content").focus();
        $("#comment_content").trigger("keyup");
    },

    create_comment: async function(f){
        await pave_async_ajax("/api/work2/comment/create", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                $(".work_cmt__tab-item").filter('[data-type="all"]').trigger("click");
            }else{
                alert(result.msg);
            }

            cmts_obj.init_comment_form();
        });
    },

    delete_comment: async function(elmt){
        await pave_async_ajax("/api/work2/comment/delete", "POST", {work_id: $(elmt).data("id"), epsd_id: $(elmt).data("epsd"), comment_no: $(elmt).data("comment")})
        .then(function(result){
            if(result.status == "success"){
                $(elmt).closest(".cmt-item").remove();
                
            }else{
                alert(result.msg);
            }
        });
    },

    get_reply_list: async function(elmt, data){
        if(cmts_obj.reply_request.load == true){
            return;
        }
        if(cmts_obj.reply_request.end == true){
            elmt.addClass("end");
            return;
        }

        cmts_obj.reply_request.load = true;
        await pave_async_ajax("/api/work2/reply/list", "GET", data)
        .then(function(result){
            cmts_obj.reply_request.load = false;
            if(result.data.list.length < 1){
                cmts_obj.reply_request.end = true;
                if(cmts_obj.reply_request.page == 1){
                    elmt.next().html(result.data.html);
                }

                elmt.text("의견 숨기기");
                elmt.addClass("end");
                return;
            }

            if(cmts_obj.reply_request.page == 1){
                elmt.next().html(result.data.html);
            }else{
                elmt.next().prepend(result.data.html);
            }

            elmt.text("의견 더보기");

            cmts_obj.reply_request.page++;
        });
    },
}

$(function () {
    works_obj.init();
    cmts_obj.init();
});