<?php
if (!defined('_PAVE_')) exit;
?>
<section class="guide">
    <div class="guide__header">
        <h2 class="skip">가이드 주메뉴</h2>
        <nav class="guide__header-gnb">
            <h2 class="guide__header-gnb-title"><?=$guide_title?></h2>
            <ul class="guide__header-gnb-list">
                <?php if($request[1] == "home"){ ?>
                    <?php foreach ((array)$guide_group_list as $i => $group) { ?>
                    <li class="guide__header-gnb-item <?=$group["guide_group_id"] == $guide_group_id ? "current" : ""?>">
                        <a href="<?=get_url(PAVE_GUIDE_URL,"group/{$group["guide_group_id"]}")?>" class="guide__header-gnb-button"><?=$group["guide_group_name"]?></a>
                    </li>
                    <?php } ?>
                <?php }else if($request[1] == "group"){ ?>
                    <?php foreach ((array)$guide_bo_list as $i => $bo) { ?>
                    <li class="guide__header-gnb-item <?=$bo["guide_bo_id"] == $guide_bo_id ? "current" : ""?>">
                        <a href="<?=get_url(PAVE_GUIDE_URL,"board/{$guide_group["guide_group_id"]}/{$bo["guide_bo_id"]}")?>" class="guide__header-gnb-button"><?=$bo["guide_bo_name"]?></a>
                    </li>
                    <?php } ?>
                <?php }else if($request[1] == "board"){ ?>
                    <?php foreach ((array)$guide_bo_list as $i => $bo) { ?>
                    <li class="guide__header-gnb-item <?=$bo["guide_bo_id"] == $guide_bo_id ? "current" : ""?>">
                        <a href="<?=get_url(PAVE_GUIDE_URL,"board/{$bo["guide_group_id"]}/{$bo["guide_bo_id"]}")?>" class="guide__header-gnb-button"><?=$bo["guide_bo_name"]?></a>
                    </li>
                    <?php } ?>
                <?php } ?>
               

            </ul>
        </nav>
    </div>

    <div class="guide__content">
        <form action="<?=get_url(PAVE_GUIDE_URL, "search")?>" class="guide__form" method="get" novalidate autocomplete="off">
            <input type="text" name="search_keyword" id="search_keyword" class="guide__form-input" value="<?=$search_keyword?>" placeholder="검색어를 입력해주세요." autocomplete="off">
            <button type="submit" class="guide__form-submit button-t1 button-s2">검색</button>
        </form>