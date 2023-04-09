<?php
if (!defined('_PAVE_')) exit;
?>
<section class="commerce">
    <div class="commerce__box">
        <div class="commerce__side">
            <h2 class="commerce__side-title"><a href="<?=get_url(PAVE_COMMERCE_URL, "home")?>">커머스</a></h2>
            <ul class="commerce__side-nav">
                <li class="commerce__side-nav-item"><a href="<?=get_url(PAVE_COMMERCE_URL, "home")?>" class="commerce__side-nav-item-link <?=$request[1] == "home" ? "current" : ""?>">홈</a></li>
                <li class="commerce__side-nav-item">
                    <a href="<?=get_url(PAVE_COMMERCE_URL, "profit")?>" class="commerce__side-nav-item-link <?=$request[1] == "profit" ? "current" : ""?>">수익</a>
                </li>
                <li class="commerce__side-nav-item">
                    <a href="<?=get_url(PAVE_COMMERCE_URL, "calc")?>" class="commerce__side-nav-item-link <?=$request[1] == "calc" ? "current" : ""?>">정산</a>
                </li>
                <li class="commerce__side-nav-item">
                    <a href="<?=get_url(PAVE_COMMERCE_URL, "profile")?>" class="commerce__side-nav-item-link <?=$request[1] == "profile" ? "current" : ""?>">정보</a>
                </li>
            </ul>
        </div>
        <div class="commerce__content">