<?php
if (!defined('_PAVE_')) exit;
?>
<div id="library__content-header">
    <h3 id="library__content-title">구독</h3>
    <div id="library__content-more">
        <div id="library__content-cnt-box">
            <span id="library__content-cnt-text">구독한 작품</span>
            <span id="library__content-cnt">0</span>
        </div>
        <button type="button" id="library__content-edit-button" class="text-button medium normal g10">편집</button>
    </div>
</div>
<ul id="library__content-list">
    
</ul>
<script>
let library_obj = {
    page : 1,
    library_end : false,
    library_request : false,
}
async function get_subscribe_list(){
    if(library_obj.library_end == true){
        return;
    }

    if(library_obj.library_request == true){
        return;
    }

    library_obj.library_request = true;

    await pave_async_ajax("/api/library/subscribe/list", "GET", library_obj)
    .then(function(result){
        library_obj.library_request = false;

        if(result.status == "success"){
            $("#library__content-cnt").text(display_number(Number(result.data.list_cnt)));
            $("#library__content-cnt").data("cnt", result.data.list_cnt);

            if(result.data.list.length < 1){
                library_obj.library_end = true;

                if(library_obj.page == 1){
                    $("#library__content-list").html(result.data.html);
                    $("#library__content-edit-button").hide();
                }
                return;
            }

            if(library_obj.page == 1){
                $("#library__content-list").html(result.data.html);
            }else{
                $("#library__content-list").append(result.data.html);
            }
            library_obj.page++;
            $("#library__content-edit-button").show();
            
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

$(function(){
    get_subscribe_list();
    $(window).on("scroll", async function(e){
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            get_subscribe_list();
        }
    });

    $(document).on("click", ".library__content-notify-button", function(e){
        e.stopPropagation();
        subscribe_obj.change_subscribe_notify($(this));
    });

    $(document).on("click", ".library__content-del-button", function(e){
        e.stopPropagation();
        let elmt = $(this);
        subscribe_obj.change_work_subscribe(elmt)
        .then(function(){
            elmt.closest(".library__content-item").remove();

            if($(".library__content-item").length == 0){
                    location.reload();
            }
        });
    });
})
</script>