<?php
if (!defined('_PAVE_')) exit;
?>
<?php if($page == 1){ ?>
<li class="sight-item-add">
    <div class="sight-item-add__box">
        <button type="button" class="sight-item-add__button upload-sight-button">
            <span class="icon icon-64 icon-white-plus"></span>
        </button>
        <p class="sight-item-add__text">창작물 업로드</p>
    </div>
</li>
<?php } ?>
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
