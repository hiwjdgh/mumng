<?php
if (!defined('_PAVE_')) exit;
?>
<header class="header">
    <div class="header__container">
        <?php if(defined("_CHARGE_")){ ?>
        <a href="<?=get_url(PAVE_URL)?>" class="header-close-button icon-button icon-button-24">
            <span class="icon-back icon-24"></span>
        </a>
        <h1 class="header__title">충전</h1>
        <?php }else if(defined("__LIBRARY__")){ ?>
        <h1 class="header__title">내 서재</h1>
        <?php }else if(defined("__SEARCH__")){ ?>
        <h1 class="header__title">검색</h1>
        <?php }else{ ?> 
        <h1 class="header__logo"><a href="<?=get_url(PAVE_URL)?>"><img src="<?=get_url(PAVE_IMG_URL,"img_logo_84px.png")?>" alt="무명 로고"><span class="skip">무명 로고</span></a></h1>
        <?php } ?>
        <ul class="header__gnb">
            <li class="header__gnb-item">
                <a href="<?=get_url(PAVE_USER_URL, "notify")?>" class="header__gnb-item-link">
                    <span class="header__gnb-item-link-icon icon-notify icon-24 icon-inactive"></span>
                </a>
            </li>
            <li class="header__gnb-item">
                <?php if($is_user){ ?>
                <a href="<?=$pave_user["user_page_url"]?>" class="header__gnb-item-link">
                    <img src="<?=$pave_user["user_img"]?>" alt="프로필이미지" class="header__gnb-item-link-img" width="24" height="24">
                </a>
                <?php }else{ ?>
                <a href="<?=get_url(PAVE_ACCOUNT_URL, "login")?>" class="header__gnb-item-link">
                    <span class="header__gnb-item-link-icon icon-page icon-24 icon-inactive"></span>
                </a>
                <?php } ?>
            </li>
        </ul>
    </div>
</header>