<?php
if (!defined('_PAVE_')) exit;
?>
<section class="wallet">
    <div class="wallet__header">
        <div class="wallet__header-container">
            <span class="wallet__header-text">더보기</span>

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
    </div>

    <div class="wallet__content">
        <div class="wallet__banner">
            <a href="<?=get_url(PAVE_PLAN_URL)?>">
                <img src="<?=get_url(PAVE_IMG_URL,"img_commerce_plan_banner_360px.png")?>" alt="커머스 배너 이미지" class="wallet__banner-img">
            </a>
        </div>
        <div class="wallet__card">
            <div class="wallet__card-title">
                <span class="wallet__card-title-icon icon-wallet icon-24"></span>
                <span class="wallet__card-title-text">지갑</span>
            </div>
            
            <div class="wallet__card-content">
                <div class="wallet__card-exp">
                    <span class="wallet__card-exp-icon icon-exp icon-24"></span>
                    <span class="wallet__card-exp-text"><?=Converter::display_number($pave_user["user_exp"])?></span>
                    <span class="wallet__card-exp-text2">EXP</span>

                    <a href="<?=get_url(PAVE_CHARGE_URL,"payment")?>" class="wallet__card-exp-link button-t2 button-s3">충전</a>
                </div>

                <a href="" class="wallet__card-free">
                    <span class="wallet__card-free-text">무료로 <span class="wallet__card-free-text2">EXP 충전하기</span></span>
                    <span class="wallet__card-free-icon icon-right icon-20"></span>
                </a>
            </div>
        </div>

        <div class="wallet__lnb">
            <ul class="wallet__lnb-list">
                <?php if($is_user){ ?>
                <li class="wallet__lnb-item">
                    <a href="<?=get_url(PAVE_LIBRARY_URL,"subscribe")?>" class="wallet__lnb-item-link">
                        <span class="wallet__lnb-item-link-text">내 서재</span>
                        <span class="wallet__lnb-item-link-icon icon-right icon-20"></span>
                        
                    </a>
                </li> 
                <li class="wallet__lnb-item">
                    <a href="<?=get_url(PAVE_PAGE_URL, $pave_user["user_code"])?>" class="wallet__lnb-item-link">
                        <span class="wallet__lnb-item-link-text">내 페이지</span>
                        <span class="wallet__lnb-item-link-icon icon-right icon-20"></span>
                    </a>
                </li> 
                <li class="wallet__lnb-item">
                    <a href="<?=get_url(PAVE_COMMERCE_URL, "home")?>" class="wallet__lnb-item-link">
                        <span class="wallet__lnb-item-link-text">내 커머스</span>
                        <span class="wallet__lnb-item-link-icon icon-right icon-20"></span>
                    </a>
                </li> 
                <?php }else{ ?>
                <li class="wallet__lnb-item">
                    <a href="<?=get_url(PAVE_ACCOUNT_URL, "login")?>" class="wallet__lnb-item-link">
                        <span class="wallet__lnb-item-link-text">로그인</span>
                        <span class="wallet__lnb-item-link-icon icon-right icon-20"></span>
                    </a>
                </li> 
                <?php } ?>
            </ul>
            <ul class="wallet__lnb-list">
                <?php if($is_user){ ?>
                <li class="wallet__lnb-item">
                    <a href="<?=get_url(PAVE_SETTING_URL, "home")?>" class="wallet__lnb-item-link">
                        <span class="wallet__lnb-item-link-text">설정</span>
                        <span class="wallet__lnb-item-link-icon icon-right icon-20"></span>
                    </a>
                </li> 
                <?php } ?>
                <li class="wallet__lnb-item">
                    <a href="<?=get_url(PAVE_HELP_URL, "home")?>" class="wallet__lnb-item-link">   
                        <span class="wallet__lnb-item-link-text">도움말</span>
                        <span class="wallet__lnb-item-link-icon icon-right icon-20"></span>
                    </a>
                </li> 
                <?php if($is_user){ ?>
                <li class="wallet__lnb-item">
                    <button type="button" class="wallet__lnb-item-link logout-button">
                        <span class="wallet__lnb-item-link-text">로그아웃</span>
                        <span class="wallet__lnb-item-link-icon icon-right icon-20"></span>
                    </button>
                </li> 
                <?php } ?>
            </ul>
        </div>
    </div>
</section>