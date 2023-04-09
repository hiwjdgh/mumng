<?php
if (!defined('_PAVE_')) exit;
?>
<footer class="footer">
    <div class="footer__container">
        <ul class="footer__gnb">
            <li class="footer__gnb-item">
                <a href="<?=get_url(PAVE_LIBRARY_URL, "subscribe")?>" class="footer__gnb-item-link">
                    <span class="footer__gnb-item-link-icon icon-subscribe icon-30 <?=defined("__LIBRARY__") ? "icon-active" : "icon-inactive"?>"></span>
                </a>
            </li>
            <li class="footer__gnb-item">
                <a href="<?=get_url(PAVE_SIGHT_URL, "/list")?>" class="footer__gnb-item-link">
                    <span class="footer__gnb-item-link-icon icon-curation icon-30 <?=defined("__SIGHT__") ? "icon-active" : "icon-inactive"?>"></span>
                </a>
            </li>
            <li class="footer__gnb-item">
                <a href="<?=get_url(PAVE_URL)?>" class="footer__gnb-item-link">
                    <span class="footer__gnb-item-link-icon icon-home icon-40 <?=defined("__LIST__") ? "icon-active" : "icon-inactive"?>"></span>
                </a>
                <div class="footer__gnb-item-fab hidden">
                    <button type="button" class="footer__gnb-item-fab-button current" data-type="">웹툰</button>
                    <?php if($is_user){ ?>
                    <button type="button" class="footer__gnb-item-fab-button" data-type="subscribe">구독</button>
                    <button type="button" class="footer__gnb-item-fab-button" data-type="follow">팔로잉</button>
                    <?php } ?>
                </div>
            </li>
            <li class="footer__gnb-item">
                <a href="<?=get_url(PAVE_SEARCH_URL, "webtoon")?>" class="footer__gnb-item-link">
                    <span class="footer__gnb-item-link-icon icon-search icon-30 <?=defined("__SEARCH__") ? "icon-active" : "icon-inactive"?>"></span>
                </a>
            </li>
            <li class="footer__gnb-item">
                <a href="<?=get_url(PAVE_USER_URL, "wallet")?>" class="footer__gnb-item-link footer__gnb-item-more-link">
                    <span class="footer__gnb-item-link-icon icon-more icon-30 <?=defined("_USER_WALLET_") ? "icon-active" : "icon-inactive"?>"></span>
                </a>
            </li>
        </ul>
    </div>
</footer>
<script>
var lastScrollTop = 0;
$(document).ready(function() {
    $(document).on("scroll", function(event){
        if($(window).scrollTop() > 0) {
            $(".header").addClass("scroll");
            $(".footer").addClass("scroll");
        }else{
            $(".header").removeClass("scroll");
            $(".footer").removeClass("scroll");
        }
    });
});
</script>
