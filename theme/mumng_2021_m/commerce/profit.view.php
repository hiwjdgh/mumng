<?php
if (!defined('_PAVE_')) exit;
?>
<div class="commerce__profit">
    <h2 class="commerce__profit-title"><a href="<?=get_url(PAVE_COMMERCE_URL, "profit")?>">수익</a></h2>
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
                    <h3 class="commerce__card-header-title">작품별 수익현황
                        <div class="tooltip-box">
                            <span class="tooltip-box__icon icon-help icon-12"></span>
                            <div class="tooltip-box__content">
                                <p>작품을 선택하여 확인</p>
                            </div>
                        </div>
                    </h3>
                </div>
                <div class="commerce__card-content">
                    <table class="data-table">
                        <thead class="data-table__head">
                            <tr class="data-table__head-row">
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">작품명</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">총 회차</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">커머스 여부</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">획득 EXP</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">조회</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">좋아요</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">의견</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">대여</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">소장</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">작품 등록일</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">최근 연재일</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">상태</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="data-table__body">
                            <?php if(pave_is_array($work_list)){ ?>
                                <?php foreach ($work_list as $i => $work) { ?>
                                <tr class="data-table__body-row <?=$request[2] == $work["work_id"] ? "current" : ""?>" data-href="<?=get_url(PAVE_COMMERCE_URL, "profit/{$work["work_id"]}")?>" data-order="<?=$i?>">
                                    <td class="data-table__body-col work-detail" data-value="<?=$work["work_name"]?>" data-id="<?=$work["work_id"]?>">
                                        <div class="commerce__profit-rank-content-item-img-box">
                                            <img src="<?=$work["work_img"]?>" alt="작품 이미지" class="commerce__profit-rank-content-item-img" width="40" height="40">
                                            <span class="commerce__profit-rank-content-item-text"><?=$work["work_name"]?></span>
                                        </div>
                                    </td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_epsd_cnt"]?>"><?=Converter::display_number($work["work_epsd_cnt"], "화")?></td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_free"]?>"><?=$work["work_free"] ? "무료 커머스" : "유료 커머스" ?></td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_earn_exp"]?>"><?=Converter::display_number($work["work_earn_exp"], "EXP")?></td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_total"]["total_hit"]?>"><?=Converter::display_number($work["work_total"]["total_hit"], "회")?></td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_total"]["total_like"]?>"><?=Converter::display_number($work["work_total"]["total_like"], "개")?></td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_total"]["total_cmt"]?>"><?=Converter::display_number($work["work_total"]["total_cmt"], "개")?></td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_rent_cnt"]?>"><?=Converter::display_number($work["work_rent_cnt"], "개")?></td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_keep_cnt"]?>"><?=Converter::display_number($work["work_keep_cnt"], "개")?></td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_insert_dt_text"]?>"><?=Converter::display_time($work["work_insert_dt"])?></td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_update_dt_text"]?>"><?=Converter::display_time($work["work_update_dt"])?></td>
                                    <td class="data-table__body-col" data-value="<?=$work["work_display"]?>">
                                        <?php 
                                        if($work["work_display"]){
                                            echo "공개";
                                        }else{
                                            echo "비공개";
                                        }

                                        switch ($work["work_state"]) {
                                            case "publish":
                                                echo "(연재)";
                                                break;
                                            case "end":
                                                echo "(완결)";
                                                break;
                                            case "stop":
                                                echo "(휴재)";
                                                break;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php }else{ ?>
                                <tr>
                                    <td colspan="12" class="data-table__body-col empty">작품이 없습니다.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="commerce__row">
        <div class="commerce__col">
            <div class="commerce__card">
                <div class="commerce__card-header">
                    <h3 class="commerce__card-header-title">회차정보</h3>
                </div>
                <div class="commerce__card-content">
                    <table class="data-table">
                        <thead class="data-table__head">
                            <tr class="data-table__head-row">
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">회차 No.</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">회차명</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">획득EXP</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">조회</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">좋아요</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">의견</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">대여</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">소장</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">등록일</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">연재일</span>
                                </th>
                                <th class="data-table__head-col default">
                                    <span class="data-table__head-col-text">상태</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="data-table__body">
                            <?php if(pave_is_array($epsd_list)){ ?>
                                <?php foreach ($epsd_list as $i => $epsd) { ?>
                                <tr class="data-table__body-row" data-order="<?=$i?>">
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_no"]?>">
                                        <?php 
                                            if($epsd["epsd_no"] == 0){
                                                echo "프롤로그";
                                            }else{
                                                echo Converter::display_number($epsd["epsd_no"], "화");
                                            }
                                        ?>
                                    </td>
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_name"]?>">
                                        <div class="commerce__profit-epsd-content-item-img-box">
                                            <img src="<?=$epsd["epsd_img"]?>" alt="회차 이미지" class="commerce__profit-epsd-content-item-img" width="40" height="40">
                                            <span class="commerce__profit-epsd-content-item-text"><?=$epsd["epsd_name"]?></span>
                                        </div>
                                    </td>
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_earn_exp"]?>"><?=Converter::display_number($epsd["epsd_earn_exp"], "EXP")?></td>
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_hit"]?>"><?=Converter::display_number($epsd["epsd_hit"], "회")?></td>
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_like"]?>"><?=Converter::display_number($epsd["epsd_like"], "개")?></td>
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_cmt"]?>"><?=Converter::display_number($epsd["epsd_cmt"], "개")?></td>
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_rent_cnt"]?>"><?=Converter::display_number($epsd["epsd_rent_cnt"], "개")?></td>
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_keep_cnt"]?>"><?=Converter::display_number($epsd["epsd_keep_cnt"], "개")?></td>
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_insert_dt"]?>"><?=Converter::display_time($epsd["epsd_insert_dt"])?></td>
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_upload_dt"]?>"><?=Converter::display_time($epsd["epsd_upload_dt"])?></td>
                                    <td class="data-table__body-col" data-value="<?=$epsd["epsd_state_text"]?>">
                                        <?=$epsd["epsd_state_text"]?>
                                        <?php 
                                            if($epsd["epsd_state"] == "success"){
                                                echo "연재중";
                                            }else if($epsd["epsd_state"] == "reserve"){
                                                echo "미리보기";
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php }else{ ?>
                            <tr>
                                <td colspan="11" class="data-table__body-col empty">
                                    <?php
                                    if($request[2]){
                                        echo "회차가 없습니다.";
                                    }else{
                                        echo "작품을 선택해주세요.";
                                    }
                                    ?>
                                    
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>