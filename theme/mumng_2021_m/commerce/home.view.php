<?php
if (!defined('_PAVE_')) exit;
?>
<div class="commerce__home">
    <h2 class="commerce__home-title"><a href="<?=get_url(PAVE_COMMERCE_URL, "home")?>">홈</a></h2>

    <?php if($pave_user["user_commerce"]){ ?>
    <div class="commerce__row">
        <div class="commerce__col">
            <div class="commerce__home-card">
                <div class="commerce__home-card-grade">
                    <div class="commerce__home-card-user">
                        <div class="commerce__home-card-user-nick-box">
                            <img src="<?=$pave_user["user_img"]?>" alt="프로필 이미지" class="commerce__home-card-user-img" width="40" height="40">
                            <span class="commerce__home-card-user-nick"><?=$pave_user["user_nick"]?></span>
                        </div>

                        <div class="commerce__home-card-user-date-box">
                            <span class="commerce__home-card-user-date-text">멤버십 가입일</span>
                            <span class="commerce__home-card-user-date">
                                <?php 
                                if($pave_user["user_commerce"]){
                                    echo Converter::display_time($pave_user["user_commerce"]["user_commerce_start_dt"]);
                                }else{
                                    echo "미가입";
                                }
                                ?>
                            </span>
                        </div>
                    </div>

                    <div class="commerce__home-card-info">
                        <div class="commerce__home-card-info-detail-box">
                            <div class="commerce__home-card-info-icon-box">
                                <span class="commerce__home-card-info-icon-text">
                                    <?php 
                                        if($pave_user["user_commerce"]){
                                            echo "현재 회원님의 등급은 {$pave_user["user_commerce"]["user_commerce_grd"]} 등급입니다.";
                                        }else{
                                            echo "커머스 작가가 되어 수익을 창출해보세요.";
                                        }
                                    ?>
                                </span>
                                <div class="commerce__home-card-info-icon-inner-box">
                                    <span class="commerce__home-card-info-icon icon-commerce <?=$pave_user["user_commerce"] ? "icon-active" : "icon-inactive" ?> icon-30">
                                        <span class="skip">커머스 등급 이미지</span>
                                    </span>
                                    <span class="commerce__home-card-info-icon-text2">
                                        <?php 
                                            if($pave_user["user_commerce"]){
                                                echo $pave_user["user_commerce"]["user_commerce_grd"];
                                            }else{
                                                echo "일반작가";
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>

                            <div class="commerce__home-card-info-fee-box">
                                <span class="commerce__home-card-info-fee-text">작품 수익 수수료</span>
                                <span class="commerce__home-card-info-fee">
                                    <?php 
                                        if($pave_user["user_commerce"]){
                                            echo $pave_user["user_commerce"]["user_commerce_fee"]."%";
                                        }else{
                                            echo "해당없음";
                                        }
                                    ?>
                                </span>
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
                                <p>정산신청</p>
                                <p>- 매월 1일부터 7일간 가능</p>
                                <p>- 15일 이내 등록 계좌로 입금</p>
                            </div>
                        </div>
                    </h3>

                    <div class="commerce__card-header-more">
                        <span class="commerce__card-header-more-text">최근정산일</span>
                        <span class="commerce__card-header-more-date">
                            <?php 
                                if($calc_latest_overview[0]){
                                    echo Converter::display_time($calc_latest_overview[0]["calc_insert_dt"]);
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
                                    <span class="mgr-6">총 정산금액</span>
                                </div>
                                <div class="flex flex-align-item-center text-size-large text-color-g7 text-weight-bold">
                                    <span class="mgr-4 text-color-g12"><?=Converter::display_number($calc_overview["total_calc"])?></span>
                                    <span class="text-color-g10">원</span>
                                </div>
                            </div>
                        </div>
                        <div class="line-vertical-g7-h40"></div>
                        <div class="commerce__col">
                            <div class="flex flex-column">
                                <div class="flex flex-align-item-center text-size-xsmall text-color-g7 text-weight-regular">
                                    <span class="mgr-6">
                                        <?php 
                                            if($calc_latest_overview[0]["calc_status"] == "calc_ready"){
                                                echo "최근 정산신청금액";
                                            }else if($calc_latest_overview[0]["calc_status"] == "calc_wait"){
                                                echo "최근 정산대기금액";
                                            }else if($calc_latest_overview[0]["calc_status"] == "calc_complete"){
                                                echo "최근 정산금액";
                                            }else{
                                                echo "최근 정산금액";
                                            }
                                        ?>
                                    </span>
                                </div>
                                <div class="flex flex-align-item-center text-size-large text-color-g7 text-weight-bold">
                                    <span class="mgr-4 text-color-g12"><?=Converter::display_number($calc_latest_overview[0]["calc_real_price"])?></span>
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
                    <h3 class="commerce__card-header-title">총 작품 현황
                        <div class="tooltip-box">
                            <span class="tooltip-box__icon icon-help icon-12"></span>
                            <div class="tooltip-box__content">
                                <p>작품</p>
                                <p>- 공개된 작품의 수</p>
                                <p>회차</p>
                                <p>- 공개된 작품 회차의 수</p>
                                <p>대여</p>
                                <p>- 독자가 대여(미리보기,회차대여)중인 수</p>
                                <p>소장</p>
                                <p>- 독자가 소장(회차소장,완결소장)중인 수</p>
                            </div>
                        </div>
                    </h3>
                </div>

                <div class="commerce__card-content">
                    <div class="flex flex-column">
                        <div class="flex flex-align-item-center flex-justify-content-space-between text-size-small text-color-g12 text-weight-regular">
                            <span>작품</span>
                            <span class="text-size-large text-weight-bold"><?=Converter::display_number($work_cnt)?></span>
                        </div>
                        <div class="flex flex-align-item-center flex-justify-content-space-between text-size-small text-color-g12 text-weight-regular">
                            <span>회차</span>
                            <span class="text-size-large text-weight-bold"><?=Converter::display_number($epsd_cnt)?></span>
                        </div>
                        <div class="flex flex-align-item-center flex-justify-content-space-between text-size-small text-color-g12 text-weight-regular">
                            <span>대여</span>
                            <span class="text-size-large text-weight-bold"><?=Converter::display_number($rent_cnt)?></span>
                        </div>
                        <div class="flex flex-align-item-center flex-justify-content-space-between text-size-small text-color-g12 text-weight-regular">
                            <span>소장</span>
                            <span class="text-size-large text-weight-bold"><?=Converter::display_number($keep_cnt)?></span>
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
                    <h3 class="commerce__card-header-title">최근 정산신청 현황
                        <div class="tooltip-box">
                            <span class="tooltip-box__icon icon-help icon-12"></span>
                            <div class="tooltip-box__content">
                                <p>최근 3건의 정산신청 현황입니다.</p>
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
                            <?php if(pave_is_array($calc_latest_overview)){ ?>
                                <?php foreach ($calc_latest_overview as $i => $calc) { ?>
                                <tr class="data-table__body-row" data-href="<?=get_url(PAVE_COMMERCE_URL, "calc")?>" data-order="<?=$i?>">
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
                                <td colspan="10" class="data-table__body-col empty">최근 정산 신청 내역이 없습니다.</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="commerce__row">
        <div class="commerce__col">
            <div class="commerce__home-empty">
                <img src="<?=get_url(PAVE_IMG_URL,"img_empty_commerce_640px.png")?>" alt="커머스없음 이미지" width="240" height="240" usemap="#author" class="commerce__home-empty-img">
                <map name="author">
                <area shape="poly" coords="71,170,104,188,103,195,66,174" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
                </map>
                <p class="commerce__home-empty-text">커머스 멤버십 등록이 필요합니다.</p>
                <button type="button" class="commerce__home-empty-text2">커머스 등록하기</button>
            </div>
        </div>
    </div>
    <?php }?>
</div>