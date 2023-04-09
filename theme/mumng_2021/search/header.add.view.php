<?php
if (!defined('_PAVE_')) exit;
?>
<section class="search">
    <div class="search__header">
        <form class="search__form" method="post" novalidate autocomplete="off">
            <input type="hidden" name="search_type" id="search_type" value="<?=$request[1]?>">
            <input type="hidden" name="search_page" id="search_page" value="1">
            <input type="hidden" name="search_end" id="search_end" value="0">

            <input type="text" name="search_keyword" id="search_keyword" class="search__form-input" value="<?=$request[2]?>" placeholder="검색어를 입력해주세요." autocomplete="off">
            <button type="submit" class="search__form-submit button-t1 button-s2">검색</button>
        </form>
        <ul class="search__quick-nav">
            <li class="search__quick-nav-item <?=$request[1] == "webtoon" ? "current" : ""?>"><a href="<?=get_url(PAVE_SEARCH_URL, "webtoon/{$request[2]}")?>">웹툰</a></li>
            <li class="search__quick-nav-item <?=$request[1] == "user" ? "current" : ""?>"><a href="<?=get_url(PAVE_SEARCH_URL, "user/{$request[2]}")?>">작가</a></li>
            <li class="search__quick-nav-item <?=($request[1] == "hashtag" || $request[1] == "tags") ? "current" : ""?>"><a href="<?=get_url(PAVE_SEARCH_URL, "hashtag/{$request[2]}")?>">해시태그</a></li>
        </ul>
    </div>

    