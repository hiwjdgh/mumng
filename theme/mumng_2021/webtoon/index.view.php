<section id="work_modal">
    
</section>
<section id="epsd_modal">

</section>
<section id="webtoon">
    <div id="webtoon__rcmnd">
    </div>
    <div id="webtoon__yoil-box">
        <ul id="webtoon__yoil">
            <li><a href="" class="webtoon__yoil-item  <?=(PAVE_SHORT_YOIL == "월") ? "active" : ""?>">월</a></li>
            <li><a href="" class="webtoon__yoil-item  <?=(PAVE_SHORT_YOIL == "화") ? "active" : ""?>">화</a></li>
            <li><a href="" class="webtoon__yoil-item  <?=(PAVE_SHORT_YOIL == "수") ? "active" : ""?>">수</a></li>
            <li><a href="" class="webtoon__yoil-item  <?=(PAVE_SHORT_YOIL == "목") ? "active" : ""?>">목</a></li>
            <li><a href="" class="webtoon__yoil-item  <?=(PAVE_SHORT_YOIL == "금") ? "active" : ""?>">금</a></li>
            <li><a href="" class="webtoon__yoil-item  <?=(PAVE_SHORT_YOIL == "토") ? "active" : ""?>">토</a></li>
            <li><a href="" class="webtoon__yoil-item  <?=(PAVE_SHORT_YOIL == "일") ? "active" : ""?>">일</a></li>
            <li><a href="" class="webtoon__yoil-item  <?=(PAVE_SHORT_YOIL == "완결") ? "active" : ""?>">완결</a></li>
        </ul>
    </div>
    <div id="webtoon__filter">
        <ul id="webtoon__filter-genre">
            <li><a href="" class="webtoon__filter-genre-item">전체</a></li>
            <?php foreach ((array)$genre_cf as $i => $genre) { ?>
            <li><a href="" class="webtoon__filter-genre-item"><?=$genre?></a></li>
            <?php } ?>
        </ul>
    </div>
    <ul id="webtoon__list">
        <?php foreach ($work_arr as $i => $work) { ?>
        <li class="webtoon__list-item" data-id="<?=$work["work_id"]?>" data-link="<?=$work["work_id"]?>">
            <img src="<?=$work["work_img"]?>" alt="작품 대표 이미지" width="290" height="360" class="webtoon__list-img">
            <div class="webtoon__list-info">
                <span class="webtoon__list-epsd-cnt">총 <?=$work["work_epsd_cnt"]?>화</span>
                <div class="webtoon__list-info01">
                    <span class="webtoon__list-state new-badge">new</span>
                    <span class="webtoon__list-name text-truncate"><?=$work["work_name"]?></span>
                </div>
                <div class="webtoon__list-info02">
                    <?php if(pave_is_array($work["work_with_arr"])){ ?>
                    <button type="button" class="dropdown-anchor webtoon__list-user" data-anchor="work_user_<?=$i?>">
                        <div class="webtoon__list-user-img">
                            <?php foreach ((array)$work["work_with_arr"] as $j => $with) { ?>
                                <img src="<?=$with["user_img"]?>" alt="함께한작가 프로필" width="20" height="20">
                            <?php }?>
                        </div>
                        <span class="webtoon__list-user-nick">여러작가</span>
                        <span class="icon-arrow icon-10"></span>
                    </button>
                    <div class="dropdown-box work_user_<?=$i?>">
                        <div class="dropdown-box__dropdown webtoon__list-user-dropdown">
                            <ul class="webtoon__list-user-follow scrollbar-macosx">
                            <?php foreach ((array)$work["work_with_arr"] as $j => $with) { ?>
                                <li class="webtoon__list-user-follow-item">
                                        <a href="">
                                            <img src="<?=$with["user_img"]?>" alt="함께한작가 프로필" width="32" height="32">
                                        </a>

                                        <div class="webtoon__list-user-follow-nick-box">
                                            <span class="webtoon__list-user-follow-nick text-truncate"><?=$with["user_nick"]?></span>
                                            <span class="webtoon__list-user-follow-field"><?=$with["user_field"]?></span>
                                        </div>
                                        <button type="button" class="webtoon__list-user-follow-button button-t1 button-s4">팔로우</button>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>   
                    <?php }else{ ?>
                    <a href="" class="webtoon__list-user">
                        <div class="webtoon__list-user-img">
                            <img src="<?=$work["user_img"]?>" alt="대표작가 프로필" width="20" height="20">
                        </div>
                        <span class="webtoon__list-user-nick text-truncate"><?=$work["user_nick"]?></span>
                    </a>
                    <?php } ?>
              
                    <span class="webtoon__list-epsd-like">
                        <span class="webtoon__list-epsd-like-icon icon-like icon-like--active icon-16"></span>
                        <span class="webtoon__list-epsd-like-cnt">367K</span>
                    </span>
                    <span class="webtoon__list-epsd-hit">
                        <span class="webtoon__list-epsd-hit-icon icon-display icon-display--active icon-16"></span>
                        <span class="webtoon__list-epsd-hit-cnt">456K</span>
                    </span>
                </div>
            </div>
        </li>
        <?php } ?>
       
    </ul>
<script>
    $('.scrollbar-macosx').scrollbar();
</script>
</section>
