<?php
if (!defined('_PAVE_')) exit;
?>
<section id="library">
    <div id="library__side">
        <div id="library__side-box">
            <h2 id="library__title"><a href="<?=get_url(PAVE_LIBRARY_URL, "subscribe")?>">내 서재</a></h2>
            <ul id="library__nav">
                <li><a href="<?=get_url(PAVE_LIBRARY_URL,"subscribe")?>" class="library__nav-link <?=defined("_LIBRARY_SUBSCRIBE_") ? "current" : "" ?>">구독</a></li>
                <li><a href="<?=get_url(PAVE_LIBRARY_URL,"latest")?>" class="library__nav-link <?=defined("_LIBRARY_LATEST_") ? "current" : "" ?>">최근</a></li>
                <li><a href="<?=get_url(PAVE_LIBRARY_URL,"pay/rent")?>" class="library__nav-link <?=defined("_LIBRARY_PAY_") ? "current" : "" ?>">구매</a></li>
                <li><a href="<?=get_url(PAVE_LIBRARY_URL,"like")?>" class="library__nav-link <?=defined("_LIBRARY_LIKE_") ? "current" : "" ?>">좋아요</a></li>
                <li><a href="<?=get_url(PAVE_LIBRARY_URL,"comment/all")?>" class="library__nav-link <?=defined("_LIBRARY_COMMENT_") ? "current" : "" ?>">의견</a></li>
            </ul>
        </div>
    </div>
    <div id="library__content">