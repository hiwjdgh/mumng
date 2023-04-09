<?php
if (!defined('_PAVE_')) exit;
?>
</div>
<!-- 컨텐츠 끝 -->
<footer id="footer">
    <div id="footer__box">
        <span class="skip">무명푸터</span>
        <ul id="footer__gnb01">
            <li>
                <button type="button" class="dropdown-anchor" data-anchor="footer_info">무명 추가정보</button>
                <div class="dropdown-box footer_info">
                    <div class="dropdown-box__dropdown footer-dropdown">
                        <h2 class="footer-dropdown__title">무명 추가정보</h2>

                        <dl class="footer-dropdown__content">
                            <dt>상호명: <?=$pave_config["pave_co_name"]?></dt>
                            <dt>대표자명: <?=$pave_config["pave_co_own"]?></dt>
                            <dt>사업자등록번호: <?=Converter::add_hyphen_bsns_num($pave_config["pave_co_bsns_num"])?></dt>
                            <dt>통신판매업신고번호: <?=$pave_config["pave_co_telemarket_num"]?></dt>
                            <dt>주소: (<?=$pave_config["pave_co_addr_zip"]?>) <?=$pave_config["pave_co_addr_load"]?>, <?=$pave_config["pave_co_addr_detail"]?></dt>
                            <dt>연락처: <?=Converter::add_hyphen_tel($pave_config["pave_co_tel"])?></dt>
                        </dl>
                    </div>
                </div>
            </li> 
            <li><a href="<?=get_url(PAVE_LEGAL_URL, "service")?>" target="_blank">이용약관</a></li> 
            <li><a href="<?=get_url(PAVE_HELP_URL, "service")?>">서비스소개</a></li> 
        </ul>
        <h1 id="footer__logo"><img src="<?=get_url(PAVE_IMG_URL,"img_pave_48px.png")?>" alt=""><span class="skip">PAVE 로고</span></h1>
    </div>
</footer>
<script>
$(document).ready(function() {
    $(".fab-button").on("click", function(){
        $(".fab-option").toggleClass("show");
    });
});
</script>