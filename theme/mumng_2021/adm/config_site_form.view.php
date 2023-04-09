<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column gap-row-24">
    <form class="adm-config__form flex flex-column gap-row-12" action="<?=get_url(PAVE_ADM_URL,"config/site/update")?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">

        <div class="adm-content__header flex flex-justify-content-flex-start flex-align-item-center">
            <h1 class="adm-content__header__title"><?=$adm_title?></h1>

            <div class="flex mgl-auto gap-column-12">
                <button type="submit" class="button-t1 button-s3">수정</button>
            </div>
        </div>


        <div class="flex flex-wrap gap-24 mg-20">
            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">기본 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">기본 설정</h3>


                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">사이트 이름</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_tit" id="pave_tit" class="input-box-t2__input" value="<?=$pave_config["pave_tit"]?>" title="사이트 이름" placeholder="사이트 이름">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">사이트 설명</p>
                        <div class="textarea-box">
                            <textarea name="pave_description" id="pave_description" class="textarea-box__textarea" placeholder="사이트 설명을 입력해주세요." spellcheck="false" maxlength="500"><?=$pave_config["pave_description"]?></textarea>
                            <div class="textarea-box__counter">
                                <span class="textarea-box__counter-now">0</span>
                                <span class="textarea-box__counter-max">/ 500자</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">사이트 키워드</p>
                        <div class="textarea-box">
                            <textarea name="pave_keyword" id="pave_keyword" class="textarea-box__textarea" placeholder="사이트 키워드를 입력해주세요." spellcheck="false" maxlength="500"><?=$pave_config["pave_keyword"]?></textarea>
                            <div class="textarea-box__counter">
                                <span class="textarea-box__counter-now">0</span>
                                <span class="textarea-box__counter-max">/ 500자</span>
                            </div>
                        </div>
                    </div>
                    
                    
                </fieldset>
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">사이트 단어 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">사이트 단어 설정</h3>

                    <div class="flex flex-column gap-row-12">
                        <div class="flex flex-align-item-center gap-column-4">
                            <p class="text-weight-medium text-color-g10 text-size-normal">사이트 예약단어</p>
                            <div class="tooltip-box">
                                <span class="tooltip-box__icon icon-help icon-12"></span>
                                <div class="tooltip-box__content">
                                    <p>- 아이디에서 검사합니다.</p>
                                    <p>- 소개에서 검사합니다.</p>
                                </div>
                            </div>
                        </div>

                        <div class="textarea-box">
                            <textarea name="pave_prohibit_word" id="pave_prohibit_word" class="textarea-box__textarea" placeholder="사이트 예약단어를 입력해주세요.(콤마 구분)" spellcheck="false" maxlength="1000"><?=$pave_config["pave_prohibit_word"]?></textarea>
                            <div class="textarea-box__counter">
                                <span class="textarea-box__counter-now">0</span>
                                <span class="textarea-box__counter-max">/ 1000자</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <div class="flex flex-align-item-center gap-column-4">
                            <p class="text-weight-medium text-color-g10 text-size-normal">사이트 비속어</p>
                            <div class="tooltip-box">
                                <span class="tooltip-box__icon icon-help icon-12"></span>
                                <div class="tooltip-box__content">
                                    <p>- 닉네임에서 검사합니다.</p>
                                    <p>- 소개에서 검사합니다.</p>
                                    <p>- 컨텐츠 제목에서 검사합니다.</p>
                                    <p>- 컨텐츠 내용에서 검사합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="textarea-box">
                            <textarea name="pave_slang_word" id="pave_slang_word" class="textarea-box__textarea" placeholder="사이트 비속어를 입력해주세요.(콤마 구분)" spellcheck="false" maxlength="1000"><?=$pave_config["pave_slang_word"]?></textarea>
                            <div class="textarea-box__counter">
                                <span class="textarea-box__counter-now">0</span>
                                <span class="textarea-box__counter-max">/ 1000자</span>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            
            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">사이트 관리자 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">사이트 관리자 설정</h3>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">사이트 관리자</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_adm" id="pave_adm" class="input-box-t2__input" value="<?=$pave_config["pave_adm"]?>" title="사이트 관리자" placeholder="사이트 관리자">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">사이트 관리자 이메일</p>
                        <div class="input-box input-box-t2">
                            <input type="email" name="pave_adm_email" id="pave_adm_email" class="input-box-t2__input" value="<?=$pave_config["pave_adm_email"]?>" title="사이트 관리자 이메일" placeholder="사이트 관리자 이메일">
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">사이트 추가 스크립트 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">사이트 추가 스크립트 설정</h3>

                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">분석 스크립트</p>
                        <div class="textarea-box">
                            <textarea name="pave_anly" id="pave_anly" class="textarea-box__textarea" placeholder="분석 스크립트를 입력해주세요." spellcheck="false" maxlength="1000"><?=$pave_config["pave_anly"]?></textarea>
                            <div class="textarea-box__counter">
                                <span class="textarea-box__counter-now">0</span>
                                <span class="textarea-box__counter-max">/ 1000자</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">로봇 차단 스크립트</p>
                        <div class="textarea-box">
                            <textarea name="pave_robot" id="pave_robot" class="textarea-box__textarea" placeholder="로봇 차단 스크립트를 입력해주세요." spellcheck="false" maxlength="1000"><?=$pave_config["pave_robot"]?></textarea>
                            <div class="textarea-box__counter">
                                <span class="textarea-box__counter-now">0</span>
                                <span class="textarea-box__counter-max">/ 1000자</span>
                            </div>
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">테스트 모드 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">테스트 모드 설정</h3>

                    <div class="flex flex-justify-content-space-between flex-align-item-center gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">테스트 모드</p>
                        <label for="pave_test" class="switch-box">
                            <input type="checkbox" name="pave_test" value="1" id="pave_test" class="switch-box__check" <?=get_checked(1, $pave_config["pave_test"])?>>
                            <span class="switch-box__slider"></span>
                        </label>
                    </div>
                </fieldset>
            </div>
            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">업체 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">업체 설정</h3>

                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">업체명</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_name" id="pave_co_name" class="input-box-t2__input" value="<?=$pave_config["pave_co_name"]?>" title="업체명" placeholder="업체명" spellcheck="false">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">대표자</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_own" id="pave_co_own" class="input-box-t2__input" value="<?=$pave_config["pave_co_own"]?>" title="대표자" placeholder="대표자" spellcheck="false">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">사업자등록번호</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_bsns_num" id="pave_co_bsns_num" class="input-box-t2__input" value="<?=$pave_config["pave_co_bsns_num"]?>" title="사업자등록번호" placeholder="사업자등록번호(숫자만 입력)">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">업체주소 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">업체주소 설정</h3>

                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">주소</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_addr" id="pave_co_addr" class="input-box-t2__input" value="<?=$pave_config["pave_co_addr"]?>" title="주소" placeholder="주소" spellcheck="false">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">우편번호</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_addr_zip" id="pave_co_addr_zip" class="input-box-t2__input" value="<?=$pave_config["pave_co_addr_zip"]?>" title="우편번호" placeholder="우편번호(숫자만 입력)">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">도로명주소</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_addr_load" id="pave_co_addr_load" class="input-box-t2__input" value="<?=$pave_config["pave_co_addr_load"]?>" title="도로명주소" placeholder="도로명주소" spellcheck="false">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">지번주소</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_addr_jibun" id="pave_co_addr_jibun" class="input-box-t2__input" value="<?=$pave_config["pave_co_addr_jibun"]?>" title="지번주소" placeholder="지번주소" spellcheck="false">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">상세주소</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_addr_detail" id="pave_co_addr_detail" class="input-box-t2__input" value="<?=$pave_config["pave_co_addr_detail"]?>" title="상세주소" placeholder="상세주소" spellcheck="false">
                        </div>
                    </div>
                    
                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">추가주소</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_addr_extra" id="pave_co_addr_extra" class="input-box-t2__input" value="<?=$pave_config["pave_co_addr_extra"]?>" title="추가주소" placeholder="추가주소" spellcheck="false">
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="flex flex-column mxw-360 gap-24">
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">업체연락처 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">업체연락처 설정</h3>


                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">휴대폰번호</p>
                        <div class="input-box input-box-t2">
                            <input type="tel" name="pave_co_cp" id="pave_co_cp" class="input-box-t2__input" value="<?=$pave_config["pave_co_cp"]?>" title="휴대폰번호" placeholder="휴대폰번호(숫자만 입력)">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">전화번호</p>
                        <div class="input-box input-box-t2">
                            <input type="tel" name="pave_co_tel" id="pave_co_tel" class="input-box-t2__input" value="<?=$pave_config["pave_co_tel"]?>" title="전화번호" placeholder="전화번호(숫자만 입력)">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">팩스번호</p>
                        <div class="input-box input-box-t2">
                            <input type="tel" name="pave_co_fax" id="pave_co_fax" class="input-box-t2__input" value="<?=$pave_config["pave_co_fax"]?>" title="팩스번호" placeholder="팩스번호(숫자만 입력)">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="flex flex-column gap-row-16 pd-16 bd-1-solid-g4 bdrd-6">
                    <legend class="skip">업체부가정보 설정</legend>
                    <h3 class="text-weight-medium text-color-g12 text-size-large">업체부가정보 설정</h3>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">통신판매업신고번호</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_telemarket_num" id="pave_co_telemarket_num" class="input-box-t2__input" value="<?=$pave_config["pave_co_telemarket_num"]?>" title="통신판매업신고번호" placeholder="통신판매업신고번호" spellcheck="false">
                        </div>
                    </div>

                    <div class="flex flex-column gap-row-12">
                        <p class="text-weight-medium text-color-g10 text-size-normal">개인정보보호책임자</p>
                        <div class="input-box input-box-t2">
                            <input type="text" name="pave_co_cpo_name" id="pave_co_cpo_name" class="input-box-t2__input" value="<?=$pave_config["pave_co_cpo_name"]?>" title="개인정보보호책임자" placeholder="개인정보보호책임자" spellcheck="false">
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</div>