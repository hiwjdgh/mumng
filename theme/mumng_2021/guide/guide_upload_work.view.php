<?php
if (!defined('_PAVE_')) exit;
?>
<div class="guide__board">
    <div class="guide__board-title">
        <h3 class="guide__board-title-text"><?=$guide_bd["guide_bo_name"]?></h3>
    </div>

    <div class="guide__board-cate">
        <div class="guide__board-cate-inner-box"> 
            <h4 class="guide__board-cate-text">1. 작품 등록</h4>
            <p class="guide__board-cate-description">무명에서는 누구나 작품을 등록하고 연재 할 수 있습니다.</p>
            <p class="guide__board-cate-caution">*유료 작품 등록은 무명 커머스 멤버십 가입을 통해 가능합니다.</p>
            <a href="<?=get_url(PAVE_PLAN_URL, "home")?>" class="guide__board-link" target="_blank">무명 커머스 멤버십 바로가기</a>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">①</span> 로그인 > 무명사이트 우측 상단 <span class="guide__board-flow-text-bold">[연재]</span> 버튼 클릭</h4>
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">②</span> 내 작품 > <span class="guide__board-flow-text-bold">[작품등록]</span> 버튼 클릭</h4>
            <img src="<?=get_url(PAVE_IMG_URL, "img_upload_work_guide_422px.png")?>" alt="작품 가이드 이미지" width="422">
        </div>
    </div>

    <div class="guide__board-cate">
        <div class="guide__board-cate-inner-box"> 
            <h4 class="guide__board-cate-text">2. 작품 정보입력</h4>
        </div>
        <div class="guide__board-flow">
            <img src="<?=get_url(PAVE_IMG_URL, "img_upload_work_guide2_939px.png")?>" alt="작품 가이드 이미지" width="939">

            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">①</span> 작품 이미지 등록</h4>
            <p class="guide__board-flow-description">메인페이지에 노출될 작품의 썸네일 이미지 입니다.</p>
            <p class="guide__board-flow-caution">*가로 580px X 세로 720px 크기의 이미지여야 합니다. (jpg 또는 png)</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">②</span> 작품 기본정보 입력</h4>
            <p class="guide__board-flow-description">작품보기 페이지에서 보여지는 작품의 제목과 줄거리를 입력할 수 있습니다.</p>
            <p class="guide__board-flow-description">비공개 상태일 경우 회차가 업로드되어도 작품이 노출 되지않습니다.</p>
            <p class="guide__board-flow-caution">*작품 편집에서 변경이 가능합니다.</p>
            <p class="guide__board-flow-caution">*한번 작성한 작품명은 작품 등록이되면 변경이 불가하니 신중하게 입력해주세요 !</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">③</span> 연재요일 선택</h4>
            <p class="guide__board-flow-description">작품이 연재되는 요일을 선택합니다. 선택한 요일에 예약된 회차가 자동으로 업로드 됩니다.</p>
            <p class="guide__board-flow-caution">*한번 선택한 요일은 작품 등록이되면 변경이 불가하니 신중하게 선택해주세요 !</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">④</span> 연재시간 선택</h4>
            <p class="guide__board-flow-description">작품이 연재되는 시간을 선택합니다. 선택한 시간에 예약된 회차가 자동으로 업로드 됩니다.</p>
            <p class="guide__board-flow-caution">*한번 선택한 시간은 작품 등록이되면 변경이 불가하니 신중하게 선택해주세요 !</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑤</span> 작품 감상 연령 선택</h4>
            <p class="guide__board-flow-description">작품을 감상하기에 적절한 연령을 선택합니다.</p>
            <a href="https://acw.or.kr/rank/?pIdx=rank2" class="guide__board-flow-link" target="_blank">연령등급 자가 진단 바로가기</a>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑥</span> 작품 장르 선택</h4>
            <p class="guide__board-flow-description">작품의 장르를 선택합니다. 최대 3개까지 선택할 수 있습니다.</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑦</span> 해시태그 입력</h4>
            <p class="guide__board-flow-description">작품을 잘 나타낼 수 있는 해시태그를 입력합니다. 최대 10개까지 입력할 수 있습니다.</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑧</span> 함께한 작가 등록</h4>
            <p class="guide__board-flow-description">작품 제작에 함께한 작가를 <span class="guide__board-flow-description-bold">[추가하기]</span> 버튼을 눌러 등록합니다. 함께한 작가는 해당 작품에서 대표작가와 함께 노출됩니다.</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑨</span> 연재 EXP 입력</h4>
            <p class="guide__board-flow-description">작품을 무료, 또는 유료로 설정 할 수 있습니다.</p>
            <p class="guide__board-flow-description">무명 커머스 멤버십 또는 이벤트에 한하여 작품을 유료로 등록 할 수 있습니다.</p>
            <p class="guide__board-flow-description">-무료 : 회차 미리보기 및 소장시 독자분들이 지불하는 회차 EXP를 설정할 수 있습니다. 작품의 가격을 의미하며 회차 전체에 공통적으로 적용됩니다.</p>
            <p class="guide__board-flow-description">-유료 : 회차 미리보기 및 소장, 열람시 독자분들이 지불하는 회차 EXP를 설정할 수 있습니다. 작품의 가격을 의미하며 회차 전체에 공통적으로 적용됩니다.</p>
            <p class="guide__board-flow-caution">*한번 등록한 작품의 EXP는 완결이 되기전까지 수정이 불가합니다 !</p>
            <div class="guide__board-flow-link-box">
                <a href="<?=get_url(PAVE_HELP_URL, "board/commerce/exp")?>" class="guide__board-flow-link" target="_blank">작품 EXP 란?</a>
                <a href="<?=get_url(PAVE_PLAN_URL, "home")?>" class="guide__board-flow-link" target="_blank">무명 커머스 멤버십 바로가기</a>
            </div>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑩</span> 연재 운영 원칙 동의</h4>
            <p class="guide__board-flow-description">작품 등록 전 무명 서비스의 운영 방안을 꼭 숙지 해주시고 준수하여 주세요.</p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text"><span class="guide__board-flow-text-black">⑪</span> 작품 등록하기</h4>
            <p class="guide__board-flow-description">연재 운영 원칙 동의 후 작품을 최종적으로 등록합니다.</p>
            <p class="guide__board-flow-description">등록을 한 후 수정이 불가한 항목이 있으니 등록하기 전 한번 더 확인 바랍니다.</p>
            <p class="guide__board-flow-caution">*작품 등록 후 연재(회차등록)까지 진행되어야 메인페이지에 노출이 됩니다.</p>

        </div>
    </div>

    <div class="guide__board-cate">
        <div class="guide__board-cate-inner-box"> 
            <h4 class="guide__board-cate-text">3. 연재 캘린더 & 내 작품</h4>
        </div>

        <div class="guide__board-flow">
            <img src="<?=get_url(PAVE_IMG_URL, "img_upload_work_guide3_940px.png")?>" alt="작품 가이드 이미지" width="939">
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text">연재 캘린더</h4>
            <p class="guide__board-flow-description">
                작품들의 연재 및 일정 관리를 확인 할 수 있습니다. 작품 등록시 설정한 연재요일에 따라
                <img src="<?=get_url(PAVE_IMG_URL, "img_upload_guide4_24px.png")?>" alt="작품 가이드 이미지" width="24">
                <span class="guide__board-flow-description-bold">[회차표시]</span> 뱃지가 생성됩니다.
            </p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text">내 작품</h4>
            <p class="guide__board-flow-description">
                작품을 클릭하여 정보와 등록된 회차를 확인 할 수 있습니다. 작품 썸네일 좌측 상단의 색상의 <span class="guide__board-flow-description-bold">[회차표시]</span>로 연재 캘린더에 표시됩니다. 
                <span class="guide__board-flow-description-bold">[편집]</span> 버튼을 눌러 작품 수정이 가능합니다.
            </p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text">회차 표시</h4>
            <p class="guide__board-flow-description">
                <img src="<?=get_url(PAVE_IMG_URL, "img_upload_guide4_24px.png")?>" alt="작품 가이드 이미지" width="24">
                <span class="guide__board-flow-description-bold">[회차표시]</span>뱃지가 생성 되어있는 해당 날짜를 누르면 연재, 휴재, 공지를 진행 할 수 있습니다. (메모도 등록이 가능합니다.)<br>
                작품 클릭 후 <span class="guide__board-flow-description-bold">[색상변경]</span> 버튼을 통해 색상 변경 가능
            </p>
        </div>

        <div class="guide__board-flow">
            <h4 class="guide__board-flow-text">등록된 회차</h4>
            <p class="guide__board-flow-description">선택한 작품의 회차를 볼 수 있습니다.</p>
        </div>
    </div>
</div>