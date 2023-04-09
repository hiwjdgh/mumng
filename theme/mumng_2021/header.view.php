<?php
if (!defined('_PAVE_')) exit;
?>
<header id="header">
    <div id="header__box">
        <h1 id="header__logo"><a href="<?=get_url(PAVE_URL)?>"><img src="<?=get_url(PAVE_IMG_URL,"img_logo_84px.png")?>" alt="무명 로고"><span class="skip">무명 로고</span></a></h1>
        <ul id="header__gnb01">
            <li class="<?=defined("__LIST__") ? "gnb01--active" : ""?>"><a href="<?=get_url(PAVE_WORK_URL,"list")?>">작품</a></li> 
            <li class="<?=defined("__SIGHT__") ? "gnb01--active" : ""?>"><a href="<?=get_url(PAVE_SIGHT_URL, "list")?>">발견</a></li> 
            <?php if($is_admin){ ?>
            <li class="<?=defined("__CREATION__") ? "gnb01--active" : ""?>"><a href="<?=get_url(PAVE_CREATION_URL, "list")?>">창작</a></li> 
            <?php } ?>
            <li class="<?=defined("__PLAN__") ? "gnb01--active" : ""?>"><a href="<?=get_url(PAVE_PLAN_URL, "home")?>">커머스</a></li> 

        </ul>
        <?php if(!defined("__SEARCH__")){ ?>
        <div id="header__search" class="input-box input-box-t5">
            <input type="text" name="search_keyword" id="search_keyword" class="input-box-t5__input" value="" placeholder="검색" autocomplete="off" spellcheck="false" data-link="<?=get_url(PAVE_SEARCH_URL, "webtoon")?>">
            <button type="submit" id="header__search-remove-button" class="input-box-t5__action icon-button icon-button-16" style="display: none;">
                <span class="icon-x icon-16"></span>
            </button>
        </div>

        <?php } ?>
        <ul id="header__gnb02">
            <?php if($is_user){ ?>
            <?php if($is_admin){ ?>
            <li>
                <a href="<?=get_url(PAVE_ADM_URL, "home")?>" class="button-t2 button-s3"><span class="button__text">관리자</span></a>
            </li> 
            <?php } ?>
            <li>
                <a href="<?=get_url(PAVE_UPLOAD_URL, "home")?>" class="button-t1 button-s3"><span class="button__text">연재</span></a>
            </li> 
            <li>
                <a href="<?=get_url(PAVE_HELP_URL, "service")?>" id="header__guide-button">도움말</a>
            </li> 
            <li>
                <button type="button" id="header__notify-button" class="dropdown-anchor" data-anchor="header_notify">알림</button>
                <div class="dropdown-box header_notify">
                    <div class="dropdown-box__dropdown notify-dropdown">
                        <h2 class="notify-dropdown__title">활동</h2>
                        <ul class="notify-dropdown__list" onscroll="get_notify_list(this);">
                        
                        </ul>
                        <a href="<?=get_url(PAVE_SETTING_URL, "notify/general")?>" class="button-t2 button-s2 notify-dropdown__config">알림설정</a>
                    </div>
                </div>
            </li> 
            <li>
                <button type="button" id="header__gnb02-profile-button" class="dropdown-anchor" data-anchor="header_profile">
                    <img src="<?=$pave_user["user_img"]?>" alt="프로필이미지" width="32" height="32">
                </button>
                <div class="dropdown-box header_profile">
                    <div class="dropdown-box__dropdown profile-dropdown">
                        <div class="profile-dropdown__info">
                            <a href="<?=$pave_user["user_page_url"]?>">
                                <img src="<?=$pave_user["user_img"]?>" alt="프로필이미지" class="profile-dropdown__img">
                            </a>
                            <div class="profile-dropdown__info02">
                                <span class="profile-dropdown__nick"><a href="<?=$pave_user["user_page_url"]?>"><?=$pave_user["user_nick"]?></a></span>
                                <span class="profile-dropdown__field"><?=$pave_user["user_field"]?></span>
                            </div>
                        </div>
                        <div class="profile-dropdown__follow">
                            <button type="button" class="profile-dropdown__follower-button follower-button" data-user="<?=$pave_user["user_no"]?>">
                                <span class="profile-dropdown__follower">팔로워</span>
                                <span class="profile-dropdown__follower-cnt"><?=Converter::display_number_format($pave_user["user_follow"]["follower_cnt"])?></span>
                            </button>
                            <div class="line-vertical"></div>
                            <button type="button" class="profile-dropdown__following-button following-button" data-user="<?=$pave_user["user_no"]?>">
                                <span class="profile-dropdown__following">팔로잉</span>
                                <span class="profile-dropdown__following-cnt"><?=Converter::display_number_format($pave_user["user_follow"]["following_cnt"])?></span>
                            </button>
                            <a href="<?=get_url(PAVE_SETTING_URL, "profile")?>" class="profile-dropdown__edit button-t2 button-s2"><span class="button__text">프로필 편집</span></a>
                        </div>
                        <div class="profile-dropdown__charge">
                            <a href="" class="profile-dropdown__free">무료충전하기</a>
                            <div class="profile-dropdown__own">
                                <span class="profile-dropdown__now"><?=Converter::display_number($pave_user["user_exp"])?><span class="profile-dropdown__exp">EXP</span></span>
                                <a href="<?=get_url(PAVE_CHARGE_URL, "payment")?>" class="button-t1 button-s3"><span class="button__text">충전</span></a>
                            </div>
                        </div>
                        <ul class="profile-dropdown__link01">
                            <li>
                                <a href="<?=get_url(PAVE_LIBRARY_URL,"subscribe")?>">내 서재</a>
                            </li> 
                            <li>
                                <a href="<?=get_url(PAVE_PAGE_URL, $pave_user["user_share"])?>">내 페이지</a>
                            </li> 
                            <li>
                                <a href="<?=get_url(PAVE_USER_URL, "creation/ask/all")?>">내 창작</a>
                            </li> 
                            <li>
                                <a href="<?=get_url(PAVE_COMMERCE_URL, "home")?>">내 커머스</a>
                            </li> 
                        </ul>
                        <ul class="profile-dropdown__link02">
                            <li>
                                <a href="<?=get_url(PAVE_SETTING_URL, "profile")?>">설정</a>
                            </li> 
                            <li>
                                <a href="<?=get_url(PAVE_HELP_URL, "service")?>">도움말</a>
                            </li> 
                            <li>
                                <button type="button" class="logout-button">로그아웃</button>
                            </li> 
                        </ul>
                    </div>
                </div>
            </li> 
        
            <?php }else { ?>
            <li>
                <a href="<?=get_url(PAVE_ACCOUNT_URL, "login")?>" class="button-t2 button-s3"><span class="button__text">연재</span></a>
            </li> 
            <li>
                <a href="<?=get_url(PAVE_ACCOUNT_URL, "reg")?>">가입</a>
            </li> 
            <li>
                <a href="<?=get_url(PAVE_ACCOUNT_URL, "login")?>">로그인</a>
            </li>
            <?php } ?>
        </ul>
    </div>
</header>
<!-- 컨텐츠 시작 -->
<div id="wrap" class="wrap">