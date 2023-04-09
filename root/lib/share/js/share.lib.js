const share_obj = {
    init: function(){
      
        share_obj.add_event();
    },
    add_event : function(){
        $(document).on("click", ".clipboard-button", function(e){
            share_obj.clipboard($(this).data("url"));
        });

        $(document).on("click", ".share-button", function(){
            navigator
            .share({
                title: document.title,
                url: window.location.href
            })
            .then(() => console.log('Successful share! 🎉'))
            .catch(err => console.error(err));
        });
    
    },

    clipboard : function(url){
        let text    = url ? url : location.href;

        navigator.clipboard.writeText(text).then(function() {
            alert("링크를 클립보드에 복사했습니다"); 
        });
    }
}

$(function(){
    share_obj.init();
})