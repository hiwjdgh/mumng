const like_obj = {
    init: function(){
        like_obj.add_event();
    },
    add_event: function(){
        $(document).on("click", ".epsd-like-button", function(e){
            like_obj.change_epsd_like($(this));
        });

        $(document).on("click", ".comment-like-button", function(e){
            like_obj.change_epsd_comment_like($(this));
        });
    },
    change_epsd_like: async function(elmt){
        return await pave_async_ajax("/api/like/epsd", "POST", {epsd_id: $(elmt).data("epsd")})
        .then(function(result){
            if(result.status == "success"){
                if($(elmt).find(".icon-like").hasClass("icon-like--inactive")){
                    $(elmt).find(".icon-like").removeClass("icon-like--inactive").addClass("icon-like--active");
                }else{
                    $(elmt).find(".icon-like").removeClass("icon-like--active").addClass("icon-like--inactive");
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
        });
    },
    change_epsd_comment_like: async function(elmt){
        return await pave_async_ajax("/api/like/comment", "POST", {comment_no: $(elmt).data("comment")})
        .then(function(result){
            if(result.status == "success"){
                if($(elmt).find(".icon-like").hasClass("icon-like--inactive")){
                    $(elmt).find(".icon-like").removeClass("icon-like--inactive").addClass("icon-like--active");
                }else{
                    $(elmt).find(".icon-like").removeClass("icon-like--active").addClass("icon-like--inactive");
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
        });
    }
};
$(function () {
    like_obj.init();
});