<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column gap-row-24">
    <form class="adm-config__form flex flex-column gap-row-12" action="<?=get_url(PAVE_ADM_URL,"config/cert/update")?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">

        <div class="adm-content__header flex flex-justify-content-flex-start flex-align-item-center">
            <h1 class="adm-content__header__title"><?=$adm_title?></h1>

            <div class="flex mgl-auto gap-column-12">
                <button type="submit" class="button-t1 button-s3">수정</button>
            </div>
        </div>


        <div class="flex flex-wrap gap-24 mg-20">
            <div class="flex flex-column mxw-480 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">기본 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">기본 설정</h3>


                    <div class="flex flex-column gap-row-12">
                        <div class="flex flex-align-item-center gap-column-4">
                            <p class="text-weight-medium text-color-g10 text-size-normal">본인인증 횟수</p>
                            <div class="tooltip-box">
                                <span class="tooltip-box__icon icon-help icon-12"></span>
                                <div class="tooltip-box__content">
                                    <p>- 하루 최대 본인인증 횟수입니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-box input-box-t2">
                            <input type="number" name="cert_max_cnt" id="cert_max_cnt" class="input-box-t2__input" value="<?=$cert_cf["cert_max_cnt"]?>" title="본인인증 횟수" placeholder="본인인증 횟수(숫자만 입력)">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">본인인증 종류</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="cert_type" id="cert_type" class="input-box-t2__input" value="<?=$cert_cf["cert_type"]?>" title="본인인증 종류" placeholder="본인인증 종류(콤마로 구분)" spellcheck="false">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">본인인증 만료기간 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">본인인증 만료기간 설정</h3>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">만료기간</p>

                        <div class="flex flex-align-item-center">
                            <div class="input-box input-box-t2">
                                <input type="number" name="cert_expire_day_no" id="cert_expire_day_no" class="input-box-t2__input" value="<?=$cert_cf["cert_expire_day_no"]?>" title="만료기간" placeholder="만료기간">
                            </div>
                            <div class="select-box">
                                <select name="cert_expire_day_unit" id="cert_expire_day_unit" class="select-box__select" title="만료기간 단위">
                                    <option value="" disabled selected>선택해주세요.</option>
                                    <option value="days" <?=get_selected("days", $cert_cf["cert_expire_day_unit"])?>>일</option>
                                    <option value="weeks" <?=get_selected("weeks", $cert_cf["cert_expire_day_unit"])?>>주</option>
                                    <option value="months" <?=get_selected("months", $cert_cf["cert_expire_day_unit"])?>>월</option>
                                    <option value="years" <?=get_selected("years", $cert_cf["cert_expire_day_unit"])?>>년</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">나이스 본인인증 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">나이스 본인인증 설정</h3>
                        
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">나이스 프로덕트 코드</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="cert_nice_product_code" id="cert_nice_product_code" class="input-box-t2__input" value="<?=$cert_cf["cert_nice_product_code"]?>" title="나이스 프로덕트 코드" placeholder="나이스 프로덕트 코드" spellcheck="false">
                        </div>
                    </div>
                        
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">나이스 클라이언트키</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="cert_nice_client_key" id="cert_nice_client_key" class="input-box-t2__input" value="<?=$cert_cf["cert_nice_client_key"]?>" title="나이스 클라이언트키" placeholder="나이스 클라이언트키" spellcheck="false">
                        </div>
                    </div>
                        
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">나이스 시크릿키</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="cert_nice_secret_key" id="cert_nice_secret_key" class="input-box-t2__input" value="<?=$cert_cf["cert_nice_secret_key"]?>" title="나이스 시크릿키" placeholder="나이스 시크릿키" spellcheck="false">
                        </div>
                    </div>
                        
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">나이스 엑세스토큰</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="cert_nice_access_token" id="cert_nice_access_token" class="input-box-t2__input" value="<?=$cert_cf["cert_nice_access_token"]?>" title="나이스 엑세스토큰" placeholder="나이스 엑세스토큰" spellcheck="false">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">나이스 계약 정보</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">나이스 계약정보</h3>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">만료일</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php
                                if(!is_time_null($cert_cf["cert_nice_expired_dt"])){
                                    echo Converter::display_time("Y-m-d", $cert_cf["cert_nice_expired_dt"]);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </p>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <div class="flex flex-align-item-center gap-column-4">
                            <p class="text-weight-medium text-color-g10 text-size-normal">계약 연장신청</p>
                            <div class="tooltip-box">
                                <span class="tooltip-box__icon icon-help icon-12"></span>
                                <div class="tooltip-box__content">
                                    <p>- 신청이 완료되었을때 눌러주세요.</p>
                                    <p>- 1년 단위로 증가.</p>
                                </div>
                            </div>
                        </div>
                        <label for="cert_nice_renew_state" class="switch-box">
                            <input type="checkbox" name="cert_nice_renew_state" value="1" id="cert_nice_renew_state" class="switch-box__check">
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>
                </fieldset>

            </div>
        </div>
    </form>
</div>