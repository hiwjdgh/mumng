<?php
if (!defined('_PAVE_')) exit;
?>
<div id="profile">
    <h2 id="profile__title">프로필 설정</h2>
    <form id="profile__form" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">

        <fieldset class="flex flex-column">
            <legend class="skip">프로필 설정</legend>

            <div class="flex flex-column mxw-480 mgb-24 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal mgb-12">프로필이미지</h3>
                
                <div class="file-profile edit">
                    <label for="user_img" class="file-profile__box">
                        <input type="file" name="user_img" id="user_img" class="file-upload profile-file file-profile__input" accept="<?=$user_img_config["file_ext"]?>">
                        <input type="hidden" name="user_tmp_img" id="user_tmp_img" value="">
                        <input type="hidden" name="user_img_data" id="user_img_data" value="">

                        <span class="file-profile__box-icon icon-plus icon-24"></span>
                        <span class="file-profile__box-text">프로필 등록</span>
                    </label>
                 
                    <img src="<?=$pave_user["user_img"]?>" alt="프로필 이미지" id="user__img-preview" class="file-profile__img">

                    <button type="button" class="helper__button file-profile__edit-button" data-anchor="profile_more">
                        <span class="icon-edit icon-20"></span>
                    </button>
               
                    <div class="helper" data-target="profile_more">
                        <div class="helper__container">
                            <div id="helper__more-box" class="helper__action-box">
                                <button type="button" id="user__img-update-button" class="helper__action-button">수정</button>
                                <button type="button" id="user__img-default-button" class="helper__action-button">기본 이미지로 변경</button>
                            </div>
                            <div class="helper__close-box">
                                <button type="button" class="helper__close-button" data-anchor="profile_more">취소</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    
            <div class="flex flex-column mxw-480">
                <h3 class="text-weight-medium text-color-g10 text-size-normal mgb-12">필명</h3>
                <div class="input-box input-box-t4">
                    <input type="text" name="user_nick" id="user_nick" class="input-box-t4__input" value="<?=$pave_user["user_nick"]?>" title="필명" minlength="<?=$user_config["user_nick_min_len"]?>" maxlength="<?=$user_config["user_nick_max_len"]?>" spellcheck="false" required>
                    <p id="user_nick_msg" class="input-box-t4__msg"></p>
                </div>
            </div>
    
            <div class="flex flex-column mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal mgb-12">소개</h3>
                <div class="textarea-box">
                    <textarea name="user_introduce" id="user_introduce" class="textarea-box__textarea" placeholder="소개를 입력해주세요." spellcheck="false" maxlength="<?=$user_config["user_introduce_max_len"]?>"><?=$pave_user["user_introduce"]?></textarea>
                    <div class="textarea-box__counter">
                        <span class="textarea-box__counter-now">0</span>
                        <span class="textarea-box__counter-max">/ <?=$user_config["user_introduce_max_len"]?>자</span>
                    </div>
                </div>
            </div>
    
    
            <div class="flex flex-column mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal mgb-12">관심분야</h3>
                <div class="flex flex-wrap gap-8">
                    <?php foreach ((array)$pave_user["user_field_list"] as $i => $field) { ?>
                    <div class="chip-box">
                        <span class="chip-box__label"><?=$field?></span>
                        <input type="hidden" name="user_field[]" class="chip-box__input" value="<?=$field?>">
                        <button class="user_field_del-button chip-box__action icon-button icon-button-16">
                            <span class="icon-x icon-16"></span>
                        </button>
                    </div>
                    <?php } ?>
                    <button type="button" id="user_field_add-button" class="icon-button icon-button-32 icon-button-circle">
                        <span class="icon icon-plus icon-20"></span><span class="skip">추가</span>
                    </button>
                </div>
            </div>
    
            <div class="flex flex-column mxw-480 mgb-24">
                <div class="flex flex-align-item-center mgb-12">
                    <h3 class="text-weight-medium text-color-g10 text-size-normal mgr-6">관심장르</h3>
                    <span class="profile__genre-counter text-weight-medium text-color-g7 text-size-normal" data-max="<?=$user_config["user_genre_max_cnt"]?>"><?=count($pave_user["user_genre_list"])?>/<?=$user_config["user_genre_max_cnt"]?></span>
                </div>
                <div class="flex flex-wrap gap-row-12 gap-column-14">
                    <?php foreach ($user_config["user_genre_list"] as $i => $genre) { ?>
                    <label for="genre_<?=$i?>" class="chip-check-box <?=get_checked($genre, $pave_user["user_genre_list"])?>">
                        <input type="checkbox" name="user_genre[]" id="genre_<?=$i?>" class="chip-check-box__check" value="<?=$genre?>" <?=get_checked($genre, $pave_user["user_genre_list"])?>>
                        <span class="chip-check-box__label"><?=$genre?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>
    
            <div class="flex flex-column mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal mgb-12">대표작품</h3>
                <button type="button" id="user__major-add-button">
                    <?php if($pave_user["user_major"]){ ?>
                    <div id="user__major-box">
                        <input type="hidden" name="user_major" id="user_major" value="<?=$pave_user["user_major"]["work_id"]?>">
                        <img src="<?=$pave_user["user_major"]["work_img"]?>" alt="대표작품 이미지" width="90" height="112" id="user__major-img">
                        <div id="user__major-info">
                            <span id="user__major-epsd">총 <?=Converter::display_number($pave_user["user_major"]["work_epsd_cnt"], "화") ?></span>
                            <span id="user__major-name" class="text-truncate"><?=$pave_user["user_major"]["work_name"]?></span>
                            <p id="user__major-description" class="text-truncate-line3"><?=$pave_user["user_major"]["work_description"]?></p>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div id="user__major-add-box">
                        <span id="user__major-add-icon" class="icon-plus icon-24"></span>
                        <span id="user__major-add-text">대표작품 등록</span>
                    </div>
                    <?php } ?>
                </button>
            </div>
            
            <div class="flex flex-column mgb-60">
                <h3 class="text-weight-medium text-color-g10 text-size-normal mgb-12">SNS계정 링크</h3>
                <ul id="user__sns-list" class="flex flex-column gap-row-8 pd-8 bd-1-solid-g4 bdrd-20">
                    <?php foreach ((array)$pave_user["user_sns"] as $i => $sns) { ?>
                    <li class="user__sns-item">
                        <span class="user__sns-hamburger icon-hamburger icon-16"></span>
                        <span class="user__sns-icon <?=$sns["user_sns_id"] ? "icon-active" : "icon-inactive"?> icon-<?=$sns["sns_name"]?> icon-24"></span>
                        <span class="user__sns-text"><?=$sns["sns_real_name"]?></span>
                        <div class="user__sns-info" style="<?=$sns["user_sns_id"] ? "display:flex" : "display:none"?>">
                            <span class="user__sns-id"><?=$sns["user_sns_id"]?></span>
                            <button type="button" class="user__sns-cancel-button icon-button icon-button-20"><span class="icon-x icon-20"></span></button> 
                        </div>
                        <button type="button"class="user__sns-reg-button input-box-t5__action button-t1 button-s4" style="<?=$sns["user_sns_id"] ? "display:none" : "display:flex"?>">등록</button>
                        <div class="user__sns-input input-box-t5">
                            <input type="text" name="user_sns[<?=$sns["sns_name"]?>][user_sns_id]" id="user_sns_<?=$sns["sns_name"]?>" class="input-box-t5__input" value="<?=$sns["user_sns_id"]?>" placeholder="사용자 이름 입력">
                            <input type="hidden" name="user_sns[<?=$sns["sns_name"]?>][sns_real_name]" value="<?=$sns["sns_real_name"]?>">
                            <input type="hidden" name="user_sns[<?=$sns["sns_name"]?>][sns_name]" value="<?=$sns["sns_name"]?>">
                            <input type="hidden" name="user_sns[<?=$sns["sns_name"]?>][sns_order]" value="<?=$sns["sns_order"]?>">
                            <button type="button" class="user__sns-add-button input-box-t5__action button-t1 button-s4">확인</button>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <script>
                    $("#user__sns-list").sortable({
                        handle: ".user__sns-hamburger",
                        placeholder: "ui-state-highlight",
                        forcePlaceholderSize: true,
                        'start': function (event, ui) {
                            ui.placeholder.css({
                                height: "50px",
                                backgroundColor: "#F7F7F7",
                                border: "1px solid #E5E5E5",
                                borderRadius: "25px",
                                boxSizing: "border-box",
                            })
                        },
                        'stop': function (event, ui) {
                            $("#user__sns-list .user__sns-item").each(function(index){
                                $(this).find("input[type='hidden']").last().val(index);
                            });
                        }
                    });
                </script>
            </div>

            <button type="submit" class="button-t1 button-s1 flex-align-self-center mxw-316 mgb-60">저장</button>
        </fieldset>
    </form>
</div>
<script>
$(document).ready(function(){
    $("#profile__form").on("submit", async function(e){
        e.preventDefault();
      
        await check_profile_form($(this));

        return false;
    });

    $(document).on("click","#user_img__save-button", function(){
        let canvas = $("#user_img__crop-img").cropper("getCroppedCanvas",{
            width:320, 
            height:320, 
            imageSmoothingQuality: 'high'
        });
        $(".file-profile").addClass("edit");
        $(".file-profile__img").prop("src", canvas.toDataURL("image/jpeg"));
        $("#user_img_data").val(canvas.toDataURL("image/jpeg"));
        $("#user_tmp_img").val(JSON.stringify($("#user_img__crop-img").data("tmp")));
        modals.hide("user_img_modal");
    });

    $(document).on("click", "#user__img-update-button", function(){
        $("#user_img").trigger("click");
    });

    $(document).on("click","#user__img-default-button", function(){
        $(".file-profile").removeClass("edit");
        $(".file-profile__img").prop("src", "/root/img/img_profile_empty_160px.png");
        $("#user_img_data").val("");
    });

    $(document).on("click", "#user_field_add-button", function(){
        let field_array = [];
        $("input[name='user_field[]']").each(function(){
            field_array.push($(this).val());
        });

        modals.load("user_field", "관심분야 수정", JSON.stringify(field_array));
    });

    $(document).on("click", "#user_field__save-button", function(){
        let field_html = "";

        $("input[name='user_field_tmp[]']").each(function(){
            if($(this).is(":checked")){
                field_html += '<div class="chip-box">';
                field_html += '<span class="chip-box__label">'+$(this).val()+'</span>';
                field_html += '<input type="hidden" name="user_field[]" class="chip-box__input" value="'+$(this).val()+'">';
                field_html += '<button class="user_field_del-button chip-box__action icon-button icon-button-16"><span class="icon-x icon-16"></span></button>';
                field_html += '</div>';
            }
        });

        $("input[name='user_field[]']").each(function(){
            $(this).closest(".chip-box").remove();
        });

        $("#user_field_add-button").before(field_html);
        modals.hide("user_field_modal");

    });

    $(document).on("click", ".user_field_del-button", function(){
        $(this).closest(".chip-box").remove();
    });
    
    $(document).on("change", "input[name='user_genre[]']", function(e){
        let max = Number($(".profile__genre-counter").data("max"));
        let checked_length = $("input[name='user_genre[]']:checked").length;
        if(checked_length > max) {
            alert("장르는 최대 "+max+"개 까지 선택가능합니다.");
            $(this).prop("checked", false);
            return false;
        }else{
            $(".profile__genre-counter").text(checked_length+"/"+max);
        }
    });

    $("#user__major-add-button").on("click", function(){
        modals.load("user_major", "대표작품 등록", JSON.stringify($("#user_major").val()));
    });

    $(document).on("click","#user_major__save-button", function(){
        let major_html = "";
        let user_major = null;
        user_major = $("input[name='user_major_tmp']:checked").val();
        if(user_major == undefined){
            modals.hide("user_major");
            return;
        }

        if(user_major == ""){
            major_html += '<div id="user__major-add-box">';
            major_html += '<span id="user__major-add-icon" class="icon-plus icon-24"></span>';
            major_html += '<span id="user__major-add-text">대표작품 등록</span>';
            major_html += '</div>';
            $("#user__major-add-button").html(major_html);
        }else{
            user_major = $.parseJSON(user_major);
            major_html += '<div id="user__major-box">';
            major_html += '<input type="hidden" name="user_major" id="user_major" value="'+user_major.work_id+'">';
            major_html += '<img src="'+user_major.work_img+'" alt="대표작품 이미지" width="90" height="112" id="user__major-img">';
            major_html += '<div id="user__major-info">';
            major_html += '<span id="user__major-epsd">총 '+ display_number(user_major.work_epsd_cnt, "화") +'</span>';
            major_html += '<span id="user__major-name" class="text-truncate">'+user_major.work_name+'</span>';
            major_html += '<p id="user__major-description" class="text-truncate-line3">'+user_major.work_description+'</p>';
            major_html += '</div>';
            major_html += '</div>';
            $("#user__major-add-button").html(major_html);
        }
        modals.hide("user_major_modal");
    });

     $("input[id^='user_sns_']").on("keyup keypress keydown", function(e){
        if (e.keyCode == 13){
            e.preventDefault();
            $(this).next().trigger("click");
        }
    });

    $(".user__sns-reg-button").on("click", function(){
        $(this).closest(".user__sns-item").find(".user__sns-input").css("display", "flex");
        $(this).css("display", "none");
    });

    $(".user__sns-cancel-button").on("click", function(){
        $(this).closest(".user__sns-item").find(".user__sns-input").css("display", "flex");
        $(this).closest(".user__sns-info").css("display", "none");
    });

    $(".user__sns-add-button").on("click", function(){
        let item = $(this).closest(".user__sns-item");
        let sns_id = $(this).closest(".user__sns-input").find("input").val();

        if(sns_id == ""){
            item.find(".user__sns-input").css("display", "none");
            item.find(".user__sns-info").css("display", "none");
            item.find(".user__sns-reg-button").css("display", "flex");
            item.find(".user__sns-icon").removeClass("icon-active");
            item.find(".user__sns-icon").addClass("icon-inactive");
        }else{
            item.find(".user__sns-input").css("display", "none");
            item.find(".user__sns-info").css("display", "flex");
            item.find(".user__sns-info").find(".user__sns-id").text(sns_id);
            item.find(".user__sns-icon").removeClass("icon-inactive");
            item.find(".user__sns-icon").addClass("icon-active");
        }
    });

});
</script>