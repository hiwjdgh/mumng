<?php
if (!defined('_PAVE_')) exit;
?>
<div class="library__content-header" style="margin-top: 46px;">
    <div class="library__content-cnt">
        <span class="library__content-cnt-text">
            <?php 
                if($request[2] == "all"){
                    echo "내가 쓴 의견";
                }else if($request[2] == "best"){
                    echo "내 BEST 의견";
                }
            ?> 
        </span>
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
    cmt_type: "<?=$request[2]?>",
    library_end : false,
    library_request : false,
}
async function get_cmt_list(){
    if(library_obj.library_end == true){
        return;
    }

    if(library_obj.library_request == true){
        return;
    }

    library_obj.library_request = true;

    await pave_async_ajax("/api/library/comment/list", "GET", library_obj)
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
    get_cmt_list();
    $(window).on("scroll", function(e){
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            get_cmt_list();
        }
    });

    $(document).on("click", ".library__content-del-button", async function(){
        let elmt = $(this);

        await pave_async_ajax("/api/work2/comment/delete", "POST", {work_id: $(elmt).data("id"), epsd_id: $(elmt).data("epsd"), comment_no: $(elmt).data("comment")})
        .then(function(result){
            if(result.status == "success"){
                $(elmt).closest("li").remove();
                if($(".library__content-cmt-item").length == 0){
                    location.reload();
                }
                
            }else{
                alert(result.msg);
            }
        });
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

    $(".library__content-delete-button").on("click",async function(){
        if($(this).find(".icon-delete").hasClass("icon-inactive")){
            alert("삭제할 의견을 선택해주세요.");
            return;
        }

        $(".icon-check.icon-active").each(async function(){
            let elmt = $(this).closest(".library__content-item3-check-button");
            await pave_async_ajax("/api/work2/comment/delete", "POST", {work_id: $(elmt).data("id"), epsd_id: $(elmt).data("epsd"), comment_no: $(elmt).data("comment")})
        });

        location.reload();
    });

    $(".library__content-cancel-button").on("click", function(){
        $(".library__content-edit-button").show();
        $(".library__content-delete-button").hide();
        $(".library__content-cancel-button").hide();
        $(".library__content-list").removeClass("edit");
    });

    $(document).on("click", ".library__content-item3-check-button", function(e){
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

});
</script>