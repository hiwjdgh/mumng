<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column gap-row-24">
    <form class="adm-config__form flex flex-column gap-row-12" action="<?=get_url(PAVE_ADM_URL,"config/epsd/update")?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
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
                    <?php foreach ($epsd_cf as $i => $epsd) { ?>
                    <li class="adm-content__tab-item">
                        <button type="button" class="adm-content__tab-button" data-anchor="<?=$epsd["epsd_cate"]?>"><?=$epsd["epsd_cate_name"]?> 설정</button>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>


        <?php foreach ($epsd_cf as $i => $epsd) { ?>
        <div class="flex flex-wrap gap-24 mg-20 adm-content__tab-content" data-anchor="<?=$epsd["epsd_cate"]?>">
            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$epsd["epsd_cate_name"]?> 회차구분 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$epsd["epsd_cate_name"]?> 회차구분 설정</h3>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">회차구분 사용</p>
                        <label for="epsd_no_type_use_<?=$i?>" class="switch-box">
                            <input type="checkbox" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_no_type_use]" value="1" id="epsd_no_type_use_<?=$i?>" class="switch-box__check" <?=get_checked(1, $epsd["epsd_no_type_use"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">회차구분 종류</p>
                        <div class="flex flex-wrap gap-8">
                            <label for="epsd_no_type_0" class="chip-check-box <?=get_checked("epsd", $epsd["epsd_no_type_list"])?>">
                                <input type="checkbox" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_no_type][]" id="epsd_no_type_<?=$i?>_0" class="chip-check-box__check" value="epsd" <?=get_checked("epsd", $epsd["epsd_no_type_list"])?>>
                                <span class="chip-check-box__label">회차</span>
                            </label>
                            <label for="epsd_no_type_1" class="chip-check-box <?=get_checked("prlg", $epsd["epsd_no_type_list"])?>">
                                <input type="checkbox" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_no_type][]" id="epsd_no_type_<?=$i?>_1" class="chip-check-box__check" value="prlg" <?=get_checked("prlg", $epsd["epsd_no_type_list"])?>>
                                <span class="chip-check-box__label">프롤로그</span>
                            </label>
                            <label for="epsd_no_type_2" class="chip-check-box <?=get_checked("end", $epsd["epsd_no_type_list"])?>">
                                <input type="checkbox" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_no_type][]" id="epsd_no_type_<?=$i?>_2" class="chip-check-box__check" value="end" <?=get_checked("end", $epsd["epsd_no_type_list"])?>>
                                <span class="chip-check-box__label">완결</span>
                            </label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$epsd["epsd_cate_name"]?> 회차명 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$epsd["epsd_cate_name"]?> 회차명 설정</h3>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">회차명 사용</p>
                        <label for="epsd_name_use_<?=$i?>" class="switch-box">
                            <input type="checkbox" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_name_use]" value="1" id="epsd_name_use_<?=$i?>" class="switch-box__check" <?=get_checked(1, $epsd["epsd_name_use"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">회차명 최소 길이</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_name_min_len]" id="epsd_name_min_len_<?=$i?>" class="input-box-t2__input" value="<?=$epsd["epsd_name_min_len"]?>" title="회차명 최소 길이" placeholder="회차명 최소 길이(숫자만 입력)">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">회차명 최대 길이</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_name_max_len]" id="epsd_name_max_len_<?=$i?>" class="input-box-t2__input" value="<?=$epsd["epsd_name_max_len"]?>" title="회차명 최대 길이" placeholder="회차명 최대 길이(숫자만 입력)">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$epsd["epsd_cate_name"]?> 에필로그 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$epsd["epsd_cate_name"]?> 에필로그 설정</h3>
                               
                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">에필로그 사용</p>
                        <label for="epsd_eplg_use_<?=$i?>" class="switch-box">
                            <input type="checkbox" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_eplg_use]" value="1" id="epsd_eplg_use_<?=$i?>" class="switch-box__check" <?=get_checked(1, $epsd["epsd_eplg_use"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">에필로그 최대 길이</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_eplg_max_len]" id="epsd_eplg_max_len_<?=$i?>" class="input-box-t2__input" value="<?=$epsd["epsd_eplg_max_len"]?>" title="에필로그 최대 길이" placeholder="에필로그 최대 길이(숫자만 입력)">
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$epsd["epsd_cate_name"]?> 원고 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$epsd["epsd_cate_name"]?> 원고 설정</h3>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">원고 사용</p>
                        <label for="epsd_copy_use_<?=$i?>" class="switch-box">
                            <input type="checkbox" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_copy_use]" value="1" id="epsd_copy_use_<?=$i?>" class="switch-box__check" <?=get_checked(1, $epsd["epsd_copy_use"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$epsd["epsd_cate_name"]?> 일반내용 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$epsd["epsd_cate_name"]?> 일반내용 설정</h3>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">일반내용 사용</p>
                        <label for="epsd_content_use_<?=$i?>" class="switch-box">
                            <input type="checkbox" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_content_use]" value="1" id="epsd_content_use_<?=$i?>" class="switch-box__check" <?=get_checked(1, $epsd["epsd_content_use"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">일반내용 최소 길이</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_content_min_len]" id="epsd_content_min_len_<?=$i?>" class="input-box-t2__input" value="<?=$epsd["epsd_content_min_len"]?>" title="일반내용 최소 길이" placeholder="일반내용 최소 길이(숫자만 입력)">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">일반내용 최대 길이</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_content_max_len]" id="epsd_content_max_len_<?=$i?>" class="input-box-t2__input" value="<?=$epsd["epsd_content_max_len"]?>" title="일반내용 최대 길이" placeholder="일반내용 최대 길이(숫자만 입력)">
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip"><?=$epsd["epsd_cate_name"]?> 의견 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large"><?=$epsd["epsd_cate_name"]?> 의견 설정</h3>

                    
                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">의견 사용</p>
                        <label for="epsd_cmt_use_<?=$i?>" class="switch-box">
                            <input type="checkbox" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_cmt_use]" value="1" id="epsd_cmt_use_<?=$i?>" class="switch-box__check" <?=get_checked(1, $epsd["epsd_cmt_use"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">의견 최대 길이</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="epsd[<?=$epsd["epsd_cate"]?>][epsd_cmt_max_len]" id="epsd_cmt_max_len_<?=$i?>" class="input-box-t2__input" value="<?=$epsd["epsd_cmt_max_len"]?>" title="의견 최대 길이" placeholder="의견 최대 길이(숫자만 입력)">
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <?php } ?>
    </form>
</div>