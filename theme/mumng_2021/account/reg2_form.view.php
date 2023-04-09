<?php
if (!defined('_PAVE_')) exit;
?>
<section id="reg">
    <div id="reg__step-box">
        <h2 id="reg__step-title">가입완료</h2>
        <div id="reg__step-msg-box" class="step5">
            <span id="reg__step5-msg" class="reg__step-msg">가입을 축하합니다 ! 작품 활동에 필요한 필명과 프로필 사진을 등록해주세요.</span>
        </div>
    </div>

   <form id="reg__form" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">
        <input type="hidden" name="user_skip" id="user_skip" value="">
        <fieldset id="reg_step5" class="reg_step flex flex-column mxw-316">
            <legend class="skip">회원가입 추가정보</legend>

            <div class="flex flex-column mgb-24">
                <h3 class="text-weight-bold text-color-g10 text-size-normal mgb-28">프로필이미지</h3>

                <div class="file-profile flex-align-self-center">
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

            <div class="flex flex-column mgb-10">
                <div class="input-box input-box-t2">
                    <label for="user_nick" class="input-box-t2__label">필명</label>
                    <input type="text" name="user_nick" id="user_nick" class="input-box-t2__input" value="<?=$pave_user["user_nick"]?>" title="필명" minlength="<?=$user_config["user_nick_min_len"]?>" maxlength="<?=$user_config["user_nick_max_len"]?>" required spellcheck="false">
                    <p id="user_nick_msg" class="input-box-t2__msg"></p>
                </div>
            </div>

            <div class="flex flex-column mgb-24">
                <h3 class="text-weight-bold text-color-g10 text-size-normal mgb-14">관심분야</h3>
                <div>
                    <div class="flex flex-wrap gap-8">
                        <button type="button" id="user_field_add-button" class="icon-button icon-button-32 icon-button-circle">
                            <span class="icon icon-plus icon-20"></span><span class="skip">추가</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="reg__genre flex flex-column mgb-36">
                <div class="flex flex-align-item-center mgb-14">
                    <h3 class="text-weight-bold text-color-g10 text-size-normal mgr-6">관심장르</h3>
                    <span class="reg__genre-counter text-color-g7 text-weight-regular text-size-normal" data-max="<?=$user_config["user_genre_max_cnt"]?>">0/<?=$user_config["user_genre_max_cnt"]?></span>
                </div>
                <div>
                    <div class="flex flex-wrap gap-row-12 gap-column-14">
                        <?php foreach ($user_config["user_genre_list"] as $i => $genre) { ?>
                        <label for="genre_<?=$i?>" class="chip-check-box">
                            <input type="checkbox" name="user_genre[]" id="genre_<?=$i?>" class="chip-check-box__check" value="<?=$genre?>">
                            <span class="chip-check-box__label"><?=$genre?></span>
                        </label>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between">
                <button type="button" id="reg__skip-button" class="text-weight-bold text-color-g7 text-size-large">건너뛰기</button>
                <button type="submit" class="text-weight-bold text-color-g11 text-size-large">확인</button>
            </div>
        </fieldset>
    </form>
</section>
<script>
$(document).ready(function(){
    $("#reg__form").on("submit", async function(e){
        e.preventDefault();

        await check_reg2_form($(this));

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
        $("#user_tmp_img").val("");
    });

    $("#user_nick").on("keyup", async function(e){
        result = await check_user_nick($(e.target).val(), true, "", true);
        if(result.status == "success"){
            $("#user_nick").closest(".input-box").addClass("valid").removeClass("invalid");
            $("#user_nick_msg").text("");
        }else{
            $("#user_nick_msg").text(result.msg);
            $("#user_nick").closest(".input-box").addClass("invalid").removeClass("valid");
        }
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
        let max = Number($(".reg__genre-counter").data("max"));
        let checked_length = $("input[name='user_genre[]']:checked").length;
        if(checked_length > max) {
            alert("장르는 최대 "+max+"개 까지 선택가능합니다.");
            $(this).prop("checked", false);
            return false;
        }else{
            $(".reg__genre-counter").text(checked_length+"/"+max);
        }
    });

    $("#reg__skip-button").on("click", function(){
        $("#user_skip").val(1);
        $("#reg__form").trigger("submit");
    });
});
</script>
