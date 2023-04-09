const calendar_obj = {
    elmt : null,
    date : new Date(),
    dow_list : ["", "mon", "tue", "wed", "thu", "fri", "sat", "sun"],
    dow_list_kr : ["", "월", "화", "수", "목", "금", "토", "일"],
    time_obj: null,
    init: function(elmt){
        calendar_obj.elmt = elmt;
        calendar_obj.date.setHours(0,0,0,0);
        calendar_obj.time_obj = {
            y : calendar_obj.date.getFullYear(),
            m : calendar_obj.date.getMonth()+1,
            d : calendar_obj.date.getDate(),
            dow: calendar_obj.date.getDay(),
            fd : new Date(calendar_obj.date.getFullYear(), calendar_obj.date.getMonth(), 1),
            ld : new Date(calendar_obj.date.getFullYear(), calendar_obj.date.getMonth() + 1, 0)
        }
        calendar_obj.render();
        calendar_obj.add_event();
    },

    add_event: function(){
        $(document).on("click", ".js-prev-button", function(){
            calendar_obj.prev();
        });

        $(document).on("click", ".js-next-button", function(){
            calendar_obj.next();
        });

        $(document).on("click", ".calendar__date-item:not(.empty)", function(){
            calendar_obj.show_popup($(this));
        });
        $(document).on("click", ".calendar-popup__header-close-button", function(){
            calendar_obj.hide_popup();
        });

        $( window ).resize( function() {
            $(".calendar__date-item").css("max-height", ($(".upload__calendar").height()-32)/$(".calendar__week-box").length);
        });
    },

    prev: function(){
        calendar_obj.date.setMonth(calendar_obj.time_obj.m - 2);
        calendar_obj.time_obj = {
            y : calendar_obj.date.getFullYear(),
            m : calendar_obj.date.getMonth()+1,
            d : calendar_obj.date.getDate(),
            dow: calendar_obj.date.getDay(),
            fd : new Date(calendar_obj.date.getFullYear(), calendar_obj.date.getMonth(), 1),
            ld : new Date(calendar_obj.date.getFullYear(), calendar_obj.date.getMonth() + 1, 0)
        }
        calendar_obj.render();
        $(".js-now").text(calendar_obj.time_obj.y+"."+calendar_obj.time_obj.m);
    },
    next: function(){
        calendar_obj.date.setMonth(calendar_obj.time_obj.m);
        calendar_obj.time_obj = {
            y : calendar_obj.date.getFullYear(),
            m : calendar_obj.date.getMonth()+1,
            d : calendar_obj.date.getDate(),
            dow: calendar_obj.date.getDay(),
            fd : new Date(calendar_obj.date.getFullYear(), calendar_obj.date.getMonth(), 1),
            ld : new Date(calendar_obj.date.getFullYear(), calendar_obj.date.getMonth() + 1, 0)
        }
        calendar_obj.render();
        $(".js-now").text(calendar_obj.time_obj.y+"."+calendar_obj.time_obj.m);
    },

    show_popup: async function(elmt){
        if($(".calendar-popup").is(":visible")){
            await calendar_obj.hide_popup();
        }
        let work_id_list = new Array();
        $(elmt).find(".calendar__date-badge").each(function(){
            work_id_list.push($(this).data("id"));
        });
        pave_async_ajax("/api/upload/calendar/popup", "GET", {work_id_list: work_id_list.join(","), calendar_date: elmt.data("date")})
        .then(function(result){
            if(result.status == "success"){
                $(".upload__left").append(result.data.html);
                $(".calendar-popup").draggable({
                    drag: function(event, ui) {
                        $(event.target).css("transform", "none");
                    }, 
                    containment: ".upload__left", 
                    scroll: false ,
                    handle: ".calendar-popup__header"
                });
                $(".calendar-popup").css({
                    transform: "translate(-50%, -50%)",
                    top: "50%",
                    left: "50%"
                });
            }else{

            }
        });
    },

    hide_popup: async function(){
        await pave_async_ajax("/api/upload/calendar/memo/update", "POST", {calendar_memo: $("#calendar_memo").val(), calendar_date: $("#calendar_date").val()})
        .then(function(result){
            if(result.status == "success"){
                $(".calendar-popup").remove();
                calendar_obj.render();
            }else{

            }
        });
    },

    render: async function(){
        let html = "";

        html += '<div class="calendar">';
        html += '<div class="calendar__day-box">';
        html += '    <div class="calendar__day-item mon">월</div>';
        html += '    <div class="calendar__day-item tue">화</div>';
        html += '    <div class="calendar__day-item wed">수</div>';
        html += '    <div class="calendar__day-item thu">목</div>';
        html += '    <div class="calendar__day-item fri">금</div>';
        html += '    <div class="calendar__day-item sat">토</div>';
        html += '    <div class="calendar__day-item sun">일</div>';
        html += '</div>';
        html += '<div class="calendar__date-box">';
        
        let start = 1;
        let end = calendar_obj.time_obj.fd.getDay();
        if(end == 0){
            end = 7;
        }

        html += '    <div class="calendar__week-box">';
        for (start;  start < end; start++) {
            html += '    <div class="calendar__date-item empty">';
            html += '        <span></span>';
            html += '        <div></div>';
            html += '    </div>';
        }



        let start2 = calendar_obj.time_obj.fd.getDate();
        let end2 = calendar_obj.time_obj.ld.getDate();
        let end_dow = "";


        //메모 가져오기
        let memo_list = null;
        await pave_async_ajax("/api/upload/calendar/memo/load", "GET", {calendar_start: calendar_obj.time_obj.fd.getTime()/1000, calendar_end: calendar_obj.time_obj.ld.getTime()/1000})
        .then(function(result){
            if(result.status == "success"){
                memo_list = result.data;
            }else{

            }
        });

         //작품 가져오기
         let work_list = null;
         await pave_async_ajax("/api/upload/calendar/work", "GET", {calendar_start: calendar_obj.time_obj.fd.getTime()/1000, calendar_end: calendar_obj.time_obj.ld.getTime()/1000})
         .then(function(result){
             if(result.status == "success"){
                work_list = result.data;
             }
         });
 


        for (start2;  start2 <= end2; start2++) {
            let data = calendar_obj.time_obj.y+"-"+calendar_obj.time_obj.m+"-"+ ("0" + start2).slice(-2);
            let loop_date = new Date(data);
            let c_date = new Date();
            loop_date.setHours(0,0,0,0);
            c_date.setHours(0,0,0,0);
            let loop_dow = loop_date.getDay();
            let loop_day_state = "";
            if(loop_dow == 0){
                loop_dow = 7;
            }
            end_dow = loop_dow;
            
            if(loop_date.getTime() < c_date.getTime()){
                loop_day_state = "past";
            }else if(loop_date.getTime() == c_date.getTime()){
                loop_day_state = "today";
            }else{
                loop_day_state = "future";
            }


            if(loop_dow % 7 == 1){
                html += '    <div class="calendar__week-box">';
            }

            html += '    <div class="calendar__date-item '+loop_day_state+' '+calendar_obj.dow_list[loop_dow]+'" data-date="'+data+'">';
            html += '        <span class="calendar__date-text">'+start2+'</span>';

            memo_list.forEach(function(memo){
                if(data == memo.calendar_date){
                    html += '<span class="calendar__date-memo icon-memo icon-12"></span>';
                }
            });
            html += '<div class="calendar__date-inner-box">';
            work_list.forEach(function(work){
                if(work.work_end_date != "0000-00-00"){
                    if(loop_date.getTime()/1000 >= work.work_insert_timestamp && loop_date.getTime()/1000 <= work.work_end_timestamp){

                        let is_epsd_exist = false;
                        work.epsd_list.forEach(function(epsd){
                            if(epsd.epsd_upload_date == data){
                                 if(epsd.epsd_state == "reserve"){
                                    html += '<div class="calendar__date-badge" data-id="'+epsd.work_id+'">';
                                    html += '<span class="calendar__date-badge-circle" style="background-color:'+work.work_color+';"></span>';
                                    html += '<span class="calendar__date-badge-state">예약</span>';
                                    html += '<span class="calendar__date-badge-epsd text-truncate">'+epsd.epsd_name+'</span>';
                                    html += '</div>';
                                }else if(epsd.epsd_state == "success"){
                                    html += '<div class="calendar__date-badge" data-id="'+epsd.work_id+'">';
                                    html += '<span class="calendar__date-badge-circle" style="background-color:'+work.work_color+';"></span>';

                                    if(epsd.epsd_delay == "1"){
                                        html += '<span class="calendar__date-badge-state delay">지각</span>';
                                    }else{
                                        html += '<span class="calendar__date-badge-state">연재중</span>';
                                    }
                                    html += '<span class="calendar__date-badge-epsd text-truncate">'+epsd.epsd_name+'</span>';
                                    html += '</div>';
                                }else if(epsd.epsd_state == "save"){
                                    html += '<div class="calendar__date-badge" data-id="'+epsd.work_id+'">';
                                    html += '<span class="calendar__date-badge-circle" style="background-color:'+work.work_color+';"></span>';
                                    html += '<span class="calendar__date-badge-state">임시저장</span>';
                                    html += '</div>';
                                }
                                is_epsd_exist = true;
                                return false;
                            }
                        });
            
                        if(is_epsd_exist){
                            return;
                        }

                        if(loop_date.getTime() < c_date.getTime()){
                            if(work.work_day_list.includes(calendar_obj.dow_list_kr[loop_dow])){
                                html += '<div class="calendar__date-badge" data-id="'+work.work_id+'">';
                                html += '<span class="calendar__date-badge-circle" style="background-color:'+work.work_color+';"></span>';
                                html += '<span class="calendar__date-badge-state">미연재</span>';
                                html += '</div>';
                            }
                           
                        }else{
                            if(work.work_day_list.includes(calendar_obj.dow_list_kr[loop_dow])){
                                html += '<div class="calendar__date-badge" data-id="'+work.work_id+'">';
                                html += '<span class="calendar__date-badge-circle" style="background-color:'+work.work_color+';"></span>';
                                html += '</div>';
                            }
                        }
                        
                    }
                }else{
                    if(loop_date.getTime()/1000 >= work.work_insert_timestamp){
                        let is_epsd_exist = false;
                        work.epsd_list.forEach(function(epsd){
                            if(epsd.epsd_upload_date == data){
                                 if(epsd.epsd_state == "reserve"){
                                    html += '<div class="calendar__date-badge" data-id="'+epsd.work_id+'">';
                                    html += '<span class="calendar__date-badge-circle" style="background-color:'+work.work_color+';"></span>';
                                    html += '<span class="calendar__date-badge-state">예약</span>';
                                    html += '<span class="calendar__date-badge-epsd text-truncate">'+epsd.epsd_name+'</span>';
                                    html += '</div>';
                                }else if(epsd.epsd_state == "success"){
                                    html += '<div class="calendar__date-badge" data-id="'+epsd.work_id+'">';
                                    html += '<span class="calendar__date-badge-circle" style="background-color:'+work.work_color+';"></span>';

                                    if(epsd.epsd_delay == "1"){
                                        html += '<span class="calendar__date-badge-state delay">지각</span>';
                                    }else{
                                        html += '<span class="calendar__date-badge-state">연재중</span>';
                                    }
                                    html += '<span class="calendar__date-badge-epsd text-truncate">'+epsd.epsd_name+'</span>';
                                    html += '</div>';
                                }else if(epsd.epsd_state == "save"){
                                    html += '<div class="calendar__date-badge" data-id="'+epsd.work_id+'">';
                                    html += '<span class="calendar__date-badge-circle" style="background-color:'+work.work_color+';"></span>';
                                    html += '<span class="calendar__date-badge-state">임시저장</span>';
                                    if(epsd.epsd_name){
                                        html += '<span class="calendar__date-badge-epsd text-truncate">'+epsd.epsd_name+'</span>';
                                    }
                                    html += '</div>';
                                }
                                is_epsd_exist = true;
                                return false;
                            }
                        });
            
                        if(is_epsd_exist){
                            return;
                        }
                      
                        if(loop_date.getTime() < c_date.getTime()){
                            if(work.work_day_list.includes(calendar_obj.dow_list_kr[loop_dow])){
                                html += '<div class="calendar__date-badge" data-id="'+work.work_id+'">';
                                html += '<span class="calendar__date-badge-circle" style="background-color:'+work.work_color+';"></span>';
                                html += '<span class="calendar__date-badge-state">미연재</span>';
                                html += '</div>';
                            }
                        }else{
                            if(work.work_day_list.includes(calendar_obj.dow_list_kr[loop_dow])){
                                html += '<div class="calendar__date-badge" data-id="'+work.work_id+'">';
                                html += '<span class="calendar__date-badge-circle" style="background-color:'+work.work_color+';"></span>';
                                html += '</div>';
                            }
                        }
                    }
                }
            });

           
         
            html += '</div>';

            html += '    </div>';

            
            if(loop_dow % 7 == 0){
                html += '    </div>';
            }
        }

        for (end_dow;  end_dow < 7; end_dow++) {
            html += '    <div class="calendar__date-item empty">';
            html += '        <span></span>';
            html += '        <div></div>';
            html += '    </div>';
        }

        html += '</div>';
        html += '</div>';
        html += '</div>';

        calendar_obj.elmt.html(html);

        $(".calendar__date-item").css("max-height", ($(".upload__calendar").height()-32)/$(".calendar__week-box").length);
    }
}


