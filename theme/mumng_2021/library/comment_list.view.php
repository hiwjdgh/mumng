<?php
if (!defined('_PAVE_')) exit;
?>

<div id="library__content-header">
    <h3 id="library__content-title">의견</h3>
    <div id="library__content-tab">
        <a href="<?=get_url(PAVE_LIBRARY_URL, "comment/all")?>" class="library__content-tab-link <?=$request[2] == "all" ? "current" : "" ?>">내 의견</a>
        <a href="<?=get_url(PAVE_LIBRARY_URL, "comment/best")?>" class="library__content-tab-link <?=$request[2] == "best" ? "current" : "" ?>">내 BEST 의견</a>
    </div>
    <div id="library__content-more">
        <div id="library__content-cnt-box">
            <span id="library__content-cnt-text">내가 쓴 의견</span>
            <span id="library__content-cnt">0</span>
        </div>
        <button type="button" id="library__content-edit-button">편집</button>
    </div>
</div>

<ul id="library__content-list">
    
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

});

</script>