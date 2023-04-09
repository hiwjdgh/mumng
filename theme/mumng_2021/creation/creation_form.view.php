<?php
if (!defined('_PAVE_')) exit;
?>
<section class="creation__header">
    <h1 class="creation__title"><?=$creation_form_title?></h1>
</section>
<section class="creation__content">
    <form class="creation__form" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
        <input type="hidden" name="creation_no" id="creation_no" value="<?=$creation["creation_no"]?>">
        <input type="hidden" name="action" id="action" value="<?=$action?>">
    
        <fieldset class="creation__fieldset gap-row-24">
            <legend class="skip">창작의뢰 정보</legend>
            <div class="form-group horizontal">
                <p class="form-group__label">구분</p>
                <div class="form-group__box">
                    <div class="chip-group chip-group--radio">
                        <div class="chip-group__box">
                            <label for="creation_ratio_0" class="chip-radio <?=get_checked("commission", $creation["creation_field"])?>">
                                <input type="radio" name="creation_field" id="creation_ratio_0" class="chip-group__input chip-radio__input" value="commission" <?=get_checked("commission", $creation["creation_field"])?> required>
                                <span class="chip-radio__label">커미션</span>
                            </label>
                            <label for="creation_ratio_1" class="chip-radio <?=get_checked("outsourcing", $creation["creation_field"])?>">
                                <input type="radio" name="creation_field" id="creation_ratio_1" class="chip-group__input chip-radio__input" value="outsourcing" <?=get_checked("outsourcing", $creation["creation_field"])?> required>
                                <span class="chip-radio__label">외주</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group horizontal">
                <p class="form-group__label">창작 의뢰 제목</p>
                <div class="form-group__box">
                    <div class="input-t2">
                        <div class="input-t2__box">
                            <input type="text" name="creation_name" id="creation_name" class="input-t2__input" value="<?=$creation["creation_name"]?>" placeholder="창작 의뢰 제목" title="창작 의뢰 제목" minlength="<?=$creation_config["creation_name_min_len"]?>" maxlength="<?=$creation_config["creation_name_max_len"]?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group horizontal">
                <p class="form-group__label">창작 의뢰 상세 내용</p>
                <div class="form-group__box">
                    <div class="textarea-t1">
                        <div class="textarea-t1__box">
                            <textarea name="creation_content" id="creation_content" class="textarea-t1__textarea" placeholder="창작 의뢰 상세 내용" maxlength="<?=$creation_config["creation_content_max_len"]?>"><?=nl2br($creation["creation_content"])?></textarea>
    
                            <div class="textarea-t1__counter">
                                <span class="textarea-t1__counter-now">0</span>
                                <span class="textarea-t1__counter-max">/ <?=$creation_config["creation_content_max_len"]?>자</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group horizontal">
                <p class="form-group__label">사용용도</p>
                <div class="form-group__box">
                    <div class="input-t2">
                        <div class="input-t2__box">
                            <input type="text" name="creation_purpose" id="creation_purpose" class="input-t2__input" value="<?=$creation["creation_purpose"]?>" placeholder="사용용도" title="사용용도" minlength="<?=$creation_config["creation_purpose_min_len"]?>" maxlength="<?=$creation_config["creation_purpose_max_len"]?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group horizontal">
                <p class="form-group__label">창작 의뢰 EXP</p>
                <div class="form-group__box">
                    <div class="input-t2">
                        <div class="input-t2__box">
                            <input type="number" name="creation_exp" id="creation_exp" class="input-t2__input" value="<?=$creation["creation_exp"]?>" placeholder="창작 의뢰 EXP" title="창작 의뢰 EXP" min="1000" step="<?=$creation_config["creation_exp_step"]?>" required>
                            <div class="input-t2__action show">
                                EXP
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group horizontal">
                <p class="form-group__label">창작 의뢰 EXP 제안 여부</p>
                <div class="form-group__box">
                    <div class="chip-group chip-group--radio">
                        <div class="chip-group__box">
                            <label for="creation_exp_request_0" class="chip-radio <?=get_checked("1", $creation["creation_exp_request"])?>">
                                <input type="radio" name="creation_exp_request" id="creation_exp_request_0" class="chip-group__input chip-radio__input" value="1" <?=get_checked("1", $creation["creation_exp_request"])?> required>
                                <span class="chip-radio__label">가능</span>
                            </label>
                            <label for="creation_exp_request_1" class="chip-radio <?=get_checked("0", $creation["creation_exp_request"])?>">
                                <input type="radio" name="creation_exp_request" id="creation_exp_request_1" class="chip-group__input chip-radio__input" value="0" <?=get_checked("0", $creation["creation_exp_request"])?> required>
                                <span class="chip-radio__label">불가능</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group horizontal">
                <p class="form-group__label">마감일</p>
                <div class="form-group__box">
                    <div class="input-t2">
                        <div class="input-t2__box">
                            <input type="date" name="creation_end_date" id="creation_end_date" class="input-t2__input" value="<?=Converter::display_time($creation["creation_end_dt"])?>" min="<?=Converter::display_time(PAVE_TIME_YMD."+ 1 days")?>" title="마감일" onkeydown="return false" required>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="creation__fieldset gap-row-24 step__content">
            <legend class="skip">창작의뢰 요구사항 정보</legend>
            
            <div class="form-group horizontal">
                <p class="form-group__label">데포르메</p>
                <div class="form-group__box">
                    <div class="chip-group chip-group--radio">
                        <div class="chip-group__box">
                            <label for="creation_ratio_sd" class="chip-radio <?=get_checked("SD", $creation["creation_ratio"])?>">
                                <input type="radio" name="creation_ratio" id="creation_ratio_sd" class="chip-group__input chip-radio__input" value="SD" <?=get_checked("SD", $creation["creation_ratio"])?> required>
                                <span class="chip-radio__label">SD(2등신)</span>
                            </label>
                            <label for="creation_ratio_md" class="chip-radio <?=get_checked("MD", $creation["creation_ratio"])?>">
                                <input type="radio" name="creation_ratio" id="creation_ratio_md" class="chip-group__input chip-radio__input" value="MD" <?=get_checked("MD", $creation["creation_ratio"])?> required>
                                <span class="chip-radio__label">MD(4~6등신)</span>
                            </label>
                            <label for="creation_ratio_ld" class="chip-radio <?=get_checked("LD", $creation["creation_ratio"])?>">
                                <input type="radio" name="creation_ratio" id="creation_ratio_ld" class="chip-group__input chip-radio__input" value="LD" <?=get_checked("LD", $creation["creation_ratio"])?> required>
                                <span class="chip-radio__label">LD(6등신 이상)</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group horizontal">
                <p class="form-group__label">사이즈</p>
                <div class="form-group__box">
                    <div class="chip-group chip-group--radio">
                        <div class="chip-group__box">
                            <label for="creation_size_0" class="chip-radio <?=get_checked("두상", $creation["creation_size"])?>">
                                <input type="radio" name="creation_size" id="creation_size_0" class="chip-group__input chip-radio__input" value="두상" <?=get_checked("두상", $creation["creation_size"])?> required>
                                <span class="chip-radio__label">두상(머리 ~ 목)</span>
                            </label>
                            <label for="creation_size_1" class="chip-radio <?=get_checked("흉상", $creation["creation_size"])?>">
                                <input type="radio" name="creation_size" id="creation_size_1" class="chip-group__input chip-radio__input" value="흉상" <?=get_checked("흉상", $creation["creation_size"])?> required>
                                <span class="chip-radio__label">흉상(머리 ~ 명치)</span>
                            </label>
                            <label for="creation_size_2" class="chip-radio <?=get_checked("반신", $creation["creation_size"])?>">
                                <input type="radio" name="creation_size" id="creation_size_2" class="chip-group__input chip-radio__input" value="반신" <?=get_checked("반신", $creation["creation_size"])?> required>
                                <span class="chip-radio__label">반신(머리 ~ 허벅지)</span>
                            </label>
                            <label for="creation_size_3" class="chip-radio <?=get_checked("전신", $creation["creation_size"])?>">
                                <input type="radio" name="creation_size" id="creation_size_3" class="chip-group__input chip-radio__input" value="전신" <?=get_checked("전신", $creation["creation_size"])?> required>
                                <span class="chip-radio__label">전신</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group horizontal">
                <p class="form-group__label">배경화면 여부</p>
                <div class="form-group__box">
                    <div class="chip-group chip-group--radio">
                        <div class="chip-group__box">
                            <label for="creation_background_0" class="chip-radio <?=get_checked("1", $creation["creation_background"])?>">
                                <input type="radio" name="creation_background" id="creation_background_0" class="chip-group__input chip-radio__input" value="1" <?=get_checked("1", $creation["creation_background"])?> required>
                                <span class="chip-radio__label">예</span>
                            </label>
                            <label for="creation_background_1" class="chip-radio <?=get_checked("0", $creation["creation_background"])?>">
                                <input type="radio" name="creation_background" id="creation_background_1" class="chip-group__input chip-radio__input" value="0" <?=get_checked("0", $creation["creation_background"])?> required>
                                <span class="chip-radio__label">아니오</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="form-group horizontal">
                <p class="form-group__label">배경화면 상세 요청사항</p>
                <div class="form-group__box">
                    <div class="textarea-t1">
                        <div class="textarea-t1__box">
                            <textarea name="creation_background_content" id="creation_background_content" class="textarea-t1__textarea" placeholder="배경화면 상세 요청사항" maxlength="<?=$creation_config["creation_add_content_max_len"]?>"><?=nl2br($creation["creation_background_content"])?></textarea>
    
                            <div class="textarea-t1__counter">
                                <span class="textarea-t1__counter-now">0</span>
                                <span class="textarea-t1__counter-max">/ <?=$creation_config["creation_add_content_max_len"]?>자</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="form-group horizontal">
                <p class="form-group__label">소품 여부</p>
                <div class="form-group__box">
                    <div class="chip-group chip-group--radio">
                        <div class="chip-group__box">
                            <label for="creation_accessory_0" class="chip-radio <?=get_checked("1", $creation["creation_accessory"])?>">
                                <input type="radio" name="creation_accessory" id="creation_accessory_0" class="chip-group__input chip-radio__input" value="1" <?=get_checked("1", $creation["creation_accessory"])?> required>
                                <span class="chip-radio__label">예</span>
                            </label>
                            <label for="creation_accessory_1" class="chip-radio <?=get_checked("0", $creation["creation_accessory"])?>">
                                <input type="radio" name="creation_accessory" id="creation_accessory_1" class="chip-group__input chip-radio__input" value="0" <?=get_checked("0", $creation["creation_accessory"])?> required>
                                <span class="chip-radio__label">아니오</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="form-group horizontal">
                <p class="form-group__label">소품 상세 요청사항</p>
                <div class="form-group__box">
                    <div class="textarea-t1">
                        <div class="textarea-t1__box">
                            <textarea name="creation_accessory" id="creation_accessory" class="textarea-t1__textarea" placeholder="소품 상세 요청사항" maxlength="<?=$creation_config["creation_add_content_max_len"]?>"><?=nl2br($creation["creation_background_content"])?></textarea>
    
                            <div class="textarea-t1__counter">
                                <span class="textarea-t1__counter-now">0</span>
                                <span class="textarea-t1__counter-max">/ <?=$creation_config["creation_add_content_max_len"]?>자</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="creation__fieldset gap-row-24 step__content">
            <legend class="skip">창작의뢰 추가옵션 정보</legend>

            <div class="form-group horizontal">
                <p class="form-group__label">성인물 여부</p>
                <div class="form-group__box">
                    <div class="chip-group chip-group--radio">
                        <div class="chip-group__box">
                            <label for="creation_adult_0" class="chip-radio <?=get_checked("1", $creation["creation_adult"])?>">
                                <input type="radio" name="creation_adult" id="creation_adult_0" class="chip-group__input chip-radio__input" value="1" <?=get_checked("1", $creation["creation_adult"])?> required>
                                <span class="chip-radio__label">예</span>
                            </label>
                            <label for="creation_adult_1" class="chip-radio <?=get_checked("0", $creation["creation_adult"])?>">
                                <input type="radio" name="creation_adult" id="creation_adult_1" class="chip-group__input chip-radio__input" value="0" <?=get_checked("0", $creation["creation_adult"])?> required>
                                <span class="chip-radio__label">아니오</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="creation__submit">
                <?php if($action == "update" && $creation["is_own"]){ ?>
                <button type="button" class="upload-creation-delete-button text-size-lgx4 text-color-g8 text-weight-bold">삭제</button>
                    <?php } ?>
                <button type="submit" class="text-size-lgx4 text-color-g11 text-weight-bold"><?=$creation_submit?></button>
            </div>
        </fieldset>
    </form>
</section>

<script>
    $(function(){
        creation_form_obj.init();
       
        <?php if($action == "create" || ($action == "update" && $creation["creation_state"] == "ready")){ ?>
            
        $(window).on("beforeunload", function(e){
            e.preventDefault();

            if($(".creation__form").data("change")){
                creation_form_obj.save_creation($(".creation__form"));
            }else{
                
            }
        });
        <?php } ?>
        <?php if($action == "create" && $tmp_creation){ ?>
            modals.load("creation_temp", "임시저장된 창작의뢰", JSON.stringify({}));
        <?php } ?>
    });
</script>