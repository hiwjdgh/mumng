<?php
if (!defined('_PAVE_')) exit;
?>
<section class="help">
    <div class="help__header">
        <div class="help__header-container">
            <a href="javascript:history.back();" class="help__header-close-button icon-button icon-button-24">
                <span class="icon-back icon-24"></span>
            </a>
            <h1 class="help__header-title"><?=$help_title?></h1>
        </div>
    </div>

    <div class="help__content">
        <form action="<?=get_url(PAVE_HELP_URL, "search")?>" class="help__form" method="get" novalidate autocomplete="off">
            <input type="text" name="search_keyword" id="search_keyword" class="help__form-input" value="<?=$search_keyword?>" placeholder="검색어를 입력해주세요." autocomplete="off">
            <button type="submit" class="help__form-submit button-t1 button-s2">검색</button>
        </form>