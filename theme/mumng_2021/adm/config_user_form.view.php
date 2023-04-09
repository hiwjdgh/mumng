<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-config">
    <form class="amd-config__form" action="<?=get_url(PAVE_ADM_URL,"config/user/update")?>" method="post" onsubmit="return adm_config_cert_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
        <fieldset class="flex flex-column">
            <h2 class="text-weight-bold text-color-g12 text-size-large">회원설정</h2>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">소개 필수 여부</h3>
                <label for="user_introduce_req" class="switch-box">
                    <input type="checkbox" name="user_introduce_req" value="1" id="user_introduce_req" class="switch-box__check" <?=get_checked(1, $user_cf["user_introduce_req"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">소개 최소 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="user_introduce_min_len" id="user_introduce_min_len" class="input-box-t4__input" value="<?=$user_cf["user_introduce_min_len"]?>" placeholder="소개 최소 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">소개 최대 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="user_introduce_max_len" id="user_introduce_max_len" class="input-box-t4__input" value="<?=$user_cf["user_introduce_max_len"]?>" placeholder="소개 최대 글자수">
                    </div>
                </div>
            </div>
            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">분야 필수 여부</h3>
                <label for="user_field_req" class="switch-box">
                    <input type="checkbox" name="user_field_req" value="1" id="user_field_req" class="switch-box__check" <?=get_checked(1, $user_cf["user_field_req"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">분야</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="user_field" id="user_field" class="input-box-t4__input" value="<?=$user_cf["user_field"]?>" placeholder="분야 (콤마 구분)">
                    </div>
                </div>
            </div>
            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">장르 필수 여부</h3>
                <label for="user_genre_req" class="switch-box">
                    <input type="checkbox" name="user_genre_req" value="1" id="user_genre_req" class="switch-box__check" <?=get_checked(1, $user_cf["user_genre_req"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">장르</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="text" name="user_genre" id="user_genre" class="input-box-t4__input" value="<?=$user_cf["user_genre"]?>" placeholder="장르 (콤마 구분)">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">장르 최대 갯수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="user_genre_max_cnt" id="user_genre_max_cnt" class="input-box-t4__input" value="<?=$user_cf["user_genre_max_cnt"]?>" placeholder="장르 최대 갯수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">등록가능 은행</h3>
                <div class="flex flex-wrap gap-8">
                    <?php foreach ((array)$user_cf["user_bank_list"] as $i => $bank) { ?>
                    <label for="user_bank_<?=$i?>" class="chip-check-box <?=get_checked($bank, $user_cf["user_bank_list"])?>">
                        <input type="checkbox" name="user_bank" id="user_bank_<?=$i?>" class="chip-check-box__check" value="<?=$bank?>" <?=get_checked($bank, $user_cf["payment_bank_list"])?>>
                        <span class="chip-check-box__label"><?=$bank?></span>
                    </label>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">아이디 최소 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="user_id_min_len" id="user_id_min_len" class="input-box-t4__input" value="<?=$user_cf["user_id_min_len"]?>" placeholder="아이디 최소 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">아이디 최대 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="user_id_max_len" id="user_id_max_len" class="input-box-t4__input" value="<?=$user_cf["user_id_max_len"]?>" placeholder="아이디 최대 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">비밀번호 최소 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="user_pwd_min_len" id="user_pwd_min_len" class="input-box-t4__input" value="<?=$user_cf["user_pwd_min_len"]?>" placeholder="비밀번호 최소 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">
                    휴대폰번호 최대 글자수
                    <div class="tooltip-box">
                        <span class="tooltip-box__icon icon-help icon-12"></span>
                        <div class="tooltip-box__content">
                            <p>- 10자 (010-111-1111)</p>
                            <p>- 11자 (010-1111-1111)</p>
                        </div>
                    </div>
                </h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="user_cp_max_len" id="user_cp_max_len" class="input-box-t4__input" value="<?=$user_cf["user_cp_max_len"]?>" placeholder="휴대폰번호 최대 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">비밀번호 만료기간</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="user_pwd_expire_day_no" id="user_pwd_expire_day_no" class="input-box-t4__input" value="<?=$user_cf["user_pwd_expire_day_no"]?>" placeholder="비밀번호 만료기간">
                    </div>

                    <div class="select-box">
                        <select name="user_pwd_expire_day_unit" id="user_pwd_expire_day_unit" class="select-box__select" title="비밀번호 만료기간 단위">
                            <option value="" disabled selected>선택해주세요.</option>
                            <option value="days" <?=get_selected("days", $user_cf["user_pwd_expire_day_unit"])?>>일</option>
                            <option value="weeks" <?=get_selected("weeks", $user_cf["user_pwd_expire_day_unit"])?>>주</option>
                            <option value="months" <?=get_selected("months", $user_cf["user_pwd_expire_day_unit"])?>>월</option>
                            <option value="years" <?=get_selected("years", $user_cf["user_pwd_expire_day_unit"])?>>년</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">닉네임 최소 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="user_nick_min_len" id="user_nick_min_len" class="input-box-t4__input" value="<?=$user_cf["user_nick_min_len"]?>" placeholder="닉네임 최소 글자수">
                    </div>
                </div>
            </div>

            <div class="flex flex-align-item-center flex-justify-content-space-between mxw-480 mgb-24">
                <h3 class="text-weight-medium text-color-g10 text-size-normal">닉네임 최대 글자수</h3>
                <div class="flex flex-align-item-center">
                    <div class="input-box input-box-t4">
                        <input type="number" name="user_nick_max_len" id="user_nick_max_len" class="input-box-t4__input" value="<?=$user_cf["user_nick_max_len"]?>" placeholder="닉네임 최대 글자수">
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>