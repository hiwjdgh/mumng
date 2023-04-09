<?php
if (!defined('_PAVE_')) exit;
?>
<div class="upload-work">
    <div class="upload-work__header">
        <h2 class="upload-work__title"><?=$work_form_title?></h2>
        <a href="<?=get_url(PAVE_GUIDE_URL, "group/upload")?>" class="upload-work__guide" target="_blank">연재 가이드</a>

        
        <button type="button" class="upload-work-close-button upload-work__close-button icon-button">
            <span class="icon-28 icon-x"></span>
        </button>
    </div>
    <div class="upload-work__group">
        <h3 class="upload-work__group-text">웹툰</h3>
    </div>
    <form class="upload-work__form" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
        <input type="hidden" name="work_id" id="work_id" value="<?=$work["work_id"]?>">
        <input type="hidden" name="action" id="action" value="<?=$action?>">

        <fieldset class="upload-work__fieldset">
            <legend class="skip">작품정보</legend>

            <div class="upload-work__img">
                <h3 class="upload-work__img-label">작품 이미지</h3>

                <div class="file-work <?=$work["work_img"] ? "edit" : ""?>">
                    <label for="work_img" class="file-work__box">
                        <input type="file" name="work_img" id="work_img" class="file-upload work-file file-work__input" accept="<?=$work_img_config["file_ext"]?>">
                        <input type="hidden" name="work_tmp_img" id="work_tmp_img" value="">
                    
                        <span class="file-work__box-icon icon-plus icon-24"></span>
                        <span class="file-work__box-text">프로필 등록</span>
                        <span class="file-work__box-text2">(580px X 720px)</span>
                        <img src="<?=$work["work_img"]?>" alt="작품 이미지" id="work__img-preview" class="file-work__img">
                    </label>
                </div>
            </div>

            <div class="upload-work__info">
                <h3 class="upload-work__info-label">작품정보</h3>
                <div class="upload-work__info-display">
                    <label for="work_display_y" class="radio-box">
                        <input type="radio" name="work_display" id="work_display_y" class="radio-box__radio" value="1" <?=get_checked("1", $work["work_display"])?>>
                        <span class="radio-box__span"></span>
                        <span class="radio-box__label">공개</span>
                    </label>
                    <label for="work_display_n" class="radio-box">
                        <input type="radio" name="work_display" id="work_display_n" class="radio-box__radio" value="0" <?=get_checked("0", $work["work_display"])?>>
                        <span class="radio-box__span"></span>
                        <span class="radio-box__label">비공개</span>
                    </label>
                </div>

                <div class="upload-work__info-name input-box-t4">
                    <input type="text" name="work_name" id="work_name" class="input-box-t4__input" value="<?=$work["work_name"]?>" placeholder="작품명" minlength="<?=$work_config["work_name_min_len"]?>" maxlength="<?=$work_config["work_name_max_len"]?>" required>
                </div>

                <div class="upload-work__info-description textarea-box">
                    <textarea name="work_description" id="work_description" class="textarea-box__textarea" placeholder="줄거리" required maxlength="<?=$work_config["work_description_max_len"]?>"><?=$work["work_description"]?></textarea>
                    <div class="textarea-box__counter">
                        <span class="textarea-box__counter-now"><?=mb_strlen($work["work_description"], "UTF-8")?: "0" ?></span>
                        <span class="textarea-box__counter-max">/ <?=$work_config["work_description_max_len"]?>자</span>
                    </div>
                </div>
            </div>

            <?php if($action == "update" && $work["is_own"]){ ?>  
            <div class="upload-work__delete">
                <button type="button" class="upload-work-delete-button upload-work__delete-button" data-id="<?=$work["work_id"]?>">작품 삭제하기</button>
                <div class="tooltip-box">
                    <span class="tooltip-box__icon icon-help icon-12"></span>
                    <div class="tooltip-box__content">
                        <p>- 삭제시 주의</p>
                        <p>- 복구 불가</p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </fieldset>
        <fieldset class="upload-work__fieldset">
            <div class="upload-work__day">
                <h3 class="upload-work__day-label">연재요일
                    <div class="tooltip-box">
                        <span class="tooltip-box__icon icon-help icon-12"></span>
                        <div class="tooltip-box__content">
                            <p>- 회차가 업로드되는 요일입니다.</p>
                        </div>
                    </div>
                </h3>
                <div class="upload-work__day-box">
                    <?php foreach ($work_config["work_day_list"] as $i => $day) { ?>
                    <label for="work_day_<?=$i?>" class="chip-day-box chip-day-box-28 <?=get_checked($day, $work["work_day_list"])?>">
                        <input type="checkbox" name="work_day[]" id="work_day_<?=$i?>" class="chip-day-box__check" value="<?=$day?>" <?=get_checked($day, $work["work_day_list"])?>>
                        <span class="chip-day-box__label"><?=$day?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>

            <div class="upload-work__time">
                <h3 class="upload-work__time-label">연재시간
                    <div class="tooltip-box">
                        <span class="tooltip-box__icon icon-help icon-12"></span>
                        <div class="tooltip-box__content">
                            <p>- 회차가 업로드되는 시간입니다.</p>
                        </div>
                    </div>
                </h3>
                <div class="upload-work__time-box select-box-t2">
                    <select name="work_time" id="work_time" class="select-box-t2__select">
                        <?php foreach ($work_config["work_time_list"] as $i => $time) { ?>
                        <option value="<?=$time?>" <?=get_selected($time, $work["work_time"])?>><?=$time?>시</option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="upload-work__age">
                <h3 class="upload-work__age-label">연령
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
                <div class="upload-work__age-box">
                    <?php foreach ($work_config["work_age_list"] as $i => $age) { ?>
                    <label for="work_age_<?=$i?>" class="chip-radio-box">
                        <input type="radio" name="work_age" id="work_age_<?=$i?>" class="chip-radio-box__radio" value="<?=$age?>" <?=get_checked($age, $work["work_age"])?>>
                        <span class="chip-radio-box__label"><?=$age?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>

            <div class="upload-work__genre">
                <div class="upload-work__genre-inner-box">
                    <h3 class="upload-work__genre-label">장르</h3>
                    <span class="upload-work__genre-counter" data-max="<?=$work_config["work_genre_max_cnt"]?>"><?=count($work["work_genre_list"])?>/<?=$work_config["work_genre_max_cnt"]?></span>
                </div>
                <div class="upload-work__genre-box">
                    <?php foreach ($work_config["work_genre_list"] as $i => $genre) { ?>
                    <label for="genre_<?=$i?>" class="chip-check-box <?=get_checked($genre, $work["work_genre_list"])?>">
                        <input type="checkbox" name="work_genre[]" id="genre_<?=$i?>" class="chip-check-box__check" value="<?=$genre?>" <?=get_checked($genre, $work["work_genre_list"])?>>
                        <span class="chip-check-box__label"><?=$genre?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>
            
            <div class="upload-work__hashtag">
                <div class="upload-work__hashtag-inner-box">
                    <h3 class="upload-work__hashtag-label">해시태그</h3>
                    <span class="upload-work__hashtag-counter" data-max="<?=$work_config["work_hashtag_max_cnt"]?>"><?=count($work["work_hashtag_list"])?>/<?=$work_config["work_hashtag_max_cnt"]?></span>
                </div>

                <div class="upload-work__hashtag-form hashtag-input">
                    <input type="text" name="work_hashtag_text" id="work_hashtag_text" class="hashtag-input__input" value="" maxlength="<?=$work_config["work_hashtag_max_len"]?>" placeholder="해시태그 (Enter 입력)">
                    <button type="button" id="work_hashtag_add_button" class="upload-work-hashtag-add-button hashtag-input__action">
                        <span class="icon-plus icon-20"></span>
                    </button>
                </div>
                <div class="upload-work__hashtag-box">
                    <?php foreach ((array)$work["work_hashtag_list"] as $i => $hashtag) { ?>
                    <div class="chip-box">
                        <span class="chip-box__label"><?=$hashtag?></span>
                        <input type="hidden" name="work_hashtag[]" value="<?=$hashtag?>">
                        <button class="upload-work-hashtag-delete-button work_hashtag_del_button chip-box__action icon-button icon-button-16"><span class="icon-x icon-16"></span></button>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </fieldset>
        <fieldset class="upload-work__fieldset">
            <div class="upload-work__with">
                <div class="upload-work__with-header">
                    <div class="upload-work__with-header-inner-box">
                        <h3 class="upload-work__with-label">함께한 작가</h3>
                        <span class="upload-work__with-counter" data-max="<?=$work_config["work_with_max_cnt"]?>"><?=count($work["work_with_user"])?>/<?=$work_config["work_with_max_cnt"]?></span>
                    </div>
                    <button type="button" class="upload-work-with-add-button upload-work__with-add-button button button-t2 button-s2">
                        <span class="icon-plus icon-16"></span>
                        <span class="button__text">추가하기</span>
                    </button>
                </div>
                <ul class="upload-work__with-box">
                    <?php foreach ((array)$work["work_with_user"] as $i => $with) { ?>
                    <li class="upload-work__with-item">
                        <img src="<?=$with["user_img"]?>" alt="프로필 이미지" class="upload-work__with-item-img">
                        <div class="upload-work__with-item-nick-box">
                            <span class="upload-work__with-item-nick"><?=$with["user_nick"]?></span>
                            <small class="upload-work__with-item-field"><?=$with["user_field"]?></small>
                        </div>
                        <button type="button" class="upload-work__with-item-delete-button icon-button icon-button-20">
                            <span class="icon-x icon-20"></span>
                        </button>
                        <input type="hidden" name="work_with[]" value="<?=$with["user_no"]?>">
                    </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="upload-work__commerce">
                <h3 class="upload-work__commerce-label">연재 EXP</h3>
                <?php if(!$pave_user["user_commerce_state"]){ ?>
                <div class="upload-work__commerce-ad"></div>
                <?php } ?>


                <div class="upload-work__commerce-use-box">
                    <label for="work_free_n" class="radio-box <?=$pave_user["user_commerce_state"] ? "" : "readonly" ?>">
                        <input type="radio" name="work_free" id="work_free_n" class="radio-box__radio" value="1" <?=get_checked("1", $work["work_free"])?> <?=$pave_user["user_commerce_state"] ? "" : "disabled" ?>>
                        <span class="radio-box__span"></span>
                        <span class="radio-box__label">무료</span>
                    </label>

                    <label for="work_free_y" class="radio-box <?=$pave_user["user_commerce_state"] ? "" : "readonly" ?>">
                        <input type="radio" name="work_free" id="work_free_y" class="radio-box__radio" value="0" <?=get_checked("0", $work["work_free"])?> <?=$pave_user["user_commerce_state"] ? "" : "disabled" ?>>
                        <span class="radio-box__span"></span>
                        <span class="radio-box__label">유료</span>
                    </label>
                </div>
                <?php if($pave_user["user_commerce_state"]){ ?>
                <div class="upload-work__commerce-free-box" style="display: <?=$work["work_free"] ? "" : "none" ?>">
                    <div class="upload-work__commerce-exp">
                        <label class="upload-work__commerce-exp-label">회차기본 EXP</label>
                        <div class="upload-work__commerce-exp-input input-box-t5 readonly">
                            <span class="input-box-t5__input">0</span>
                        </div>
                    </div>
                    <div class="upload-work__commerce-exp">
                        <label for="work_preview2_exp" class="upload-work__commerce-exp-label">미리보기 EXP</label>
                        <div class="upload-work__commerce-exp-input input-box-t5">
                            <input type="number" name="work_preview2_exp" id="work_preview2_exp" class="input-box-t5__input" value="<?=$work["work_preview2_exp"]?>" min="0" max="5000" step="10">
                        </div>
                    </div>
                    <div class="upload-work__commerce-exp">
                        <label for="work_keep2_exp" class="upload-work__commerce-exp-label">회차소장 EXP</label>
                        <div class="upload-work__commerce-exp-input input-box-t5">
                            <input type="number" name="work_keep2_exp" id="work_keep2_exp" class="input-box-t5__input" value="<?=$work["work_keep2_exp"]?>" min="0" max="5000" step="10">
                        </div>
                    </div>
                    <?php if($work["work_state"] == "end"){ ?>
                    <div class="upload-work__commerce-exp">
                        <label for="work_end2_exp" class="upload-work__commerce-exp-label">완결소장 EXP</label>
                        <div class="upload-work__commerce-exp-input input-box-t5">
                            <input type="number" name="work_end2_exp" id="work_end2_exp" class="input-box-t5__input" value="<?=$work["work_end2_exp"]?>" min="0" max="5000" step="10">
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="upload-work__commerce-nonfree-box" style="display: <?=$work["work_free"] ? "none" : "" ?>">
                    <div class="upload-work__commerce-exp">
                        <label for="work_rent_exp" class="upload-work__commerce-exp-label">회차기본 EXP</label>
                        <div class="upload-work__commerce-exp-input input-box-t5">
                            <input type="number" name="work_rent_exp" id="work_rent_exp" class="input-box-t5__input" value="<?=$work["work_rent_exp"]?>" min="0" max="5000" step="10">
                        </div>
                    </div>
                    <div class="upload-work__commerce-exp">
                        <label for="work_preview_exp" class="upload-work__commerce-exp-label">미리보기 EXP</label>
                        <div class="upload-work__commerce-exp-input input-box-t5">
                            <input type="number" name="work_preview_exp" id="work_preview_exp" class="input-box-t5__input" value="<?=$work["work_preview_exp"]?>" min="0" max="5000" step="10">
                        </div>
                    </div>

                    

                    <div class="upload-work__commerce-exp">
                        <label for="work_keep_exp" class="upload-work__commerce-exp-label">회차소장 EXP</label>
                        <div class="upload-work__commerce-exp-input input-box-t5">
                            <input type="number" name="work_keep_exp" id="work_keep_exp" class="input-box-t5__input" value="<?=$work["work_keep_exp"]?>" min="0" max="5000" step="10">
                        </div>
                    </div>
                    <?php if($work["work_state"] == "end"){ ?>
                    <div class="upload-work__commerce-exp">
                        <label for="work_end_exp" class="upload-work__commerce-exp-label">완결소장 EXP</label>
                        <div class="upload-work__commerce-exp-input input-box-t5">
                            <input type="number" name="work_end_exp" id="work_end_exp" class="input-box-t5__input" value="<?=$work["work_end_exp"]?>" min="0" max="5000" step="10">
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>

            <div class="upload-work__agree">
                <label for="work_agree" class="check-box">
                    <input type="checkbox" name="work_agree" id="work_agree" class="check-box__check" value="1" <?=get_checked("1", $work["work_agree"])?>>
                    <span class="check-box__span"></span>
                    <span class="check-box__label">연재 운영원칙 동의</span>
                    <a href="/legal/commerce" target="_blank" class="check-box__more"><span class="skip">더보기</span><span class="icon-right icon-20"></span></a>
                </label>
            </div>

            <div class="upload-work__update">
                <button type="button" class="upload-work-close-button upload-work__update-cancel-button">취소</button>
                <?php if($action == "create"){ ?>
                <button type="submit" class="upload-work__update-submit">등록</button>
                <?php }else{ ?>
                <?php if($work["is_own"]){ ?>
                <button type="submit" class="upload-work__update-submit">편집</button>
                <?php } ?>
                <?php } ?>
            </div>
        </fieldset>
    </form>
</div>