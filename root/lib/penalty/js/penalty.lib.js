$(document).ready(function(){
    $(document).on("click", ".penalty-button", function(e){
        e.stopPropagation();
        load_modal("penalty", "신고하기", JSON.stringify({target: $(this).data("target"), type: $(this).data("type")}), false);
    });
});
