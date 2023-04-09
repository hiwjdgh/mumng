<?php
if (!defined('_PAVE_')) exit;
?>
<section class="notify">
    <div class="notify__header">
        <div class="notify__header-container">
            <a href="javascript:history.back();" class="notify__header-close-button icon-button icon-button-24">
                <span class="icon-back icon-24"></span>
            </a>
            <h1 class="notify__header-title">활동</h1>

            <a href="<?=get_url(PAVE_SETTING_URL, "notify/home")?>" class="notify__header-action-button">
                <span class="icon-config icon-inactive icon-24"></span>
            </a>
        </div>
    </div>

    <div class="notify__content">
        <ul class="notify__list">
        </ul>
    </div>
</section>

<script>
$(document).ready(function(){
    get_notify_list($(".notify__list"));
    $(window).on("scroll", function(e){
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            get_notify_list($(".notify__list"));
        }

    });
});
</script>