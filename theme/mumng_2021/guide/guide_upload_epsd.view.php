<?php
if (!defined('_PAVE_')) exit;
?>
<div class="guide__board">
    <div class="guide__board-title">
        <h3 class="guide__board-title-text"><?=$guide_bd["guide_bo_name"]?></h3>
    </div>

    <div class="guide__board-cate">
        <div class="guide__board-cate-inner-box"> 
            <h4 class="guide__board-cate-text">1. 연재캘린더 날짜 선택</h4>
            <p class="guide__board-cate-description">
                <img src="<?=get_url(PAVE_IMG_URL, "img_upload_guide4_24px.png")?>" alt="작품 가이드 이미지" width="24">
                <span class="guide__board-cate-description-bold">[회차표시]</span> 뱃지가 생성 되어있는 해당 날짜를 누르면 연재, 휴재, 공지를 진행 할 수 있습니다. (메모도 등록이 가능합니다.)
            </p>
        </div>

        <div class="guide__board-flow">
            <img src="<?=get_url(PAVE_IMG_URL, "img_upload_epsd_guide_939px.png")?>" alt="작품 가이드 이미지" width="939">
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text">회차 예약 등록 및 미리보기 등록</h4>
            <p class="guide__board-flow-description">연재날이 아닌 다음날을 선택하여 연재 할 경우 자동으로 예약 등록되어 연재 시간에 자동으로 회차가 업로드 됩니다.</p>
            <p class="guide__board-flow-description">유료로 회차를 등록 할 경우 자동으로 미리보기로 업로드됩니다.</p>
            <p class="guide__board-flow-caution">*작품 생성시 정해놓은 연재일, 시간까지 업로드가 되지 않으면 지각, 혹은 미연재 처리되며 이후 패널티를 받을 수 있습니다.<br>
            부득이 하게 연재를 못하게될 경우 휴재 또는 공지를 올려 독자분들께 알려주세요 !</p>
        </div>
    </div>

    <div class="guide__board-cate">
        <div class="guide__board-cate-inner-box"> 
            <h4 class="guide__board-cate-text">2. 회차정보 입력</h4>
            <p class="guide__board-cate-description">연재 캘린더에서 날짜를 선택 후 연재 버튼을 누르면 회차를 등록 할 수 있습니다.</p>
        </div>

        <div class="guide__board-flow">
            <img src="<?=get_url(PAVE_IMG_URL, "img_upload_epsd_guide2_840px.png")?>" alt="작품 가이드 이미지" width="840">
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">①</span> 연재, 휴재, 공지 표시</h4>
            <p class="guide__board-flow-description">연재,휴재,공지 표시 및 선택한 날짜와 작품이 업로드 되는 시간이 표시됩니다.</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">②</span> 회차 순서</h4>
            <p class="guide__board-flow-description">회차 순서는 업로드되는 순서에 따라 자동으로 지정됩니다.</p>
            <p class="guide__board-flow-description">처음 연재되는 회차에 <span class="guide__board-flow-description-bold">[프롤로그]</span> 또는 <span class="guide__board-flow-description-bold">[회차]</span> 버튼을 선택하여 지정할 수 있습니다.</p>
            <p class="guide__board-flow-description">- 프롤로그 : 회차 제목 앞에 프롤로그가 표시되며 다음 회차부터 1회차로 자동입력됩니다.</p>
            <p class="guide__board-flow-description">- 회차 : 1회차 부터 표시되며 다음 회차부터 2회차로 자동입력됩니다.</p>
            <p class="guide__board-flow-description">- 완결 : 1회차 등록 이후 완결 버튼이 생깁니다. 완결 등록 후에는 회차를 등록 할 수 없습니다.</p>
            <p class="guide__board-flow-caution">*프롤로그는 첫 회차 연재시에만 선택이 가능합니다</p>

        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">③</span> 회차명 입력</h4>
            <p class="guide__board-flow-description">편의상 회차 순서에 맞게 자동으로 수식이 붙습니다.</p>
            <p class="guide__board-flow-description">특수문자를 제외한 다른 방식으로 회차순 표시를 자유롭게 표시할 수 있습니다.</p>
            <p class="guide__board-flow-description">작품페이지에 노출될 회차의 썸네일 이미지와 회차명을 입력합니다.</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">④</span> 원고 등록</h4>
            <p class="guide__board-flow-description"><span class="guide__board-flow-description-bold">[업로드]</span> 버튼을 눌러 원고 파일을 등록할 수 있습니다. 최대 20개의 파일을 업로드 할 수 있습니다. *컷 상관없음</p>
            <p class="guide__board-flow-description">파일 1개 당 최대 5MB의 용량, 전체 20MB의 용량을 업로드 할 수 있습니다.</p>
            <p class="guide__board-flow-description">jpg, jpeg 파일만 업로드 가능합니다.</p>
            <p class="guide__board-flow-description">
                <img src="<?=get_url(PAVE_IMG_URL, "img_upload_epsd_guide3_24px.png")?>" alt="작품 가이드 이미지" width="24">
                버튼을 누른 상태로 위아래 드래그하여 저작권표시 이미지, 원고 위치를 바꿀 수 있습니다.
            </p>
            <p class="guide__board-flow-caution">*가로 960px X 세로 자유</p>
            <p class="guide__board-flow-caution">*저작권 표시 이미지는 삭제 할 수 없습니다.</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑤</span> 작가 에필로그</h4>
            <p class="guide__board-flow-description">회차가 끝난 후 작가 에필로그를 입력하여 독자분들과 소통을 할 수 있습니다. </p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑥</span> 연재 운영 원칙 동의</h4>
            <p class="guide__board-flow-description">회차 등록 전 무명 서비스의 운영 방안을 꼭 숙지 해주시고 준수하여 주세요</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑦</span> 임시저장</h4>
            <p class="guide__board-flow-description">회차등록 진행을 임시로 저장을 해 둘 수 있습니다.</p>
            <p class="guide__board-flow-caution">*임시저장된 회차는 자동으로 업로드 되지 않습니다. 또한 연재날이 지난후 수정을 통해 업로드시 지각 처리되니 유의해주세요.</p>

        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑧</span> 연재</h4>
            <p class="guide__board-flow-description">연재 운영 원칙 동의 후 연재를 누르면 회차가 자동으로 예약 등록되어 설정한 연재 시간에 맞춰 업로드됩니다.</p>
            <p class="guide__board-flow-description">연재 시간 이후 연재를 누르면 바로 업로드가 되며 지각으로 등록이 됩니다.</p>
        </div>
    </div>

    <div class="guide__board-cate">
        <div class="guide__board-cate-inner-box"> 
            <h4 class="guide__board-cate-text">3. 회차 표시 뱃지 확인</h4>
            <p class="guide__board-cate-description">
                회차 등록이 정상적으로 완료되면 연재 캘린더에 회차표시 뱃지가 <span class="guide__board-cate-description-bold">[예약]</span>으로 표시 됩니다.</p>
            <p class="guide__board-cate-description">이후 연재 시간이 되어 업로드되면 <span class="guide__board-cate-description-bold">[연재중]</span>으로 표시됩니다.</p>
            <p class="guide__board-cate-description">회차 상황에 따라 다르게 표시됩니다.</p>

        </div>

        <div class="guide__board-flow">
            <img src="<?=get_url(PAVE_IMG_URL, "img_upload_epsd_guide4_450px.png")?>" alt="작품 가이드 이미지" width="450">
        </div>
    </div>
</div>