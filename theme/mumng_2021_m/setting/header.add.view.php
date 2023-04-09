<?php
if (!defined('_PAVE_')) exit;
?>
<section class="setting">
    <div class="setting__header">
        <div class="setting__header-container">
            <a href="javascript:history.back();" class="setting__header-close-button icon-button icon-button-24">
                <span class="icon-back icon-24"></span>
            </a>
            <h1 class="setting__header-title"><?=$setting_title?></h1>

            <?php if(defined("__ACCOUNT_PRIVACY__")){ ?>
            <button type="button" id="setting_update_button" class="setting__header-action-button button-t2 button-s4">수정</button>
            <?php } ?>
        </div>
    </div>

    <div class="setting__content">