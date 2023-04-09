<?php
if (!defined('_PAVE_')) exit;
?>
<section class="library">
    <div class="library__header">
        <div class="library__header-tab">
            <ul class="library__header-tab-list">
                <li class="library__header-tab-item">
                    <a href="<?=get_url(PAVE_LIBRARY_URL,"subscribe")?>" class="library__header-tab-item-link <?=defined("_LIBRARY_SUBSCRIBE_") ? "current" : "" ?>">구독</a>
                </li>
                <li class="library__header-tab-item">
                    <a href="<?=get_url(PAVE_LIBRARY_URL,"latest")?>" class="library__header-tab-item-link <?=defined("_LIBRARY_LATEST_") ? "current" : "" ?>">최근</a>
                </li>
                <li class="library__header-tab-item">
                    <a href="<?=get_url(PAVE_LIBRARY_URL,"pay/rent")?>" class="library__header-tab-item-link <?=defined("_LIBRARY_PAY_") ? "current" : "" ?>">구매</a>

                    <div class="library__header-tab2">
                        <ul class="library__header-tab2-list">
                            <li class="library__header-tab2-item">
                                <a href="<?=get_url(PAVE_LIBRARY_URL,"pay/rent")?>" class="library__header-tab2-item-link <?=$request[2] == "rent" ? "current" : "" ?>">회차대여</a>
                            </li>
                            <li class="library__header-tab2-item">
                                <a href="<?=get_url(PAVE_LIBRARY_URL,"pay/keep")?>" class="library__header-tab2-item-link <?=$request[2] == "keep" ? "current" : "" ?>">회차소장</a>
                            </li>
                            <li class="library__header-tab2-item">
                                <a href="<?=get_url(PAVE_LIBRARY_URL,"pay/end")?>" class="library__header-tab2-item-link <?=$request[2] == "end" ? "current" : "" ?>">완결소장</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="library__header-tab-item">
                    <a href="<?=get_url(PAVE_LIBRARY_URL,"like")?>" class="library__header-tab-item-link <?=defined("_LIBRARY_LIKE_") ? "current" : "" ?>">좋아요</a>
                </li>
                <li class="library__header-tab-item">
                    <a href="<?=get_url(PAVE_LIBRARY_URL,"comment/all")?>" class="library__header-tab-item-link <?=defined("_LIBRARY_COMMENT_") ? "current" : "" ?>">의견</a>
                    <div class="library__header-tab2">
                        <ul class="library__header-tab2-list">
                            <li class="library__header-tab2-item">
                                <a href="<?=get_url(PAVE_LIBRARY_URL,"comment/all")?>" class="library__header-tab2-item-link <?=$request[2] == "all" ? "current" : "" ?>">내 의견</a>
                            </li>
                            <li class="library__header-tab2-item">
                                <a href="<?=get_url(PAVE_LIBRARY_URL,"comment/best")?>" class="library__header-tab2-item-link <?=$request[2] == "best" ? "current" : "" ?>">내 BEST 의견</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="library__content">
        <form class="library__form" method="post" novalidate autocomplete="off">
            <input type="hidden" name="library_page" id="library_page" value="1">
            <input type="hidden" name="library_end" id="library_end" value="0">
            <?php if(defined("_LIBRARY_PAY_")){ ?>
            <input type="hidden" name="pay_type" id="pay_type" value="<?=$request[2]?>">
            <?php } ?>
            <?php if(defined("_LIBRARY_COMMENT_")){ ?>
            <input type="hidden" name="cmt_type" id="cmt_type" value="<?=$request[2]?>">
            <?php } ?>
        </form>