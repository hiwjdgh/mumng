
const sight_obj = {
    scroll_top: 0,
    list_elmt: {},
    list_request: {},
    detail_request: {},

    init: function(elmt){
        sight_obj.list_elmt = elmt
        sight_obj.set_list_request();
        sight_obj.add_event();
    },

    add_event: function(){
        $(document).off("click", ".sight-header__filter-item").on("click", ".sight-header__filter-item", function(){
            $(".sight-header__filter-item").removeClass("current");
            $(this).addClass("current");

            sight_obj.set_list_request($(this).data("type"));
            sight_obj.get_sight_list();
        });

              
        $(document).on("click", ".sight-detail", function(){
            sight_obj.set_detail_request($(this).data("sight"));
            sight_obj.get_sight_detail();
        });

        $(window).off("scroll").on("scroll", function(e){
            if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                if($(this).scrollTop() > sight_obj.scroll_top) {
                    sight_obj.get_sight_list();

                }
    
            }
            sight_obj.scroll_top = $(this).scrollTop(); 
        });

    },

    set_list_request: function(type = "", page = 1, end = false, request = false){
        sight_obj.list_request = {
            type: type,
            page: page,
            sight_end: end,
            sight_request: request,
        };

    },

    set_detail_request: function(no, request = false){
        sight_obj.detail_request = {
            sight_no: no,
            sight_request: request,
        };
    },

    get_sight_list: async function(){
        if(sight_obj.list_request.sight_request == true){
            return;
        }
        if(sight_obj.list_request.sight_end == true){
            return;
        }

        sight_obj.list_request.sight_request = true;

        await pave_async_ajax("/api/sight/list", "GET", sight_obj.list_request)
        .then(function(result){
            sight_obj.list_request.sight_request = false;

            if(result.data.list.length < 1){
                sight_obj.list_request.sight_end = true;
                if(sight_obj.list_request.page == 1){
                    sight_obj.list_elmt.html(result.data.html);
                }
                return;
            }

            if(sight_obj.list_request.page == 1){
                sight_obj.list_elmt.html(result.data.html);
            }else{
                sight_obj.list_elmt.append(result.data.html);
            }


            sight_obj.list_request.page++;
        });
    },

    get_sight_detail: async function(){
        if(sight_obj.detail_request.sight_request == true){
            return;
        }
        sight_obj.detail_request.sight_request = true;

        await pave_async_ajax("/api/sight/detail", "GET", sight_obj.detail_request)
        .then(function(result){
            sight_obj.detail_request.sight_request = false;

            if(result.status == "success"){
                modals.show(result.data.html);
            }else{
                alert(result.msg);
            }
           
        });
    },


}

