<?php
if (!defined('_PAVE_')) exit;
?>
<div id="library__content-header">
    <h3 id="library__content-title">좋아요</h3>
    <div id="library__content-more">
        <div id="library__content-cnt-box">
            <span id="library__content-cnt-text">좋아요한 회차</span>
            <span id="library__content-cnt">0</span>
        </div>
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
async function get_like_list(){
    if(library_obj.library_end == true){
        return;
    }

    if(library_obj.library_request == true){
        return;
    }

    library_obj.library_request = true;

    await pave_async_ajax("/api/library/like/list", "GET", library_obj)
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
    get_like_list();
    $(window).on("scroll", function(e){
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            get_like_list();
        }
    });


    $(document).on("click", ".library__content-like-button", async function(e){
        e.stopPropagation();

        let elmt = $(this);
        like_obj.change_epsd_like(elmt)
        .then(function(){
            elmt.closest("li").remove();

            if($(".library__content-epsd-item").length == 0){
                    location.reload();
            }
        });
    });
});

</script>