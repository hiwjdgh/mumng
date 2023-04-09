<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column gap-row-24">
    <form class="adm-list__form" action="<?=get_url(PAVE_ADM_URL,"commerce/calc/list")?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=get_session("csrf_token")?>">

        <div class="flex flex-column mxw-5 gap-row-24">
            <table class="data-search-table">
                <tbody class="data-search-table__body">
                    <tr class="data-search-table__body-row">
                        <th class="data-search-table__body-header">분류</th>
                        <td class="data-search-table__body-col">
                            <div class="flex gap-column-8 mxw-2">
                                <div class="select-box-t2">
                                    <select name="search_field" id="search_field" class="select-box-t2__select" title="사용자 검색 구분">
                                        <option value="user_id" <?=get_selected("user_id", $search_field)?>>회원ID</option>
                                        <option value="user_code" <?=get_selected("user_code", $search_field)?>>코드</option>
                                        <option value="user_nick" <?=get_selected("user_nick", $search_field)?>>필명</option>
                                    </select>
                                </div>

                                <div class="input-box input-box-t4">
                                    <input type="text" name="search_keyword" id="search_keyword" class="input-box-t4__input" value="<?=$search_keyword?>" placeholder="검색">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr class="data-search-table__body-row">
                        <th class="data-search-table__body-header">커머스등급</th>
                        <td class="data-search-table__body-col">
                            <div class="flex gap-column-8">
                                <label for="user_grd_0" class="chip-check-box <?=get_checked("", $user_grd)?>">
                                    <input type="checkbox" name="user_grd[]" id="user_grd_0" class="chip-check-box__check" value="" <?=get_checked("", $user_grd)?>>
                                    <span class="chip-check-box__label">일반</span>
                                </label>
                                <label for="user_grd_1" class="chip-check-box <?=get_checked("C0", $user_grd)?>">
                                    <input type="checkbox" name="user_grd[]" id="user_grd_1" class="chip-check-box__check" value="C0" <?=get_checked("C0", $user_grd)?>>
                                    <span class="chip-check-box__label">C0</span>
                                </label>
                                <label for="user_grd_2" class="chip-check-box <?=get_checked("C1", $user_grd)?>">
                                    <input type="checkbox" name="user_grd[]" id="user_grd_2" class="chip-check-box__check" value="C1" <?=get_checked("C1", $user_grd)?>>
                                    <span class="chip-check-box__label">C1</span>
                                </label>
                                <label for="user_grd_3" class="chip-check-box <?=get_checked("C2", $user_grd)?>">
                                    <input type="checkbox" name="user_grd[]" id="user_grd_3" class="chip-check-box__check" value="C2" <?=get_checked("C2", $user_grd)?>>
                                    <span class="chip-check-box__label">C2</span>
                                </label>
                                <label for="user_grd_4" class="chip-check-box <?=get_checked("C3", $user_grd)?>">
                                    <input type="checkbox" name="user_grd[]" id="user_grd_4" class="chip-check-box__check" value="C3" <?=get_checked("C3", $user_grd)?>>
                                    <span class="chip-check-box__label">C3</span>
                                </label>
                                <label for="user_grd_5" class="chip-check-box <?=get_checked("C4", $user_grd)?>">
                                    <input type="checkbox" name="user_grd[]" id="user_grd_5" class="chip-check-box__check" value="C4" <?=get_checked("C4", $user_grd)?>>
                                    <span class="chip-check-box__label">C4</span>
                                </label>
                                <label for="user_grd_6" class="chip-check-box <?=get_checked("C5", $user_grd)?>">
                                    <input type="checkbox" name="user_grd[]" id="user_grd_6" class="chip-check-box__check" value="C5" <?=get_checked("C5", $user_grd)?>>
                                    <span class="chip-check-box__label">C5</span>
                                </label>
                                <label for="user_grd_7" class="chip-check-box <?=get_checked("C6", $user_grd)?>">
                                    <input type="checkbox" name="user_grd[]" id="user_grd_7" class="chip-check-box__check" value="C6" <?=get_checked("C6", $user_grd)?>>
                                    <span class="chip-check-box__label">C6</span>
                                </label>
                                <label for="user_grd_8" class="chip-check-box <?=get_checked("C7", $user_grd)?>">
                                    <input type="checkbox" name="user_grd[]" id="user_grd_8" class="chip-check-box__check" value="C7" <?=get_checked("C7", $user_grd)?>>
                                    <span class="chip-check-box__label">C7</span>
                                </label>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="data-search-table__body-row">
                        <th class="data-search-table__body-header">커머스 등록일</th>
                        <td class="data-search-table__body-col">
                            <div class="flex flex-align-item-center gap-column-8">
                                <div class="input-box input-box-t4">
                                    <input type="text" name="user_commerce_start_dt_from" id="user_commerce_start_dt_from" class="input-box-t4__input" value="<?=$user_commerce_start_dt_from?>" placeholder="커머스 등록일(<?=PAVE_TIME_YMD?>)">
                                </div>
                                ~
                                <div class="input-box input-box-t4">
                                    <input type="text" name="user_commerce_start_dt_to" id="user_commerce_start_dt_to" class="input-box-t4__input" value="<?=$user_commerce_start_dt_to?>" placeholder="커머스 등록일(<?=PAVE_TIME_YMD?>)">
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="flex flex-justify-content-flex-end gap-column-8">
                <button type="submit" class="button-t2 button-s2">초기화</button>
                <button type="submit" class="button-t1 button-s2">검색</button>
            </div>
        </div>
    </form>
    <table class="data-table">
        <thead class="data-table__head">
            <tr class="data-table__head-row">
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">회원 ID</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">필명</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">코드</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">커머스 등록일</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">상세보기</span>
                </th>
            </tr>
        </thead>
        <tbody class="data-table__body">
            <?php if(pave_is_array($commerce_user_list)){ ?>
                <?php foreach ($commerce_user_list as $i => $commerce_user) { ?>
                <tr class="data-table__body-row" data-order="<?=$i?>">
                    <td class="data-table__body-col" data-value="<?=$commerce_user["user_id"]?>" data-id="<?=$commerce_user["user_id"]?>"><?=$commerce_user["user_id"]?></td>
                    <td class="data-table__body-col" data-value="<?=$commerce_user["user_nick"]?>" data-id="<?=$commerce_user["user_nick"]?>"><?=$commerce_user["user_nick"]?></td>
                    <td class="data-table__body-col" data-value="<?=$commerce_user["user_code"]?>" data-id="<?=$commerce_user["user_code"]?>"><?=$commerce_user["user_code"]?></td>
                    <td class="data-table__body-col" data-value="<?=$commerce_user["user_commerce_start_dt"]?>" data-id="<?=$commerce_user["user_commerce_start_dt"]?>"><?=$commerce_user["user_commerce_start_dt"]?></td>
                    <td class="data-table__body-col"><a href="<?=get_url(PAVE_ADM_URL,"commerce/calc/detail/{$commerce_user["user_id"]}")?>" class="button-t1 button-s3">상세보기</a></td>
                </tr>
            <?php } ?>
            <?php }else{ ?>
                <tr>
                    <td colspan="5" class="data-table__body-col empty">검색결과가 없습니다.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
