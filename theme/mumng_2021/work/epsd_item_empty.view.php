<?php
if (!defined('_PAVE_')) exit;
?>
<?php if($work["is_own"]){ ?> 
<li class="epsd-item-add">
    <a href="<?=get_url(PAVE_UPLOAD_URL, "home")?>" class="epsd-item-add__box">
        <button type="button" class="epsd-item-add__button add-webtoon-button">
            <span class="icon icon-64 icon-white-plus"></span>
        </button>
        <p class="epsd-item-add__text">원고 업로드</p>
    </a>
</li>
<?php }else{ ?>
<li class="epsd-item-empty">
    <a href="<?=get_url(PAVE_URL)?>" class="epsd-item-empty__box">
        <p class="epsd-item-empty__text">작가님께서 작품을 준비중입니다. <br>다른 작품 둘러보기</p>
    </a>
</li>
<?php } ?>

<!-- <li class="epsd-item">
    <div class="epsd-item__empty">
        <?php if($work["is_own"]){ ?> 
        <a href="<?=get_url(PAVE_UPLOAD_URL)?>" class="epsd-item__empty-link" target="_blank">
            <span class="icon-plus icon-24"></span>
        </a>
        <p class="epsd-item__empty-text">첫 회차를 연재한 후 부터<br>작품이 노출됩니다 !</p>
        <?php }else{ ?>
        <a href="<?=get_url(PAVE_URL)?>" class="epsd-item__empty-link2">다른 작품 둘러보기</a>
        <?php } ?>
    </div>
</li> -->