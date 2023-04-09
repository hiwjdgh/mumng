<?php
if (!defined('_PAVE_')) exit;
?>
<div class="commerce__calc">
    <h2 class="commerce__calc-title"><a href="<?=get_url(PAVE_COMMERCE_URL, "calc")?>">정산</a></h2>
    <div class="commerce__row">
        <div class="commerce__col">
            <div class="commerce__card">
                <div class="commerce__card-header">
                    <h3 class="commerce__card-header-title">현재 보유중인 EXP
                        <div class="tooltip-box">
                            <span class="tooltip-box__icon icon-help icon-12"></span>
                            <div class="tooltip-box__content">
                                <p>작품 활동으로 획득한 EXP 입니다.</p>
                                <p>무료 EXP는 합산에서 제외 됩니다.</p>
                                <p>- 광고 EXP</p>
                                <p>- 이벤트 EXP</p>
                            </div>
                        </div>
                    </h3>
                    <div class="commerce__card-header-more">
                        <a href="<?=get_url(PAVE_GUIDE_URL)?>" target="_blank">정산가이드</a>
                    </div>
                </div>

                <div class="commerce__card-content">
                    <div class="flex flex-align-item-center flex-justify-content-space-between">
                        <div class="flex flex-column">
                            <div class="flex flex-align-item-center text-size-xsmall text-color-g7 text-weight-regular">
                                <span class="mgr-6">총 획득한 EXP</span>
                                <span><?=Converter::display_number($profit_overview["total_exp"], "EXP")?></span>
                            </div>
                            <div class="flex flex-align-item-center text-size-large text-color-g7 text-weight-bold">
                                <span class="mgr-4 text-color-g12"><?=Converter::display_number($profit_overview["hold_exp"])?></span>
                                <span class="text-color-g10">EXP</span>
                            </div>
                        </div>
                        <button type="button" class="commerce_calc_button button-t1 button-s2 <?=Commerce::is_calc_day() ? "" : "disabled"?>" <?=Commerce::is_calc_day() ? "" : "disabled"?>>정산신청</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="commerce__row">
        <div class="commerce__col">
            <div class="commerce__card">
                <div class="commerce__card-header">
                    <h3 class="commerce__card-header-title">정산현황
                        <div class="tooltip-box">
                            <span class="tooltip-box__icon icon-help icon-12"></span>
                            <div class="tooltip-box__content">
                                <p>최근 정산금액입니다.</p>
                                <p>신청대기</p>
                                <p>- 정산신청 검토</p>
                                <p>신청완료</p>
                                <p>- 정산신청 승인</p>
                                <p>입금완료</p>
                                <p>- 정산금액 입금완료</p>
                            </div>
                        </div>
                    </h3>
                    <div class="commerce__card-header-more">
                        <span class="commerce__card-header-more-text">최근 신청일</span>
                        <span class="commerce__card-header-more-date">
                            <?php 
                                if($calc_list[0]){
                                    echo Converter::display_time($calc_list[0]["calc_insert_dt"]);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </span>
                    </div>
                </div>

                <div class="commerce__card-content">
                    <div class="commerce__row">
                        <div class="commerce__col">
                            <div class="flex flex-column">
                                <div class="flex flex-align-item-center text-size-xsmall text-color-g7 text-weight-regular">
                                    <span class="mgr-6">
                                        <?php 
                                            if($calc_list[0]["calc_status"] == "calc_ready"){
                                                echo "최근 정산신청금액";
                                            }else if($calc_list[0]["calc_status"] == "calc_wait"){
                                                echo "최근 정산대기금액";
                                            }else if($calc_list[0]["calc_status"] == "calc_complete"){
                                                echo "최근 정산금액";
                                            }else{
                                                echo "최근 정산금액";
                                            }
                                        ?>    
                                    </span>
                                </div>
                                <div class="flex flex-align-item-center text-size-large text-color-g7 text-weight-bold">
                                    <span class="mgr-4 text-color-g12"><?=Converter::display_number($calc_list[0]["calc_real_price"])?></span>
                                    <span class="text-color-g10">원</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="commerce__row">
        <div class="commerce__col">
            <div class="commerce__card">
                <div class="commerce__card-header">
                    <h3 class="commerce__card-header-title">정산현황
                        <div class="tooltip-box">
                            <span class="tooltip-box__icon icon-help icon-12"></span>
                            <div class="tooltip-box__content">
                                <p>정산신청 현황입니다.</p>
                            </div>
                        </div>
                    </h3>
                </div>
                <div class="commerce__card-content">
                    <table class="data-table">
                        <thead class="data-table__head">
                            <tr class="data-table__head-row">
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">정산번호</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">정산신청 EXP</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">정산금액</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">무명수수료</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">무명부가세</span>
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
                                    <span class="data-table__head-col-text">신청일</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">정산상태</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="data-table__body">
                            <?php if(pave_is_array($calc_list)){ ?>
                                <?php foreach ($calc_list as $i => $calc) { ?>
                                <tr class="data-table__body-row <?=$request[2] == $calc["calc_no"] ? "current" : ""?>" data-order="<?=$i?>">
                                    <td class="data-table__body-col" data-value="<?=$calc["calc_no"]?>"><?=$calc["calc_no"]?></td>
                                    <td class="data-table__body-col" data-value="<?=$calc["calc_exp"]?>"><?=Converter::display_number($calc["calc_exp"], "EXP")?></td>
                                    <td class="data-table__body-col" data-value="<?=$calc["calc_real_price"]?>"><?=Converter::display_number($calc["calc_real_price"], "원")?></td>
                                    <td class="data-table__body-col" data-value="<?=$calc["calc_fee_price"]?>"><?=Converter::display_number($calc["calc_fee_price"], "원")?></td>
                                    <td class="data-table__body-col" data-value="<?=$calc["calc_vat_price"]?>"><?=Converter::display_number($calc["calc_vat_price"], "원")?></td>
                                    <td class="data-table__body-col" data-value="<?=$calc["calc_bank_name"]?>"><?=$calc["calc_bank_name"]?></td>
                                    <td class="data-table__body-col" data-value="<?=$calc["calc_bank_number"]?>"><?=$calc["calc_bank_number"]?></td>
                                    <td class="data-table__body-col" data-value="<?=$calc["calc_bank_owner"]?>"><?=$calc["calc_bank_owner"]?></td>
                                    <td class="data-table__body-col" data-value="<?=$calc["calc_ready_dt"]?>"><?=Converter::display_time($calc["calc_ready_dt"])?></td>
                                    <td class="data-table__body-col" data-value="<?=$calc["calc_status_text"]?>"><?=$calc["calc_status_text"]?></td>
                                </tr>
                            <?php } ?>
                            <?php }else{ ?>
                            <tr>
                                <td colspan="10" class="data-table__body-col empty">정산 신청 내역이 없습니다.</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>