<?php
if (!defined('_PAVE_')) exit;
?>
<div class="guide__search">
    <div class="guide__search-header">
        <h3 class="guide__search-header-text">"<?=$search_keyword?>" 검색결과</h3>
    </div>

    <ul class="guide__search-list">
        <?php if(pave_is_array($guide_bd_list)){ ?>
        <?php foreach ($guide_bd_list as $i => $bd) { ?>
        <li class="guide__search-item">
            <div class="guide__search-item-inner-box">
                <span class="guide__search-item-path">
                    <?=$bd["guide_group_name"]?> > <?=$bd["guide_bo_name"]?>
                </span>
                <a href="<?=get_url(PAVE_GUIDE_URL, "board/{$bd["guide_group_id"]}/{$bd["guide_bo_id"]}")?>" class="guide__search-item-link"><?=$bd["guide_bo_name"]?></a>
            </div>
            <span class="guide__search-item-icon icon-right icon-20"></span>
        </li>
        <?php } ?>
        <?php }else{ ?>
        <li class="guide__search-item-empty">
            <span class="guide__search-item-empty-text">검색결과가 없습니다.</span>
        </li>
        <?php } ?>
    </ul>
</div>
