<?php
if (!defined('_PAVE_')) exit;
?>
<?php 
foreach ($notify_list as $i => $notify) { ?>
<li class="notify-item">
    <?php include($pave_theme["thm_path"]."/{$notify["notify_template"]}"); ?>
</li>
<?php } ?>
