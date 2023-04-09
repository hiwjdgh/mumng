const creation_obj = {
    scroll_top: 0,

    list_elmt: null,
    list_request: {},

    init: function(elmt){
        creation_obj.list_elmt = elmt;
        creation_obj.add_event();
        creation_obj.set_list_request();
    },

    set_list_request: function(){
        creation_obj.list_request = {
            field: "",
            order : "update,desc",
            state: "recruit",
            ratio: "",
            size: "",
            exp: "0,1000000",
            page: 1,
            list_request: false,
            list_end: false,
        };

        $("select[name='creation_order']").val(creation_obj.list_request.order);
        $("input[name='creation_field[]']").each(function(i, elmt){
            if($(elmt).val() == creation_obj.list_request.field){
                $(elmt).prop("checked", true);
            }else{
                $(elmt).prop("checked", false);
            }
        });
        $("input[name='creation_state']").each(function(i, elmt){
            if($(elmt).val() == creation_obj.list_request.state){
                $(elmt).prop("checked", true);
            }else{
                $(elmt).prop("checked", false);
            }
        });
        $("input[name='creation_ratio[]']").each(function(i, elmt){
            if($(elmt).val() == creation_obj.list_request.ratio){
                $(elmt).prop("checked", true);
            }else{
                $(elmt).prop("checked", false);
            }
        });
        $("input[name='creation_size[]']").each(function(i, elmt){
            if($(elmt).val() == creation_obj.list_request.size){
                $(elmt).prop("checked", true);
            }else{
                $(elmt).prop("checked", false);
            }
        });
        $("input[name='creation_exp[]']").each(function(i, elmt){
            if($(elmt).val() == creation_obj.list_request.exp){
                $(elmt).prop("checked", true);
            }else{
                $(elmt).prop("checked", false);
            }
        });
    },

    add_event: function(){
        $(document).on("click", ".creation-filter-clear-button", function(){
            creation_obj.set_list_request();
            console.log("asd");
            creation_obj.get_creation_list();
        });

        $(document).on("change", "select[name='creation_order']", function(){
            creation_obj.list_request.order = $(this).val();
            creation_obj.list_request.page = 1;
            creation_obj.list_request.list_end = false;

            creation_obj.get_creation_list();
        });

        $(document).on("click", "input[name='creation_field[]']", function(){
            let field_list = new Array();
            $("input[name='creation_field[]']:checked").each(function(i,elmt){
                field_list.push($(elmt).val());
            })

            creation_obj.list_request.field = field_list.join(",");
            creation_obj.list_request.page = 1;
            creation_obj.list_request.list_end = false;

            creation_obj.get_creation_list();
        });

        $(document).on("change", "input[name='creation_state']", function(){
            creation_obj.list_request.state = $(this).val();
            creation_obj.list_request.page = 1;
            creation_obj.list_request.list_end = false;

            creation_obj.get_creation_list();
        });

        $(document).on("change", "input[name='creation_ratio[]']", function(){
            let ratio_list = new Array();
            $("input[name='creation_ratio[]']:checked").each(function(i,elmt){
                ratio_list.push($(elmt).val());
            })
            creation_obj.list_request.ratio = ratio_list.join(",");
            creation_obj.list_request.page = 1;
            creation_obj.list_request.list_end = false;

            creation_obj.get_creation_list();
        });

        $(document).on("change", "input[name='creation_size[]']", function(){
            let size_list = new Array();
            $("input[name='creation_size[]']:checked").each(function(i,elmt){
                size_list.push($(elmt).val());
            })
            creation_obj.list_request.size = size_list.join(",");
            creation_obj.list_request.page = 1;
            creation_obj.list_request.list_end = false;

            creation_obj.get_creation_list();
        });

        $(document).on("change", "input[name='creation_exp[]']", function(){
            creation_obj.list_request.exp = $(this).val();
            creation_obj.list_request.page = 1;
            creation_obj.list_request.list_end = false;

            creation_obj.get_creation_list();
        });

        $(window).off("scroll").on("scroll", function(e){
            if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                if($(this).scrollTop() > creation_obj.scroll_top) {
                    creation_obj.get_creation_list();

                }
    
            }
            creation_obj.scroll_top = $(this).scrollTop(); 
        });

        
    },
    get_creation_list: async function(){
        if(creation_obj.list_request.list_request == true){
            return;
        }
        if(creation_obj.list_request.list_end == true){
            return;
        }

        creation_obj.list_request.list_request = true;

        await pave_async_ajax("/api/creation/list", "GET", creation_obj.list_request)
        .then(function(result){
            creation_obj.list_request.list_request = false;

            if(result.data.list.length < 1){
                creation_obj.list_request.list_end = true;
                if(creation_obj.list_request.page == 1){
                    creation_obj.list_elmt.html(result.data.html);
                }
                return;
            }

            if(creation_obj.list_request.page == 1){
                creation_obj.list_elmt.html(result.data.html);
            }else{
                creation_obj.list_elmt.append(result.data.html);
            }

            creation_obj.list_request.page++;
        });
    }
};