const upload_obj = {
    pop_obj : {},

    init: function(){
        upload_obj.pop_obj = {
            url: window.location.href,
            type: "",
            data: null
        };

        let paths = window.location.pathname.split("/");

        if(paths[2] == "work"){
            if(paths[3] == "form"){
                upload_obj.pop_obj.type = "work_form";
                if(paths[4]){
                    upload_obj.pop_obj.data = {
                        work_id : paths[4],
                        action : "update",
                    }
                }else{
                    upload_obj.pop_obj.data = {
                        work_id : "",
                        action : "create",
                    }
                }
              
            }else if(paths[3] == "detail"){
                upload_obj.pop_obj.type = "work_detail";
                if(paths[4]){
                    upload_obj.pop_obj.data = {
                        work_id : paths[4],
                    }
                }else{
                    location.href = "/upload/home";
                }
            }
        }
        calendar_obj.init($(".upload__calendar"));
        upload_obj.add_event();
        upload_obj.get_work_list();
        upload_obj.domain_setting(upload_obj.pop_obj, false);
    },
    add_event: function(){
        $(document).on("click", ".upload__work-item", function(){
            $(".upload__work-item").removeClass("current");
            $(this).addClass("current");
            

            let work_id = $(this).data("id");
            upload_obj.pop_obj.url = "/upload/work/detail/" + work_id;
            upload_obj.pop_obj.type = "work_detail";
            upload_obj.pop_obj.data = {
                work_id : work_id
            }
            upload_obj.domain_setting(upload_obj.pop_obj, true);
        });

        $(document).on("change", ".upload__info-color-input", function(e){
            e.stopPropagation();
            let elmt = $(this);
            pave_async_ajax("/api/upload/work/color", "POST", {work_color: elmt.val(), work_id: elmt.data("id")})
            .then(function(result){
                if(result.status == "success"){
                    $('.calendar__date-badge').filter("[data-id='"+elmt.data("id")+"']").find(".calendar__date-badge-circle").css("background-color", elmt.val());
                    $('.upload__work-item-color').css("background-color", elmt.val());
                }else{
    
                }
            });
        });

        //작품 가이드
        $(document).on("click", ".upload_work_guide__button", function(event){
            modals.hide($(this).data("anchor"));
        });

               
        $(document).on("click", ".upload-work-button", function(e){
            e.stopPropagation();

            let work_id = $(this).data("id") === undefined ? "" : $(this).data("id");
            upload_obj.pop_obj.url = "/upload/work/form/" + work_id;
            upload_obj.pop_obj.type = "work_form";
            upload_obj.pop_obj.data = {
                work_id : work_id,
                action : $(this).data("action"),
            }
            upload_obj.domain_setting(upload_obj.pop_obj, true);
        });
        
        $(document).on("click", ".upload-work-close-button", function(e){
            history.back();
            //upload_obj.hide_work_form();
        });
                
        $(document).on("click", ".upload-epsd-button", function(e){
            e.stopPropagation();
            upload_obj.show_epsd_form($(this).data("id"), $(this).data("epsd"), $(this).data("action"), $(this).data("cate"), $(this).data("date"));
        });

        $(document).on("click", ".upload-epsd-close-button", function(e){
            upload_obj.hide_epsd_form();
        });
              
        window.addEventListener("popstate", function (e) {
            upload_obj.domain_setting(e.state, false);
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
                upload_obj.hide_work_form();
                setTimeout(function(){
                    $(".upload__work-item").removeClass("current").filter("[data-id='"+state.data.work_id+"']").addClass("current");
                    upload_obj.get_work(state.data.work_id);
                }, 200); 
            }else if(state.type == "work_form"){
                upload_obj.show_work_form(state.data.work_id, state.data.action);
            }else if(state.type == "epsd_detail"){
                works_obj.get_epsd_detail(state.data);
            } 
        }
    },
    show_work_form: async function(work_id, action){
        upload_obj.hide_work_form();
        await pave_async_ajax("/api/upload/work/form", "GET", {work_id: work_id, action: action})
        .then(function(result){
            if(result.status == "success"){
                $(".upload__left").append(result.data.html);
            }else{
                alert(result.msg);
                location.href = "/upload/home";
            }
        });
    },
    hide_work_form: function(){
        if($(".upload-work").length > 0 && $(".upload-work__form").data("change")){
            if(confirm("작성중인 내용이 있습니다. 나가시겠습니까?")){
                $(".upload-work").remove();

                return true;
            }
            return false;
        }else{
            $(".upload-work").remove();

            return true;
        }
    },
    get_work: async function(work_id){
        await pave_async_ajax("/api/upload/work/detail", "GET", {work_id: work_id})
        .then(function(result){
            if(result.status == "success"){
                $(".upload__info").remove();
                $(".upload__epsd").remove();
                $(".upload__work").append(result.data.html);
            }else{

            }
        });
    },

    get_work_list: async function(){
        await pave_async_ajax("/api/upload/work/list", "GET", {})
        .then(function(result){
            if(result.status == "success"){
                $(".upload__work").html(result.data.html);
            }else{

            }
        });
    },
    show_epsd_form: async function(work_id, epsd_id, action, epsd_cate, calendar_date){
        upload_obj.hide_epsd_form();
        await pave_async_ajax("/api/upload/epsd/form", "POST", {work_id: work_id, epsd_id: epsd_id, action: action, epsd_cate: epsd_cate, calendar_date: calendar_date})
        .then(function(result){
            if(result.status == "success"){
                $(".upload__left").append(result.data.html);
            }else{
                alert(result.msg);
            }
        });
    },
    hide_epsd_form: function(){
        if($(".upload-epsd").length > 0 && $(".upload-epsd__form").data("change")){
            if(confirm("작성중인 내용이 있습니다. 나가시겠습니까?")){
                $(".upload-epsd").remove();

                return true;
            }
            return false;
        }else{
            $(".upload-epsd").remove();

            return true;
        }
    },
}

