<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($sight_list)) { ?>
<?php foreach ($sight_list as $i => $sight) { ?>
<li class="sight-detail sight-item" data-sight="<?=$sight["sight_no"]?>">
    <?php if($sight["sight_img_use"]){ ?>
    <img src="<?=$sight["sight_img"]?>" alt="작품 대표 이미지" class="sight-item__img <?=$sight["sight_grp_id"] == "novel" ? "sight-item__img--novel" : ""?>">
    <?php }else{ ?>
    <div class="sight-item__none <?=$sight["sight_grp_id"] == "novel" ? "sight-item__none--novel" : ""?>">
        <p class="sight-item__none-grp">
        <?php
            if($sight["sight_grp_id"] == "webtoon"){
            echo "그림";
            }else{
            echo "글";
            }
        ?>
        </p>
        <p class="sight-item__none-title text-truncate"><?=$sight["sight_name"]?></p>
        <p class="sight-item__none-name"><?=$sight["sight_user"]["user_nick"]?></p>
    </div>
    <?php } ?>
</li>
<?php } ?>
<?php }else{ ?>
<li class="sight-item-empty">
    <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default_640px.png")?>" alt="작품없음 이미지" width="240" height="240" usemap="#author" class="sight-item-empty-img">
    <map name="author">
    <area shape="rect" coords="43,204,90,214" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
    </map>
</li>
<?php } ?>
