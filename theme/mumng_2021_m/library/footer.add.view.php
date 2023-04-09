<?php
if (!defined('_PAVE_')) exit;
?>
    </div>
<script>

$(document).ready(function() {
    $(window).on("scroll", function(event){
        if($(window).scrollTop() > 0) {
            $(".library__header").addClass("scroll");
        }else{
            $(".library__header").removeClass("scroll");
        }
    });

    $(document).on("click", ".library__content-more-button, .library__content-epsd-more-button, .library__content-cmt-more-button", function(e){
        e.stopPropagation();
        let elmt = $(this);

        pave_ajax(
        "/api/library/help",
        {more_id: $(elmt).data("more"), type: $(elmt).data("type")},
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    $("#helper__more-box").html(result.data.html);
                    helper_show();
                }
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
        },
        function(error){
            alert(error);
        }
        );
    });

    $(document).on("click", "#library-subscribe-penalty-button", function(){
        //todo
    });
   
    $(document).on("click", "#library-subscribe-copy-button", function(){
        clipboard_url($(this).data("url"));
    });
});
</script>
</section>