const work_upload_obj = {
    with_request_obj: {},
    init: function(){
        work_upload_obj.add_event();
    },
    add_event: function(){
        //작품 등록 폼
        $(document).on("change", ".upload-work__form", function(e){
            $(this).data("change", true);
        });
   

        $(document).on("click", ".upload-work-delete-button", function(){
            if(confirm("작품을 정말 삭제하시겠습니까? 삭제 이후 복구할 수 없습니다.")){
                $("#action").val("delete");
                $(".upload-work__form").submit();
            }
        });

        $(document).on("change", "#work_img", async function(e){
            let files = e.target.files;

            if(!files || files.length == 0){
                return;
            }
        
            await check_work_file(e)
            .then(function(result){
                if(result.status == "success"){
                    $("#work__img-preview").prop("src",result.data.url);
                    $("#work_tmp_img").val(JSON.stringify(result.data));
                    $(".file-work").addClass("edit");
                }else{
                   alert(result.msg);
                }
            });
            $("#work_img").val("");

        });

        $(document).on("change", "input[name='work_genre[]']", function(event){
            let max = Number($(".upload-work__genre-counter").data("max"));
            let checked_length = $("input[name='work_genre[]']:checked").length;
            if(checked_length > max) {
                alert("장르는 최대 "+max+"개 까지 선택가능합니다.");
                $(this).prop("checked", false);
                return false;
            }else{
                $(".upload-work__genre-counter").text(checked_length+"/"+max);
            }
        });

        $(document).on("keydown", "#work_hashtag_text", function(event){
            if (event.keyCode === 13 || event.keyCode === 32) {
                event.preventDefault();
                $(".upload-work-hashtag-add-button").trigger("click");
            };
        });

        $(document).on("click", ".upload-work-hashtag-add-button", function(){
            work_upload_obj.check_work_hashtag();
        });

        $(document).on("click", ".upload-work-hashtag-delete-button", function(event){
            $(event.target).closest(".chip-box").remove();
        });

        $(document).on("click", ".upload-work-with-add-button", function(event){
            let work_with_list = new Array();
            $("input[name='work_with[]']").each(function(){
                work_with_list.push($(this).val());
            });
        
            modals.load("upload_work_with", "함께한 작가 추가", JSON.stringify({work_with_list: work_with_list.join(",")}))
            .then(function(){
                work_upload_obj.with_request_obj = {
                    page: 1,
                    keyword: "",
                    work_with_list: work_with_list.join(","),
                    search: false,
                    end: false,
                    with_request: false,
                };
                work_upload_obj.get_with_list();
            });
        });
    
        $(document).on("keydown", "#user_nick", function(e){
            if (e.keyCode === 13) {
                e.preventDefault();
                $(".work_with__search-form-submit").trigger("click");
            }
        });

        $(document).on("click", ".work_with__search-form-submit", function(){
            work_upload_obj.with_request_obj = {
                page: 1,
                keyword: $("#user_nick").val(),
                work_with_list: work_with_list.join(","),
                search: true,
                end: false,
                with_request: false,
            };
            work_upload_obj.get_with_list();
        });

        $(document).on("click", ".work_with__item-add-button", function(e){
            let user_data = $(this).data("json");
            let user_data_json = escape_html(JSON.stringify(user_data));
            let work_with_html = "";
            work_with_html += '<li class="work_with__select-item" data-json="'+user_data_json+'">';
            work_with_html += '<img src="'+user_data.user_img+'" alt="프로필 이미지" class="work_with__select-img" width="50" height="50">';
            work_with_html += '<small class="work_with__select-nick">'+user_data.user_nick+'</small>';
            work_with_html += '<div class="work_with__select-overlay">';
            work_with_html += '<button type="button" class="work_with__select-delete-button icon-button icon-20" data-user="'+user_data.user_no+'">';
            work_with_html += '<span class="icon-x icon-20"></span>';
            work_with_html += '</button>';
            work_with_html += '</div>';
            work_with_html += '</li>';

            if($(".work_with__select-item").length == 5){
                alert("함께한 작가는 최대 5명 입니다.");
                return;
            }
        
        
            $(".work_with__select-list").append(work_with_html);
            $(this).prop("disabled", true).addClass("disabled").text("추가됨");
        });

        $(document).on("click", ".work_with__select-delete-button", function(){
            $(this).closest(".work_with__select-item").remove();
            $(".work_with__item-add-button").filter("[data-user='"+$(this).data("user")+"']").prop("disabled", false).removeClass("disabled").text("추가");
        });

        $(document).on("click", ".work_with__add-button", function(event){
            let work_with_html = "";

            $(".work_with__select-item").each(function(){
                let user_data = $(this).data("json");
                work_with_html += '<li class="upload-work__with-item">';
                work_with_html += '    <img src="'+user_data.user_img+'" alt="프로필 이미지" class="upload-work__with-item-img">';
                work_with_html += '    <div class="upload-work__with-item-nick-box">';
                work_with_html += '        <span class="upload-work__with-item-nick">'+user_data.user_nick+'</span>';
                work_with_html += '        <small class="upload-work__with-item-field">'+user_data.user_field+'</small>';
                work_with_html += '    </div>';
                work_with_html += '    <button type="button" class="upload-work__with-item-delete-button icon-button icon-button-20">';
                work_with_html += '        <span class="icon-x icon-20"></span>';
                work_with_html += '    </button>';
                work_with_html += '    <input type="hidden" name="work_with[]" value="'+user_data.user_no+'">';
                work_with_html += '</li>';
            });
           $(".upload-work__with-box").html(work_with_html);
         
            let max = Number($(".upload-work__with-counter").data("max"));
            let with_length = $("input[name='work_with[]']").length;
            $(".upload-work__with-counter").text(with_length+"/"+max);

           modals.hide("work_with_modal");
        });

        $(document).on("click", ".upload-work__with-item-delete-button", function(event){
            $(this).closest(".upload-work__with-item").remove();
            let max = Number($(".upload-work__with-counter").data("max"));
            let with_length = $("input[name='work_with[]']").length;
            $(".upload-work__with-counter").text(with_length+"/"+max);
        });

        $(document).on("change", "input[name='work_free']", function(event){
            if($(this).val() == "1"){
                $(".upload-work__commerce-nonfree-box").hide();
                $(".upload-work__commerce-free-box").show();
            }else{
                $(".upload-work__commerce-nonfree-box").show();
                $(".upload-work__commerce-free-box").hide();
            }
        });

        $(document).on("submit", ".upload-work__form", function(){
            if($("#action").val() == "create"){
                work_upload_obj.create_work(this);
            }else if($("#action").val() == "update"){
                work_upload_obj.update_work(this);
            }else if($("#action").val() == "delete"){
                work_upload_obj.delete_work(this);
            }else{
                alert("잘못된 요청입니다.");
                return false;
            }
            return false;
        });
    },

    check_work_hashtag: function(){
        let max = Number($(".upload-work__hashtag-counter").data("max"));
        let hashtag_length = $("input[name='work_hashtag[]']").length;
        let work_hashtag = $.trim($("#work_hashtag_text").val());
    
        if(work_hashtag == ""){
            return;
        }
    
        work_hashtag = escape_html(work_hashtag);
    
    
        if(hashtag_length == max){
            alert("해시태그는 최대 10개까지 입력 가능합니다.");
            $("#work_hashtag_text").select();
            return;
        } 
    
        let is_duplicate = false;
        $("input[name='work_hashtag[]']").each(function(){
            if(escape_html($(this).val()) == work_hashtag){
                is_duplicate = true;
                return;
            }
        });
    
        if(is_duplicate){
            alert("중복된 해시태그 입니다.");
            $("#work_hashtag_text").select();
            return;
        }
        
        let hashtag_html = "";
        hashtag_html += '<div class="chip-box">';
        hashtag_html += '<span class="chip-box__label">'+work_hashtag+'</span>';
        hashtag_html += '<input type="hidden" name="work_hashtag[]" value="'+work_hashtag+'">';
        hashtag_html += '<button class="work_hashtag_del_button chip-box__action icon-button icon-button-16"><span class="icon-x icon-16"></span></button>';
        hashtag_html += '</div>';
        $(".upload-work__hashtag-box").prepend(hashtag_html);
        $("#work_hashtag_text").val("");
        $("#work_hashtag_text").focus();
    
        $(".upload-work__hashtag-counter").text((hashtag_length+1)+"/"+ max);
    },
    
    get_with_list: async function(){
        if(work_upload_obj.with_request_obj.end){
            return;
        }

        if(work_upload_obj.with_request_obj.with_request){
            return;
        }
        work_upload_obj.with_request_obj.with_request = true;
        await pave_async_ajax("/api/upload/work/with", "GET", work_upload_obj.with_request_obj)
        .then(function(result){
            work_upload_obj.with_request_obj.with_request = false;
            if(result.status == "success"){
                if(result.data.list.length < 1){
                    work_upload_obj.with_request_obj.end = true;
                    if(work_upload_obj.with_request_obj.page == 1){
                        $(".work_with__list").html(result.data.html);
                    }
                    return;
                }
    
                if(work_upload_obj.with_request_obj.page == 1){
                    $(".work_with__list").html(result.data.html);
                }else{
                    $(".work_with__list").append(result.data.html);
                }
    
    
                work_upload_obj.with_request_obj.page++;
            }else{
               alert(result.msg);
            }
        });
    },
    create_work: async function(f){
        await pave_async_ajax("/api/upload/work/create", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                alert("작품이 등록되었습니다.");
                location.href = "/upload/home";
            }else{
                alert(result.msg);
            }
        });
    },
    update_work: async function(f){
        await pave_async_ajax("/api/upload/work/update", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                alert("작품이 수정되었습니다.");
                location.href = "/upload/work/form/"+ f.work_id.value;
            }else{
                alert(result.msg);
            }
        });
    },
    delete_work: async function(f){
        await pave_async_ajax("/api/upload/work/delete", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                alert("작품이 삭제되었습니다.");
                location.href = "/upload/home";
            }else{
                alert(result.msg);
            }
        });
    },
}