const creation_request_obj = {
    init: function(){
        creation_request_obj.add_event();
    },
    add_event: function(){
        $(document).on("submit", ".creation-request__form", function(){
            creation_request_obj.request_creation(this);
            return false;
        });
    },
    request_creation: async function(f){
        await pave_async_ajax("/api/creation/request", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                alert("신청되었습니다.");
                location.reload();
            }else{
                if(result.redirect_url){
                    if(confirm(result.msg)){
                        location.href = result.redirect_url;
                    }
                }else{
                    alert(result.msg);
                }
            }
        });
    }
}

const creation_form_obj = {
    init: function(){
        creation_form_obj.add_event();
    },

    add_event: function(){
        $(document).on("input", ".creation__form", function(){
            $(this).data("change", true);
        });

        $(document).on("submit", ".creation__form", function(){
            if($("#action").val() == "create"){
                creation_form_obj.create_creation(this);
            }else if($("#action").val() == "update"){
                creation_form_obj.update_creation(this);
            }else if($("#action").val() == "delete"){
                creation_form_obj.delete_creation(this);
            }else{
                alert("잘못된 요청입니다.");
                return false;
            }
            return false;
        });

        $(document).on("click", ".upload-creation-delete-button", function(){
            $("#action").val("delete");
            $(".creation__form").submit();
        });


        $(document).on("click", ".creation-temp-item", function(e){
            e.preventDefault();
            location.replace($(this).prop("href"));
        });

        $(document).on("click", ".load-creation-temp-button", function(){
            modals.load("creation_temp_list", "임시저장된 창작의뢰", JSON.stringify({}));
        });
    },
    create_creation: async function(f){
        await pave_async_ajax("/api/creation/create", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                alert("창작 의뢰가 등록되었습니다.");
                location.replace(result.redirect_url);
            }else{
                alert(result.msg);
            }
        });
    },
    save_creation: async function(f){
        await pave_async_ajax("/api/creation/save", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                return result;
            }
        });
    },
    update_creation: async function(f){
        await pave_async_ajax("/api/creation/update", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                alert("창작 의뢰가 수정되었습니다.");
                $(".creation__form").data("change", false);
                location.href = result.redirect_url;
            }else{
                alert(result.msg);
            }
        });
    },
    delete_creation: async function(f){
        await pave_async_ajax("/api/creation/delete", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                alert("창작 의뢰가 삭제되었습니다.");
                location.href = result.redirect_url;
            }else{
                alert(result.msg);
            }
        });
    },
}

const creation_admin_obj = {
    init: function(){
        creation_admin_obj.add_event();
    },

    add_event: function(){
        $(document).on("click", ".creation-admin-button", function(){
            modals.load("creation_dashboard", "의뢰 관리", JSON.stringify({creation_no: $(this).data("creation")}));
        });

        $(document).on("click", ".creation-select-button", function(e){
            e.stopPropagation();
            e.preventDefault();
            alert("Asd");
        });
    }
    
}