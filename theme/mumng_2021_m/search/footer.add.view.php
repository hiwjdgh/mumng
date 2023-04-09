<?php
if (!defined('_PAVE_')) exit;
?>
</section>
<script>
let search_obj = {
    page : 1,
    search_type : "<?=$request[1]?>",
    search_keyword : "<?=$request[2]?>",
    search_end : false,
    search_request : false,
}
async function get_search_list(elmt){
    if(search_obj.search_end == true){
        return;
    }

    if(search_obj.search_request == true){
        return;
    }

    search_obj.search_request = true;

    await pave_async_ajax("/api/search/list", "GET", search_obj)
    .then(function(result){
        search_obj.search_request = false;
        if(result.status == "success"){
            if(result.data.list.length < 1){
                search_obj.search_end = true;

                if(search_obj.page == 1){
                    elmt.html(result.data.html);
                }
                return;
            }

            if(search_obj.page == 1){
                let count_text = $(".search__content-header-cnt").text();
                $(".search__content-header-cnt").text(count_text.replace(/[0-9]/g, display_number(result.data.list_cnt)));
                elmt.html(result.data.html);
            }else{
                elmt.append(result.data.html);
            }
            search_obj.page++;
            
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
    $(".search__form-submit").on("click", function(){
        $(".search__form").prop("action", "/search/" + $("#search_type").val()+ "/" + $("#search_keyword").val());
        $(".search__form").submit();
    });

});
</script>