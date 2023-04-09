<?php
if (!defined('_PAVE_')) exit;
?>
<div class="adm-help flex flex-column">
    <div class="flex flex-justify-content-space-between">
        <span class="adm-help__bd-cnt"><?=Converter::display_number($help_bd_cnt)?></span>
        <a href="<?=get_url(PAVE_ADM_URL, "help/bd/form")?>">추가</a>
    </div>
    <table class="adm-help__bd-list data-table">
        <thead class="data-table__head">
            <tr class="data-table__head-row">
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">도움말그룹명</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">도움말명</span>
                </th>
                <th class="data-table__head-col default">
                    <span class="data-table__head-col-text">공개</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">관리</span>
                </th>
            </tr>
        </thead>
        <tbody class="data-table__body">
            <?php if(pave_is_array($help_bd_list)){ ?>
                <?php foreach ($help_bd_list as $i => $bd) { ?>
                <tr class="data-table__body-row" data-order="<?=$i?>">
                    <td class="data-table__body-col" data-value="<?=$bd["help_group_name"]?>"><?=$bd["help_group_name"]?></td>
                    <td class="data-table__body-col" data-value="<?=$bd["help_bo_name"]?>"><?=$bd["help_bo_name"]?></td>
                    <td class="data-table__body-col" data-value="<?=$bd["help_bd_display_text"]?>"><?=$bd["help_bd_display_text"]?></td>
                    <td class="data-table__body-col"><a href="<?=get_url(PAVE_ADM_URL, "help/bd/form/{$bd["help_bd_id"]}")?>">수정</a></td>
                </tr>
            <?php } ?>
            <?php }else{ ?>
            <tr>
                <td colspan="4" class="data-table__body-col empty">도움말이 없습니다.</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>