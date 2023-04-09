<?php
if (!defined('_PAVE_')) exit;
?>
<li class="epsd-item__empty">
    <?php if($work["is_own"]){ ?> 
    <a href="<?=get_url(PAVE_UPLOAD_URL, "home")?>" class="epsd-item__empty-link" target="_blank">
        <span class="icon-plus icon-24"></span>
    </a>
    <p class="epsd-item__empty-text">첫 회차를 연재한 후 부터<br>작품이 노출됩니다 !</p>
    <?php }else{ ?>
    <a href="<?=get_url(PAVE_URL)?>" class="epsd-item__empty-link2">다른 작품 둘러보기</a>
    <?php } ?>
</li>