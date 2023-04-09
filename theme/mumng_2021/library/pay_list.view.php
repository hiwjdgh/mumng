<?php
if (!defined('_PAVE_')) exit;
?>
<div id="library__content-header">
    <h3 id="library__content-title">구매</h3>
    <div id="library__content-tab">
        <a href="<?=get_url(PAVE_LIBRARY_URL,"pay/rent")?>" class="library__content-tab-link <?=$request[2] == "rent" ? "current" : "" ?>">회차대여</a>
        <a href="<?=get_url(PAVE_LIBRARY_URL,"pay/keep")?>" class="library__content-tab-link <?=$request[2] == "keep" ? "current" : "" ?>">회차소장</a>
        <a href="<?=get_url(PAVE_LIBRARY_URL,"pay/end")?>" class="library__content-tab-link <?=$request[2] == "end" ? "current" : "" ?>">완결소장</a>
    </div>
    <div id="library__content-more">
        <div id="library__content-cnt-box">
            <span id="library__content-cnt-text">대여한 회차</span>
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
    pay_type : "<?=$request[2]?>",
    library_end : false,
    library_request : false,
}
async function get_pay_list(){
    if(library_obj.library_end == true){
        return;
    }

    if(library_obj.library_request == true){
        return;
    }

    library_obj.library_request = true;

    await pave_async_ajax("/api/library/pay/list", "GET", library_obj)
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
    get_pay_list();
    $(window).on("scroll", async function(e){
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            get_pay_list();
        }
    });

    $(document).on("click", ".library__content-del-button", async function(e){
        e.stopPropagation();
        let elmt = $(this);

        pay_obj.delete_pay($(this))
        .then(function(){
            elmt.closest(".library__content-item").remove();

            if($(".library__content-item").length == 0){
                    location.reload();
            }
        });
      
    });
})
</script>