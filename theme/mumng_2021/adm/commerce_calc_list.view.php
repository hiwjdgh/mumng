<?php
if (!defined('_PAVE_')) exit;
?>
<div class="flex flex-column gap-row-24">
    <form class="adm-list__form" action="<?=get_url(PAVE_ADM_URL,"commerce/calc/list")?>" method="get" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="page" id="page" value="<?=$page?>">

        <div class="flex flex-column gap-row-24">
             
            <div class="flex flex-justify-content-flex-end gap-column-8">
                <button type="submit" class="button-t2 button-s2">초기화</button>
                <a href="<?=get_url(PAVE_ADM_URL,"commerce/calc/form")?>" class="button-t2 button-s2">추가</a>
                <button type="submit" class="button-t1 button-s2">검색</button>
            </div>
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
                        <th class="data-search-table__body-header">정산상태</th>
                        <td class="data-search-table__body-col">
                            <div class="flex gap-column-8">
                                <label for="calc_status_1" class="chip-check-box <?=get_checked("calc_ready", $calc_status)?>">
                                    <input type="checkbox" name="calc_status[]" id="calc_status_1" class="chip-check-box__check" value="calc_ready" <?=get_checked("calc_ready", $calc_status)?>>
                                    <span class="chip-check-box__label">신청대기</span>
                                </label>
                                <label for="calc_status_2>" class="chip-check-box <?=get_checked("calc_wait", $calc_status)?>">
                                    <input type="checkbox" name="calc_status[]" id="calc_status_2>" class="chip-check-box__check" value="calc_wait" <?=get_checked("calc_wait", $calc_status)?>>
                                    <span class="chip-check-box__label">신청완료</span>
                                </label>
                                <label for="calc_status_3" class="chip-check-box <?=get_checked("calc_complete", $calc_status)?>">
                                    <input type="checkbox" name="calc_status[]" id="calc_status_3" class="chip-check-box__check" value="calc_complete" <?=get_checked("calc_complete", $calc_status)?>>
                                    <span class="chip-check-box__label">입금완료</span>
                                </label>
                                <label for="calc_status_4" class="chip-check-box <?=get_checked("calc_cancel", $calc_status)?>">
                                    <input type="checkbox" name="calc_status[]" id="calc_status_4" class="chip-check-box__check" value="calc_cancel" <?=get_checked("calc_cancel", $calc_status)?>>
                                    <span class="chip-check-box__label">신청취소</span>
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr class="data-search-table__body-row">
                        <th class="data-search-table__body-header">정산 신청일</th>
                        <td class="data-search-table__body-col">
                            <div class="flex flex-align-item-center gap-column-8">
                                <div class="input-box input-box-t4">
                                    <input type="text" name="calc_insert_dt_from" id="calc_insert_dt_from" class="input-box-t4__input date-autocomplete" value="<?=$calc_insert_dt_from?>" placeholder="정산 신청일(<?=PAVE_TIME_YMD?>)">
                                </div>
                                ~
                                <div class="input-box input-box-t4">
                                    <input type="text" name="calc_insert_dt_to" id="calc_insert_dt_to" class="input-box-t4__input date-autocomplete" value="<?=$calc_insert_dt_to?>" placeholder="정산 신청일(<?=PAVE_TIME_YMD?>)">
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
           
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
                    <span class="data-table__head-col-text">정산EXP</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">정산금액</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">무명수수료</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">원천징수세</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">정산은행</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">계좌번호</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">예금주</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">정산상태</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">상세보기</span>
                </th>
            </tr>
        </thead>
        <tbody class="data-table__body">
            <?php if(pave_is_array($calc_list)){ ?>
                <?php foreach ($calc_list as $i => $calc) { ?>
                <tr class="data-table__body-row <?=$request[2] == $calc["calc_id"] ? "current" : ""?>" data-order="<?=$i?>">
                    <td class="data-table__body-col" data-value="<?=$calc["user_id"]?>"><?=$calc["user_id"]?></td>
                    <td class="data-table__body-col" data-value="<?=$calc["user_nick"]?>"><?=$calc["user_nick"]?></td>
                    <td class="data-table__body-col" data-value="<?=$calc["user_code"]?>"><?=$calc["user_code"]?></td>
                    <td class="data-table__body-col" data-value="<?=$calc["calc_exp"]?>"><?=Converter::display_number($calc["calc_exp"], "EXP")?></td>
                    <td class="data-table__body-col" data-value="<?=$calc["calc_real_price"]?>"><?=Converter::display_number($calc["calc_real_price"], "원")?></td>
                    <td class="data-table__body-col" data-value="<?=$calc["calc_fee_price"]?>"><?=Converter::display_number($calc["calc_fee_price"], "원")?></td>
                    <td class="data-table__body-col" data-value="<?=$calc["calc_tax_price"]?>"><?=Converter::display_number($calc["calc_tax_price"], "원")?></td>
                    <td class="data-table__body-col" data-value="<?=$calc["calc_bank"]?>"><?=$calc["calc_bank"]?></td>
                    <td class="data-table__body-col" data-value="<?=$calc["calc_bank_number"]?>"><?=$calc["calc_bank_number"]?></td>
                    <td class="data-table__body-col" data-value="<?=$calc["calc_bank_owner"]?>"><?=$calc["calc_bank_owner"]?></td>
                    <td class="data-table__body-col" data-value="<?=$calc["calc_status_text"]?>"><?=$calc["calc_status_text"]?></td>
                    <td class="data-table__body-col"><a href="<?=get_url(PAVE_ADM_URL,"commerce/calc/form?calc_id={$calc["calc_id"]}")?>" class="button-t1 button-s3">상세보기</a></td>
                </tr>
            <?php } ?>
            <?php }else{ ?>
            <tr>
                <td colspan="13" class="data-table__body-col empty">정산 신청 내역이 없습니다.</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
