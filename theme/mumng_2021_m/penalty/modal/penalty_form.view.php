<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="penalty_modal">
    <div id="modal__box" class="modal__box--620">
        <div id="modal__header" class="modal__header-line">
            <h2 id="modal__header-title"><?=$title?></h2>
            <button type="button" id="modal__header-close-button"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div id="modal__content">
            <div class="penalty__box">
                <form class="penalty__form" method="post" onsubmit="return penalty_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
                    <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">
                    <input type="hidden" name="penalty_target" id="penalty_target" value="<?=$penalty_target?>">
                    <input type="hidden" name="penalty_cate" id="penalty_cate" value="<?=$penalty_cate?>">

                    <ul class="penalty__form-reason-list">
                        <?php foreach ($penalty_cf["penalty_reason_list"] as $i => $reason) { ?>
                        <?php if(!$reason["reason_show"]) continue; ?>
                        <li class="penalty__form-reason-item">
                            <label for="penalty_reason_<?=$i?>" class="radio-box">
                                <input type="radio" name="penalty_reason" id="penalty_reason_<?=$i?>" class="radio-box__radio" value="<?=$reason["reason_key"]?>">
                                <span class="radio-box__span"></span>
                                <span class="radio-box__label"><?=$reason["reason_value"]?></span>
                            </label>

                            <div class="tooltip-box">
                                <span class="tooltip-box__icon icon-help icon-12"></span>
                                <div class="tooltip-box__content">
                                    <p><?=$reason["reason_help"]?></p>
                                </div>
                            </div>
                            <?php if($reason["reason_key"] == "etc"){ ?>
                            <div class="textarea-box" style="display: none;">
                                <textarea name="penalty_reason_text" id="penalty_reason_text" class="textarea-box__textarea" placeholder="기타사유" maxlength="500"></textarea>
                                <div class="textarea-box__counter">
                                    <span class="textarea-box__counter-now">0</span>
                                    <span class="textarea-box__counter-max">/ 500자</span>
                                </div>
                            </div>
                            <?php } ?>
                        </li>
                        <?php } ?>
                    </ul>
                    
                    <div class="penalty__form-submit-box">
                        <button type="submit" class="penalty__form-submit-button button-t1 button-s1">신고하기</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="modal__footer">
        </div>
    </div>
</div>
<script>
function penalty_form_check(f){
    if($("input[name='penalty_reason']:checked").length == 0){
        alert("신고사유를 선택해주세요.");
        return false;
    } 

    if($("input[name='penalty_reason']:checked").val() == "etc"){
        if($("#penalty_reason_text").val() == ""){
            alert("기타사유를 작성해주세요.");
            $("#penalty_reason_text").focus();
            return false;
        }
    }

    pave_ajax(
        "/api/penalty/create",
        $(f),
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    alert("신고가 완료되었습니다.")
                    hide_modal();
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
        },
        function(error){
            alert(error);
        }
    );

    return false;
}

$(document).ready(function(){
    $(document).off("change", "input[name='penalty_reason']");
    $(document).on("change", "input[name='penalty_reason']", function(e){
        if($(this).val() == "etc"){
            $(".textarea-box").show();
        }else{
            $(".textarea-box").hide();
        }
        $("#penalty_reason_text").val("");
    });
});
</script>