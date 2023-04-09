<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($notify_list)){ ?>
    <?php include_once($pave_theme["thm_path"]."/notify_item.view.php"); ?>
<?php }else { ?> 
    <?php if($page == 1){ ?>
    <?php include_once($pave_theme["thm_path"]."/notify_item_empty.view.php"); ?>
    <?php } ?>
<?php } ?>