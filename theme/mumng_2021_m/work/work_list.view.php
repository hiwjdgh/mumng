<?php
if (!defined('_PAVE_')) exit;
?>
<section class="work">
    <div class="work__header">
        <div class="work__header-container">
            <div class="work__header-inner-box">
                <button type="button" class="helper__button work__header-genre-button" data-anchor="work_genre">전체</button>
               
                <div class="helper" data-target="work_genre">
                    <div class="helper__container">
                        <div id="helper__more-box" class="helper__action-box">
                            <button type="button" class="helper__action-button work_genre_filter_button current" data-genre="">전체</button>
                            <?php foreach ((array)$work_config["work_genre_list"] as $i => $genre) { ?>
                            <button type="button" class="helper__action-button work_genre_filter_button" data-genre="<?=$genre?>"><?=$genre?></button>
                            <?php } ?>
                        </div>
                        <div class="helper__close-box">
                            <button type="button" class="helper__close-button" data-anchor="work_genre">취소</button>
                        </div>
                    </div>
                </div>
                
                <div class="work__header-order">
                    <button type="button" class="work__header-order-prev-button icon-button icon-button-16">
                        <span class="icon-arrow icon-16"></span>
                    </button>
                    <span class="work__header-order-text">업데이트순</span>
                    <button type="button" class="work__header-order-next-button icon-button icon-button-16">
                        <span class="icon-arrow icon-16"></span>
                    </button>
                </div>
                <ul class="header__gnb">
                    <li class="header__gnb-item">
                        <a href="<?=get_url(PAVE_USER_URL, "notify")?>" class="header__gnb-item-link">
                            <span class="header__gnb-item-link-icon icon-notify icon-24 icon-inactive"></span>
                        </a>
                    </li>
                    <li class="header__gnb-item">
                        <?php if($is_user){ ?>
                        <a href="<?=$pave_user["user_page_url"]?>" class="header__gnb-item-link">
                            <img src="<?=$pave_user["user_img"]?>" alt="프로필이미지" class="header__gnb-item-link-img" width="24" height="24">
                        </a>
                        <?php }else{ ?>
                        <a href="<?=get_url(PAVE_ACCOUNT_URL, "login")?>" class="header__gnb-item-link">
                            <span class="header__gnb-item-link-icon icon-page icon-24 icon-inactive"></span>
                        </a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
            <div class="work__header-day">
                <ul class="work__header-day-list">
                    <li class="work__header-day-item <?=(PAVE_SHORT_YOIL == "월") ? "current" : ""?>" data-state="publish,stop" data-day="월">월</li>
                    <li class="work__header-day-item <?=(PAVE_SHORT_YOIL == "화") ? "current" : ""?>" data-state="publish,stop" data-day="화">화</li>
                    <li class="work__header-day-item <?=(PAVE_SHORT_YOIL == "수") ? "current" : ""?>" data-state="publish,stop" data-day="수">수</li>
                    <li class="work__header-day-item <?=(PAVE_SHORT_YOIL == "목") ? "current" : ""?>" data-state="publish,stop" data-day="목">목</li>
                    <li class="work__header-day-item <?=(PAVE_SHORT_YOIL == "금") ? "current" : ""?>" data-state="publish,stop" data-day="금">금</li>
                    <li class="work__header-day-item <?=(PAVE_SHORT_YOIL == "토") ? "current" : ""?>" data-state="publish,stop" data-day="토">토</li>
                    <li class="work__header-day-item <?=(PAVE_SHORT_YOIL == "일") ? "current" : ""?>" data-state="publish,stop" data-day="일">일</li>
                    <li class="work__header-day-item" data-state="end" data-day="">완결</li>
                </ul>
            </div>
        </div>
    </div>
    <ul class="work__list"></ul>
</section>
<script>
$(document).ready(function() {
    works_list_obj.init($(".work__list"));

    works_list_obj.list_request = {
        type: "",
        user_no: "",
        work_day: new Date().toLocaleString('ko-kr', {weekday: 'short'}),
        work_state: "publish,stop",
        work_age: "전체,12세,15세",
        work_genre: "",
        page: 1,
        work_end: false,
        work_request: false,
    }
    works_list_obj.get_work_list();
});
</script>
   
    