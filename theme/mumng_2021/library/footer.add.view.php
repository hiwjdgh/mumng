<?php
if (!defined('_PAVE_')) exit;
?>
    </div>
<script>
$(document).ready(function() {
    $("#library__content-edit-button").on("click", function(){
        if($("#library__content-list").hasClass("edit")){
            $("#library__content-edit-button").text("편집");
        }else{
            $("#library__content-edit-button").text("취소");
        }
        $("#library__content-list").toggleClass("edit");
    });
});
</script>
</section>