<?php
if (!defined('_PAVE_')) exit;
?>
<div class="help__search">
    <div class="help__search-header">
        <h3 class="help__search-header-text">"<?=$search_keyword?>" 검색결과</h3>
    </div>

    <ul class="help__search-list">
        <?php if(pave_is_array($help_bd_list)){ ?>
        <?php foreach ($help_bd_list as $i => $bd) { ?>
        <li class="help__search-item">
            <div class="help__search-item-inner-box">
                <span class="help__search-item-path">
                    <?=$bd["help_group_name"]?> > <?=$bd["help_bo_name"]?>
                </span>
                <a href="<?=get_url(PAVE_HELP_URL, "board/{$bd["help_group_id"]}/{$bd["help_bo_id"]}")?>" class="help__search-item-link"><?=$bd["help_bo_name"]?></a>
            </div>
            <span class="help__search-item-icon icon-right icon-20"></span>
        </li>
        <?php } ?>
        <?php }else{ ?>
        <li class="help__search-item-empty">
            <span class="help__search-item-empty-text">검색결과가 없습니다.</span>
        </li>
        <?php } ?>
    </ul>
</div>
