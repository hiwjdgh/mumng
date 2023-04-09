const follow_obj = {
    follow_request: false,
    load_obj : null,
    init: function(){
        follow_obj.load_obj = {
            type : "",
            user_no: "",
            keyword : "",
            search : true,
            page : 1,
            end : false,
        };
        follow_obj.add_event();
    },
    add_event : function(){
        $(document).on("click", ".follow-button", function(e){
            follow_obj.change_follow($(this));
        });
    
        $(document).on("click", ".follower-button", function(e){
            e.stopPropagation();
            follow_obj.load_obj = {
                type : "follower",
                user_no: $(this).data("user"),
                keyword : "",
                search : true,
                page : 1,
                end : false,
            };
            modals.load("user_follow", "팔로워", JSON.stringify({user_no: $(this).data("user"), type: "follower"}));
        });

        $(document).on("click", ".following-button", function(e){
            e.stopPropagation();
            follow_obj.load_obj = {
                type : "following",
                user_no: $(this).data("user"),
                keyword : "",
                search : true,
                page : 1,
                end : false,
            };
            modals.load("user_follow", "팔로잉", JSON.stringify({user_no: $(this).data("user"), type: "following"}));
        });

        $(document).on("scroll", ".user_follow__list", function(){
            follow_obj.get_user_follow_list();
        });
    
        $(document).on("click", "#follow_search_button", function(e){
            follow_obj.load_obj.keyword = $("#follow_keyword").val();
            follow_obj.load_obj.page = 1;
            follow_obj.load_obj.end = false;
            follow_obj.get_user_follow_list();
        });
    },

    change_follow: function(elmt){
        pave_async_ajax("/api/follow/change", "POST", {user_no: $(elmt).data("user")})
        .then(function(result){
            if(result.status == "success"){
                if($(elmt).hasClass("button-t1")){
                    $(elmt).removeClass("button-t1").addClass("button-t3");
                    $(elmt).text("팔로우 취소")
                }else{
                    $(elmt).removeClass("button-t3").addClass("button-t1");
                    $(elmt).text("팔로우")
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

    get_user_follow_list: function(){
        if(follow_obj.follow_request){
            return;
        }

        if(follow_obj.load_obj.end){
            return;
        }
        follow_obj.follow_request = true;
        
        pave_async_ajax("/api/follow/"+ follow_obj.load_obj.type, "POST", follow_obj.load_obj)
        .then(function(result){
            follow_obj.follow_request = false;

            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    $(".user_follow__title-text2").text(display_number(result.data.list_cnt));
                    if(result.data == null || result.data.list.length < 1){
                        follow_obj.load_obj.end = true;
                        if(follow_obj.load_obj.page == "1"){
                            $(".user_follow__list").html(result.data.html);
                        }
                        return;
                    }

                    if(follow_obj.load_obj.page == "1"){
                        $(".user_follow__list").html(result.data.html);
                    }else{
                        $(".user_follow__list").append(result.data.html);
                    }
                    follow_obj.load_obj.page++;
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
}

$(function(){
    follow_obj.init();
})