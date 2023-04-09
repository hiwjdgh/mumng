<?php
if (!defined('_PAVE_')) exit;
?>
<section id="legal">
    <div id="legal__header">
        <h2 id="legal__title">무명정책</h2>
        <ul id="legal__tab">
            <li class="legal__tab-item <?=defined("__SERVICE__") ? "current" : ""?>">
                <a href="<?=get_url(PAVE_LEGAL_URL, "service")?>">이용약관</a>
            </li>
            <li class="legal__tab-item <?=defined("__PRIVACY__") ? "current" : ""?>">
                <a href="<?=get_url(PAVE_LEGAL_URL, "privacy")?>">개인정보처리방침</a>
            </li>
            <li class="legal__tab-item <?=defined("__CHARGE__") ? "current" : ""?>">
                <a href="<?=get_url(PAVE_LEGAL_URL, "charge")?>">유료서비스이용약관</a>
            </li>
            <li class="legal__tab-item <?=defined("__COMMERCE__") ? "current" : ""?>">
                <a href="<?=get_url(PAVE_LEGAL_URL, "commerce")?>">커머스서비스이용약관</a>
            </li>
        </ul>
    </div>
    <div id="legal__content">