<section id="epsd_modal">

<div id="epsd__header-box">
    <div id="epsd__header">
       <div id="epsd__info01">
           <span id="epsd__work-name"><?=$work["work_name"]?></span>
           <span id="epsd__name"><?=$epsd["epsd_name"]?></span>
       </div>
       <div id="epsd__info02">
           <span id="epsd__date"><?=Converter::display_time("Y-m-d", $epsd["epsd_upload_dt"])?></span>
            <span id="epsd__like">
                <span id="epsd__like-icon" class="icon-like icon-like--active icon-16"></span>
                <span id="epsd__like-text" ><?=Converter::display_number_format($epsd["epsd_like"])?></span>
            </span>
            <span id="epsd__hit">
                <span id="epsd__hit-icon" class="icon-display icon-display--active icon-16"></span>
                <span id="epsd__hit-text"><?=Converter::display_number_format($epsd["epsd_hit"])?></span>
            </span>
        </div>
    </div>
    <button type="button" id="epsd__close" class="icon-button icon-button-28"><span class="icon-x icon-28"></span></button>
</div>
<div id="epsd__box">
    <input type="hidden" name="epsd_id" id="epsd_id" value="<?=$epsd["epsd_id"]?>">
    <input type="hidden" name="epsd_cmt_page" id="epsd_cmt_page" value="1">
    <div id="epsd__content">
       <?=$epsd["epsd_content"]?>
    </div>
    <div id="epsd__more">
        <ul id="epsd__more-link">
            <li>
                <a href="<?=get_url(PAVE_PAGE_URL, $work_user["user_id"])?>" id="epsd__more-page">
                    <img src="<?=$work_user["user_img"]?>" alt="대표작가 프로필 이미지" width="48" height="48">
                </a>
                <span>공유</span>
            </li>
            <li>
                <button type="button" id="epsd__more-subscribe" class="icon-button icon-button-48 icon-button-circle">
                    <span class="icon-subscribe <?=$work_obj->is_subscribe() ? "icon-active" : "icon-inactive" ?> icon-20"></span>
                </button>
                <span>구독</span>
            </li>
            <li>
                <button type="button" id="epsd__more-like" class="icon-button icon-button-48 icon-button-circle">
                    <span class="icon-like <?=$work_obj->is_like($epsd["epsd_id"]) ? "icon-like--active" : "icon-like--inactive" ?> icon-20"></span>
                </button>
                <span>좋아요</span>
            </li>
        </ul>
    </div>
    <div id="epsd__eplg">
        <h3 id="epsd__eplg-label">작가 에필로그</h3>
        <p id="epsd__eplg-content"><?=$epsd["epsd_eplg"]?></p>
    </div>
    <div id="epsd__list">
        <div id="epsd__list-header">
            <h3 id="epsd__list-label">회차목록</h3>
            <button type="button" id="epsd__list-first" data-epsd="<?=$epsd_first["epsd_id"]?>">첫회보기</button>
            <button type="button" id="epsd__list-all">목록보기</button>
        </div>
        <ul id="epsd__list-list">
            <?php foreach ((array)$work_epsd as $i => $inner_epsd) { ?>
                <?php 
                    $item_css = "";
                    if($inner_epsd["epsd_reserve"]) $item_css = "preview";
                    if($inner_epsd["epsd_pay"]) $item_css = "";
                    if($inner_epsd["epsd_visit"]) $item_css .= " visit"
                ?>
            <li class="epsd__list-item <?=$item_css?>" data-epsd="<?=$inner_epsd["epsd_id"]?>">
                <div class="epsd__list-img">
                    <div class="epsd__list-img-overlay">
                        <span class="epsd__list-img-overlay-icon icon-preview icon-24"></span>
                    </div>
                    <img src="<?=$inner_epsd["epsd_img"]?>" alt="회차 이미지" width="222" height="222">
                </div>
                <div class="epsd__list-info">
                    <div class="epsd__list-info01">
                        <span class="epsd__list-name text-truncate"><?=$inner_epsd["epsd_name"]?></span>
                        <?php if($inner_epsd["epsd_pay"]){ ?>
                            <span class="epsd__list-upload"><?=Converter::display_time("Y-m-d", $inner_epsd["epsd_upload_dt"]) ?></span>
                        <?php }else{ ?>
                            <?php if($inner_epsd["epsd_after_free"] ){ ?>
                            <span class="epsd__list-upload"><?=Converter::display_number($inner_epsd["epsd_diff_day"] , "일 후 무료")?></span>
                            <?php }else if($inner_epsd["epsd_after_exp"] ){ ?>
                            <span class="epsd__list-upload"><?=Converter::display_number($inner_epsd["epsd_diff_day"] , "일 후 {$work["work_rent_exp"]} EXP") ?></span>
                            <?php }else{ ?>
                            <span class="epsd__list-upload"><?=Converter::display_time("Y-m-d", $inner_epsd["epsd_upload_dt"]) ?></span>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="epsd__list-info02">
                        <?php if($inner_epsd["epsd_pay"]){ ?> 
                            <?php if($inner_epsd["epsd_is_keep"]){ ?>
                            <span class="epsd__list-keep"><?=$inner_epsd["epsd_expire_dt"]?></span>
                            <?php }else{ ?>
                            <div class="epsd__list-rent">
                                <span>남은대여시간</span>
                                <span><?=$inner_epsd["epsd_expire_dt"]?></span>
                            </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php if($inner_epsd["epsd_reserve"] ){ ?>
                                <?php if($inner_epsd["epsd_after_free"] ){ ?>
                                <span class="epsd__list-exp"><?=Converter::display_number($work["work_preview2_exp"] , " EXP")?></span>
                                <?php }else if($inner_epsd["epsd_after_exp"] ){ ?>
                                <span class="epsd__list-exp"><?=Converter::display_number($work["work_preview_exp"] , " EXP")?></span>
                                <?php } ?>
                            <?php }else{ ?>
                                <?php if($work["work_rent_exp"] ){ ?>
                                <span class="epsd__list-exp"><?=Converter::display_number($work["work_rent_exp"] , " EXP")?></span>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                        <span class="epsd__list-like">
                            <span class="epsd__list-like-icon icon-like icon-like--active icon-16"></span>
                            <span class="epsd__list-like-cnt"><?=Converter::display_number_format($inner_epsd["epsd_like"])?></span>
                        </span>
                        <span class="epsd__list-hit">
                            <span class="epsd__list-hit-icon icon-display icon-display--active icon-16"></span>
                            <span class="epsd__list-hit-cnt"><?=Converter::display_number_format($inner_epsd["epsd_hit"])?></span>
                        </span>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div id="epsd__bottom">
        <div id="epsd__detail">
            <div id="epsd__info">
                <span id="epsd__info-work-name"><?=$work["work_name"]?></span>
                <p id="epsd__info-name"><?=$epsd["epsd_name"]?></p>
                <span id="epsd__info-upload"><?=Converter::display_time("Y-m-d", $epsd["epsd_upload_dt"])?></span>
                <div id="epsd__info-total">
                    <span id="epsd__info-like">
                        <span id="epsd__info-like-icon" class="icon-like icon-like--active icon-16"></span>
                        <span id="epsd__info-like-cnt"><?=Converter::display_number_format($epsd["epsd_like"])?></span>
                    </span>
                    <span id="epsd__info-hit">
                        <span id="epsd__info-hit-icon" class="icon-display icon-display--active icon-16"></span>
                        <span id="epsd__info-hit-cnt"><?=Converter::display_number_format($epsd["epsd_hit"])?></span>
                    </span>
                </div>
            </div>
            <div id="epsd__user">
                <span id="epsd__user-label">작가</span>
                <ul id="epsd__user-list">
                    <li class="epsd__user-item">
                        <a href="<?=get_url(PAVE_PAGE_URL, $work_user["user_id"])?>">
                            <img src="<?=$work_user["user_img"]?>" alt="대표작가 프로필" width="32" height="32">
                        </a>
                        <div class="epsd__user-nick-box">
                            <span class="epsd__user-nick text-truncate"><?=$work_user["user_nick"]?></span>
                            <span class="epsd__user-field"><?=$work_user["user_field"]?></span>
                        </div>
                        <?php if($is_user && $pave_user["user_id"] != $work_user["user_id"]){?>
                        <button type="button" class="epsd__user-follow button-t1 button-s4" data-user="<?=$work_user["user_code"]?>">팔로우</button>
                        <?php }?>
                    </li>
                    <?php foreach ((array)$work_with_user as $i => $with) { ?>
                    <li class="epsd__user-item">
                        <a href="<?=get_url(PAVE_PAGE_URL, $with["user_id"])?>">
                            <img src="<?=$with["user_img"]?>" alt="함께한작가 프로필" width="32" height="32">
                        </a>
                        <div class="epsd__user-nick-box">
                            <span class="epsd__user-nick text-truncate"><?=$with["user_nick"]?></span>
                            <span class="epsd__user-field"><?=$with["user_field"]?></span>
                        </div>
                        <?php if($is_user && $pave_user["user_id"] != $with["user_id"]){?>
                        <?php if($with["is_follow"]){ ?>
                        <button type="button" class="epsd__user-follow button-t3 button-s4" data-user="<?=$with["user_code"]?>">팔로우 취소</button>
                        <?php }else{ ?>
                        <button type="button" class="epsd__user-follow button-t1 button-s4" data-user="<?=$with["user_code"]?>">팔로우</button>
                        <?php } ?>
                        <?php }?>

                    </li>
                    <?php }?>
                </ul>
            </div>
            <ul id="epsd__tag">
                <?php foreach ($work_obj->get_work_genre_array() as $i => $genre) { ?>
                <li class="epsd__tag-genre"><?=$genre?></li>
                <?php } ?>
                <?php foreach ($work_obj->get_work_hashtag_array() as $i => $hashtag) { ?>
                <li class="epsd__tag-hash"><?=$hashtag?></li>
                <?php } ?>
            </ul>
            <div id="epsd__license">
                <span>저작권 정보</span>
                <button type="button" id="epsd__license-penalty-button">신고</button>
            </div>
            <div id="epsd__ad"></div>
        </div>

        <div id="epsd__cmt">
            <div id="epsd__cmt-header">
                <h3 id="epsd__cmt-label">의견</h3>
                <span id="epsd__cmt-cnt">총 <?=Converter::display_number($epsd["epsd_cmt"], "개") ?></span>
            </div>
            <div id="epsd__cmt-tab">
                <button type="button" id="epsd__cmt-tab-best" class="active">BEST의견</button>
                <button type="button" id="epsd__cmt-tab-all">전체의견</button>
            </div>
            <div id="epsd__cmt-form-box">
                <form id="epsd__cmt-form" method="post" onsubmit="return epsd_cmt_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
                    <fieldset>
                        <?php if($is_user){ ?>
                        <legend class="skip">의견정보</legend>
                        <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">
                        <input type="hidden" name="cmt_parent_id" id="cmt_parent_id" value="">
                        <input type="hidden" name="cmt_metion" id="cmt_metion" value="">
                        <div>
                            <a href="<?=get_url(PAVE_PAGE_URL, $pave_user["user_id"])?>">
                                <img src="<?=$pave_user["user_img"]?>" alt="프로필" width="32" height="32">
                            </a>
                            <div class="textarea-box">
                                <textarea name="cmt_content" id="cmt_content" class="textarea-box__textarea scrollbar-macosx" placeholder="의견을 입력해주세요." maxlength="500"></textarea>
                                <div class="textarea-box__counter">
                                    <span class="textarea-box__counter-now">0</span>
                                    <span class="textarea-box__counter-max">/ 500자</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="epsd__cmt-submit" class="button-t2 button-s2">의견쓰기</button>
                        <?php }else{ ?>
                            <p>로그인 후 이용해주세요.</p>
                        <?php } ?>
                    </fieldset>
                </form>
            </div>
            <ul id="epsd__cmt-list">
                <?php foreach ((array)$epsd_cmt as $key => $cmt) { ?>
                <li class="epsd__cmt-item">
                    <div class="epsd__cmt-nick-box">
                        <a href="<?=get_url(PAVE_PAGE_URL, $cmt["user_id"])?>">
                            <img src="<?=$cmt["user_img"]?>" alt="댓글작성자 프로필">
                            <span class="epsd__cmt-nick text text-truncate"><?=$cmt["user_nick"]?></span>
                        </a>
                        <button type="button" class="dropdown-anchor epsd__cmt-more-button icon-button icon-button-24" data-epsd="<?=$cmt["epsd_id"]?>" data-anchor="epsd_cmt_<?=$cmt["cmt_id"]?>"><span class="icon-more icon-24"></span></button>
                        <div class="dropdown-box right epsd_cmt_<?=$cmt["cmt_id"]?>">
                            <div class="dropdown-box__dropdown epsd__cmt-edit-dropdown">
                                <button type="button" class="epsd__cmt-penalty-button" data-cmt="<?=$cmt["cmt_id"]?>">의견 신고</button>
                                <?php if($cmt["cmt_owner"]) {?>
                                <button type="button" class="epsd__cmt-delete-button" data-cmt="<?=$cmt["cmt_id"]?>">의견 삭제</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="epsd__cmt-content">
                        <?php if($cmt["cmt_best"]){?>
                            <span class="best-badge">BEST</span>
                        <?php } ?>
                        <p><?=$cmt["cmt_content"]?></p>
                    </div>
                    <div class="epsd__cmt-info">
                        <span class="epsd__cmt-upload"><?=Converter::display_time_ago($cmt["cmt_insert_dt"]) ?></span>
                        <span class="epsd__cmt-like">좋아요 <?=Converter::display_number($cmt["cmt_like"], "개")?></span>
                        <button class="epsd__cmt-reply-button" data-mention="<?=$cmt["user_nick"]?>" data-cmt="<?=$cmt["cmt_id"]?>">의견쓰기</button>
                        <button type="button" class="epsd__cmt-like-button icon-button icon-button-32 icon-button-circle" data-cmt="<?=$cmt["cmt_id"]?>">
                            <span class="icon-like <?=$cmt["is_like"] ? "icon-like--active" : "icon-like--inactive" ?> icon-16"></span>
                        </button>
                    </div>
                    <?php if($cmt["cmt_reply"] > 0){?>
                    <button type="button" class="epsd__cmt-reply-list-button" data-cmt="<?=$cmt["cmt_id"]?>" data-page="1" data-reply="<?=$cmt["cmt_reply"]?>" data-remain="<?=$cmt["cmt_reply"]?>">의견 <?=Converter::display_number($cmt["cmt_reply"], "개 보기")?></button>
                    <ul class="epsd__cmt-reply-list">
                    </ul>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
</section>
