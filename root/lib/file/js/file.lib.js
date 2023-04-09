$(function(){
    $(document).on("change", ".file-upload", async function(e){
        if($(this).hasClass("sight-file")){
            check_sight_file(e);
        }else if($(this).hasClass("profile-file")){
            check_profile_file(e);
        }
    });
})



async function check_profile_file(e){
    let files = e.target.files;
    let f = new FormData();
    for (let i = 0; i < files.length; i++) {
        f.append("file[]", files[i]);
    }
    let result = await pave_async_ajax("/api/file/user_img", "POST", f);

    $(e.target).val("");
    if(result.status == "success"){
        modals.load("user_img", "프로필 이미지 수정", JSON.stringify( result.data));

    }else{
       alert(result.msg);
    }
}

async function check_sight_file(e){
/*     let files = e.target.files;
    let f = new FormData();
    for (let i = 0; i < files.length; i++) {
        f.append("file[]", files[i]);
    }
    let result = await pave_async_ajax("/api/file/sight_img", "POST", f);

    if(result.status == "success"){
        $(".file-sight__img").prop("src",result.data.url);
        $("#sight_tmp_img").val(JSON.stringify(result.data));
        $(".file-sight__img").show();
        $("#sight_img").val("");
    }else{
        $(e.target).val("");
       alert(result.msg);
    } */

    let files = e.target.files;
    let f = new FormData();
    for (let i = 0; i < files.length; i++) {
        f.append("file[]", files[i]);
    }
    return pave_async_ajax("/api/file/sight_img", "POST", f);
}

async function check_work_file(e){
    let files = e.target.files;
    let f = new FormData();
    for (let i = 0; i < files.length; i++) {
        f.append("file[]", files[i]);
    }
    return pave_async_ajax("/api/file/work_img", "POST", f);
}

async function check_epsd_file(e){
    let files = e.target.files;
    let f = new FormData();
    for (let i = 0; i < files.length; i++) {
        f.append("file[]", files[i]);
    }
    return pave_async_ajax("/api/file/epsd_img", "POST", f);
}


function check_epsd_copy_file(e){
    let files = e.target.files;
    let f = new FormData();
    for (let i = 0; i < files.length; i++) {
        f.append("file[]", files[i]);
    }
    return pave_async_ajax("/api/file/epsd_copy", "POST", f);
}