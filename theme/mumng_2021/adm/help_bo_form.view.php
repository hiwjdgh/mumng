<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-help">
    <form class="amd-help__form" action="<?=get_url(PAVE_ADM_URL,"help/bo/{$help_action}")?>" method="post" onsubmit="return adm_help_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
        <input type="hidden" name="crud" id="crud" value="<?=$help_action?>">


        <fieldset class="flex flex-column">
            <h2 class="text-weight-medium text-color-g10 text-size-normal">도움말 설정</h2>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말그룹</h3>
                <div class="select-box">
                    <select name="help_group_id" id="help_group_id" class="select-box__select" title="도움말그룹">
                        <option value="" disabled selected>선택해주세요.</option>
                        <?php foreach ($help_group_list as $i => $group) { ?>
                        <option value="<?=$group["help_group_id"]?>" <?=get_selected($group["help_group_id"], $help_bo["help_group_id"])?>><?=$group["help_group_name"]?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말 ID</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4 <?=$help_action == "update" ? "readonly" : "" ?>">
                        <input type="text" name="help_bo_id" id="help_bo_id" class="input-box-t4__input" value="<?=$help_bo["help_bo_id"]?>" placeholder="도움말 ID" <?=$help_action == "update" ? "readonly" : "" ?>>
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말명</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="help_bo_name" id="help_bo_name" class="input-box-t4__input" value="<?=$help_bo["help_bo_name"]?>" placeholder="도움말명">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말정렬</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="help_bo_order" id="help_bo_order" class="input-box-t4__input" value="<?=$help_bo["help_bo_order"]?>" placeholder="도움말정렬">
                    </div>
                </div>
            </div>

            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말노출</h3>
                <label for="help_bo_display" class="switch-box">
                    <input type="checkbox" name="help_bo_display" value="1" id="help_bo_display" class="switch-box__check" <?=get_checked(1, $help_bo["help_bo_display"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
        </fieldset>

        <div class="flex flex-column gap-row-8 mxw-480">
            <button type="submit" class="button-t1 button-s1"><?=$help_submit?></button>
            <a href="<?=get_url(PAVE_ADM_URL, "help/bo/list")?>" class="button-t2 button-s1">취소</a>
        </div>

    </form>

</div>