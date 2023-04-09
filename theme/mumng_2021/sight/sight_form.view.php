<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals sight_form_modal" data-target="sight_form_modal">
    <div class="modals__box">
        <div class="modals__header">
            <h2 class="modals__title"><?=$sight_form_title?></h2>
            <button type="button" id="modal__header-close-button" class="modal-close-button modals__close-button" data-anchor="sight_form_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div class="modals__content">
            <form class="sight__form" enctype="multipart/form-data" method="POST" novalidate autocomplete="off">
                <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
                <input type="hidden" name="sight_no" id="sight_no" value="<?=$sight["sight_no"]?>">
                <input type="hidden" name="action" id="action" value="<?=$action?>">

                <fieldset class="sight__fieldset">
                    <legend class="skip">창작물 정보</legend>

                    <div class="sight__left">
                        <div class="flex gap-column-16">
                            <label for="sight_grp_id_webtoon" class="radio-box2">
                                <input type="radio" name="sight_grp_id" id="sight_grp_id_webtoon" class="radio-box2__radio" value="webtoon" <?=get_checked("webtoon" , $sight_config["sight_grp_id"])?>>
                                <span class="radio-box2__label">그림</span>
                            </label>
                            <label for="sight_grp_id_novel" class="radio-box2">
                                <input type="radio" name="sight_grp_id" id="sight_grp_id_novel" class="radio-box2__radio" value="novel" <?=get_checked("novel" , $sight_config["sight_grp_id"])?>>
                                <span class="radio-box2__label">글</span>
                            </label>
                        </div>
                        <div class="flex flex-column gap-row-12">
                            <h3 class="text-size-normal text-color-g10 text-weight-medium">창작물 이미지</h3>

                            <div class="sight__img-use flex gap-column-16">
                                <label for="sight_img_use_y" class="radio-box">
                                    <input type="radio" name="sight_img_use" id="sight_img_use_y" class="radio-box__radio" value="1" <?=get_checked("1", $sight["sight_img_use"])?>>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">이미지 사용</span>
                                </label>
                                <label for="sight_img_use_n" class="radio-box">
                                    <input type="radio" name="sight_img_use" id="sight_img_use_n" class="radio-box__radio" value="0" <?=get_checked("0", $sight["sight_img_use"])?>>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">이미지 사용안함</span>
                                </label>
                            </div>

                            <div class="file-sight <?=$sight["sight_img"] ? "edit" : ""?> <?=$sight["sight_img_use"] ? "" : "none"?>">
                                <label for="sight_img" class="file-sight__box">
                                    <input type="file" name="sight_img" id="sight_img" class="file-upload sight-file file-sight__input" accept="<?=$sight_img_config["file_ext"]?>">
                                    <input type="hidden" name="sight_tmp_img" id="sight_tmp_img" value="">
                                
                                    <span class="file-sight__box-icon icon-plus icon-24"></span>
                                    <span class="file-sight__box-text">창작물 이미지</span>
                                    <span class="file-sight__box-text2">(580px X 720px)</span>
                                    <img src="<?=$sight["sight_img"]?>" alt="작품 이미지" id="sight__img-preview" class="file-sight__img">
                                    <div class="file-sight__none">
                                        <p class="file-sight__none-grp">
                                            <?php
                                            if($sight["sight_grp_id"] == "webtoon"){
                                                echo "그림";
                                            }else{
                                                echo "글";
                                            }
                                            ?>
                                        </p>
                                        <p class="file-sight__none-title text-truncate"><?=$sight["sight_name"]?></p>
                                        <p class="file-sight__none-name"><?=$pave_user["user_nick"]?></p>
                                    </div>
                                </label>
                            </div>

                            <div class=""></div>
                        </div>

                        <div class="flex flex-column gap-row-12">
                            <h3 class="text-size-normal text-color-g10 text-weight-medium">창작물 정보</h3>
                            <div class="flex gap-column-16">
                                <label for="sight_display_y" class="radio-box">
                                    <input type="radio" name="sight_display" id="sight_display_y" class="radio-box__radio" value="1" <?=get_checked("1", $sight["sight_display"])?>>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">공개</span>
                                </label>
                                <label for="sight_display_n" class="radio-box">
                                    <input type="radio" name="sight_display" id="sight_display_n" class="radio-box__radio" value="0" <?=get_checked("0", $sight["sight_display"])?>>
                                    <span class="radio-box__span"></span>
                                    <span class="radio-box__label">비공개</span>
                                </label>
                            </div>

                            <div class="input-box-t4">
                                <input type="text" name="sight_name" id="sight_name" class="input-box-t4__input" value="<?=$sight["sight_name"]?>" placeholder="작품명" minlength="<?=$sight_config["sight_name_min_len"]?>" maxlength="<?=$sight_config["sight_name_max_len"]?>">
                            </div>
                        </div>

                        <div class="flex flex-column gap-row-12">
                            <div class="flex flex-column gap-row-12">
                                <h3 class="text-size-normal text-color-g10 text-weight-medium">연령
                                    <div class="tooltip-box">
                                        <span class="tooltip-box__icon icon-help icon-12"></span>
                                        <div class="tooltip-box__content">
                                            <p>- 작품 연령입니다.</p>
                                            <p>- 전체(메인, 검색, 페이지 노출)</p>
                                            <p>- 12세(메인, 검색, 페이지 노출)</p>
                                            <p>- 15세(메인, 검색, 페이지 노출)</p>
                                            <p>- 19세(페이지 노출)</p>
                                        </div>
                                    </div>
                                </h3>
                                <div class="flex gap-6">
                                    <?php foreach ($sight_config["sight_age_list"] as $i => $age) { ?>
                                    <label for="sight_age_<?=$i?>" class="chip-radio-box">
                                        <input type="radio" name="sight_age" id="sight_age_<?=$i?>" class="chip-radio-box__radio" value="<?=$age?>" <?=get_checked($age, $sight["sight_age"])?>>
                                        <span class="chip-radio-box__label"><?=$age?></span>
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-column gap-row-12">
                            <div class="flex gap-column-6">
                                <h3 class="text-size-normal text-color-g10 text-weight-medium">해시태그</h3>
                                <span class="text-size-normal text-color-g7 text-weight-medium sight-hashtag-counter" data-max="<?=$sight_config["sight_hashtag_max_cnt"]?>"><?=count((array)$sight["sight_hashtag_list"])?>/<?=$sight_config["sight_hashtag_max_cnt"]?></span>
                            </div>
                            
                            <div class="hashtag-input">
                                <input type="text" name="sight_hashtag_text" id="sight_hashtag_text" class="hashtag-input__input" value="" maxlength="<?=$sight_config["sight_hashtag_max_len"]?>" placeholder="해시태그 (Enter 입력)">
                                <button type="button" id="sight_hashtag_add_button" class="hashtag-input__action">
                                    <span class="icon-plus icon-20"></span>
                                </button>
                            </div>

                            <div class="flex flex-wrap gap-6 bd-1-solid-g4 pd-10 bdrd-20 sight-hashtag-box">
                                <?php foreach ((array)$sight["sight_hashtag_list"] as $i => $hashtag) { ?>
                                <div class="chip-box">
                                    <span class="chip-box__label"><?=$hashtag?></span>
                                    <input type="hidden" name="sight_hashtag[]" value="<?=$hashtag?>">
                                    <button class="sight_hashtag_del_button chip-box__action icon-button icon-button-16"><span class="icon-x icon-16"></span></button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="sight__right">
                        <div class="sight__content">
                            <h3 class="text-size-normal text-color-g10 text-weight-medium">내용</h3>
                            <textarea name="sight_content" id="pave-editor" class="sight__content-input" cols="30" rows="10" style="width: 100%;"></textarea>
                        </div>


                        <div class="sight__submit">
                            <?php if($action == "update" && $sight["is_own"]){ ?>
                            <button type="button" class="upload-sight-delete-button text-size-lgx4 text-color-g8 text-weight-bold">삭제</button>
                                <?php } ?>
                            <button type="button" class="text-size-lgx4 text-color-g8 text-weight-bold modal-close-button" data-anchor="sight_form_modal">취소</button>
                            <button type="submit" class="text-size-lgx4 text-color-g11 text-weight-bold"><?=$sight_submit?></button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div id="modal__footer">
        </div>
    </div>
</div>