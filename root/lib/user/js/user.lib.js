async function check_login_form(f){
    pave_async_ajax("/api/account/login", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            location.href = result.redirect_url;
        }else{
            alert(result.msg);
        }
    });
    
    return false;
}

async function check_reg_form(f){
    pave_async_ajax("/api/account/reg", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            location.href = result.redirect_url;
        }else{
            alert(result.msg);
        }
    });
    
    return false;
}

async function check_reg2_form(f){
    pave_async_ajax("/api/account/reg2", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            location.href = result.redirect_url;
        }else{
            alert(result.msg);
        }
    });
    
    return false;
}

async function check_find_id_form(f){
    pave_async_ajax("/api/account/find/id", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            location.href = result.redirect_url;
        }else{
            alert(result.msg);
            location.href = result.redirect_url;
        }
    });
    
    return false;
}


async function check_new_pwd_form(f){
    pave_async_ajax("/api/account/new_pwd", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            alert(result.msg);
            location.href = result.redirect_url;
        }else{
            alert(result.msg);

            if(result.redirect_url){
                location.href = result.redirect_url;
            }
        }
    });
    
    return false;
}


async function check_find_pwd_form(f){
    pave_async_ajax("/api/account/find/pwd", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            location.href = result.redirect_url;
        }else{
            alert(result.msg);
            if(result.redirect_url){
                location.href = result.redirect_url;
            }
        }
    });
    
    return false;
}

async function check_profile_form(f){
    pave_async_ajax("/api/user/profile", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            location.reload();
        }else{
            alert(result.msg);
            if(result.redirect_url){
                location.href = result.redirect_url;
            }
        }
    });
    
    return false;
}

async function check_privacy_form(f){
    pave_async_ajax("/api/user/privacy", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            location.reload();
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
    
    return false;
}

async function check_cert_form(f){
    pave_async_ajax("/api/user/cert", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            location.href = result.redirect_url;
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
    
    return false;
}


async function check_pwd_form(f){
    pave_async_ajax("/api/user/pwd", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            if(result.msg){
                alert(result.msg)
            }
            location.href = result.redirect_url;
        }else{
            if(result.msg){
                alert(result.msg);
            }
            if(result.redirect_url){
                location.href = result.redirect_url;
            }
        }
    });
    
    return false;
}

async function check_commerce_calc_form(f){
    await pave_async_ajax("/api/commerce/calc", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            if(result.msg){
                alert("정산신청이 완료되었습니다.");
            }
            location.href = result.redirect_url;
        }else{
            if(result.msg){
                alert(result.msg);
            }
            if(result.redirect_url){
                location.href = result.redirect_url;
            }
        }
    });
    
    return false;
}

async function check_user_id(user_id, is_dup_check){
    return await pave_async_ajax("/api/account/check/user_id", "POST", {"user_id" : user_id, "is_dup_check" : is_dup_check ? 1 : 0});
}

async function check_user_pwd(user_pwd){
    return await pave_async_ajax("/api/account/check/user_pwd", "POST", {"user_pwd" : user_pwd});
}

async function check_user_pwd_re(user_pwd, user_pwd_re){
    return await pave_async_ajax("/api/account/check/user_pwd_re", "POST", {"user_pwd" : user_pwd, "user_pwd_re" : user_pwd_re});
}

async function check_user_nick(user_nick, is_required, user_id, is_dup_check){
    return await pave_async_ajax("/api/account/check/user_nick", "POST", {"user_nick" : user_nick, "is_required" : is_required ? 1 : 0,  user_id : user_id,"is_dup_check" : is_dup_check ? 1 : 0});
}

async function check_user_email(user_email, is_required, user_id, is_dup_check){
    return await pave_async_ajax("/api/account/check/user_email", "POST", {"user_email" : user_email, "is_required" : is_required ? 1 : 0,  user_id : user_id,"is_dup_check" : is_dup_check ? 1 : 0});
}

async function check_user_cp(user_cp, is_required, user_id, is_dup_check){
    return await pave_async_ajax("/api/account/check/user_cp", "POST", {"user_cp" : user_cp, "is_required" : is_required ? 1 : 0,  user_id : user_id,"is_dup_check" : is_dup_check ? 1 : 0});
}

async function check_user_tel(user_tel, is_required, user_id, is_dup_check){
    return await pave_async_ajax("/api/account/check/user_tel", "POST", {"user_tel" : user_tel, "is_required" : is_required ? 1 : 0,  user_id : user_id,"is_dup_check" : is_dup_check ? 1 : 0});
}

