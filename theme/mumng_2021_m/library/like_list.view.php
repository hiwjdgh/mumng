<?php
if (!defined('_PAVE_')) exit;
?>
<div class="library__content-header">
    <div class="library__content-cnt">
        <span class="library__content-cnt-text">좋아요한 회차</span>
        <span class="library__content-cnt-text2">0</span>
    </div>
    <button type="button" class="library__content-delete-button" style="display: none;">
        <span class="icon-delete icon-24 icon-inactive"></span>
    </button>
    <button type="button" class="library__content-cancel-button disabled" style="display: none;">
        <span class="icon-x icon-24"></span>
    </button>
    <button type="button" class="library__content-edit-button">편집</button>
</div>
<ul class="library__content-list">
    
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
            $(".library__content-cnt-text2").text(display_number(Number(result.data.list_cnt)));
            $(".library__content-cnt-text2").data("cnt", result.data.list_cnt);

            if(result.data.list.length < 1){
                library_obj.library_end = true;

                if(library_obj.page == 1){
                    $(".library__content-list").html(result.data.html);
                }
                return;
            }

            if(library_obj.page == 1){
                $(".library__content-list").html(result.data.html);
            }else{
                $(".library__content-list").append(result.data.html);
            }
            library_obj.page++;
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

    $(".library__content-edit-button").on("click", function(){
        $(".library__content-edit-button").hide();
        $(".library__content-delete-button").show();
        $(".library__content-cancel-button").show();
        $(".library__content-list").addClass("edit");

        //ui init
        $(".icon-check").removeClass("icon-active").addClass("icon-inactive");
        $(".icon-delete").removeClass("icon-active").addClass("icon-inactive");
    });

    $(".library__content-delete-button").on("click", function(){
        if($(this).find(".icon-delete").hasClass("icon-inactive")){
            alert("삭제할 좋아요한 회차를 선택해주세요.");
            return;
        }

        let epsd_id_list = new Array();
        $(".icon-check.icon-active").each(function(){
            like_obj.change_epsd_like($(this).closest(".library__content-item2-check-button"));
        });

        location.reload();
    });

    $(document).on("click", ".library__content-item2-check-button", function(e){
        e.stopPropagation();
        if($(this).find(".icon-check").hasClass("icon-inactive")){
            $(this).find(".icon-check").removeClass("icon-inactive").addClass("icon-active");
        }else{
            $(this).find(".icon-check").removeClass("icon-active").addClass("icon-inactive");
        }

        if($(".icon-check.icon-active").length > 0){
            $(".library__content-delete-button").find(".icon-delete").removeClass("icon-inactive").addClass("icon-active");
        }else{
            $(".library__content-delete-button").find(".icon-delete").removeClass("icon-active").addClass("icon-inactive");
        }
    });

    $(".library__content-cancel-button").on("click", function(){
        $(".library__content-edit-button").show();
        $(".library__content-delete-button").hide();
        $(".library__content-cancel-button").hide();
        $(".library__content-list").removeClass("edit");
    });
})
</script>