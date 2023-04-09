<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-help">
    <form class="amd-help__form" action="<?=get_url(PAVE_ADM_URL,"help/group/{$help_action}")?>" method="post" onsubmit="return adm_help_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
        <input type="hidden" name="crud" id="crud" value="<?=$help_action?>">


        <fieldset class="flex flex-column">
            <h2 class="text-weight-medium text-color-g10 text-size-normal">도움말그룹 설정</h2>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말그룹 ID</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4 <?=$help_action == "update" ? "readonly" : "" ?>">
                        <input type="text" name="help_group_id" id="help_group_id" class="input-box-t4__input" value="<?=$help_group["help_group_id"]?>" placeholder="도움말그룹 ID" <?=$help_action == "update" ? "readonly" : "" ?>>
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말그룹명</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="help_group_name" id="help_group_name" class="input-box-t4__input" value="<?=$help_group["help_group_name"]?>" placeholder="도움말그룹명">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">도움말그룹정렬</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="help_group_order" id="help_group_order" class="input-box-t4__input" value="<?=$help_group["help_group_order"]?>" placeholder="도움말그룹정렬">
                    </div>
                </div>
            </div>

            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">
                    도움말그룹노출
                    <div class="tooltip-box">
                        <span class="tooltip-box__icon icon-help icon-12"></span>
                        <div class="tooltip-box__content">
                            <p>- 비공개시 해당 그룹 하위 도움말 비공개</p>
                        </div>
                    </div>
                </h3>
                <label for="help_group_display" class="switch-box">
                    <input type="checkbox" name="help_group_display" value="1" id="help_group_display" class="switch-box__check" <?=get_checked(1, $help_group["help_group_display"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
        </fieldset>

        <div class="flex flex-column gap-row-8 mxw-480">
            <button type="submit" class="button-t1 button-s1"><?=$help_submit?></button>
            <a href="<?=get_url(PAVE_ADM_URL, "help/group/list")?>" class="button-t2 button-s1">취소</a>
        </div>

    </form>

</div>