const sight_upload_obj = {
    form_request: {},
    init: function(){

        sight_upload_obj.add_event();
    },

    add_event: function(){

        $(document).on("click", ".upload-sight-button", function(){
            sight_upload_obj.set_form_request($(this).data("sight"), $(this).data("action"));
            sight_upload_obj.get_sight_form();
        });

        $(document).on("change", ".sight-form", function(e){
            $(this).data("change", true);
        })
     
        $(document).on("change", "#sight_img", async function(e){
            let files = e.target.files;

            if(!files || files.length == 0){
                return;
            }
        
            await check_sight_file(e)
            .then(function(result){
                if(result.status == "success"){
                    $("#sight__img-preview").prop("src",result.data.url);
                    $("#sight_tmp_img").val(JSON.stringify(result.data));
                    $(".file-sight").addClass("edit");
                }else{
                   alert(result.msg);
                }
            });
            $("#sight_img").val("");

        });

        $(document).on("change", "input[name='sight_grp_id']", function(e){
            if($(this).val() == "webtoon"){
                $(".file-sight").removeClass("novel");
                $(".file-sight__none-grp").text("그림");

            }else{
                $(".file-sight").addClass("novel");
                $(".file-sight__none-grp").text("글");

            }
        });

        $(document).on("change", "input[name='sight_img_use']", function(e){
            if($(this).val() == "1"){
                $(".file-sight").removeClass("none");
                $("#sight_img").prop("disabled", false);
                $(".file-sight__none-title").text("제목");
            }else{
                $(".file-sight").addClass("none");
                $("#sight_img").prop("disabled", true);
                if($("#sight_name").val()){
                    $(".file-sight__none-title").text($("#sight_name").val());
                }
            }
        });

        $(document).on("keyup keydown keypress paste blur", "#sight_name", function(e){
            if($("input[name='sight_img_use']:checked").val() == "0"){
                if($(this).val()){
                    $(".file-sight__none-title").text($(this).val());
                }else{
                    $(".file-sight__none-title").text("제목");
                }
            }
        })

        
        $(".sight-delete-button").on("click", function(e){
            let form = $(this).data("form");
            $(form).find("input[name='action']").val("delete");

            $(form).submit();
        })

        $(document).on("keydown", "#sight_hashtag_text", function(event){
            if (event.keyCode === 13 || event.keyCode === 32) {
                event.preventDefault();
                sight_upload_obj.check_sight_hashtag();
            };
        });

        $(document).on("click", "#sight_hashtag_add_button", function(){
            sight_upload_obj.check_sight_hashtag();
        });

        $(document).on("click", ".sight_hashtag_del_button", function(event){
            $(event.target).closest(".chip-box").remove();

            let max = Number($(".sight-hashtag-counter").data("max"));
            let hashtag_length = $("input[name='sight_hashtag[]']").length;
            $(".sight-hashtag-counter").text((hashtag_length)+"/"+ max);
        });

        $(document).on("submit", ".sight__form", function(){
            oEditors.getById["pave-editor"].exec("UPDATE_CONTENTS_FIELD", []);

            if ($("#pave-editor").val() == "<p><br></p>") {
                $("#pave-editor").val("");
            }

            if($("#action").val() == "create"){
                sight_upload_obj.create_sight(this);
            }else if($("#action").val() == "update"){
                sight_upload_obj.update_sight(this);
            }else if($("#action").val() == "save"){
            }else if($("#action").val() == "delete"){
                sight_upload_obj.delete_sight(this);
            }else{
                alert("잘못된 요청입니다.");
                return false;
            }
            return false;
        });

        $(document).on("click", ".upload-sight-delete-button", function(){
            $("#action").val("delete");
            $(".sight__form").submit();
        });
    },

    set_form_request: function(no, action = "create",  request = false){
        if(no === undefined){
            no = "";
        }
        sight_upload_obj.form_request = {
            sight_no: no,
            action: action,
            sight_request: request,
        };
    },

    get_sight_form: async function(){
        if(sight_upload_obj.form_request.sight_request == true){
            return;
        }
        sight_upload_obj.form_request.sight_request = true;

        await pave_async_ajax("/api/sight/form", "GET", sight_upload_obj.form_request)
        .then(function(result){
            sight_upload_obj.form_request.sight_request = false;

            if(result.status == "success"){
                modals.show(result.data.html);
                setTimeout(function(){
                    load_editor(result.data.sight.sight_content);
                }, 200);
            }else{
                alert(result.msg);
            }
           
        });
    },

    check_sight_hashtag: function(){
        let max = Number($(".sight-hashtag-counter").data("max"));
        let hashtag_length = $("input[name='sight_hashtag[]']").length;
        let sight_hashtag = $.trim($("#sight_hashtag_text").val());

        if(sight_hashtag == ""){
            return;
        }

        sight_hashtag = escape_html(sight_hashtag);


        if(hashtag_length == max){
            alert("해시태그는 최대 10개까지 입력 가능합니다.");
            $("#sight_hashtag_text").select();
            return;
        } 

        let is_duplicate = false;
        $("input[name='sight_hashtag[]']").each(function(){
            if(escape_html($(this).val()) == sight_hashtag){
                is_duplicate = true;
                return;
            }
        });

        if(is_duplicate){
            alert("중복된 해시태그 입니다.");
            $("#sight_hashtag_text").select();
            return;
        }
        
        let hashtag_html = "";
        hashtag_html += '<div class="chip-box">';
        hashtag_html += '<span class="chip-box__label">'+sight_hashtag+'</span>';
        hashtag_html += '<input type="hidden" name="sight_hashtag[]" value="'+sight_hashtag+'">';
        hashtag_html += '<button class="sight_hashtag_del_button chip-box__action icon-button icon-button-16"><span class="icon-x icon-16"></span></button>';
        hashtag_html += '</div>';
        $(".sight-hashtag-box").prepend(hashtag_html);
        $("#sight_hashtag_text").val("");
        $("#sight_hashtag_text").focus();

        $(".sight-hashtag-counter").text((hashtag_length+1)+"/"+ max);
    },

    create_sight: async function(f){
        await pave_async_ajax("/api/sight/create", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                alert("창작물이 등록되었습니다.");
                location.href = "/sight/list";
            }else{
                alert(result.msg);
            }
        });
    },
    update_sight: async function(f){
        await pave_async_ajax("/api/sight/update", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                alert("창작물이 수정되었습니다.");
                modals.hide("sight_form_modal");
                sight_obj.set_detail_request(f.sight_no.value);
                sight_obj.get_sight_detail();
            }else{
                alert(result.msg);
            }
        });
    },
    delete_sight: async function(f){
        await pave_async_ajax("/api/sight/delete", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                alert("창작물이 삭제되었습니다.");
                location.reload();
            }else{
                alert(result.msg);
            }
        });
    },

}

$(function(){
    sight_upload_obj.init();
});
