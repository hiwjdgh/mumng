<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-help">
    <form class="amd-help__form" action="<?=get_url(PAVE_ADM_URL,"help/bd/{$help_action}")?>" method="post" onsubmit="return adm_help_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
        <input type="hidden" name="crud" id="crud" value="<?=$help_action?>">
        <input type="hidden" name="help_bd_id" id="help_bd_id" value="<?=$help_bd["help_bd_id"]?>">


        <fieldset class="flex flex-column">
            <h2 class="text-weight-medium text-color-g10 text-size-normal">도움말 설정</h2>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말</h3>
                <div class="select-box">
                    <select name="help_bo_id" id="help_bo_id" class="select-box__select" title="도움말">
                        <option value="" disabled selected>선택해주세요.</option>
                        <?php foreach ($help_bo_list as $i => $bo) { ?>
                        <option value="<?=$bo["help_bo_id"]?>" <?=get_selected($bo["help_bo_id"], $help_bd["help_bo_id"])?>><?=$bo["help_bo_name"]?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말노출</h3>
                <label for="help_bd_display" class="switch-box">
                    <input type="checkbox" name="help_bd_display" value="1" id="help_bd_display" class="switch-box__check" <?=get_checked(1, $help_bd["help_bd_display"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-column mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말내용</h3>
                
                <div class="adm-help__form-content flex flex-column">
                    <?php if(pave_is_array($help_bd["help_bd_content_list"])){ ?>
                    <?php foreach ($help_bd["help_bd_content_list"] as $i => $bd_content) { ?>
                    <div class="adm-help__form-content-cate">
                        <div class="input-box input-box-t4">
                            <input type="text" name="help_bd_content[<?=$i?>][title]" class="input-box-t4__input" value="<?=$bd_content["title"]?>" placeholder="도움말 카테고리명">
                        </div>
                        <div class="input-box input-box-t4">
                            <input type="text" name="help_bd_content[<?=$i?>][description]" class="input-box-t4__input" value="<?=$bd_content["description"]?>" placeholder="도움말 카테고리 설명">
                        </div>
                        <div class="flex flex-align-center">
                            <div class="input-box input-box-t4">
                                <input type="text" name="help_bd_content[<?=$i?>][link][title]" class="input-box-t4__input" value="<?=$bd_content["link"]["title"]?>" placeholder="도움말 카테고리 링크명">
                            </div>
                            <div class="input-box input-box-t4">
                                <input type="text" name="help_bd_content[<?=$i?>][link][url]" class="input-box-t4__input" value="<?=$bd_content["link"]["url"]?>" placeholder="도움말 카테고리 링크 URL">
                            </div>
                        </div>

                        <?php foreach ((array)$bd_content["content"] as $j => $bd_content_detail){ ?>
                            <?php if($bd_content_detail["type"] == "general"){ ?>
                                <div class="bd-content">
                                    <div class="textarea-box">
                                        <textarea name="help_bd_content[<?=$i?>][content][<?=$j?>][content]" class="textarea-box__textarea" placeholder="" spellcheck="false"><?=$bd_content_detail["content"]?></textarea>
                                    </div>
                                    <div class="bd-content-general-link flex flex-align-center">
                                        <div class="input-box input-box-t4">
                                            <input type="text" name="help_bd_content[<?=$i?>][content][<?=$j?>][link][title]" class="input-box-t4__input" value="<?=$bd_content_detail["link"]["title"]?>" placeholder="링크명">
                                        </div>
                                        <div class="input-box input-box-t4">
                                            <input type="text" name="help_bd_content[<?=$i?>][content][<?=$j?>][link][url]" class="input-box-t4__input" value="<?=$bd_content_detail["link"]["url"]?>" placeholder="링크 URL">
                                        </div>
                                    </div>
                                    <input type="hidden" name="help_bd_content[<?=$i?>][content][<?=$j?>][type]" value="general">
                                </div>
                            <?php }else if($bd_content_detail["type"] == "flow"){ ?>
                                <div class="bd-content">
                                    <div class="input-box input-box-t4">
                                        <input type="text" name="help_bd_content[<?=$i?>][content][<?=$j?>][title]" class="input-box-t4__input" value="<?=$bd_content_detail["title"]?>" placeholder="제목">
                                    </div>
                                    <div class="input-box input-box-t4">
                                        <input type="text" name="help_bd_content[<?=$i?>][content][<?=$j?>][content]" class="input-box-t4__input" value="<?=$bd_content_detail["content"]?>" placeholder="내용">
                                    </div>
                                    <input type="hidden" name="help_bd_content[<?=$i?>][content][<?=$j?>][type]" value="flow">
                                    <?php foreach ((array)$bd_content_detail["step"] as $k => $bd_content_detail_step){ ?>
                                    <div class="bd-content-flow2" style="padding-left: 20px">
                                        <div class="input-box input-box-t4">
                                            <input type="text" name="help_bd_content[<?=$i?>][content][<?=$j?>][step][<?=$k?>][title]" class="input-box-t4__input" value="<?=$bd_content_detail_step["title"]?>" placeholder="제목">
                                        </div>
                                        <div class="input-box input-box-t4">
                                            <input type="text" name="help_bd_content[<?=$i?>][content][<?=$j?>][step][<?=$k?>][content]" class="input-box-t4__input" value="<?=$bd_content_detail_step["content"]?>" placeholder="내용">
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="bd-content-cate flex flex-align-center">
                            <button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="general">내용</button>
                            <button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="flow">순서</button>
                            <button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="next">다음</button>
                        </div>
                    </div>
                    <?php } ?>
                    <?php }else{ ?>
                        <div class="adm-help__form-content-cate">
                            <div class="input-box input-box-t4">
                                <input type="text" name="help_bd_content[0][title]" class="input-box-t4__input" value="" placeholder="도움말 카테고리명">
                            </div>
                            <div class="input-box input-box-t4">
                                <input type="text" name="help_bd_content[0][description]" class="input-box-t4__input" value="" placeholder="도움말 카테고리 설명">
                            </div>
                            <div class="flex flex-align-center">
                                <div class="input-box input-box-t4">
                                    <input type="text" name="help_bd_content[0][link][title]" class="input-box-t4__input" value="" placeholder="도움말 카테고리 링크명">
                                </div>
                                <div class="input-box input-box-t4">
                                    <input type="text" name="help_bd_content[0][link][url]" class="input-box-t4__input" value="" placeholder="도움말 카테고리 링크 URL">
                                </div>
                            </div>
    
                            <div class="bd-content-cate flex flex-align-center">
                                <button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="general">내용</button>
                                <button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="flow">순서</button>
                                <button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="next">다음</button>
                            </div>
                        </div>
                        <?php } ?>
                </div>
                
            </div>
        </fieldset>

        <div class="flex flex-column gap-row-8 mxw-480">
            <button type="submit" class="button-t1 button-s1"><?=$help_submit?></button>
            <a href="<?=get_url(PAVE_ADM_URL, "help/bd/list")?>" class="button-t2 button-s1">취소</a>
        </div>
    </form>
</div>
<script>
    let cate_html = "";
    cate_html += '<div class="adm-help__form-content-cate">';
    cate_html += '<div class="input-box input-box-t4">';
    cate_html += '<input type="text" name="" class="input-box-t4__input" value="" placeholder="도움말 카테고리명">';
    cate_html += '</div>';
    cate_html += '<div class="input-box input-box-t4">';
    cate_html += '<input type="text" name="" class="input-box-t4__input" value="" placeholder="도움말 카테고리 설명">';
    cate_html += '</div>';
    cate_html += '<div class="bd-content-general-link flex flex-align-center">';
    cate_html += '<div class="input-box input-box-t4">';
    cate_html += '<input type="text" name="" class="input-box-t4__input" value="" placeholder="도움말 카테고리 링크명">';
    cate_html += '</div>';
    cate_html += '<div class="input-box input-box-t4">';
    cate_html += '<input type="text" name="" class="input-box-t4__input" value="" placeholder="도움말 카테고리 링크 URL">';
    cate_html += '</div>';
    cate_html += '</div>';
    cate_html += '<div class="bd-content-cate flex flex-align-center">';
    cate_html += '<button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="general">내용</button>';
    cate_html += '<button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="flow">순서</button>';
    cate_html += '<button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="next">다음</button>';
    cate_html += '</div>';
    cate_html += '</div>';

    let cate_button_html = "";
    cate_button_html += '<div class="bd-content-cate flex flex-align-center">';
    cate_button_html += '<button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="general">내용</button>';
    cate_button_html += '<button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="flow">순서</button>';
    cate_button_html += '<button type="button" class="bd-content-cate-button button-t2 button-s1" data-cate="next">다음</button>';
    cate_button_html += '</div>';

    let step_button_html = "";
    step_button_html += '<div class="bd-content-step flex flex-align-center">';
    step_button_html += '<button type="button" class="bd-content-step-button button-t2 button-s1" data-step="prev">이전</button>';
    step_button_html += '<button type="button" class="bd-content-step-button button-t2 button-s1" data-step="next">완료</button>';
    step_button_html += '</div>';

    let step_button_html2 = "";
    step_button_html2 += '<div class="bd-content-step flex flex-align-center">';
    step_button_html2 += '<button type="button" class="bd-content-step-button button-t2 button-s1" data-step="prev">이전</button>';
    step_button_html2 += '<button type="button" class="bd-content-step-button button-t2 button-s1" data-step="next">완료</button>';
    step_button_html2 += '<button type="button" class="bd-content-step-button button-t2 button-s1" data-step="depth">하위추가</button>';
    step_button_html2 += '</div>';

    let general_html = "";
    general_html += '<div class="bd-content">';
    general_html += '<div class="textarea-box">';
    general_html += '<textarea name="" class="textarea-box__textarea" placeholder="" spellcheck="false"></textarea>';
    general_html += '</div>';
    general_html += '<div class="flex flex-align-center">';
    general_html += '<div class="input-box input-box-t4">';
    general_html += '<input type="text" name="help_bd_content[0][link][title]" class="input-box-t4__input" value="" placeholder="링크명">';
    general_html += '</div>';
    general_html += '<div class="input-box input-box-t4">';
    general_html += '<input type="text" name="help_bd_content[0][link][url]" class="input-box-t4__input" value="" placeholder="링크 URL">';
    general_html += '</div>';
    general_html += '</div>';
    general_html += '<input type="hidden" name="" value="">';
    general_html += '</div>';


    let flow_html = "";
    flow_html += '<div class="bd-content">';
    flow_html += '<div class="input-box input-box-t4">';
    flow_html += '<input type="text" name="" class="input-box-t4__input" value="" placeholder="제목">';
    flow_html += '</div>';
    flow_html += '<div class="input-box input-box-t4">';
    flow_html += '<input type="text" name="" class="input-box-t4__input" value="" placeholder="내용">';
    flow_html += '</div>';
    flow_html += '<input type="hidden" name="" value="">';
    flow_html += '</div>';

    let flow_html2 = "";
    flow_html2 += '<div class="bd-content-flow2">';
    flow_html2 += '<div class="input-box input-box-t4">';
    flow_html2 += '<input type="text" name="" class="input-box-t4__input" value="" placeholder="제목">';
    flow_html2 += '</div>';
    flow_html2 += '<div class="input-box input-box-t4">';
    flow_html2 += '<input type="text" name="" class="input-box-t4__input" value="" placeholder="내용">';
    flow_html2 += '</div>';
    flow_html2 += '</div>';

    function adm_help_form_check(f){
        return true;
    }
    $(document).ready(function(){
        $(document).on("click", ".bd-content-cate-button", function(){
            let box = $(".adm-help__form-content");
            let cate = $(this).data("cate");
            let cate_box = $(this).closest(".adm-help__form-content-cate");
            let cate_index = $(this).closest(".adm-help__form-content-cate").index();
            let content_index = cate_box.find(".bd-content").length;
            switch (cate) {
                case "general":
                    let tmp_general = $(general_html);
                    tmp_general.find(".textarea-box__textarea").prop("name", "help_bd_content["+cate_index+"][content]["+content_index+"][content]");
                    tmp_general.find(".input-box-t4__input").eq(0).prop("name", "help_bd_content["+cate_index+"][content]["+content_index+"][link][title]");
                    tmp_general.find(".input-box-t4__input").eq(1).prop("name", "help_bd_content["+cate_index+"][content]["+content_index+"][link][url]");
                    tmp_general.find("input[type='hidden']").prop("name", "help_bd_content["+cate_index+"][content]["+content_index+"][type]");
                    tmp_general.find("input[type='hidden']").val("general");
                    cate_box.append(tmp_general);
                    cate_box.append(step_button_html);

                    $(this).closest(".bd-content-cate").remove();
                    break;
                case "flow":
                    let tmp_flow = $(flow_html);
                    tmp_flow.find(".input-box-t4__input").eq(0).prop("name", "help_bd_content["+cate_index+"][content]["+content_index+"][title]");
                    tmp_flow.find(".input-box-t4__input").eq(1).prop("name", "help_bd_content["+cate_index+"][content]["+content_index+"][content]");
                    tmp_flow.find("input[type='hidden']").prop("name", "help_bd_content["+cate_index+"][content]["+content_index+"][type]");
                    tmp_flow.find("input[type='hidden']").val("flow");
                    cate_box.append(tmp_flow);
                    cate_box.append(step_button_html2);

                    $(this).closest(".bd-content-cate").remove();
                    break;
                case "next":
                    $(this).closest(".bd-content-cate").remove();
                    let tmp_cate = $(cate_html);
                    tmp_cate.find(".input-box-t4__input").eq(0).prop("name", "help_bd_content["+(cate_index+1)+"][title]");
                    tmp_cate.find(".input-box-t4__input").eq(1).prop("name", "help_bd_content["+(cate_index+1)+"][description]");
                    tmp_cate.find(".input-box-t4__input").eq(2).prop("name", "help_bd_content["+(cate_index+1)+"][link][title]");
                    tmp_cate.find(".input-box-t4__input").eq(3).prop("name", "help_bd_content["+(cate_index+1)+"][link][url]");
                    box.append(tmp_cate);
                    break;
            }
        });

        $(document).on("click", ".bd-content-step-button", function(){
            let step = $(this).data("step");
            let cate_box = $(this).closest(".adm-help__form-content-cate");
            let cate_index = $(this).closest(".adm-help__form-content-cate").index();
            let content_index = cate_box.find(".bd-content").length -1;

            switch (step) {
                case "prev":
                    cate_box.children().slice(-1).remove();

                    if(cate_box.find(".bd-content").length == 0){
                        cate_box.append(cate_button_html);
                    }else{
                        if(cate_box.find(".bd-content").last().find("input[type='hidden']").val() == "flow"){
                            if(cate_box.find(".bd-content").last().find(".bd-content-flow2").length == 0){
                                cate_box.children().slice(-1).remove();
                                cate_box.append(step_button_html);
                            }else{
                                cate_box.find(".bd-content").last().find(".bd-content-flow2").last().remove();
                                cate_box.append(step_button_html2);
                            }
                        }else{
                            cate_box.children().slice(-1).remove();
                            cate_box.append(step_button_html);
                        }
                    }
                    break;
                case "next":
                    $(this).closest(".bd-content-step").remove();
                    cate_box.append(cate_button_html);
                    break;
                case "depth":
                    let tmp_flow2 = $(flow_html2);
                    let flow2_index = cate_box.find(".bd-content-flow2").length;
                    tmp_flow2.find(".input-box-t4__input").eq(0).prop("name", "help_bd_content["+cate_index+"][content]["+content_index+"][step]["+flow2_index+"][title]");
                    tmp_flow2.find(".input-box-t4__input").eq(1).prop("name", "help_bd_content["+cate_index+"][content]["+content_index+"][step]["+flow2_index+"][content]");
                    tmp_flow2.css("padding-left", "20px");

                    cate_box.find(".bd-content").last().append(tmp_flow2);
                    cate_box.append(step_button_html2);
                    $(this).closest(".bd-content-step").remove();
                    break;
            }
        });

    });
</script>