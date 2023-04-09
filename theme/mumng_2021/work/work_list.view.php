<?php
if (!defined('_PAVE_')) exit;
?>
<section class="work">
    <div class="work__filter">
        <div class="work__day">
            <ul class="work__day-list">
                <li class="work__day-item <?=(PAVE_SHORT_YOIL == "월") ? "current" : ""?>" data-state="publish,stop" data-day="월">월</li>
                <li class="work__day-item <?=(PAVE_SHORT_YOIL == "화") ? "current" : ""?>" data-state="publish,stop" data-day="화">화</li>
                <li class="work__day-item <?=(PAVE_SHORT_YOIL == "수") ? "current" : ""?>" data-state="publish,stop" data-day="수">수</li>
                <li class="work__day-item <?=(PAVE_SHORT_YOIL == "목") ? "current" : ""?>" data-state="publish,stop" data-day="목">목</li>
                <li class="work__day-item <?=(PAVE_SHORT_YOIL == "금") ? "current" : ""?>" data-state="publish,stop" data-day="금">금</li>
                <li class="work__day-item <?=(PAVE_SHORT_YOIL == "토") ? "current" : ""?>" data-state="publish,stop" data-day="토">토</li>
                <li class="work__day-item <?=(PAVE_SHORT_YOIL == "일") ? "current" : ""?>" data-state="publish,stop" data-day="일">일</li>
                <li class="work__day-item" data-state="end" data-day="">완결</li>
            </ul>
        </div>

        <div class="work__filter-inner-box">
            <div class="work__type">
                <ul class="work__type-list">
                    <li class="work__type-item current" data-type="">웹툰</li>
                    <?php if($is_user){ ?>
                    <li class="work__type-item" data-type="subscribe">구독</li>
                    <li class="work__type-item" data-type="follow">팔로잉</li>
                    <?php } ?>
                </ul>
            </div>
            <div class="work__genre">
                <ul class="work__genre-list">
                    <li class="work__genre-item current" data-genre="">전체</li>
                    <?php foreach ((array)$work_config["work_genre_list"] as $i => $genre) { ?>
                    <li class="work__genre-item" data-genre="<?=$genre?>"><?=$genre?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>


    
    <div class="work__list-box">
        <ul class="work__list"></ul>
    </div>
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