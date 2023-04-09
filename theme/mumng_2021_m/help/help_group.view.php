<?php
if (!defined('_PAVE_')) exit;
?>
<div class="help__home">
    <div class="help__home-lnb">
        <ul class="help__home-lnb-list">
            <?php foreach ((array)$help_bo_list as $i => $bo) { ?>
            <li class="help__home-lnb-item">
                <a href="<?=get_url(PAVE_HELP_URL,"board/{$bo["help_group_id"]}/{$bo["help_bo_id"]}")?>" class="help__home-lnb-item-link">
                    <span class="help__home-lnb-item-link-text"><?=$bo["help_bo_name"]?></span>
                    <span class="help__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <?php } ?>
        </ul>
    </div>
</div>