const epsd_upload_obj = {
    init: function(){
        epsd_upload_obj.add_event();
    },
    add_event: function(){
        $(document).on("change", ".upload-epsd__form", function(e){
            $(this).data("change", true);
        });

        $(document).on("click", ".upload-epsd-delete-button", function(){
            if(confirm("회차를 정말 삭제하시겠습니까? 삭제 이후 복구할 수 없습니다.")){
                $("#action").val("delete");
                $(".upload-epsd__form").submit();
            }
        });
    
        $(document).on("change", "input[name='epsd_no_type']", function(event){
            if($(this).val() == "prlg"){
                $("#epsd_no").val("프롤로그");
                $("#epsd_name").val("프롤로그");
            }else if($(this).val() == "epsd"){
                $("#epsd_no").val($("#epsd_no").data("no"));
                $("#epsd_name").val($("#epsd_no").data("no")+"화");
            }else if($(this).val() == "end"){
                $("#epsd_no").val("완결");
                $("#epsd_name").val("완결");
            }
        });
        
        $(document).on("change", "#epsd_img", async function(e){
            let files = e.target.files;
    
           
            if(!files || files.length == 0){
                return;
            }
        
            await check_epsd_file(e)
            .then(function(result){
                if(result.status == "success"){
                    $("#epsd__img-preview").prop("src",result.data.url);
                    $("#epsd_tmp_img").val(JSON.stringify(result.data));
                    $(".file-epsd").addClass("edit");
                }else{
                   alert(result.msg);
                }
            });
            $("#epsd_img").val("");
        });
    
        $(document).on("change", "#epsd_copy", async function(e){
            let files = e.target.files;
    
            if(!files || files.length == 0){
                return;
            }

            let files_capacity = 0;
            for (let i = 0; i < files.length; i++) {
                files_capacity += files[i].size;
            }

            if(!epsd_upload_obj.check_epsd_copy_capacity(files_capacity)){
                alert("최대 용량을 초과했습니다.");
                $("#epsd_copy").val("");
                return;
            }
            if(!epsd_upload_obj.check_epsd_copy_count(files.length)){
                alert("최대 원고 갯수를 초과했습니다.");
                $("#epsd_copy").val("");
                return;
            }


            await check_epsd_copy_file(e)
            .then(function(result){
                if(result.status == "success"){
                    result.data.forEach(function(item){
                        let epsd_copy_item_html = "";
                        if(item.is_success){
                            epsd_copy_item_html += '<li class="upload-epsd__copy-item">';
                        }else{
                            epsd_copy_item_html += '<li class="upload-epsd__copy-item error">';
                        }
                        epsd_copy_item_html += '<span class="upload-epsd__copy-item-hamburger icon-hamburger icon-16"></span>';
                        if(item.is_success){
                            epsd_copy_item_html += '<span class="upload-epsd__copy-item-name text-truncate">'+item.orgn+'</span>';
                            epsd_copy_item_html += '<span class="upload-epsd__copy-item-size">'+item.size_text+'</span>';
                        }else{
                            epsd_copy_item_html += '<span class="upload-epsd__copy-item-name text-truncate">'+item.orgn+'</span>';
                            epsd_copy_item_html += '<span class="upload-epsd__copy-item-msg">'+item.msg+'</span>';
                        }
                        epsd_copy_item_html += '<button type="button" class="upload-epsd__copy-item-delete-button icon-button icon-button-16" data-size="'+item.size+'">';
                        epsd_copy_item_html += '<span class="icon-x icon-16"></span>';
                        epsd_copy_item_html += '</button>';
                        epsd_copy_item_html += '<input type="hidden" name="epsd_tmp_copy[]" value="'+escape_html(JSON.stringify(item))+'">';
                        epsd_copy_item_html += '</li>';
        
                        $(".upload-epsd__copy-list").append(epsd_copy_item_html);
                        epsd_upload_obj.change_epsd_copy_progress(item.size);
                    });
                }else{
                   alert(result.msg);
                }
            });
            $("#epsd_copy").val("");
        });
    
        $(document).on("click", ".upload-epsd__copy-item-delete-button", function(event){
            $(this).closest(".upload-epsd__copy-item").remove();
            epsd_upload_obj.change_epsd_copy_progress(-1* $(this).data("size"));
         });
    
        $(document).on("click", ".epsd-preview", function(){
            epsd_upload_obj.show_epsd_preview();
         });

         $(document).on("click", ".upload-epsd-save-button", function(){
            $("#action").val("save");
            $(".upload-epsd__form").submit();
         });

         $(document).on("submit", ".upload-epsd__form", function(){
          

            if($("#action").val() == "create"){
                if($("#epsd_display").val() == "0"){
                    if(!confirm("현재 작품은 비공개 상태입니다.\n비공개 상태일 경우 메인페이지에 노출되지않습니다.\n그래도 연재를 하시겠습니까?")){
                        return false;
                    }
                }
                epsd_upload_obj.create_epsd(this);
            }else if($("#action").val() == "update"){
                epsd_upload_obj.update_epsd(this);
            }else if($("#action").val() == "save"){
                epsd_upload_obj.save_epsd(this);
            }else if($("#action").val() == "delete"){
                epsd_upload_obj.delete_epsd(this);
            }else{
                alert("잘못된 요청입니다.");
                return false;
            }
            return false;
        });
    },

    check_epsd_copy_capacity: function(size){
        let max = Number($(".upload-epsd__copy-progress-bar").data("max"));
        let now = Number($(".upload-epsd__copy-progress-bar").data("now"));
        
        now = now + size;
        if(now > max){
            return false;
        }

        return true;
    },
    check_epsd_copy_count: function(length){
        if($(".upload-epsd__copy-item").length + length - 1 > Number($("#epsd_copy").data("max"))){
            return false;
        }

        return true;
    },

    change_epsd_copy_progress: function(size){
        let max = Number($(".upload-epsd__copy-progress-bar").data("max"));
        let now = Number($(".upload-epsd__copy-progress-bar").data("now"));
    
        now = now + size;
    
        $(".upload-epsd__copy-progress-bar").data("now",now);
        let width = Math.round((now / max) * 100);
        if(width > 100){
            width = "100%";
        }else{
            width += "%";
        }
        $(".upload-epsd__copy-progress-slider").css("width", width);
    
        $(".upload-epsd__copy-progress-size").text(display_byte_format(now));
        
        //용량 에러검사
        let has_error_copy_size = now > max;
        if(has_error_copy_size){
            $(".upload-epsd__copy-progress").addClass("error");
    
        }else{
            $(".upload-epsd__copy-progress").removeClass("error");
    
        }
    
        //원고 에러검사
        let has_error_copy = false;
        $(".upload-epsd__copy-item").each(function(){
            if($(this).hasClass("error")){
                has_error_copy = true;
                return;
            }
        });
    
        if(has_error_copy){
            $(".upload-epsd__copy-list-box").addClass("error");
            $(".upload-epsd__copy-list-box-text").text("업로드불가한 원고가 존재합니다.");
        }else{
            $(".upload-epsd__copy-list-box").removeClass("error");
            $(".upload-epsd__copy-list-box-text").text("");
        }
    
        $(".upload-epsd__copy-item").each(function(i, elmt){
            if($(elmt).find("#epsd_copyright").length > 0){
                $("#epsd_copyright").val(i);
            }
        });
    },

    show_epsd_preview: function(){

    },
    create_epsd: async function(f){
        $(".upload-epsd-submit-button").prop("disabled", true).addClass("disabled");
        await pave_async_ajax("/api/upload/"+f.epsd_cate.value+"/create", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                let msg_prefix = "";
                if(f.epsd_cate.value == "epsd"){
                    msg_prefix = "회차가";
                }else if(f.epsd_cate.value == "notice"){
                    msg_prefix = "공지가";
                }else if(f.epsd_cate.value == "rest"){
                    msg_prefix = "휴재가";
                }
                alert(msg_prefix+ " 등록되었습니다.");
                location.reload();
            }else{
                alert(result.msg);
                $(".upload-epsd-submit-button").prop("disabled", false).removeClass("disabled");
            }
        });
    },
    save_epsd: async function(f){
        $(".upload-epsd-submit-button").prop("disabled", true).addClass("disabled");
        await pave_async_ajax("/api/upload/"+f.epsd_cate.value+"/save", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                let msg_prefix = "";
                if(f.epsd_cate.value == "epsd"){
                    msg_prefix = "회차가";
                }else if(f.epsd_cate.value == "notice"){
                    msg_prefix = "공지가";
                }else if(f.epsd_cate.value == "rest"){
                    msg_prefix = "휴재가";
                }
                alert(msg_prefix+ " 임시저장되었습니다.");
                location.reload();
            }else{
                alert(result.msg);
                $(".upload-epsd-submit-button").prop("disabled", false).removeClass("disabled");
            }
        });
    },
    update_epsd: async function(f){
        $(".upload-epsd-submit-button").prop("disabled", true).addClass("disabled");
        await pave_async_ajax("/api/upload/"+f.epsd_cate.value+"/update", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                let msg_prefix = "";
                if(f.epsd_cate.value == "epsd"){
                    msg_prefix = "회차가";
                }else if(f.epsd_cate.value == "notice"){
                    msg_prefix = "공지가";
                }else if(f.epsd_cate.value == "rest"){
                    msg_prefix = "휴재가";
                }
                alert(msg_prefix+ " 수정되었습니다.");
                location.reload();
            }else{
                alert(result.msg);
                $(".upload-epsd-submit-button").prop("disabled", false).removeClass("disabled");
            }
        });
    },
    delete_epsd: async function(f){
        $(".upload-epsd-submit-button").prop("disabled", true).addClass("disabled");
        await pave_async_ajax("/api/upload/"+f.epsd_cate.value+"/delete", "POST", $(f))
        .then(function(result){
            if(result.status == "success"){
                let msg_prefix = "";
                if(f.epsd_cate.value == "epsd"){
                    msg_prefix = "회차가";
                }else if(f.epsd_cate.value == "notice"){
                    msg_prefix = "공지가";
                }else if(f.epsd_cate.value == "rest"){
                    msg_prefix = "휴재가";
                }
                alert(msg_prefix+ " 삭제되었습니다.");
                location.reload();
            }else{
                alert(result.msg);
                $(".upload-epsd-submit-button").prop("disabled", false).removeClass("disabled");
            }
        });
    },

}

$(function(){
    upload_obj.init();
    work_upload_obj.init();
    epsd_upload_obj.init();
})



