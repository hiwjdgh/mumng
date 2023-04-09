<?php
if (!defined('_PAVE_')) exit;
?>
<div class="help__home">
    <div class="help__home-lnb">
        <ul class="help__home-lnb-list">
            <?php foreach ((array)$help_group_list as $i => $group) { ?>
            <li class="help__home-lnb-item">
                <a href="<?=get_url(PAVE_HELP_URL,"group/{$group["help_group_id"]}/{$group["help_bo_id"]}")?>" class="help__home-lnb-item-link">
                    <span class="help__home-lnb-item-link-text"><?=$group["help_group_name"]?></span>
                    <span class="help__home-lnb-item-link-icon icon-right icon-20"></span>
                </a>
            </li> 
            <?php } ?>
        </ul>
    </div>
</div>