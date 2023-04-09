<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals work_cmt_modal bottom-sheet" data-target="work_cmt_modal">
        
    <div class="bottom-sheet__box">
        <div class="bottom-sheet__header"></div>

        <div class="bottom-sheet__content">
            <div class="work_cmt__box">
                <div class="work_cmt__tab">
                    <ul class="work_cmt__tab-list">
                        <li class="work_cmt__tab-item current" data-id="<?=$work_id?>" data-epsd="<?=$epsd_id?>" data-type="best">BEST의견</li>
                        <li class="work_cmt__tab-item" data-id="<?=$work_id?>" data-epsd="<?=$epsd_id?>" data-type="all">전체의견(<?=Converter::display_number($epsd["epsd_cmt"], "개")?>)</li>
                    </ul>
                </div>

                <ul class="work_cmt__list"></ul>

                <div class="work_cmt__form-box">
                    <?php if($is_user){ ?>
                    <form id="epsd-comment__form" class="work_cmt__form" novalidate autocomplete="off">
                        <legend class="skip">의견정보</legend>
                        <input type="hidden" name="work_id" id="work_id" value="<?=$work["work_id"]?>">
                        <input type="hidden" name="epsd_id" id="epsd_id" value="<?=$epsd["epsd_id"]?>">
                        <input type="hidden" name="comment_parent_no" id="comment_parent_no" value="">
                        <input type="hidden" name="comment_mention" id="comment_mention" value="">
    
                        <div class="work_cmt__form-inner-box">
                            <div class="work_cmt__form-user">
                                <a href="<?=$pave_user["user_page_url"]?>" class="work_cmt__form-user-link">
                                    <img src="<?=$pave_user["user_img"]?>" alt="프로필 이미지" width="32" height="32" class="work_cmt__form-user-img">
                                </a>
                            </div>
                            <div class="work_cmt__form-content textarea-box">
                                <textarea name="comment_content" id="comment_content" class="textarea-box__textarea" placeholder="의견을 입력해주세요." maxlength="500"></textarea>
                                <div class="textarea-box__counter">
                                    <span class="textarea-box__counter-now">0</span>
                                    <span class="textarea-box__counter-max">/ 500자</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="work_cmt__form-submit-button button-t2 button-s2">의견쓰기</button>
                    </form>
                    <?php }else{ ?>
                    <div class="work_cmt__login">
                        <div class="work_cmt__login-inner-box">
                            <a href="<?=get_url(PAVE_ACCOUNT_URL, "login")?>" class="button-t1 button-s2">로그인</a>
                        </div>
                    </div>
                    <?php } ?>

                </div>

            </div>
        </div>
    </div>
</div>