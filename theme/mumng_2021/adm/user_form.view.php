<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column gap-row-24">
    <form class="adm-list__form flex flex-column gap-row-12" action="<?=get_url(PAVE_ADM_URL, "user/{$action}") ?>" method="post" onsubmit="return reg_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">
        <?php if($action == "create"){ ?>
        <input type="hidden" name="user_temporary_state" id="user_temporary_state" value="1">
        <?php } ?>
    

        <div class="adm-content__header flex flex-justify-content-flex-start flex-align-item-center">
            <h1 class="adm-content__header__title">
                <?php 
                    if($action == "create"){
                        echo $adm_title;
                     }else{
                ?>
                <a href="<?=$user["user_page_url"]?>" class="flex flex-align-item-center" target="_blank">
                    <img src="<?=$user["user_img"]?>" alt="프로필 이미지" class="bdrd-50 bd-1-solid-g4 mgr-12" width="40" height="40">
                    <span><?=$adm_title?></span>
                </a>
                <?php } ?>
            </h1>
            <div class="flex mgl-auto gap-column-12">
                <a href="<?=get_url(PAVE_ADM_URL,"user/list?search_field={$search_field}&search_keyword={$search_keyword}&page={$page}")?>" class="button-t2 button-s3">취소</a>
                <button type="submit" class="button-t1 button-s3"><?=$submit?></button>
            </div>
        </div>

        <div class="flex flex-wrap gap-24 mg-20">
            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 <?=$action == "create" ? "bd-1-solid-g12" : "bd-1-solid-g4" ?> bdrd-6">
                    <legend class="skip">기본 정보</legend>

                    <h3 class="text-weight-medium text-color-g12 text-size-large">기본 정보</h3>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">회원코드</p>
                        <div class="input-box input-box-t2 readonly">
                            <?php if($action == "create"){ ?>
                            <input type="text" name="user_code" id="user_code" class="input-box-t2__input" value="<?=$user["user_code"]?>" title="회원코드" placeholder="회원코드" readonly required spellcheck="false">
                            <?php }else{ ?>
                            <span class="input-box-t2__input"><?=$user["user_code"]?></span>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">회원ID</p>
                        <div class="input-box input-box-t2 <?=$action == "create" ?:"readonly"?>">
                            <?php if($action == "create"){ ?>
                            <input type="text" name="user_id" id="user_id" class="input-box-t2__input" value="" title="아이디" placeholder="아이디" minlength="<?=$user_cf["user_id_min_len"]?>" maxlength="<?=$user_cf["user_id_max_len"]?>" required spellcheck="false">
                            <?php }else{ ?>
                            <span class="input-box-t2__input"><?=$user["user_id"]?></span>
                            <input type="hidden" name="user_id" id="user_id" value="<?=$user["user_id"]?>">
                            <?php } ?>
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">비밀번호</p>
                        <div class="input-box input-box-t2">
                            <input type="password" name="user_pwd" id="user_pwd" class="input-box-t2__input" value="" title="비밀번호" placeholder="비밀번호" minlength="<?=$user_cf["user_pwd_min_len"]?>" autocomplete="new-password" required>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 <?=$action == "create" ? "bd-1-solid-g12" : "bd-1-solid-g4" ?> bdrd-6">
                    <legend class="skip">프로필 정보</legend>

                    <h3 class="text-weight-medium text-color-g12 text-size-large">프로필 정보</h3>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">필명</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="user_nick" id="user_nick" class="input-box-t2__input" value="<?=$user["user_nick"]?>" title="필명" placeholder="필명" minlength="<?=$user_cf["user_nick_min_len"]?>" maxlength="<?=$user_cf["user_nick_max_len"]?>" required spellcheck="false">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">관심분야</p>
                        <div class="flex flex-wrap gap-8">
                            <?php foreach ($user_cf["user_field_list"] as $i => $field) { ?>
                            <label for="user_field_<?=$i?>" class="chip-check-box <?=get_checked($field, $user["user_field_list"])?>">
                                <input type="checkbox" name="user_field[]" id="user_field_<?=$i?>" class="chip-check-box__check" value="<?=$field?>" <?=get_checked($field, $user["user_field_list"])?> required>
                                <span class="chip-check-box__label"><?=$field?></span>
                            </label>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <div class="flex flex-align-item-center">
                            <p class="text-weight-medium text-color-g10 text-size-normal">관심장르</p>
                            <span class="mgl-4 text-color-g7 text-weight-regular text-size-normal user_genre_cnt" data-max="<?=$user_cf["user_genre_max_cnt"]?>">
                                <?php if($action == "create"){ ?>
                                    0/<?=$user_cf["user_genre_max_cnt"]?>
                                    <?php }else{ ?>
                                    <?=count($user["user_genre_list"])?>/<?=$user_cf["user_genre_max_cnt"]?>
                                <?php } ?>
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-8">
                            <?php foreach ($user_cf["user_genre_list"] as $i => $genre) { ?>
                            <label for="user_genre_<?=$i?>" class="chip-check-box <?=get_checked($genre, $user["user_genre_list"])?>">
                                <input type="checkbox" name="user_genre[]" id="user_genre_<?=$i?>" class="chip-check-box__check" value="<?=$genre?>" data-max="<?=$user_cf["user_genre_max_cnt"]?>" <?=get_checked($genre, $user["user_genre_list"])?> required>
                                <span class="chip-check-box__label"><?=$genre?></span>
                            </label>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">소개</p>
                        <div class="textarea-box">
                            <textarea name="user_introduce" id="user_introduce" class="textarea-box__textarea" placeholder="소개" spellcheck="false" maxlength="<?=$user_cf["user_introduce_max_len"]?>"><?=$user["user_introduce"]?></textarea>
                            <div class="textarea-box__counter">
                                <span class="textarea-box__counter-now">0</span>
                                <span class="textarea-box__counter-max">/ <?=$user_cf["user_introduce_max_len"]?>자</span>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>


            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 <?=$action == "create" ? "bd-1-solid-g12" : "bd-1-solid-g4" ?> bdrd-6">
                    <legend class="skip">개인 정보</legend>   

                    <h3 class="text-weight-medium text-color-g12 text-size-large">개인 정보</h3>
        
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">이름</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="user_name" id="user_name" class="input-box-t2__input" value="<?=$user["user_name"]?>" title="이름" placeholder="이름" required>
                        </div>
                    </div>
        
                
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">생년월일</p>
                        <div class="input-box input-box-t3">
                            <input type="number" name="user_birth_year" id="user_birth_year" class="input-box-t3__input" value="<?=$user["user_birth_list"][0]?>" title="연도" placeholder="연도(4자리)" required>
                            <input type="number" name="user_birth_month" id="user_birth_month" class="input-box-t3__input" value="<?=$user["user_birth_list"][1]?>" title="월" placeholder="월(2자리)" required>
                            <input type="number" name="user_birth_day" id="user_birth_day" class="input-box-t3__input" value="<?=$user["user_birth_list"][2]?>" title="일" placeholder="일(2자리)" required>
                        </div>
                    </div>
        
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">성별</p>
                        <div class="input-box input-box-t2">
                            <div class="select-box">
                                <select name="user_sex" id="user_sex" class="select-box__select" title="성별" required>
                                    <option value="" disabled selected>선택해주세요.</option>
                                    <option value="m" <?=get_selected("m", $user["user_sex"])?>>남</option>
                                    <option value="f" <?=get_selected("f", $user["user_sex"])?>>여</option>
                                    <option value="n" <?=get_selected("n", $user["user_sex"])?>>선택안함</option>
                                    <option value="a" <?=get_selected("a", $user["user_sex"])?>>해당없음</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 <?=$action == "create" ? "bd-1-solid-g12" : "bd-1-solid-g4" ?> bdrd-6">
                    <legend class="skip">인증 정보</legend>   

                    <h3 class="text-weight-medium text-color-g12 text-size-large">인증 정보</h3>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">휴대폰번호</p>
                        <div class="input-box input-box-t2">
                            <input type="tel" name="user_cp" id="user_cp" class="input-box-t2__input" value="<?=$user["user_cp"]?>" title="휴대폰번호" placeholder="휴대폰번호(숫자만 입력)">
                        </div>
                    </div>
                
                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">본인인증여부</p>
                        <label for="user_cp_cert_state" class="switch-box">
                            <input type="checkbox" name="user_cp_cert_state" value="1" id="user_cp_cert_state" class="switch-box__check" <?=get_checked(1, $user["user_cp_cert_state"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>

                    <?php if($action == "update"){ ?>
                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">성인 여부</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php if($user["user_adult_cert_state"]){ ?>
                                🟢
                            <?php }else{ ?>
                                ❌
                            <?php } ?>
                        </p>
                    </div>
                    <?php } ?>
                </fieldset>
                
                <fieldset class="flex flex-column gap-row-16 pd-16 <?=$action == "create" ? "bd-1-solid-g12" : "bd-1-solid-g4" ?> bdrd-6">
                    <legend class="skip">동의 정보</legend>   
                    <h3 class="text-weight-medium text-color-g12 text-size-large">동의 정보</h3>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">무명 이용약관 동의</p>
                        <label for="user_term_agree_state" class="switch-box">
                            <input type="checkbox" name="user_term_agree_state" value="1" id="user_term_agree_state" class="switch-box__check" <?=get_checked(1, $user["user_term_agree_state"])?> required>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">개인정보 이용동의</p>
                        <label for="user_info_agree_state" class="switch-box">
                            <input type="checkbox" name="user_info_agree_state" value="1" id="user_info_agree_state" class="switch-box__check" <?=get_checked(1, $user["user_info_agree_state"])?> required>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>
                    
                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">이벤트 마케팅 정보 수신</p>
                        <label for="user_event_agree_state" class="switch-box">
                            <input type="checkbox" name="user_event_agree_state" value="1" id="user_event_agree_state" class="switch-box__check" <?=get_checked(1, $user["user_event_agree_state"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">성인물 차단</p>
                        <label for="user_adult_content" class="switch-box">
                            <input type="checkbox" name="user_adult_content" value="1" id="user_adult_content" class="switch-box__check" <?=get_checked(1, $user["user_adult_content"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">부가 정보</legend>   
                    <h3 class="text-weight-medium text-color-g12 text-size-large">부가 정보</h3>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">이메일</p>
                        <div class="input-box input-box-t2">
                            <input type="email" name="user_email" id="user_email" class="input-box-t2__input" value="<?=$user["user_email"]?>" title="이메일" placeholder="이메일" spellcheck="false">
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">커머스 정보</legend>   
                    <h3 class="text-weight-medium text-color-g12 text-size-large">커머스 정보</h3>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">커머스 여부</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php if($user["user_commerce"]){ ?>
                                💲(수익 창출중)
                            <?php }else{ ?>
                                ❌
                            <?php } ?>
                        </p>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">커머스강등 여부</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php if($user["user_commerce_demote"]){ ?>
                                🔴
                            <?php }else{ ?>
                                ❌
                            <?php } ?>
                        </p>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">커머스등급</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php if($user["user_grd"]){ ?>
                                <?=$user["user_grd"]?>
                            <?php }else{ ?>
                                일반
                            <?php } ?>
                        </p>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">커머스점수</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal"><?=Converter::display_number($user["user_score"], "점") ?></p>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">사업자 정보</legend>   
                    <h3 class="text-weight-medium text-color-g12 text-size-large">사업자 정보</h3>
                    
                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">사업자 여부</p>
                        <label for="user_bsns_state" class="switch-box">
                            <input type="checkbox" name="user_bsns_state" value="1" id="user_bsns_state" class="switch-box__check" <?=get_checked(1, $user["user_bsns_state"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">대표자명</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="user_bsns_owner" id="user_bsns_owner" class="input-box-t2__input" value="<?=$user["user_bsns_owner"]?>" title="대표자명" placeholder="대표자명" spellcheck="false">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">상호명</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="user_bsns_name" id="user_bsns_name" class="input-box-t2__input" value="<?=$user["user_bsns_name"]?>" title="상호명" placeholder="상호명" spellcheck="false">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">사업자번호</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="user_bsns_number" id="user_bsns_number" class="input-box-t2__input" value="<?=$user["user_bsns_number"]?>" title="사업자등록번호" placeholder="사업자등록번호(숫자만 입력)">
                        </div>
                    </div>

                </fieldset>
                
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">정산 정보</legend>   

                    <h3 class="text-weight-medium text-color-g12 text-size-large">정산 정보</h3>


                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">정산은행</p>
                        <div class="select-box">
                            <select name="user_bank" id="user_bank" class="select-box__select" title="정산은행">
                                <option value="" disabled selected>선택안함</option>
                                <?php foreach ($user_cf["user_bank_list"] as $key => $bank) { ?>
                                <option value="<?=$key?>" <?=get_selected($key, $user["user_bank"])?>><?=$bank?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">계좌번호</p>
                        <div class="input-box input-box-t2">
                            <input type="number" name="user_bank_number" id="user_bank_number" class="input-box-t2__input" value="<?=$user["user_bank_number"]?>" title="계좌번호" placeholder="계좌번호(숫자만 입력)">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">예금주</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="user_bank_owner" id="user_bank_owner" class="input-box-t2__input" value="<?=$user["user_bank_owner"]?>" title="예금주" placeholder="예금주">
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="flex flex-column mxw-360 gap-24">

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">보호자 인증 정보</legend>   

                    <h3 class="text-weight-medium text-color-g12 text-size-large">보호자 인증 정보</h3>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">보호자 관계</p>
                        <div class="input-box input-box-t2">
                            <div class="select-box">
                                <select name="user_rel" id="user_rel" class="select-box__select" title="보호자 관계">
                                    <option value="" disabled selected>선택해주세요.</option>
                                    <option value="부">부</option>
                                    <option value="모">모</option>
                                    <option value="형제">형제</option>
                                    <option value="자매">자매</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">보호자 휴대폰번호</p>
                        <div class="input-box input-box-t2">
                            <input type="tel" name="user_rel_cp" id="user_rel_cp" class="input-box-t2__input" value="<?=$user["user_rel_cp"]?>" title="보호자 휴대폰번호" placeholder="보호자 휴대폰번호">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">상태 정보</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">차단 정보</h3>
                    
                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">차단 여부</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php if($user["user_block_state"]){ ?>
                                🔴
                            <?php }else{ ?>
                                ❌
                            <?php } ?>
                        </p>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">탈퇴 여부</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php if($user["user_leave_state"]){ ?>
                                🔴
                            <?php }else{ ?>
                                ❌
                            <?php } ?>
                        </p>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">시간 정보</legend>   

                    <h3 class="text-weight-medium text-color-g12 text-size-large">시간 정보</h3>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">비밀번호 만료일</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php
                                if(!is_time_null($user["user_pwd_dt"])){
                                    echo Converter::display_time("Y-m-d", $user["user_pwd_dt"]);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </p>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">본인인증 만료일</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php
                                if(!is_time_null($user["user_cp_cert_dt"])){
                                    echo Converter::display_time("Y-m-d", $user["user_cp_cert_dt"]);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </p>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">가입일</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php
                                if(!is_time_null($user["user_insert_dt"])){
                                    echo Converter::display_time("Y-m-d", $user["user_insert_dt"]);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </p>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">탈퇴일</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php
                                if(!is_time_null($user["user_leave_dt"])){
                                    echo Converter::display_time("Y-m-d", $user["user_leave_dt"]);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </p>
                    </div>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">차단일</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php
                                if(!is_time_null($user["user_block_dt"])){
                                    echo Converter::display_time("Y-m-d", $user["user_block_dt"]);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </p>
                    </div>
                    
                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">커머스 시작일</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php
                                if(!is_time_null($user["user_commerce_start_dt"])){
                                    echo Converter::display_time("Y-m-d", $user["user_commerce_start_dt"]);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </p>
                    </div>
                
                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">커머스 만료일</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php
                                if(!is_time_null($user["user_commerce_expire_dt"])){
                                    echo Converter::display_time("Y-m-d", $user["user_commerce_expire_dt"]);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </p>
                    </div>
                
                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">커머스 강등일</p>
                        <p class="text-weight-medium text-color-g10 text-size-normal">
                            <?php
                                if(!is_time_null($user["user_commerce_demote_dt"])){
                                    echo Converter::display_time("Y-m-d", $user["user_commerce_demote_dt"]);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </p>
                    </div>
                </fieldset>
            </div>

        </div>
    </form>
</div>
<script>
function reg_form_check(f){
    let data = null;

   /*  data = check_user_id_ajax(f.user_id.value); 
    if(data.msg != ""){
        alert(data.msg);
        $(f.user_id).focus();
        return false;
    }

    data = check_user_pwd_ajax(f.user_pwd.value, "", false);
    if(data.msg != ""){
        alert(data.msg);
        $(f.user_pwd).focus();
        return false;
    } */

    data = check_user_nick_ajax(f.user_nick.value, f.user_id.value);
    if(data.msg != ""){
        alert(data.msg);
        $(f.user_nick).focus();
        return false;
    }
/* 

    data = check_user_field_ajax($("input[name='user_field[]']:checked").map(function(){return $(this).val();}).get(), true);
    if(data.msg != ""){
        alert(data.msg);
        return false;
    }

    data = check_user_genre_ajax($("input[name='user_genre[]']:checked").map(function(){return $(this).val();}).get(), true);
    if(data.msg != ""){
        alert(data.msg);
        return false;
    } */
 
    if(f.user_name.value == ""){
        alert("이름을 입력해주세요.");
        $(f.user_name).focus();
        return false;
    }

    if(f.user_birth_year.value == ""){
        alert("태어난 년도를 입력해주세요.");
        $(f.user_birth_year).focus();
        return false;
    }

    if(f.user_birth_month.value == ""){
        alert("태어난 월을 입력해주세요.");
        $(f.user_birth_month).focus();
        return false;
    }

    if(f.user_birth_day.value == ""){
        alert("태어난 일을 입력해주세요.");
        $(f.user_birth_day).focus();
        return false;
    }

    let birth_date = f.user_birth_year.value + f.user_birth_month.value + f.user_birth_day.value;
  
    if (!birth_date.match(/^(19[0-9][0-9]|20\d{2})(0[0-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])$/)) {
        alert("생년월일을 올바르게 입력해주세요.");
        return false;
    }

    if(f.user_sex.value == ""){
        alert("성별을 입력해주세요.");
        $(f.user_sex).focus();
        return false;
    }


    data = check_user_cp_ajax(f.user_cp.value, false, f.user_id.value);
    if(data.msg != ""){
        alert(data.msg);
        $(f.user_cp).focus();
        return false;
    }

    if(!$(f.user_term_agree_state).prop("checked")){
        alert("무명 이용약관 동의해주세요.");
        $(f.user_term_agree_state).focus();
        return false;
    }
    if(!$(f.user_info_agree_state).prop("checked")){
        alert("개인정보 이용 동의해주세요.");
        $(f.user_info_agree_state).focus();
        return false;
    }

    return true;
}

$(document).ready(function(){
    $("input[name='user_genre[]']").on("change", function(e){
        let max = Number($(this).data("max"));
        let checked_length = $("input[name='user_genre[]']:checked").length;
        if(checked_length > max) {
            alert("장르는 최대 "+max+"개 까지 선택가능합니다.");
            $(this).prop("checked", false);
            return false;
        }else{
            $(".user_genre_cnt").text(checked_length+"/"+max);
        }
    });
});

</script>