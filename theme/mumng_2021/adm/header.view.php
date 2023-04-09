<?php
if (!defined('_PAVE_')) exit;
?>
<header class="adm-header">
    <nav class="adm-header__gnb">
        <h1 class="adm-header__title">관리자</h2>
            <ul class="adm-header__gnb-list">
                <li class="adm-header__gnb-item <?= defined("ADM_HOME") ? "current" : "" ?>">
                    <button class="adm-header__gnb-button">홈</button>
                    <div class="adm-header__gnb-dropdown">
                        <ul class="adm-header__gnb-dropdown-list">
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "home") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_HOME") && $request[1] == "home" ? "current" : "" ?>">홈</a>
                            </li>
                    </div>
                </li>

                <li class="adm-header__gnb-item <?= defined("ADM_CONFIG") ? "current" : "" ?>">
                    <button class="adm-header__gnb-button">설정</button>
                    <div class="adm-header__gnb-dropdown">
                        <ul class="adm-header__gnb-dropdown-list">
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/site/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "site" ? "current" : "" ?>">사이트설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/cert/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "cert" ? "current" : "" ?>">본인인증설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/charge/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "charge" ? "current" : "" ?>">충전설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/commerce/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "commerce" ? "current" : "" ?>">커머스설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/epsd/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "epsd" ? "current" : "" ?>">회차설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/file/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "file" ? "current" : "" ?>">파일설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/notify/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "notify" ? "current" : "" ?>">알림설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/pay/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "pay" ? "current" : "" ?>">구매설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/payment/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "payment" ? "current" : "" ?>">결제설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/sitemap/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "sitemap" ? "current" : "" ?>">사이트맵설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/sns/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "sns" ? "current" : "" ?>">SNS설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/theme/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "theme" ? "current" : "" ?>">테마설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/user/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "user" ? "current" : "" ?>">회원설정</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "config/work/form") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONFIG") && $request[2] == "work" ? "current" : "" ?>">작품설정</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="adm-header__gnb-item <?= defined("ADM_HELP") ? "current" : "" ?>">
                    <button class="adm-header__gnb-button">도움말관리</button>
                    <div class="adm-header__gnb-dropdown">
                        <ul class="adm-header__gnb-dropdown-list">
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "help/group/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_HELP") && $request[2] == "group" ? "current" : "" ?>">도움말그룹관리</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "help/bo/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_HELP") && $request[2] == "bo" ? "current" : "" ?>">도움말관리</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "help/bd/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_HELP") && $request[2] == "bd" ? "current" : "" ?>">도움말내용관리</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="adm-header__gnb-item <?= defined("ADM_COMMERCE") ? "current" : "" ?>">
                    <button class="adm-header__gnb-button">커머스관리</button>
                    <div class="adm-header__gnb-dropdown">
                        <ul class="adm-header__gnb-dropdown-list">
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "commerce/calc/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_COMMERCE") && $request[2] == "calc" ? "current" : "" ?>">커머스정산관리</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "commerce/calc/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_COMMERCE") && $request[2] == "coupon" ? "current" : "" ?>">커머스 이벤트관리</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="adm-header__gnb-item <?= defined("ADM_CONTENT") ? "current" : "" ?>">
                    <button class="adm-header__gnb-button">콘텐츠관리</button>
                    <div class="adm-header__gnb-dropdown">
                        <ul class="adm-header__gnb-dropdown-list">
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "content/work/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONTENT") && $request[2] == "work" ? "current" : "" ?>">작품 관리</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "content/epsd/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONTENT") && $request[2] == "epsd" ? "current" : "" ?>">회차 관리</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "content/comment/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONTENT") && $request[2] == "comment" ? "current" : "" ?>">의견 관리</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "content/commission/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CONTENT") && $request[2] == "commission" ? "current" : "" ?>">커미션 관리</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="adm-header__gnb-item <?= defined("ADM_USER") ? "current" : "" ?>">
                    <button class="adm-header__gnb-button">회원관리</button>
                    <div class="adm-header__gnb-dropdown">
                        <ul class="adm-header__gnb-dropdown-list">
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "user/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_USER") && $request[1] == "user" ? "current" : "" ?>">회원관리</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="adm-header__gnb-item <?= defined("ADM_CHARGE") ? "current" : "" ?>">
                    <button class="adm-header__gnb-button">충전관리</button>
                    <div class="adm-header__gnb-dropdown">
                        <ul class="adm-header__gnb-dropdown-list">
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "charge/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CHARGE") && $request[2] == "charge" ? "current" : "" ?>">충전내역</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "charge/list") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_CHARGE") && $request[2] == "user" ? "current" : "" ?>">충전내역</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="adm-header__gnb-item <?= defined("ADM_SALES") ? "current" : "" ?>">
                    <button class="adm-header__gnb-button">매출관리</button>
                    <div class="adm-header__gnb-dropdown">
                        <ul class="adm-header__gnb-dropdown-list">
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "sales") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_SALES") && $request[2] == "user" ? "current" : "" ?>">매출현황</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="adm-header__gnb-item <?= defined("ADM_AD") ? "current" : "" ?>">
                    <button class="adm-header__gnb-button">광고관리</button>
                    <div class="adm-header__gnb-dropdown">
                        <ul class="adm-header__gnb-dropdown-list">
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "ad") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_AD") && $request[2] == "user" ? "current" : "" ?>">무료 충전소 관리</a>
                            </li>
                            <li class="adm-header__gnb-dropdown-item">
                                <a href="<?= get_url(PAVE_ADM_URL, "ad") ?>" class="adm-header__gnb-dropdown-link <?= defined("ADM_AD") && $request[2] == "user" ? "current" : "" ?>">배너 광고 관리</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <button class="adm-header__collapse-button icon-button icon-button-40">
                <span class="icon icon-20 icon-right"></span>
            </button>
    </nav>
</header>