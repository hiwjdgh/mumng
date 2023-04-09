<?php
if (!defined('_PAVE_')) exit;
?>
<div class="search__content">
    <div class="search__content-header">
        <h3 class="search__content-header-title"><?=$request[2]?:"추천"?></h3>
        <span class="search__content-header-cnt">0개의 작품</span>
    </div>
    <div class="search__content-list-box">
        <ul class="search__work-list">
        </ul>
    </div>
</div>
<script>
$(function(){
    get_search_list($(".search__work-list"));
    $(window).on("scroll", function(e){
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            get_search_list($(".search__work-list"));
        }
    });
});
</script>