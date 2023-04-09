<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column gap-row-24">
    <form class="adm-config__form flex flex-column gap-row-12" action="<?=get_url(PAVE_ADM_URL,"config/file/update")?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">

        <div class="adm-content__header flex flex-column gap-row-24">

            <div class="flex flex-justify-content-flex-start flex-align-item-center">
                <h1 class="adm-content__header__title"><?=$adm_title?></h1>
    
                <div class="flex mgl-auto gap-column-12">
                    <button type="submit" class="button-t1 button-s3">수정</button>
                </div>
            </div>

            <div class="adm-content__tab">
                <ul class="adm-content__tab-list">
                    <?php foreach ($file_cf as $i => $file) { ?>
                    <li class="adm-content__tab-item">
                        <button type="button" class="adm-content__tab-button" data-anchor="<?=$file["file_id"]?>"><?=$file["file_name"]?> 설정</button>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>


        <?php foreach ($file_cf as $i => $file) { ?>
        <div class="flex flex-wrap gap-24 mg-20 adm-content__tab-content" data-anchor="<?=$file["file_id"]?>">
            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$file["file_name"]?> 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$file["file_name"]?> 설정</h3>


                    
                    <div class="flex flex-column gap-row-12">
                        <div class="flex flex-align-item-center gap-column-4">
                            <p class="text-weight-medium text-color-g10 text-size-normal"><?=$file["file_name"]?> 최대 업로드 갯수</p>
                            <div class="tooltip-box">
                                <span class="tooltip-box__icon icon-help icon-12"></span>
                                <div class="tooltip-box__content">
                                    <p>- 1회 최대 업로드 갯수입니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-box input-box-t2">
                            <input type="number" name="file[<?=$file["file_id"]?>][file_cnt]" id="file_cnt_<?=$i?>" class="input-box-t2__input" value="<?=$file["file_cnt"]?>" title="<?=$file["file_name"]?> 최대 업로드 갯수" placeholder="<?=$file["file_name"]?> 최대 업로드 갯수(숫자만 입력)">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">업로드 가능 확장자</p>
                        <div class="flex flex-wrap gap-8">
                            <label for="file_ext_0" class="chip-check-box <?=get_checked(".jpg", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_0" class="chip-check-box__check" value=".jpg" <?=get_checked(".jpg", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.jpg</span>
                            </label>
                            <label for="file_ext_1" class="chip-check-box <?=get_checked(".jpeg", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_1" class="chip-check-box__check" value=".jpeg" <?=get_checked(".jpeg", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.jpeg</span>
                            </label>
                            <label for="file_ext_2" class="chip-check-box <?=get_checked(".png", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_2" class="chip-check-box__check" value=".png" <?=get_checked(".png", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.png</span>
                            </label>
                            <label for="file_ext_3" class="chip-check-box <?=get_checked(".gif", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_3" class="chip-check-box__check" value=".gif" <?=get_checked(".gif", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.gif</span>
                            </label>
                            <label for="file_ext_4" class="chip-check-box <?=get_checked(".hwp", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_4" class="chip-check-box__check" value=".hwp" <?=get_checked(".hwp", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.hwp</span>
                            </label>
                            <label for="file_ext_5" class="chip-check-box <?=get_checked(".xls", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_5" class="chip-check-box__check" value=".xls" <?=get_checked(".xls", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.xls</span>
                            </label>
                            <label for="file_ext_6" class="chip-check-box <?=get_checked(".xlsx", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_6" class="chip-check-box__check" value=".xlsx" <?=get_checked(".xlsx", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.xlsx</span>
                            </label>
                            <label for="file_ext_7" class="chip-check-box <?=get_checked(".doc", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_7" class="chip-check-box__check" value=".doc" <?=get_checked(".doc", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.doc</span>
                            </label>
                            <label for="file_ext_8" class="chip-check-box <?=get_checked(".docx", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_8" class="chip-check-box__check" value=".docx" <?=get_checked(".docx", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.docx</span>
                            </label>
                            <label for="file_ext_9" class="chip-check-box <?=get_checked(".pdf", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_9" class="chip-check-box__check" value=".pdf" <?=get_checked(".pdf", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.pdf</span>
                            </label>
                            <label for="file_ext_10" class="chip-check-box <?=get_checked(".txt", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_10" class="chip-check-box__check" value=".txt" <?=get_checked(".txt", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.txt</span>
                            </label>
                            <label for="file_ext_11" class="chip-check-box <?=get_checked(".ppt", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_11" class="chip-check-box__check" value=".ppt" <?=get_checked(".ppt", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.ppt</span>
                            </label>
                            <label for="file_ext_12" class="chip-check-box <?=get_checked(".pptx", $file["file_ext_list"])?>">
                                <input type="checkbox" name="file[<?=$file["file_id"]?>][file_ext][]" id="file_ext_<?=$i?>_12" class="chip-check-box__check" value=".pptx" <?=get_checked(".pptx", $file["file_ext_list"])?>>
                                <span class="chip-check-box__label">.pptx</span>
                            </label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$file["file_name"]?> 너비 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$file["file_name"]?> 너비 설정</h3>


                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">너비</p>
                        
                        <div class="flex flex-align-item-center">
                            <div class="input-box input-box-t2">
                                <input type="number" name="file[<?=$file["file_id"]?>][file_width]" id="file_width_<?=$i?>" class="input-box-t2__input" value="<?=$file["file_width"]?>" title="너비" placeholder="너비(숫자만 입력)">
                            </div>
                            <div class="select-box">
                                <select name="file[<?=$file["file_id"]?>][file_width_opt]" id="file_width_opt_<?=$i?>" class="select-box__select" title="너비 옵션">
                                    <option value="" disabled selected>선택해주세요.</option>
                                    <option value="==" <?=get_selected("==", $file["file_width_opt"])?>>같다</option>
                                    <option value=">" <?=get_selected(">", $file["file_width_opt"])?>>보다 크다</option>
                                    <option value="<" <?=get_selected("<", $file["file_width_opt"])?>>보다 작다</option>
                                    <option value=">=" <?=get_selected(">=", $file["file_width_opt"])?>>보다 크거나같다</option>
                                    <option value="<=" <?=get_selected("<=", $file["file_width_opt"])?>>보다 작거나같다</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$file["file_name"]?> 높이 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$file["file_name"]?> 높이 설정</h3>


                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">높이</p>
                        
                        <div class="flex flex-align-item-center">
                            <div class="input-box input-box-t2">
                                <input type="number" name="file[<?=$file["file_id"]?>][file_height]" id="file_height_<?=$i?>" class="input-box-t2__input" value="<?=$file["file_height"]?>" title="높이" placeholder="높이(숫자만 입력)">
                            </div>
                            <div class="select-box">
                                <select name="file[<?=$file["file_id"]?>][file_height_opt]" id="file_height_opt_<?=$i?>" class="select-box__select" title="높이 옵션">
                                    <option value="" disabled selected>선택해주세요.</option>
                                    <option value="==" <?=get_selected("==", $file["file_height_opt"])?>>같다</option>
                                    <option value=">" <?=get_selected(">", $file["file_height_opt"])?>>보다 크다</option>
                                    <option value="<" <?=get_selected("<", $file["file_height_opt"])?>>보다 작다</option>
                                    <option value=">=" <?=get_selected(">=", $file["file_height_opt"])?>>보다 크거나같다</option>
                                    <option value="<=" <?=get_selected("<=", $file["file_height_opt"])?>>보다 작거나같다</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$file["file_name"]?> 용량 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$file["file_name"]?> 용량 설정</h3>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">1개당 용량</p>
                        
                        <div class="flex flex-align-item-center">
                            <div class="input-box input-box-t2">
                                <input type="number" name="file[<?=$file["file_id"]?>][file_size]" id="file_size_<?=$i?>" class="input-box-t2__input" value="<?=$file["file_size"]?>" title="개당 용량" placeholder="개당 용량(숫자만 입력)">
                            </div>
                            <div class="select-box">
                                <select name="file[<?=$file["file_id"]?>][file_unit]" id="file_unit_<?=$i?>" class="select-box__select" title="개당 용량 단위">
                                    <option value="" disabled selected>선택해주세요.</option>
                                    <option value="KB" <?=get_selected("KB", $file["file_unit"])?>>KB</option>
                                    <option value="MB" <?=get_selected("MB", $file["file_unit"])?>>MB</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">총 용량</p>
                        
                        <div class="flex flex-align-item-center">
                            <div class="input-box input-box-t2">
                                <input type="number" name="file[<?=$file["file_id"]?>][file_total_size]" id="file_total_size_<?=$i?>" class="input-box-t2__input" value="<?=$file["file_total_size"]?>" title="총 용량" placeholder="총 용량(숫자만 입력)">
                            </div>
                            <div class="select-box">
                                <select name="file[<?=$file["file_id"]?>][file_total_unit]" id="file_total_unit_<?=$i?>" class="select-box__select" title="총 용량 단위">
                                    <option value="" disabled selected>선택해주세요.</option>
                                    <option value="KB" <?=get_selected("KB", $file["file_total_unit"])?>>KB</option>
                                    <option value="MB" <?=get_selected("MB", $file["file_total_unit"])?>>MB</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <?php } ?>
    </form>
</div>