<?php
if (!defined('_PAVE_')) exit;
?>
<table id="charge__content_list" class="mgb-24">
    <thead class="bdt-1-solid-g4 bdb-1-solid-g4">
        <tr>
            <th class="bg-g2 pdvt-8 text-weight-medium text-color-g12 text-size-xsmall">충전일</th>
            <th class="bg-g2 pdvt-8 text-weight-medium text-color-g12 text-size-xsmall">충전EXP</th>
            <th class="bg-g2 pdvt-8 text-weight-medium text-color-g12 text-size-xsmall">상세보기</th>
        </tr>
    </thead>
    <tbody>
    <?php if(pave_is_array($receipt_list)){ ?>
        <?php foreach ($receipt_list as $i => $receipt) { ?>
        <tr class="bdb-1-solid-g4 text-align-center">
            <td class="text-weight-regular text-color-g12 text-size-xsmall pdvt-18"><?=Converter::display_time($receipt["rcpt_insert_dt"])?></td>
            <td class="pdvt-18">
                <?php if($receipt["rcpt_status"] != "payment_complete"){ ?>
                <span class="text-weight-bold text-color-g10 text-size-small"></span>
                <span class="text-weight-bold text-color-g12 text-size-small mghz-4"><?=$receipt["rcpt_status_text"]?></span>
                <span class="text-weight-bold text-color-g10 text-size-small"></span>
                <?php }else{ ?>
                <span class="text-weight-bold text-color-g10 text-size-small">+</span>
                <span class="text-weight-bold text-color-g12 text-size-small mghz-4"><?=Converter::display_number($receipt["rcpt_exp"]["exp_amount"])?></span>
                <span class="text-weight-bold text-color-g10 text-size-small">EXP</span>
                <?php } ?>
            </td>
            
            <td class="pdvt-18">
                <button type="button" class="receipt_detail_button text-button regular g12 xsmall" data-receipt="<?=$receipt["rcpt_id"]?>">상세보기</button>
            </td>
        </tr>
        <?php }?>
    <?php }else{ ?>
        <tr class="bdb-1-solid-g4 text-align-center">
            <td colspan="3" class="charge__content_empty">충전내역이 없습니다.</td>
        </tr>
    <?php }?>
    </tbody>
</table>
<?php if($pagination["total_page"] > 1){ ?>
<ul id="charge__content_pagination" class="pagination">
    <li class="pagination__prev <?=$pagination["prev_page"] == 0 ? "readonly" : ""?>">
        <a href="<?=get_url(PAVE_CHARGE_URL, "receipt/list/{$pagination["prev_page"]}")?>">이전</a>
    </li>
    <?php for ($i = $pagination["from_page"]; $i <= $pagination["to_page"] ; $i++) { ?>
    <li class="pagination__item <?=$pagination["page"] == $i ? "current readonly" : ""?>">
        <a href="<?=get_url(PAVE_CHARGE_URL, "receipt/list/{$i}")?>"><?=$i?></a>
    </li>
    <?php } ?>
    <li class="pagination__next <?=$pagination["next_page"] == 0 ? "readonly" : ""?>">
        <a href="<?=get_url(PAVE_CHARGE_URL, "receipt/list/{$pagination["next_page"]}")?>">다음</a>
    </li>
</ul>
<?php } ?>
