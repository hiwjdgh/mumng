<?php
if (!defined('_PAVE_')) exit;
?>
<div class="upload-epsd">
    <div class="upload-epsd__header">
        <h2 class="upload-epsd__header-title"><?=$epsd_form_title?></h2>
        <a href="<?=get_url(PAVE_GUIDE_URL, "group/upload")?>" class="upload-epsd__header-guide">연재 가이드</a>
        <button type="button" class="upload-epsd-close-button upload-epsd__header-close-button icon-button">
            <span class="icon-28 icon-x"></span>
        </button>
    </div>
    <div class="upload-epsd__header2">
        <span class="upload-epsd__header2-text">연재</span>
        <div class="upload-epsd__header2-box">
            <span class="upload-epsd__header2-date"><?=$epsd_date?></span>
            <span class="upload-epsd__header2-time"><?=$work["work_time"]?>시</span>
        </div>
    </div>
    <form class="upload-epsd__form" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
        <input type="hidden" name="work_id" id="work_id" value="<?=$work["work_id"]?>">
        <input type="hidden" name="epsd_id" id="epsd_id" value="<?=$epsd["epsd_id"]?>">
        <input type="hidden" name="epsd_cate" id="epsd_cate" value="epsd">
        <input type="hidden" name="action" id="action" value="<?=$action?>">
        <input type="hidden" name="epsd_upload_date" id="epsd_upload_date" value="<?=$calendar_date?>">
        <input type="hidden" name="epsd_display" id="epsd_display" value="<?=$work["work_display"]?>">

        <legend class="skip">회차정보</legend>
        <fieldset class="upload-epsd__fieldset">
        
            <?php if($action == "update" && $work["is_own"]){ ?>
            <button type="button" class="upload-epsd-submit-button upload-epsd-delete-button upload-epsd__delete-button">회차 삭제하기
                <div class="tooltip-box">
                    <span class="tooltip-box__icon icon-help icon-12"></span>
                    <div class="tooltip-box__content" style="left: 905px; top: 193px; display: none;">
                        <p>- 삭제 시 복구 불가합니다.</p>
                    </div>
                </div>
            </button>
            <?php } ?>
        </fieldset>

        <fieldset class="upload-epsd__fieldset">
            <div class="upload-epsd__no">
                <h3 class="upload-epsd__no-label">회차 No 자동입력</h3>
                <div class="upload-epsd__no-type">
                    <?php if($action == "create"){ ?>
                        <?php if($latest_epsd_no === null){ ?>
                        <label for="epsd_no_type_prlg" class="chip-radio-box">
                            <input type="radio" name="epsd_no_type" id="epsd_no_type_prlg" class="chip-radio-box__radio" value="prlg">
                            <span class="chip-radio-box__label">프롤로그</span>
                        </label>
                        <?php } ?>

                        <label for="epsd_no_type_epsd" class="chip-radio-box">
                            <input type="radio" name="epsd_no_type" id="epsd_no_type_epsd" class="chip-radio-box__radio" value="epsd" checked>
                            <span class="chip-radio-box__label">회차</span>
                        </label>
                        
                        <?php if($epsd_no > 1){ ?>
                        <label for="epsd_no_type_end" class="chip-radio-box">
                            <input type="radio" name="epsd_no_type" id="epsd_no_type_end" class="chip-radio-box__radio" value="end">
                            <span class="chip-radio-box__label">완결</span>
                        </label>
                        <?php } ?>

                    <?php }else{ ?>
                        <?php if($epsd["epsd_no_type"] == "prlg"){ ?>
                        <label for="epsd_no_type_prlg" class="chip-radio-box readonly">
                            <input type="radio" name="epsd_no_type" id="epsd_no_type_prlg" class="chip-radio-box__radio" value="prlg" checked readonly>
                            <span class="chip-radio-box__label">프롤로그</span>
                        </label>
                        <?php }else if($epsd["epsd_no_type"] == "epsd"){ ?>
                        <label for="epsd_no_type_epsd" class="chip-radio-box readonly">
                            <input type="radio" name="epsd_no_type" id="epsd_no_type_epsd" class="chip-radio-box__radio" value="epsd" checked readonly>
                            <span class="chip-radio-box__label">회차</span>
                        </label>
                        <?php }else if($epsd["epsd_no_type"] == "end"){ ?>
                        <label for="epsd_no_type_end" class="chip-radio-box readonly">
                            <input type="radio" name="epsd_no_type" id="epsd_no_type_end" class="chip-radio-box__radio" value="end" checked readonly>
                            <span class="chip-radio-box__label">완결</span>
                        </label>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="input-box-t4 focus">
                    <?php if($action == "create"){ ?>
                    <input type="text" name="epsd_no" id="epsd_no" class="input-box-t4__input" value="<?=$epsd_no?>" data-no="<?=$epsd_no?>" readonly>
                    <?php }else{ ?>
                    <input type="text" name="epsd_no" id="epsd_no" class="input-box-t4__input" value="<?=$epsd["epsd_no"] == 0 ? "프롤로그" : $epsd["epsd_no"] ?>" data-no="<?=$epsd["epsd_no"]?>" readonly>
                    <?php } ?>
                </div>
            </div>

            <div class="upload-epsd__info">
                <h3 class="upload-epsd__info-label">회차명</h3>
                <div class="upload-epsd__info-box">

                    <div class="upload-epsd__info-img file-epsd <?=$epsd["epsd_img"] ? "edit" : ""?>">
                        <label for="epsd_img" class="file-epsd__box">
                            <input type="file" name="epsd_img" id="epsd_img" class="file-upload epsd-file file-epsd__input" accept="<?=$epsd_img_config["file_ext"]?>">
                            <input type="hidden" name="epsd_tmp_img" id="epsd_tmp_img" value="">
                        
                            <span class="file-epsd__box-icon icon-plus icon-24"></span>
                            <span class="file-epsd__box-text">회차 이미지</span>
                            <span class="file-epsd__box-text2">(500px X 500px)</span>
                            <img src="<?=$epsd["epsd_img"]?>" alt="회차" id="epsd__img-preview" class="file-epsd__img">
                        </label>
                    </div>

                    <div class="upload-epsd__info-name input-box-t4">
                        <?php if($action == "create"){ ?>
                        <input type="text" name="epsd_name" id="epsd_name" class="input-box-t4__input" value="<?=$epsd_no?>화" minlength="<?=$epsd_config["epsd_name_min_len"]?>" maxlength="<?=$epsd_config["epsd_name_max_len"]?>" placeholder="회차명" required>
                        <?php }else{ ?>
                        <input type="text" name="epsd_name" id="epsd_name" class="input-box-t4__input" value="<?=$epsd["epsd_name"]?>" minlength="<?=$epsd_config["epsd_name_min_len"]?>" maxlength="<?=$epsd_config["epsd_name_max_len"]?>" placeholder="회차명" required>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="upload-epsd__copy">
                <div class="upload-epsd__copy-header">
                    <h3 class="upload-epsd__copy-header-label">
                        원고등록
                        <div class="tooltip-box">
                            <span class="tooltip-box__icon icon-help icon-12"></span>
                            <div class="tooltip-box__content">
                                <p>- 최대 <?=$epsd_copy_config["file_cnt"]?>개 등록가능</p>
                                <p>- <?=$epsd_copy_config["file_ext"]?> 파일만 업로드가능</p>
                                <p>- 파일 1개 용량 <?=$epsd_copy_config["file_size"].$epsd_copy_config["file_unit"]?>, 총 용량 <?=$epsd_copy_config["file_total_size"].$epsd_copy_config["file_total_unit"]?></p>
                                <p>- 가로 <?=$epsd_copy_config["file_width"]?>px(최적)</p>
                                <p>- 세로 제한 없음</p>
                            </div>
                        </div>
                    </h3>
                    <label for="epsd_copy" class="upload-epsd__copy-header-upload-button button button-t2 button-s2">
                        <input type="file" name="epsd_copy[]" id="epsd_copy" style="display: none;" multiple accept="<?=$epsd_copy_config["file_ext"]?>" data-max="<?=$epsd_copy_config["file_cnt"]?>">
                        <span class="icon-plus icon-16"></span>
                        <span class="button__text">업로드</span>
                    </label>
                    <button type="button" class="upload-epsd__copy-header-preview-button epsd-preview button button-t2 button-s2">
                        <span class="button__text">미리보기</span>
                    </button>
                </div>

                <div class="upload-epsd__copy-progress">
                    <div class="upload-epsd__copy-progress-bar" data-now="<?=$epsd_copy_total_capacity?>" data-max="<?=$epsd_copy_total_max_capacity?>">
                        <div class="upload-epsd__copy-progress-slider" style="width: <?=$epsd_copy_total_ratio?>%;"></div>
                    </div>
                    <span class="upload-epsd__copy-progress-size"><?=Converter::display_byte_format($epsd_copy_total_capacity)?></span>
                    <span class="upload-epsd__copy-progress-max"><?=$epsd_copy_config["file_total_size"].$epsd_copy_config["file_total_unit"]?></span>
                </div>

                <div class="upload-epsd__copy-list-box">
                    <p class="upload-epsd__copy-list-box-text"></p>
                    <ul class="upload-epsd__copy-list">
                        <?php if(pave_is_array($epsd_copy_list)){ ?>
                            <?php foreach ($epsd_copy_list as $i => $copy) { ?>
                                <?php if($i == $epsd["epsd_copyright"]){ ?>
                                <li class="upload-epsd__copy-item">
                                    <span class="upload-epsd__copy-item-hamburger icon-hamburger icon-16"></span>
                                    <span class="upload-epsd__copy-item-name">저작권 표시</span>
                                    <span class="upload-epsd__copy-item-size"></span>
                                    <input type="hidden" name="epsd_copyright" id="epsd_copyright" value="<?=$epsd["epsd_copyright"]?>">
                                </li>
                                <?php } ?>
                                <li class="upload-epsd__copy-item">
                                    <span class="upload-epsd__copy-item-hamburger icon-hamburger icon-16"></span>
                                    <span class="upload-epsd__copy-item-name text-truncate"><?=$copy["file_orgn_name"]?></span>
                                    <span class="upload-epsd__copy-item-size"><?=Converter::display_byte_format($copy["file_size"])?></span>
                                    <button type="button" class="upload-epsd__copy-item-delete-button icon-button icon-button-16" data-size="<?=$copy["file_size"]?>">
                                        <span class="icon-x icon-16"></span>
                                    </button>
                                    <input type="hidden" name="epsd_tmp_copy[]" value="<?=htmlspecialchars(json_encode(array("name" => $copy["file_full_name"], "file_no" => $copy["file_no"]), JSON_UNESCAPED_UNICODE))?>">
                                </li>

                            <?php } ?>
                            <?php if($i+1 == $epsd["epsd_copyright"]){ ?>
                            <li class="upload-epsd__copy-item">
                                <span class="upload-epsd__copy-item-hamburger icon-hamburger icon-16"></span>
                                <span class="upload-epsd__copy-item-name">저작권 표시</span>
                                <span class="upload-epsd__copy-item-size"></span>
                                <input type="hidden" name="epsd_copyright" id="epsd_copyright" value="<?=$epsd["epsd_copyright"]?>">
                            </li>
                            <?php } ?>
                        <?php }else{ ?>
                            <li class="upload-epsd__copy-item">
                                <span class="upload-epsd__copy-item-hamburger icon-hamburger icon-16"></span>
                                <span class="upload-epsd__copy-item-name">저작권 표시</span>
                                <span class="upload-epsd__copy-item-size"></span>
                                <input type="hidden" name="epsd_copyright" id="epsd_copyright" value="0">
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <script>
                    var copy_sortabled = 
                    $(".upload-epsd__copy-list").sortable({
                        placeholder: "ui-state-highlight",
                        forcePlaceholderSize: true,
                        'start': function (event, ui) {
                            ui.placeholder.css({
                                display: "block",
                                height: "28px",
                                backgroundColor: "#F7F7F7",
                                border: "1px solid #E5E5E5",
                                padding: "4px 8px",
                                borderRadius: "20px",
                                boxSizing: "border-box",
                            })
                        },
                        update: function(event, ui){
                            $(".upload-epsd__copy-item").each(function(i, elmt){
                                if($(elmt).find("#epsd_copyright").length > 0){
                                    $("#epsd_copyright").val(i);
                                }
                            });
                           
                        }
                    });
                </script>
            </div>

            <div class="upload-epsd__eplg">
                <h3 class="upload-epsd__eplg-label">작가 에필로그</h3>
                <div class="textarea-box">
                    <textarea name="epsd_eplg" id="epsd_eplg" class="textarea-box__textarea" placeholder="작가 에필로그를 입력해주세요" maxlength="<?=$epsd_config["epsd_eplg_max_len"]?>"><?=$epsd["epsd_eplg"]?></textarea>
                    <div class="textarea-box__counter">
                        <span class="textarea-box__counter-now">0</span>
                        <span class="textarea-box__counter-max">/ <?=$epsd_config["epsd_eplg_max_len"]?>자</span>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="upload-epsd__fieldset">
            <div class="upload-epsd__agree">
                <label for="epsd_agree" class="check-box">
                    <input type="checkbox" name="epsd_agree" id="epsd_agree" class="check-box__check" value="1" <?=get_checked("1", $epsd["epsd_agree"])?>>
                    <span class="check-box__span"></span>
                    <span class="check-box__label">연재 운영원칙 동의</span>
                    <a href="<?=get_url(PAVE_LEGAL_URL, "commerce")?>" target="_blank" class="check-box__more"><span class="skip">더보기</span><span class="icon-right icon-20"></span></a>
                </label>
            </div>

            <div class="upload-epsd__update">
                <button type="button" class="upload-epsd-submit-button upload-epsd-close-button upload-epsd__cancel-button">취소</button>
                <?php if($work["is_own"]){ ?>
                    <?php if($action == "create"){ ?>
                    <button type="button" class="upload-epsd-submit-button upload-epsd-save-button upload-epsd__save-button">임시저장</button>
                    <button type="submit" class="upload-epsd-submit-button upload-epsd__upload-button">연재</button>
                    <?php }else{ ?>
                    <?php if($epsd["epsd_state"] == "save"){ ?>
                    <button type="button" class="upload-epsd-submit-button upload-epsd-save-button upload-epsd__save-button">임시저장</button>
                    <?php } ?>
                    <button type="submit" class="upload-epsd-submit-button upload-epsd__upload-button">수정</button>
                    <?php } ?>
                <?php } ?>
            </div>
        </fieldset>
    </form>
</div>