async function check_user_name(user_name, is_required){
    return await pave_async_ajax("/api/account/check/user_name", "POST", {"user_name" : user_name, "is_required" : is_required ? 1 : 0});
}

async function check_user_birthdate(user_birthdate, is_required){
    return await pave_async_ajax("/api/account/check/user_birthdate", "POST", {"user_birthdate" : user_birthdate, "is_required" : is_required ? 1 : 0});
}

async function check_user_introduce(user_introduce, is_required){
    return await pave_async_ajax("/api/account/check/user_introduce", "POST", {"user_introduce" : user_introduce, "is_required" : is_required ? 1 : 0});
}

async function check_user_rel(user_rel, is_required){
    return await pave_async_ajax("/api/account/check/user_rel", "POST", {"user_rel" : user_rel, "is_required" : is_required ? 1 : 0});
}

async function check_user_rel_cp(user_rel_cp, is_required, user_id, is_dup_check){
    return await pave_async_ajax("/api/account/check/user_rel_cp", "POST", {"user_rel_cp" : user_rel_cp, "is_required" : is_required ? 1 : 0,  user_id : user_id,"is_dup_check" : is_dup_check ? 1 : 0});
}

async function check_user_sex(user_sex, is_required){
    return await pave_async_ajax("/api/account/check/user_sex", "POST", {"user_sex" : user_sex, "is_required" : is_required ? 1 : 0});
}

async function check_user_share(user_share, is_required, user_id, is_dup_check){
    return await pave_async_ajax("/api/account/check/user_share", "POST", {"user_share" : user_share, "is_required" : is_required ? 1 : 0,  user_id : user_id,"is_dup_check" : is_dup_check ? 1 : 0});
}

async function check_user_term_agree(user_term_agree, is_required){
    return await pave_async_ajax("/api/account/check/user_term_agree", "POST", {"user_term_agree" : user_term_agree, "is_required" : is_required ? 1 : 0});
}

async function check_user_info_agree(user_info_agree, is_required){
    return await pave_async_ajax("/api/account/check/user_info_agree", "POST", {"user_info_agree" : user_info_agree, "is_required" : is_required ? 1 : 0});
}

async function check_user_event_agree(user_event_agree, is_required){
    return await pave_async_ajax("/api/account/check/user_event_agree", "POST", {"user_event_agree" : user_event_agree, "is_required" : is_required ? 1 : 0});
}

async function change_user_notify(key, value){
    await pave_async_ajax("/api/user/notify_change", "POST", {"key" : key, "value" : value})
    .then(function(result){
        if(result.status == "success"){
            alert("알림상태가 변경되었습니다.");
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

async function change_user_share(f){
    await pave_async_ajax("/api/user/share_change", "POST", $(f))
    .then(function(result){
        if(result.status == "success"){
            alert("공유 URL이 수정되었습니다.");
            location.reload();
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

async function change_user_adult(key, value){
    await pave_async_ajax("/api/user/content_change", "POST", {"key" : key, "value" : value})
    .then(function(result){
        if(result.status == "success"){
            if(value == "1"){
                alert("무명 성인컨텐츠가 차단되었습니다.");
            }else{
                alert("무명 성인컨텐츠가 노출됩니다.");
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


$(function(){
    //로그인
    $("#login__form").on("submit", async function(e){
        e.preventDefault();
        await check_login_form($(this));

        return false;
    });

    //로그아웃
    $(".logout-button").on("click", async function(){
        let result = await pave_async_ajax("/api/account/logout", "POST", {});

        if(result.status == "success"){
            location.href = result.redirect_url;
        }
    });

    //알림 상태 변경
    $(".notify-change-button").on("click", function(){
        change_user_notify($(this).prop("name"), $(this).is(":checked") ? "1" : "0");
    });

    //성인물 차단 상태 변경
    $(".content-change-button").on("click", function(){
        change_user_adult($(this).prop("name"), $(this).is(":checked") ? "1" : "0");
    });

    //커머스 정산신청
    $(".commerce_calc_button").on("click", function(){
        modals.load("commerce_calc", "정산신청", JSON.stringify({}));
    });

    //공유 URL 변경
    $(".url-change-button").on("click", function(){
        modals.load("user_share", "URL 설정", {});
     });

    $(document).on("submit", ".user-form", function(){
        if($(this).hasClass("commerce_calc__form")){
            check_commerce_calc_form(this);
        }else if($(this).hasClass("user_share__form")){
            change_user_share(this);
        }

        return false;
    });
});