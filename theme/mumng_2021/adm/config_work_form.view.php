<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-config">
    <form class="amd-config__form" action="<?=get_url(PAVE_ADM_URL,"config/work/update")?>" method="post" onsubmit="return adm_config_cert_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
        <?php foreach ($work_cf as $i => $work) { ?>
        <fieldset class="flex flex-column">
            <h2 class="text-weight-bold text-color-g12 text-size-large">작품설정</h2>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 신고 사용</h3>
                <label for="work_use_penalty" class="switch-box">
                    <input type="checkbox" name="work_use_penalty" value="1" id="work_use_penalty" class="switch-box__check" <?=get_checked(1, $work["work_use_penalty"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 구독 사용</h3>
                <label for="work_use_subscribe" class="switch-box">
                    <input type="checkbox" name="work_use_subscribe" value="1" id="work_use_subscribe" class="switch-box__check" <?=get_checked(1, $work["work_use_subscribe"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 좋아요 사용</h3>
                <label for="work_use_like" class="switch-box">
                    <input type="checkbox" name="work_use_like" value="1" id="work_use_like" class="switch-box__check" <?=get_checked(1, $work["work_use_like"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 댓글 사용</h3>
                <label for="work_use_cmt" class="switch-box">
                    <input type="checkbox" name="work_use_cmt" value="1" id="work_use_cmt" class="switch-box__check" <?=get_checked(1, $work["work_use_cmt"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 대댓글 사용</h3>
                <label for="work_use_reply" class="switch-box">
                    <input type="checkbox" name="work_use_reply" value="1" id="work_use_reply" class="switch-box__check" <?=get_checked(1, $work["work_use_reply"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 댓글 좋아요 사용</h3>
                <label for="work_use_cmt_like" class="switch-box">
                    <input type="checkbox" name="work_use_cmt_like" value="1" id="work_use_cmt_like" class="switch-box__check" <?=get_checked(1, $work["work_use_cmt_like"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 댓글 신고 사용</h3>
                <label for="work_use_cmt_penalty" class="switch-box">
                    <input type="checkbox" name="work_use_cmt_penalty" value="1" id="work_use_cmt_penalty" class="switch-box__check" <?=get_checked(1, $work["work_use_cmt_penalty"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 임시저장 사용</h3>
                <label for="work_use_save" class="switch-box">
                    <input type="checkbox" name="work_use_save" value="1" id="work_use_save" class="switch-box__check" <?=get_checked(1, $work["work_use_save"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 노출 목록 수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_list_row" id="work_list_row" class="input-box-t4__input" value="<?=$work["work_list_row"]?>" placeholder="작품 노출 목록 수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 노출 모바일 목록 수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_list_m_row" id="work_list_m_row" class="input-box-t4__input" value="<?=$work["work_list_m_row"]?>" placeholder="작품 노출 목록 수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 페이지네이션 목록 수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_nav_row" id="work_nav_row" class="input-box-t4__input" value="<?=$work["work_nav_row"]?>" placeholder="작품 페이지네이션 목록 수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 페이지네이션 모바일 목록 수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_nav_m_row" id="work_nav_m_row" class="input-box-t4__input" value="<?=$work["work_nav_m_row"]?>" placeholder="작품 페이지네이션 목록 수">
                    </div>
                </div>
            </div>
            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품소개 최소 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_description_min_len" id="work_description_min_len" class="input-box-t4__input" value="<?=$work["work_description_min_len"]?>" placeholder="작품소개 최소 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품소개 최대 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_description_max_len" id="work_description_max_len" class="input-box-t4__input" value="<?=$work["work_description_max_len"]?>" placeholder="작품소개 최대 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품명 최소 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_name_min_len" id="work_name_min_len" class="input-box-t4__input" value="<?=$work["work_name_min_len"]?>" placeholder="작품명 최소 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품명 최대 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_name_max_len" id="work_name_max_len" class="input-box-t4__input" value="<?=$work["work_name_max_len"]?>" placeholder="작품명 최대 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 해시태그 최대 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_hashtag_max_len" id="work_hashtag_max_len" class="input-box-t4__input" value="<?=$work["work_hashtag_max_len"]?>" placeholder="작품 해시태그 최대 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 해시태그 최대 갯수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_hashtag_max_cnt" id="work_hashtag_max_cnt" class="input-box-t4__input" value="<?=$work["work_hashtag_max_cnt"]?>" placeholder="작품 해시태그 최대 갯수">
                    </div>
                </div>
            </div>
            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 함께한작가 최대 갯수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_with_max_cnt" id="work_with_max_cnt" class="input-box-t4__input" value="<?=$work["work_with_max_cnt"]?>" placeholder="작품 함께한작가 최대 갯수">
                    </div>
                </div>
            </div>
            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 장르</h3>
                <div class="flex flex-wrap gap-8">
                    <?php foreach ((array)$work["work_genre_list"] as $i => $genre) { ?>
                    <label for="work_genre_<?=$i?>" class="chip-check-box <?=get_checked($genre, $work["work_genre_list"])?>">
                        <input type="checkbox" name="work_genre" id="work_genre_<?=$i?>" class="chip-check-box__check" value="<?=$genre?>" <?=get_checked($genre, $work["work_genre_list"])?>>
                        <span class="chip-check-box__label"><?=$genre?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 장르 최대 갯수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_genre_max_cnt" id="work_genre_max_cnt" class="input-box-t4__input" value="<?=$work["work_genre_max_cnt"]?>" placeholder="작품 장르 최대 갯수">
                    </div>
                </div>
            </div>
            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 요일</h3>
                <div class="flex flex-wrap gap-8">
                    <?php foreach ((array)$work["work_day_list"] as $i => $day) { ?>
                    <label for="work_day_<?=$i?>" class="chip-check-box <?=get_checked($day, $work["work_day_list"])?>">
                        <input type="checkbox" name="work_day" id="work_day_<?=$i?>" class="chip-check-box__check" value="<?=$day?>" <?=get_checked($day, $work["work_day_list"])?>>
                        <span class="chip-check-box__label"><?=$day?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 요일 최대 갯수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="work_day_max_cnt" id="work_day_max_cnt" class="input-box-t4__input" value="<?=$work["work_day_max_cnt"]?>" placeholder="작품 장르 최대 갯수">
                    </div>
                </div>
            </div>
            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 연령</h3>
                <div class="flex flex-wrap gap-8">
                    <?php foreach ((array)$work["work_age_list"] as $i => $age) { ?>
                    <label for="work_age_<?=$i?>" class="chip-check-box <?=get_checked($age, $work["work_age_list"])?>">
                        <input type="checkbox" name="work_age" id="work_age_<?=$i?>" class="chip-check-box__check" value="<?=$age?>" <?=get_checked($age, $work["work_age_list"])?>>
                        <span class="chip-check-box__label"><?=$age?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">작품 시간</h3>
                <div class="flex flex-wrap gap-8">
                    <?php foreach ((array)$work["work_time_list"] as $i => $time) { ?>
                    <label for="work_time_<?=$i?>" class="chip-check-box <?=get_checked($time, $work["work_time_list"])?>">
                        <input type="checkbox" name="work_time" id="work_time_<?=$i?>" class="chip-check-box__check" value="<?=$time?>" <?=get_checked($time, $work["work_time_list"])?>>
                        <span class="chip-check-box__label"><?=$time?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>
        </fieldset>
        <?php } ?>

    </form>
</div>