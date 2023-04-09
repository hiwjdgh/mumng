<?php
if (!defined('_PAVE_')) exit;
?>
</section>
<script>
function delete_form_check(f){
    let temp_value = $("input[name='adm_check[]']:checked").map(function(){ return $(this).val();}).get();
    
    $(f.temp).val(temp_value);
    return true;
}
$(document).ready(function() {    
    /* 글로벌 네비게이션 */
    $(".adm-header__gnb-button").on("click", function(){
        $(".adm-header__gnb-item").removeClass("current");
        $(this).closest(".adm-header__gnb-item").addClass("current");
    })
    
    $(".adm-header__collapse-button").on("click", function(){
        $(this).toggleClass("open")
        if($(this).hasClass("open")){
            $(this).find(".icon").removeClass("icon-right").addClass("icon-left");
        }else{
            $(this).find(".icon").removeClass("icon-left").addClass("icon-right");
        }

        $(".adm-header").toggleClass("open")
    })


    /* 폼 탭 */
    $(".adm-content__tab-button").on("click", function(){
        $(".adm-content__tab-content").hide();
        $(".adm-content__tab-content[data-anchor='"+$(this).data("anchor")+"']").show();

        $(".adm-content__tab-button").removeClass("current");
        $(this).addClass("current");
    })

    $(".adm-content__tab-content").hide();
    $(".adm-content__tab-content").eq(0).show();
    $(".adm-content__tab-button").eq(0).addClass("current");

    /* 글로벌 체크박스 */
    $("#adm_check_all").on("change", function(){
        $("input[name='adm_check[]']").prop("checked", $(this).prop("checked"));
    })

    $("input[name='adm_check[]']").on("change", function(){
        let checked = true;
        $("input[name='adm_check[]']").each(function(){
            if(!$(this).prop("checked")){
                checked = false;
                return false;
            }
        })

        $("#adm_check_all").prop("checked", checked);
    })
})
</script>