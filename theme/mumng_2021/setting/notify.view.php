<?php
if (!defined('_PAVE_')) exit;
?>
<div id="notify">
    <h2 id="notify__title">알림 설정</h2>
    <div class="notify__content" class="mxw-480" data-target="">
        <h3 class="notify__content-label">일반활동</h3>

        <div id="general_notify__like" class="switch-group">
            <h3 class="switch-group__label">좋아요</h3>
            <div class="switch-group__box">
                <label for="notify_user_like" class="switch-box">
                    <input type="checkbox" name="notify_user_like" value="1" id="notify_user_like" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_user_like"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">무명님이 회원님의 작품/레퍼런스북을 좋아합니다.</small>
        </div>

        <div id="general_notify__comment" class="switch-group">
            <h3 class="switch-group__label">의견</h3>
            <div class="switch-group__box">
                <label for="notify_user_comment" class="switch-box">
                    <input type="checkbox" name="notify_user_comment" value="1" id="notify_user_comment" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_user_comment"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">무명님이 회원님의 작품/레퍼런스북에 의견을 작성했습니다.</small>
        </div>

        <div id="general_notify__mention" class="switch-group">
            <h3 class="switch-group__label">언급</h3>
            <div class="switch-group__box">
                <label for="notify_user_mention" class="switch-box">
                    <input type="checkbox" name="notify_user_mention" value="1" id="notify_user_mention" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_user_mention"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">무명님이 회원님을 언급했습니다.</small>
        </div>

        <div id="general_notify__follow" class="switch-group">
            <h3 class="switch-group__label">팔로우</h3>
            <div class="switch-group__box">
                <label for="notify_user_follow" class="switch-box">
                    <input type="checkbox" name="notify_user_follow" value="1" id="notify_user_follow" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_user_follow"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">무명님이 회원님을 팔로우하기 시작했습니다.</small>
        </div>
    </div>

    <div class="notify__content" class="mxw-480" style="display: none;" data-target="#work">
        <h3 class="notify__content-label">작품활동</h3>
        
        <div id="work_notify__subscribe" class="switch-group">
            <h3 class="switch-group__label">내 작품 구독</h3>
            <div class="switch-group__box">
                <label for="notify_work_subscribe" class="switch-box">
                    <input type="checkbox" name="notify_work_subscribe" value="1" id="notify_work_subscribe" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_work_subscribe"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">무명님이 회원님의 작품을 구독하였습니다.</small>
        </div>
        
        <div id="work_notify__upload" class="switch-group">
            <h3 class="switch-group__label">작품 예약</h3>
            <div class="switch-group__box">
                <label for="notify_work_reserve" class="switch-box">
                    <input type="checkbox" name="notify_work_reserve" value="1" id="notify_work_reserve" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_work_reserve"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">작품이(가) 성공적으로 예약되었습니다.</small>
        </div>

        <div id="work_notify__complete" class="switch-group">
            <h3 class="switch-group__label">작품 연재</h3>
            <div class="switch-group__box">
                <label for="notify_work_complete" class="switch-box">
                    <input type="checkbox" name="notify_work_complete" value="1" id="notify_work_complete" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_work_complete"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">작품이(가) 성공적으로 연재되었습니다.</small>
        </div>

        <div id="work_notify__deadline" class="switch-group">
            <h3 class="switch-group__label">작품 연재 마감</h3>
            <div class="switch-group__box">
                <label for="notify_work_deadline" class="switch-box">
                    <input type="checkbox" name="notify_work_deadline" value="1" id="notify_work_deadline" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_work_deadline"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">작품이(가) 연재 마감까지 1시간 전입니다.</small>
        </div>

        <div id="work_notify__late" class="switch-group">
            <h3 class="switch-group__label">작품 지각</h3>
            <div class="switch-group__box">
                <label for="notify_work_late" class="switch-box">
                    <input type="checkbox" name="notify_work_late" value="1" id="notify_work_late" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_work_late"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">작품이(가) 아직 연재되지 않았습니다.</small>
        </div>

        <div id="work_notify__with" class="switch-group">
            <h3 class="switch-group__label">작품 참여</h3>
            <div class="switch-group__box">
                <label for="notify_work_with" class="switch-box">
                    <input type="checkbox" name="notify_work_with" value="1" id="notify_work_with" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_work_with"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">무명님이 함께하는 작품에 회원님을 추가하였습니다.</small>
        </div>

        <div id="work_notify__rcmnd" class="switch-group">
            <h3 class="switch-group__label">기업추천</h3>
            <div class="switch-group__box">
                <label for="notify_work_rcmnd" class="switch-box">
                    <input type="checkbox" name="notify_work_rcmnd" value="1" id="notify_work_rcmnd" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_work_rcmnd"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">회원님의 작품을(를) 기업이(가) 추천합니다.</small>
        </div>
    </div>

    <div class="notify__content" class="mxw-480" style="display: none;" data-target="#subscribe">
        <h3 class="notify__content-label">구독</h3>

        <div id="subscribe_notify__epsd" class="switch-group">
            <h3 class="switch-group__label">구독한 작품 회차 업로드</h3>
            <div class="switch-group__box">
                <label for="notify_subscribe_epsd" class="switch-box">
                    <input type="checkbox" name="notify_subscribe_epsd" value="1" id="notify_subscribe_epsd" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_subscribe_epsd"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">작품의 새 회차가 업로드되었습니다.</small>
        </div>

        <div id="subscribe_notify__notice" class="switch-group">
            <h3 class="switch-group__label">구독한 작품 공지 업로드</h3>
            <div class="switch-group__box">
                <label for="notify_subscribe_notice" class="switch-box">
                    <input type="checkbox" name="notify_subscribe_notice" value="1" id="notify_subscribe_notice" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_subscribe_notice"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">작품의 새 공지가 업로드되었습니다.</small>
        </div>

        <div id="subscribe_notify__rest" class="switch-group">
            <h3 class="switch-group__label">구독한 작품 휴재 업로드</h3>
            <div class="switch-group__box">
                <label for="notify_subscribe_rest" class="switch-box">
                    <input type="checkbox" name="notify_subscribe_rest" value="1" id="notify_subscribe_rest" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_subscribe_rest"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">작품이(가) 9999-01-01 휴재입니다.</small>
        </div>
    </div>

    <div class="notify__content" class="mxw-480" style="display: none;" data-target="#pay">
        <h3 class="notify__content-label">구매</h3>

        <div id="pay_notify__complete" class="switch-group">
            <h3 class="switch-group__label">작품 대여/소장</h3>
            <div class="switch-group__box">
                <label for="notify_pay_complete" class="switch-box">
                    <input type="checkbox" name="notify_pay_complete" value="1" id="notify_pay_complete" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_pay_complete"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">작품을(를) 성공적으로 대여/소장 했습니다. -EXP 사용</small>
        </div>
        
        <div id="pay_notify__expire" class="switch-group">
            <h3 class="switch-group__label">대여 작품 만료</h3>
            <div class="switch-group__box">
                <label for="notify_pay_expire" class="switch-box">
                    <input type="checkbox" name="notify_pay_expire" value="1" id="notify_pay_expire" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_pay_expire"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">대여하신 작품이(가) 만료까지 하루 남았습니다.</small>
        </div>
    </div>

    <div class="notify__content" class="mxw-480" style="display: none;" data-target="#charge">
        <h3 class="notify__content-label">충전</h3>

        <div id="charge_notify__complete" class="switch-group">
            <h3 class="switch-group__label">EXP 충전</h3>
            <div class="switch-group__box">
                <label for="notify_charge_complete" class="switch-box">
                    <input type="checkbox" name="notify_charge_complete" value="1" id="notify_charge_complete" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_charge_complete"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">EXP가 충전되었습니다.</small>
        </div>
        <div id="charge_notify__cancel" class="switch-group">
            <h3 class="switch-group__label">EXP 충전취소</h3>
            <div class="switch-group__box">
                <label for="notify_charge_cancel" class="switch-box">
                    <input type="checkbox" name="notify_charge_cancel" value="1" id="notify_charge_cancel" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_charge_cancel"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">EXP가 충전취소되었습니다.</small>
        </div>
    </div>

    <div class="notify__content" class="mxw-480" style="display: none;" data-target="#commerce">
        <h3 class="notify__content-label">커머스</h3>

        <div id="commerce_notify__grade" class="switch-group">
            <h3 class="switch-group__label">커머스 등급 변경</h3>
            <div class="switch-group__box">
                <label for="notify_commerce_grade" class="switch-box">
                    <input type="checkbox" name="notify_commerce_grade" value="1" id="notify_commerce_grade" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_commerce_grade"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">회원님의 커머스 등급이 변경되었습니다.</small>
        </div>

        <div id="commerce_notify__calc_period" class="switch-group">
            <h3 class="switch-group__label">EXP 정산 신청기간</h3>
            <div class="switch-group__box">
                <label for="notify_commerce_calc_period" class="switch-box">
                    <input type="checkbox" name="notify_commerce_calc_period" value="1" id="notify_commerce_calc_period" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_commerce_calc_period"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">정산신청 기간입니다. 작품활동으로 획득한 EXP를 정산해보세요.</small>
        </div>

        <div id="commerce_notify__calc_request" class="switch-group">
            <h3 class="switch-group__label">EXP 정산 신청</h3>
            <div class="switch-group__box">
                <label for="notify_commerce_calc_request" class="switch-box">
                    <input type="checkbox" name="notify_commerce_calc_request" value="1" id="notify_commerce_calc_request" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_commerce_calc_request"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">EXP 정산 신청이 완료되었습니다.</small>
        </div>

        <div id="commerce_notify__calc_deposit" class="switch-group">
            <h3 class="switch-group__label">입금완료</h3>
            <div class="switch-group__box">
                <label for="notify_commerce_calc_deposit" class="switch-box">
                    <input type="checkbox" name="notify_commerce_calc_deposit" value="1" id="notify_commerce_calc_deposit" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_commerce_calc_deposit"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">회원님의 계좌에 입금이 완료되었습니다.</small>
        </div>
    </div>

    <div class="notify__content" class="mxw-480" style="display: none;" data-target="#login">
        <h3 class="notify__content-label">로그인</h3>
        
        <div id="login_notify__other_device" class="switch-group">
            <h3 class="switch-group__label">다른기기 로그인</h3>
            <div class="switch-group__box">
                <label for="notify_other_device" class="switch-box">
                    <input type="checkbox" name="notify_other_device" value="1" id="notify_other_device" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_other_device"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">다른기기에서 로그인이 감지되었습니다.</small>
        </div>

        <div id="login_notify__pwd_expire" class="switch-group">
            <h3 class="switch-group__label">비밀번호 변경 요청</h3>
            <div class="switch-group__box">
                <label for="notify_pwd_expire" class="switch-box">
                    <input type="checkbox" name="notify_pwd_expire" value="1" id="notify_pwd_expire" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_pwd_expire"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description">장기간 비밀번호를 변경하지 않으셨습니다.<br>안전한 활동을 위해 비밀번호를 변경해주세요.</small>
        </div>
    </div>

    <div class="notify__content" class="mxw-480" style="display: none;" data-target="#mumng">
        <h3 class="notify__content-label">무명</h3>

        <div id="mumng_notify__notice" class="switch-group">
            <h3 class="switch-group__label">공지사항</h3>
            <div class="switch-group__box">
                <label for="noitfy_mumng_notice" class="switch-box">
                    <input type="checkbox" name="noitfy_mumng_notice" value="1" id="noitfy_mumng_notice" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["noitfy_mumng_notice"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description"></small>
        </div>

        <div id="mumng_notify__event" class="switch-group">
            <h3 class="switch-group__label">이벤트</h3>
            <div class="switch-group__box">
                <label for="notify_mumng_event" class="switch-box">
                    <input type="checkbox" name="notify_mumng_event" value="1" id="notify_mumng_event" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_mumng_event"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description"></small>
        </div>

        <div id="mumng_notify__penalty" class="switch-group">
            <h3 class="switch-group__label">신고</h3>
            <div class="switch-group__box">
                <label for="notify_mumng_penalty" class="switch-box">
                    <input type="checkbox" name="notify_mumng_penalty" value="1" id="notify_mumng_penalty" class="notify-change-button switch-box__check" <?=get_checked(1, $pave_user["user_notify"]["notify_mumng_penalty"])?>>
                    <span class="switch-box__slider"></span>
                </label>
            </div>
            <small class="switch-group__description"></small>
        </div>
    </div>
</div>
<script>
function change_tab(){
    let target = window.location.hash;
    $(".notify__side-nav-link").removeClass("current").filter("[href='"+window.location+"']").addClass("current");
    $(".notify__content").hide().filter("[data-target='"+target+"']").show();
}
$(function(){
    change_tab();
    $(window).on("hashchange", function(){
        change_tab();
    });
});
</script>  
