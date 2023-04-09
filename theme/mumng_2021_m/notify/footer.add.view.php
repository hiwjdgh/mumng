<?php
if (!defined('_PAVE_')) exit;
?>
        </ul>
    </div>
</section>

<script>
$(document).ready(function(){
    load_user_notify_list($(".notify__list"));
    $(window).on("scroll", function(e){
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            load_user_notify_list($(".notify__list"));
        }

    });
});
</script>