<?php
if (!defined('_PAVE_')) exit;
?>
<section class="creation__header">
    <h1 class="creation__title">창작</h1>
    <div class="creation__action">
        <a href="<?=get_url(PAVE_CREATION_URL, "form?action=create")?>" class="creation__reuqest-button button-t1 button-s1">창작 의뢰하기</a>
    </div>
</section>
<section class="creation__content">
    <aside class="creation__left">
        <div class="creation__left-header">
            <h2 class="creation__left-title">필터</h2>
            <button type="button" class="creation__left-button creation-filter-clear-button button-t2 button-s4">초기화</button>
        </div>
        <ul class="creation__filter">
            <li class="creation__filter-item">
                <div class="creation__filter-title">
                    정렬
                </div>
                <ul class="creation__filter2">
                    <li class="creation__filter2-item2">
                        <div class="select-t1">
                            <select name="creation_order" class="select-t1__select" title="정렬">
                                <option value="update,desc" selected>최신 등록 순</option>
                                <option value="end,desc">마감 임박 순</option>
                                <option value="end,desc">마감 여유로운 순</option>
                                <option value="exp,desc">금액 높은 순</option>
                                <option value="exp,asc">금액 낮은 순</option>
                            </select>
                        </div>
                    </li>
                </ul>
            </li>

            <li class="creation__filter-item">
                <div class="creation__filter-title">
                    구분
                </div>
                <ul class="creation__filter2">
                    <li class="creation__filter2-item2">
                        <div class="check-t1">
                            <div class="check-t1__box">
                                <input type="checkbox" name="creation_field[]" id="creation_field_0" class="check-t1__input" value="commission">
                                <label for="creation_field_0" class="check-t1__label">커미션(비상업용도)
                                    <div class="tooltip-box">
                                        <span class="tooltip-box__icon icon-help icon-12"></span>
                                        <div class="tooltip-box__content">
                                            <p>재편집, 재창작 불가</p>
                                            <p>무단배포 불가</p>
                                            <p>모든 상업적 활동 불가</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </li>
                    <li class="creation__filter2-item2">
                        <div class="check-t1">
                            <div class="check-t1__box">
                                <input type="checkbox" name="creation_field[]" id="creation_field_1" class="check-t1__input" value="outsourcing">
                                <label for="creation_field_1" class="check-t1__label">외주(상업적용도)
                                    <div class="tooltip-box">
                                        <span class="tooltip-box__icon icon-help icon-12"></span>
                                        <div class="tooltip-box__content">
                                            <p>모든 상업적 활동 가능</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        
            <li class="creation__filter-item">
                <div class="creation__filter-title">
                    상태
                </div>
                <ul class="creation__filter2">
                    <li class="creation__filter2-item2">
                        <div class="radio-t1">
                            <div class="radio-t1__box">
                                <input type="radio" name="creation_state" id="creation_state_0" class="radio-t1__input" value="recruit">
                                <label for="creation_state_0" class="radio-t1__label">모집중</label>
                            </div>
                        </div>
                    </li>
                    <li class="creation__filter2-item2">
                        <div class="radio-t1">
                            <div class="radio-t1__box">
                                <input type="radio" name="creation_state" id="creation_state_1" class="radio-t1__input" value="ongoing">
                                <label for="creation_state_1" class="radio-t1__label">작업중</label>
                            </div>
                        </div>
                    </li>
                    <li class="creation__filter2-item2">
                        <div class="radio-t1">
                            <div class="radio-t1__box">
                                <input type="radio" name="creation_state" id="creation_state_2" class="radio-t1__input" value="complete">
                                <label for="creation_state_2" class="radio-t1__label">작업완료</label>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>

            <li class="creation__filter-item">
                <div class="creation__filter-title">
                    데포르메
                </div>
                <ul class="creation__filter2">
                    <li class="creation__filter2-item2">
                        <div class="check-t1">
                            <div class="check-t1__box">
                                <input type="checkbox" name="creation_ratio[]" id="creation_ratio_0" class="check-t1__input" value="SD">
                                <label for="creation_ratio_0" class="check-t1__label">SD(2등신)</label>
                            </div>
                        </div>
                    </li>
                    <li class="creation__filter2-item2">
                        <div class="check-t1">
                            <div class="check-t1__box">
                                <input type="checkbox" name="creation_ratio[]" id="creation_ratio_1" class="check-t1__input" value="MD">
                                <label for="creation_ratio_1" class="check-t1__label">MD(4~6등신)</label>
                            </div>
                        </div>
                    </li>
                    <li class="creation__filter2-item2">
                        <div class="check-t1">
                            <div class="check-t1__box">
                                <input type="checkbox" name="creation_ratio[]" id="creation_ratio_2" class="check-t1__input" value="LD">
                                <label for="creation_ratio_2" class="check-t1__label">LD(6등신 이상)</label>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>

            <li class="creation__filter-item">
                <div class="creation__filter-title">
                    크기
                </div>
                <ul class="creation__filter2">
                    <li class="creation__filter2-item2">
                        <div class="check-t1">
                            <div class="check-t1__box">
                                <input type="checkbox" name="creation_size[]" id="creation_size_0" class="check-t1__input" value="두상">
                                <label for="creation_size_0" class="check-t1__label">두상(머리 ~ 목)</label>
                            </div>
                        </div>
                    </li>
                    <li class="creation__filter2-item2">
                        <div class="check-t1">
                            <div class="check-t1__box">
                                <input type="checkbox" name="creation_size[]" id="creation_size_1" class="check-t1__input" value="흉상">
                                <label for="creation_size_1" class="check-t1__label">흉상(머리 ~ 명치)</label>
                            </div>
                        </div>
                    </li>
                    <li class="creation__filter2-item2">
                        <div class="check-t1">
                            <div class="check-t1__box">
                                <input type="checkbox" name="creation_size[]" id="creation_size_2" class="check-t1__input" value="반신">
                                <label for="creation_size_2" class="check-t1__label">반신(머리 ~ 허벅지)</label>
                            </div>
                        </div>
                    </li>
                    <li class="creation__filter2-item2">
                        <div class="check-t1">
                            <div class="check-t1__box">
                                <input type="checkbox" name="creation_size[]" id="creation_size_3" class="check-t1__input" value="전신">
                                <label for="creation_size_3" class="check-t1__label">전신</label>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>

            <li class="creation__filter-item">
                <div class="creation__filter-title">
                    EXP
                </div>
                <ul class="creation__filter2">
                    <li class="creation__filter2-item2">
                        <div class="radio-t1">
                            <div class="radio-t1__box">
                                <input type="radio" name="creation_exp[]" id="creation_exp_0" class="radio-t1__input" value="0,10000">
                                <label for="creation_exp_0" class="radio-t1__label">1만 이하</label>
                            </div>
                        </div>
                    </li>
                    <li class="creation__filter2-item2">
                        <div class="radio-t1">
                            <div class="radio-t1__box">
                                <input type="radio" name="creation_exp[]" id="creation_exp_1" class="radio-t1__input" value="10000,50000">
                                <label for="creation_exp_1" class="radio-t1__label">1만 ~ 5만</label>
                            </div>
                        </div>
                    </li>
                    <li class="creation__filter2-item2">
                        <div class="radio-t1">
                            <div class="radio-t1__box">
                                <input type="radio" name="creation_exp[]" id="creation_exp_2" class="radio-t1__input" value="50000,1000000">
                                <label for="creation_exp_2" class="radio-t1__label">5만 이상</label>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
    <article class="creation__right">
        <div class="creation__list">
        </div>
    </article>
</section>
<script>
    $(function(){
        creation_obj.init($(".creation__list"));
        creation_obj.get_creation_list();
    });
</script>