<?php
if (!defined('_PAVE_')) exit;
?>
<section class="help">
    <div class="help__header">
        <h2 class="skip">도움말 주메뉴</h2>
        <nav class="help__header-gnb">
            <h2 class="help__header-gnb-title">도움말</h2>
            <ul class="help__header-gnb-list">
                <li class="help__header-gnb-item <?=$request[1] == "service" ? "current" : ""?>">
                    <a href="<?=get_url(PAVE_HELP_URL, "service")?>" class="help__header-gnb-button">서비스 소개</a>

                    <div class="help__header-gnb-dropdown">
                        <ul class="help__header-gnb-dropdown-list">
                            <li class="help__header-gnb-dropdown-item current">
                                <a href="<?=get_url(PAVE_HELP_URL, "service")?>" class="help__header-gnb-dropdown-link">무명</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php foreach ((array)$help_group_list as $i => $group) { ?>
                <li class="help__header-gnb-item <?=$group["help_group_id"] == $help_group_id ? "current" : ""?>">
                    <a href="<?=get_url(PAVE_HELP_URL,"board/{$group["help_group_id"]}/{$group["help_bo_list"][0]["help_bo_id"]}")?>" class="help__header-gnb-button"><?=$group["help_group_name"]?></a>
                    <div class="help__header-gnb-dropdown">
                        <ul class="help__header-gnb-dropdown-list">
                            <?php 
                                foreach ((array)$group["help_bo_list"] as $j => $bo) {  
                            ?>
                            <li class="help__header-gnb-dropdown-item <?=$bo["help_bo_id"] == $help_bo_id ? "current" : ""?>">
                                <a href="<?=get_url(PAVE_HELP_URL, "board/{$group["help_group_id"]}/{$bo["help_bo_id"]}")?>" class="help__header-gnb-dropdown-link"><?=$bo["help_bo_name"]?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    <div class="help__content">
        <form action="<?=get_url(PAVE_HELP_URL, "search")?>" class="help__form" method="get" novalidate autocomplete="off">
            <input type="text" name="search_keyword" id="search_keyword" class="help__form-input" value="<?=$search_keyword?>" placeholder="검색어를 입력해주세요." autocomplete="off">
            <button type="submit" class="help__form-submit button-t1 button-s2">검색</button>
        </form>