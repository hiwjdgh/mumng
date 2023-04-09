<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="work_epsd_caution_modal">
    <div id="modal__box" class="modal__box--380">
        <div id="modal__content">
            <div class="work_epsd_caution__box">
                <h3 class="work_epsd_caution__title">반드시 주의해주세요 !</h3>
                <p class="work_epsd_caution__text1">해당 작품은 무명에서 서비스하는 작품으로<br>저작권법의 보호를 받는 창작물입니다.</p>
                <p class="work_epsd_caution__text2">작품을 캡쳐한 스크린샷을 온/오프라인에 유포/공유할 경우</p>
                <p class="work_epsd_caution__text3">저작권 침해, 청소년보호법 위반, 재산권 침해 등의 항목으로<br>손해배상 청구를 포함한 법적 제제를 받으실 수 있습니다.</p>
            </div>
        </div>
        <div id="modal__footer">
           <button type="button" class="work_epsd_caution__button epsd-detail button-s1 button-t1" data-id="<?=$data["work_id"]?>" data-epsd="<?=$data["epsd_id"]?>" data-skip="true">확인했습니다</button>
        </div>
    </div>
</div>