<?php
if (!defined('_PAVE_')) exit;
?>
    </div>
</section>
<script>
    $(function(){
        $(".data-table__body-row").on("click", function(){
            if($(this).data("href") !== undefined){
                location.href = $(this).data("href");
            }
        });
    })
</script>