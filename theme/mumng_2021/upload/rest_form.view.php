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
        <input type="hidden" name="epsd_cate" id="epsd_cate" value="rest">
        <input type="hidden" name="action" id="action" value="<?=$action?>">
        <input type="hidden" name="epsd_upload_date" id="epsd_upload_date" value="<?=$calendar_date?>">
        <input type="hidden" name="epsd_display" id="epsd_display" value="<?=$work["work_display"]?>">

        <legend class="skip">휴재정보</legend>
        <fieldset class="upload-epsd__fieldset">
        
            <?php if($action == "update" && $work["is_own"]){ ?>
            <button type="button" class="upload-epsd-submit-button upload-epsd-delete-button upload-epsd__delete-button">휴재 삭제하기
                <div class="tooltip-box">
                    <span class="tooltip-box__icon icon-help icon-12"></span>
                    <div class="tooltip-box__content" style="left: 905px; top: 193px; display: none;">
                        <p>- 삭제 시 복구 불가합니다.</p>
                    </div>
                </div>
            </button>
            <?php } ?>
        </fieldset>

        <fieldset class="upload-epsd__fieldset2">
            <div class="upload-epsd__content">
                <h3 class="upload-epsd__content-label">휴재공지</h3>
                <div class="upload-epsd__content-input textarea-box">
                    <textarea name="epsd_content" id="epsd_content" class="textarea-box__textarea" placeholder="내용을 작성해주세요" minlength="<?=$epsd_config["epsd_content_min_len"]?>" maxlength="<?=$epsd_config["epsd_content_max_len"]?>"><?=$epsd["epsd_content"]?></textarea>
                    <div class="textarea-box__counter">
                        <span class="textarea-box__counter-now">0</span>
                        <span class="textarea-box__counter-max">/ <?=Converter::display_number($epsd_config["epsd_content_max_len"], "자")?></span>
                    </div>
                </div>
            </div>
            
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