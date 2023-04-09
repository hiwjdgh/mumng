<?php
if (!defined('_PAVE_')) exit;
?>
   
<div class="charge__content-container">
    <table class="charge__content-list mgb-24">
        <thead class="bdt-1-solid-g4 bdb-1-solid-g4">
            <tr>
           
                <th class="bg-g2 pdvt-8 text-weight-medium text-color-g12 text-size-xsmall">상품명</th>
                <th class="bg-g2 pdvt-8 text-weight-medium text-color-g12 text-size-xsmall">사용EXP</th>
                <th class="bg-g2 pdvt-8 text-weight-medium text-color-g12 text-size-xsmall">상세보기</th>
            </tr>
        </thead>
        <tbody>
            <?php if(pave_is_array($pay_list)){ ?>
                <?php foreach ($pay_list as $i => $pay) { ?>
                <tr class="bdb-1-solid-g4 text-align-center">
                    <td class="pdvt-12 text-align-left">
                        <p class="text-weight-regular text-color-g7 text-size-xxsmall"><?=$pay["pay_work"]["work_name"]?></p>
                        <p class="text-weight-regular text-color-g10 text-size-xxsmall"><?=$pay["pay_epsd"]["epsd_name"]?></p>
                    </td>
                    <td class="pdvt-12">
                        <?php if($pay["pay_status"] == "success"){ ?>
                        <span class="text-weight-bold text-color-g10 text-size-small">-</span>
                        <span class="text-weight-bold text-color-g12 text-size-small mghz-4"><?=Converter::display_number($pay["pay_exp"])?></span>
                        <span class="text-weight-bold text-color-g10 text-size-small">EXP</span>
                        <?php }else {?> 
                        <span class="text-weight-bold text-color-g10 text-size-small"></span>
                        <span class="text-weight-bold text-color-g12 text-size-small mghz-4"><?=$pay["pay_status_text"]?></span>
                        <span class="text-weight-bold text-color-g10 text-size-small"></span>
                        <?php } ?>
                    </td>
                    <td class="pdvt-12">
                        <button type="button" class="pay-detail-button text-button regular g12 xsmall" data-pay="<?=$pay["pay_id"]?>">상세보기</button>
                    </td>
                </tr>
                <?php }?>
            <?php }else{ ?>
                <tr class="bdb-1-solid-g4 text-align-center">
                    <td colspan="3" class="charge__content-empty">구매내역이 없습니다.</td>
                </tr>
            <?php }?>
        </tbody>
    </table>
    <?php if($pagination["total_page"] > 1){ ?>
    <ul class="charge__content-pagination pagination">
        <li class="pagination__prev <?=$pagination["prev_page"] == 0 ? "readonly" : ""?>">
            <a href="<?=get_url(PAVE_CHARGE_URL, "pay/list/{$pagination["prev_page"]}")?>">이전</a>
        </li>
        <?php for ($i = $pagination["from_page"]; $i <= $pagination["to_page"] ; $i++) { ?>
        <li class="pagination__item <?=$pagination["page"] == $i ? "current readonly" : ""?>">
            <a href="<?=get_url(PAVE_CHARGE_URL, "pay/list/{$i}")?>"><?=$i?></a>
        </li>
        <?php } ?>
        <li class="pagination__next <?=$pagination["next_page"] == 0 ? "readonly" : ""?>">
            <a href="<?=get_url(PAVE_CHARGE_URL, "pay/list/{$pagination["next_page"]}")?>">다음</a>
        </li>
    </ul>
    <?php } ?>
</div>
  