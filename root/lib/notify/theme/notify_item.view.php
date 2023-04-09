<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($notify_list)){ ?>
    <?php foreach ($notify_list as $i => $notify) { ?>
    <li class="notify-item">
    <?php include_once(PAVE_LIB_NOTIFY_PATH."/theme/{$notify["notify_template"]}"); ?>
    </li>
    <?php } ?>
<?php }else { ?> 
    <?php if($page == 1){ ?>
    <?php include_once(PAVE_LIB_NOTIFY_PATH."/theme/notify_item_empty.view.php"); ?>
    <?php } ?>
<?php } ?>
