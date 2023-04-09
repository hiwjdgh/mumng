<section id="work">
    <input type="hidden" name="work_list_load" id="work_list_load" value="<?=__WEBTOON__?>">
    <input type="hidden" name="work_day" id="work_day" value="<?=PAVE_SHORT_YOIL?>">
    <input type="hidden" name="work_grp_id" id="work_grp_id" value="webtoon">
    <input type="hidden" name="work_state" id="work_state" value="publish">
    <input type="hidden" name="work_page" id="work_page" value="1">
    <input type="hidden" name="work_genre" id="work_genre" value="">
    <input type="hidden" name="work_order" id="work_order" value="update">
    <div id="work__rcmnd">
    </div>
    <div id="work__day-box">
        <ul id="work__day">
            <li><button type="button" class="work__day-item <?=(PAVE_SHORT_YOIL == "월") ? "active" : ""?>" data-day="월">월</button></li>
            <li><button type="button" class="work__day-item <?=(PAVE_SHORT_YOIL == "화") ? "active" : ""?>" data-day="화">화</button></li>
            <li><button type="button" class="work__day-item <?=(PAVE_SHORT_YOIL == "수") ? "active" : ""?>" data-day="수">수</button></li>
            <li><button type="button" class="work__day-item <?=(PAVE_SHORT_YOIL == "목") ? "active" : ""?>" data-day="목">목</button></li>
            <li><button type="button" class="work__day-item <?=(PAVE_SHORT_YOIL == "금") ? "active" : ""?>" data-day="금">금</button></li>
            <li><button type="button" class="work__day-item <?=(PAVE_SHORT_YOIL == "토") ? "active" : ""?>" data-day="토">토</button></li>
            <li><button type="button" class="work__day-item <?=(PAVE_SHORT_YOIL == "일") ? "active" : ""?>" data-day="일">일</button></li>
            <li><button type="button" class="work__state-item" data-state="end">완결</button></li>
        </ul>
    </div>
    <div id="work__filter">
        <ul id="work__filter-genre">
            <li><button type="button" class="work__filter-genre-item active" data-genre="">전체</a></li>
            <?php foreach ((array)$genre_cf as $i => $genre) { ?>
            <li><button type="button" class="work__filter-genre-item" data-genre="<?=$genre?>"><?=$genre?></a></li>
            <?php } ?>
        </ul>
        <button type="button" id="work__filter-order-button" data-order="update">업데이트순</button>
    </div>
    <ul id="work__list">
    </ul>
    <script>
        $('.scrollbar-macosx').scrollbar();
    </script>
</section>