<?php
/************************************************************************************************************************
   버전 상수 선언
************************************************************************************************************************/
define("PAVE", "PAVE");
define("PAVE_VERSION", "1.0.0.0");

/************************************************************************************************************************
   경로 정의 부
************************************************************************************************************************/
if(!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])){
	$http = $_SERVER['HTTP_X_FORWARDED_PROTO'].'://';
}else{
	$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')?'https://':'http://';
}
$host = preg_replace('/:[0-9]+$/', '', isset($_SERVER['HTTP_HOST'])? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);

/************************************************************************************************************************
   시스템 상수 선언
************************************************************************************************************************/
define("_PAVE_", true); // 개별 페이지 접근 제한 상수
define('PAVE_PATH', $_SERVER['DOCUMENT_ROOT']);
define('PAVE_URL', $http.$host);
define('PAVE_CURRENT_URL', PAVE_URL.$_SERVER["REQUEST_URI"]);
define("PAVE_USER_REFERER", isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '');
define("PAVE_PHPSELF", $_SERVER['PHP_SELF']);
define("PAVE_FILENAME", pathinfo(PAVE_PHPSELF, PATHINFO_FILENAME));
define("PAVE_QUERYS", $_SERVER['QUERY_STRING']);
define("PAVE_USER_AGENT", isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT'] : '');

/************************************************************************************************************************
   공통 경로 상수 선언
************************************************************************************************************************/
define("ROOT", "root"); // 루트
define("VIEW", "view"); // 뷰
define("DATA", "data"); // 데이터
define("THM", "theme"); // 테마
define("API", "api"); //API

/************************************************************************************************************************
   공통 하위 경로 상수 선언
************************************************************************************************************************/
define("JS","js"); // 자바스크립트
define("CSS", "css"); //CSS
define("IMG", "img"); //이미지
define("LIB", "lib"); // 라이브러리
define("ICON", "icon"); // 아이콘
define("COMMON", "common"); // 공통
define("PLUGIN","plugin"); //플러그인

/************************************************************************************************************************
   공통 상수 선언
************************************************************************************************************************/
define("SESSION","session"); // 세션
define("SQL", "sql"); // 데이터베이스
define("SECURE", "secure"); // 보안
define("OBJECTS", "objects"); // 객체
define("URI", "uri"); // URI
define("MAIL", "mail"); //메일
define("EDITOR", "editor"); //에디터
define("EXP", "exp"); // 경험치
define("CS", "cs"); // 고객센터
define("FAQ", "faq"); // FAQ
define("INQUIRY", "inquiry"); // 문의하기
define("NOTICE", "notice"); // 공지사항
define("USER", "user"); //회원
define("BOARD","board"); // 게시판
define("GROUP", "group"); // 그룹
define("ADM","adm"); // 관리자
define("EXTEND", "extend"); // 확장
define("CAPTCHA", "captcha"); //캡차
define("LIKE", "like"); //좋아요
define("GRADE", "grade"); // 등급
define("LEVEL", "level"); // 레벨
define("AUTH", "auth"); // 권한
define("UPLOAD", "upload"); // 업로드
define("THUMBNAIL", "thumbnail"); // 썸네일
define("TEMP", "temp"); // 임시저장소
define("MENU", "menu"); // 메뉴
define("CATEGORY", "category"); //카테고리
define("FILE", "file"); //파일
define("SAVE", "save"); //자동저장
define("ADDR", "addr"); //주소찾기
define("CROP", "crop"); //크롭
define("CALENDAR", "calendar"); //캘린더
define("WEBTOON", "webtoon"); //웹툰
define("NOVEL", "novel"); //소설
define("SWIPER", "swiper"); //스와이프
define("WORK", "work"); //작품
define("PALETTE", "palette"); //팔레트
define("CRONTAB", "crontab"); //크론탭
define("CERT", "cert"); //인증
define("SCROLLBAR", "scrollbar"); //스크롤바
define("PAGE", "page"); //페이지
define("LIBRARY", "library"); //서재
define("SETTING", "setting"); //설정
define("LEGAL", "legal"); //정책
define("COMMERCE", "commerce"); //커머스
define("GUIDE", "guide"); //가이드
define("SEARCH", "search"); //검색
define("FOLLOW", "follow"); //팔로우
define("NOTIFY", "notify"); //알림
define("CHARGE", "charge"); //충전
define("PAYMENT", "payment"); //결제
define("PLAN", "plan"); //플랜
define("HELP", "help"); //도움말
define("SUBSCRIBE", "subscribe"); //구독
define("PAY", "pay"); //구매
define("SHARE", "share"); //공유
define("KAKAO", "kakao"); //kakao
define("MODAL", "modal"); //모달
define("PENALTY", "penalty"); //신고
define("SIGHT", "sight"); //발견
define("CREATION", "creation"); //창작
define("ACCOUNT", "account"); //계정
define("THM_DEFAULT", "mumng_2021"); // 기본 테마
define("THM_M_DEFAULT", "mumng_2021_m"); // 기본 테마
/************************************************************************************************************************
   퍼미션 상수 선언
************************************************************************************************************************/
define('PAVE_DIR_PERMISSION',  0755);
define('PAVE_FILE_PERMISSION', 0644);

/************************************************************************************************************************
   브라우저경로 상수 선언
************************************************************************************************************************/
define("PAVE_ROOT_URL", PAVE_URL.DIRECTORY_SEPARATOR.ROOT); // 루트
define("PAVE_JS_URL", PAVE_ROOT_URL.DIRECTORY_SEPARATOR.JS); // 자바스크립트
define("PAVE_IMG_URL", PAVE_ROOT_URL.DIRECTORY_SEPARATOR.IMG); //이미지
define("PAVE_CSS_URL", PAVE_ROOT_URL.DIRECTORY_SEPARATOR.CSS); // CSS
define("PAVE_ICON_URL", PAVE_ROOT_URL.DIRECTORY_SEPARATOR.ICON); // 아이콘
define("PAVE_LIB_URL", PAVE_ROOT_URL.DIRECTORY_SEPARATOR.LIB); // 라이브러리
define("PAVE_PLUGIN_URL", PAVE_ROOT_URL.DIRECTORY_SEPARATOR.PLUGIN); // 플러그인

define("PAVE_VIEW_URL", PAVE_URL.DIRECTORY_SEPARATOR.VIEW); // VIEW
define("PAVE_THM_URL", PAVE_URL.DIRECTORY_SEPARATOR.THM); // 테마
define("PAVE_DATA_URL", PAVE_URL.DIRECTORY_SEPARATOR.DATA); // 데이터
define("PAVE_API_URL", PAVE_URL.DIRECTORY_SEPARATOR.API); //API

/***********************************************************************************************************************/
define("PAVE_USER_URL", PAVE_URL.DIRECTORY_SEPARATOR.USER); // 회원
define("PAVE_WEBTOON_URL", PAVE_URL.DIRECTORY_SEPARATOR.WEBTOON); // 웹툰
define("PAVE_NOVEL_URL", PAVE_URL.DIRECTORY_SEPARATOR.NOVEL); // 소설
define("PAVE_PAGE_URL", PAVE_URL.DIRECTORY_SEPARATOR.PAGE); // 페이지
define("PAVE_BOARD_URL", PAVE_URL.DIRECTORY_SEPARATOR.BOARD); // 게시판
define("PAVE_CS_URL", PAVE_URL.DIRECTORY_SEPARATOR.CS); // 고객센터
define("PAVE_FAQ_URL", PAVE_URL.DIRECTORY_SEPARATOR.FAQ); // FAQ
define("PAVE_INQURIY_URL", PAVE_URL.DIRECTORY_SEPARATOR.INQUIRY); // 문의하기
define("PAVE_NOTICE_URL", PAVE_URL.DIRECTORY_SEPARATOR.NOTICE); // 공지사항
define("PAVE_GROUP_URL", PAVE_URL.DIRECTORY_SEPARATOR.GROUP); // 그룹
define("PAVE_ADM_URL", PAVE_URL.DIRECTORY_SEPARATOR.ADM); // 관리자
define("PAVE_UPLOAD_URL", PAVE_URL.DIRECTORY_SEPARATOR.UPLOAD); // 업로드
define("PAVE_CRONTAB_URL", PAVE_URL.DIRECTORY_SEPARATOR.CRONTAB); // 크론탭
define("PAVE_LIBRARY_URL", PAVE_URL.DIRECTORY_SEPARATOR.LIBRARY); // 서재
define("PAVE_SETTING_URL", PAVE_URL.DIRECTORY_SEPARATOR.SETTING); // 설정
define("PAVE_LEGAL_URL", PAVE_URL.DIRECTORY_SEPARATOR.LEGAL); // 정책
define("PAVE_COMMERCE_URL", PAVE_URL.DIRECTORY_SEPARATOR.COMMERCE); // 커머스
define("PAVE_GUIDE_URL", PAVE_URL.DIRECTORY_SEPARATOR.GUIDE); // 가이드
define("PAVE_SEARCH_URL", PAVE_URL.DIRECTORY_SEPARATOR.SEARCH); // 검색
define("PAVE_WORK_URL", PAVE_URL.DIRECTORY_SEPARATOR.WORK); // 작품
define("PAVE_SIGHT_URL", PAVE_URL.DIRECTORY_SEPARATOR.SIGHT); // 발견
define("PAVE_CHARGE_URL", PAVE_URL.DIRECTORY_SEPARATOR.CHARGE); // 충전
define("PAVE_PAYMENT_URL", PAVE_URL.DIRECTORY_SEPARATOR.PAYMENT); // 결제
define("PAVE_CERT_URL", PAVE_URL.DIRECTORY_SEPARATOR.CERT); // 인증
define("PAVE_PLAN_URL", PAVE_URL.DIRECTORY_SEPARATOR.PLAN); // 플랜
define("PAVE_PAY_URL", PAVE_URL.DIRECTORY_SEPARATOR.PAY); // 구매
define("PAVE_HELP_URL", PAVE_URL.DIRECTORY_SEPARATOR.HELP); // 도움말
define("PAVE_MODAL_URL", PAVE_URL.DIRECTORY_SEPARATOR.MODAL); // 모달
define("PAVE_NOTIFY_URL", PAVE_URL.DIRECTORY_SEPARATOR.NOTIFY); // 알림
define("PAVE_PENALTY_URL", PAVE_URL.DIRECTORY_SEPARATOR.PENALTY); // 신고
define("PAVE_EDITOR_URL", PAVE_URL.DIRECTORY_SEPARATOR.EDITOR); // 에디터
define("PAVE_CREATION_URL", PAVE_URL.DIRECTORY_SEPARATOR.CREATION); // 창작
define("PAVE_ACCOUNT_URL", PAVE_URL.DIRECTORY_SEPARATOR.ACCOUNT); // 계정
/***********************************************************************************************************************/
define("PAVE_DATA_TEMP_URL", PAVE_DATA_URL.DIRECTORY_SEPARATOR.TEMP); // 데이터|임시저장소
define("PAVE_DATA_USER_URL", PAVE_DATA_URL.DIRECTORY_SEPARATOR.USER); // 데이터|회원
define("PAVE_DATA_EDITOR_URL", PAVE_DATA_URL.DIRECTORY_SEPARATOR.EDITOR); // 데이터|에디터
define("PAVE_DATA_LEVEL_URL", PAVE_DATA_URL.DIRECTORY_SEPARATOR.LEVEL); // 데이터|레벨
define("PAVE_DATA_BOARD_URL", PAVE_DATA_URL.DIRECTORY_SEPARATOR.BOARD); // 데이터|게시판
define("PAVE_DATA_WEBTOON_URL", PAVE_DATA_URL.DIRECTORY_SEPARATOR.WEBTOON); // 데이터|웹툰
define("PAVE_DATA_NOVEL_URL", PAVE_DATA_URL.DIRECTORY_SEPARATOR.NOVEL); // 데이터|소설
define("PAVE_DATA_SIGHT_URL", PAVE_DATA_URL.DIRECTORY_SEPARATOR.SIGHT); // 데이터|발견
/***********************************************************************************************************************/
define("PAVE_API_BOARD_URL", PAVE_API_URL.DIRECTORY_SEPARATOR.BOARD); // 게시판 API
/***********************************************************************************************************************/
define("PAVE_PLUGIN_EDITOR_URL", PAVE_PLUGIN_URL.DIRECTORY_SEPARATOR.EDITOR); // 플러그인|에디터
define("PAVE_PLUGIN_CROP_URL", PAVE_PLUGIN_URL.DIRECTORY_SEPARATOR.CROP); // 플러그인|크롭
define("PAVE_PLUGIN_CALENDAR_URL", PAVE_PLUGIN_URL.DIRECTORY_SEPARATOR.CALENDAR); // 플러그인|캘린더
define("PAVE_PLUGIN_SWIPER_URL", PAVE_PLUGIN_URL.DIRECTORY_SEPARATOR.SWIPER); // 플러그인|스와이프
define("PAVE_PLUGIN_SCROLLBAR_URL", PAVE_PLUGIN_URL.DIRECTORY_SEPARATOR.SCROLLBAR); // 플러그인|스크롤바
define("PAVE_PLUGIN_KAKAO_URL", PAVE_PLUGIN_URL.DIRECTORY_SEPARATOR.KAKAO); // 플러그인|KAKAO

/***********************************************************************************************************************/


/************************************************************************************************************************
   서버경로 상수 선언
************************************************************************************************************************/
define("PAVE_ROOT_PATH", PAVE_PATH.DIRECTORY_SEPARATOR.ROOT); // 루트
define('PAVE_SESSION_PATH', PAVE_PATH.DIRECTORY_SEPARATOR.SESSION); // 세션
define("PAVE_PLUGIN_PATH", PAVE_ROOT_PATH.DIRECTORY_SEPARATOR.PLUGIN); // 플러그인
define("PAVE_LIB_PATH", PAVE_ROOT_PATH.DIRECTORY_SEPARATOR.LIB); // 라이브러리

define("PAVE_VIEW_PATH", PAVE_PATH.DIRECTORY_SEPARATOR.VIEW); // VIEW
define('PAVE_DATA_PATH', PAVE_PATH.DIRECTORY_SEPARATOR.DATA); // 데이터
define("PAVE_API_PATH", PAVE_PATH.DIRECTORY_SEPARATOR.API); //API
define("PAVE_THM_PATH", PAVE_PATH.DIRECTORY_SEPARATOR.THM); // 테마

/***********************************************************************************************************************/
define("PAVE_CS_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.CS); // 고객센터
define("PAVE_USER_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.USER); // 회원
define("PAVE_WEBTOON_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.WEBTOON); // 웹툰
define("PAVE_NOVEL_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.NOVEL); // 소설
define("PAVE_PAGE_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.PAGE); // 페이지
define("PAVE_ADM_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.ADM); // 관리자
define("PAVE_BOARD_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.BOARD); // 게시판
define("PAVE_GROUP_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.GROUP); // 그룹
define("PAVE_FAQ_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.FAQ); // FAQ
define("PAVE_INQURIY_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.INQUIRY); // 문의하기
define("PAVE_NOTICE_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.NOTICE); // 공지사항
define("PAVE_UPLOAD_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.UPLOAD); // 업로드
define("PAVE_CRONTAB_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.CRONTAB); // 크론탭
define("PAVE_LIBRARY_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.LIBRARY); // 서재
define("PAVE_SETTING_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.SETTING); // 설정
define("PAVE_LEGAL_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.LEGAL); // 정책
define("PAVE_COMMERCE_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.COMMERCE); // 커머스
define("PAVE_GUIDE_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.GUIDE); // 가이드
define("PAVE_SEARCH_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.SEARCH); // 검색
define("PAVE_WORK_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.WORK); // 작품
define("PAVE_SIGHT_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.SIGHT); // 발견
define("PAVE_CHARGE_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.CHARGE); // 충전
define("PAVE_PAYMENT_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.PAYMENT); // 결제
define("PAVE_CERT_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.CERT); // 인증
define("PAVE_PLAN_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.PLAN); // 플랜
define("PAVE_PAY_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.PAY); // 구매
define("PAVE_HELP_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.HELP); // 도움말
define("PAVE_MODAL_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.MODAL); // 모달
define("PAVE_NOTIFY_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.NOTIFY); // 알림
define("PAVE_PENALTY_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.PENALTY); // 신고
define("PAVE_EDITOR_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.EDITOR); // 에디터
define("PAVE_CREATION_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.CREATION); // 창작
define("PAVE_ACCOUNT_PATH", PAVE_VIEW_PATH.DIRECTORY_SEPARATOR.ACCOUNT); // 계정
/***********************************************************************************************************************/
define("PAVE_DATA_TEMP_PATH", PAVE_DATA_PATH.DIRECTORY_SEPARATOR.TEMP); // 데이터|임시저장소
define("PAVE_DATA_USER_PATH", PAVE_DATA_PATH.DIRECTORY_SEPARATOR.USER); // 데이터|회원
define("PAVE_DATA_LEVEL_PATH", PAVE_DATA_PATH.DIRECTORY_SEPARATOR.LEVEL); // 데이터|레벨
define("PAVE_DATA_CS_PATH", PAVE_DATA_PATH.DIRECTORY_SEPARATOR.CS); // 데이터|고객센터
define("PAVE_DATA_BOARD_PATH", PAVE_DATA_PATH.DIRECTORY_SEPARATOR.BOARD); // 데이터|게시판
define("PAVE_DATA_WEBTOON_PATH", PAVE_DATA_PATH.DIRECTORY_SEPARATOR.WEBTOON); // 데이터|웹툰
define("PAVE_DATA_NOVEL_PATH", PAVE_DATA_PATH.DIRECTORY_SEPARATOR.NOVEL); // 데이터|소설
define("PAVE_DATA_SIGHT_PATH", PAVE_DATA_PATH.DIRECTORY_SEPARATOR.SIGHT); // 데이터|발견
/***********************************************************************************************************************/
define("PAVE_PLUGIN_MAIL_PATH", PAVE_PLUGIN_PATH.DIRECTORY_SEPARATOR.MAIL); // 플러그인|메일
define("PAVE_PLUGIN_EDITOR_PATH", PAVE_PLUGIN_PATH.DIRECTORY_SEPARATOR.EDITOR); // 플러그인|에디터
define("PAVE_PLUGIN_THUMBNAIL_PATH", PAVE_PLUGIN_PATH.DIRECTORY_SEPARATOR.THUMBNAIL); // 플러그인|썸네일
define("PAVE_PLUGIN_CROP_PATH", PAVE_PLUGIN_PATH.DIRECTORY_SEPARATOR.CROP); // 플러그인|크롭
define("PAVE_PLUGIN_CALENDAR_PATH", PAVE_PLUGIN_PATH.DIRECTORY_SEPARATOR.CALENDAR); // 플러그인|캘린더
define("PAVE_PLUGIN_SWIPER_PATH", PAVE_PLUGIN_PATH.DIRECTORY_SEPARATOR.SWIPER); // 플러그인|템플릿
define("PAVE_PLUGIN_PALETTE_PATH", PAVE_PLUGIN_PATH.DIRECTORY_SEPARATOR.PALETTE); // 플러그인|팔레트
define("PAVE_PLUGIN_SCROLLBAR_PATH", PAVE_PLUGIN_PATH.DIRECTORY_SEPARATOR.SCROLLBAR); // 플러그인|스크롤바
define("PAVE_PLUGIN_KAKAO_PATH", PAVE_PLUGIN_PATH.DIRECTORY_SEPARATOR.KAKAO); // 플러그인|KAKAO

/***********************************************************************************************************************/

/************************************************************************************************************************
   라이브러리 브라우저 경로 상수 선언
************************************************************************************************************************/
define("PAVE_LIB_SQL_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.SQL); // 라이브러리|데이터베이스
define("PAVE_LIB_COMMON_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.COMMON); // 라이브러리|공통
define("PAVE_LIB_SECURE_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.SECURE); // 라이브러리|보안
define("PAVE_LIB_EXP_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.EXP); // 라이브러리|경험치
define("PAVE_LIB_OBJECTS_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.OBJECTS); // 라이브러리|클래스
define("PAVE_LIB_URI_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.URI); // 라이브러리|URI
define("PAVE_LIB_CS_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.CS); // 라이브러리|고객센터
define("PAVE_LIB_USER_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.USER); // 라이브러리|회원
define("PAVE_LIB_MAIL_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.MAIL); // 라이브러리|메일
define("PAVE_LIB_ADM_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.ADM); // 라이브러리|관리자
define("PAVE_LIB_THM_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.THM); // 라이브러리|테마
define("PAVE_LIB_BOARD_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.BOARD); // 라이브러리|게시판
define("PAVE_LIB_CAPTCHA_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.CAPTCHA); //라이브러리|캡차
define("PAVE_LIB_LIKE_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.LIKE); //라이브러리|좋아요
define("PAVE_LIB_GRADE_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.GRADE); //라이브러리|등급
define("PAVE_LIB_LEVEL_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.LEVEL); //라이브러리|레벨
define("PAVE_LIB_AUTH_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.AUTH); //라이브러리|권한
define("PAVE_LIB_UPLOAD_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.UPLOAD); //라이브러리|업로드
define("PAVE_LIB_THUMBNAIL_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.THUMBNAIL); //라이브러리|썸네일
define("PAVE_LIB_MENU_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.MENU); //라이브러리|메뉴
define("PAVE_LIB_GROUP_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.GROUP); //라이브러리|그룹
define("PAVE_LIB_CATEGORY_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.CATEGORY); //라이브러리|카테고리
define("PAVE_LIB_FILE_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.FILE); //라이브러리|파일
define("PAVE_LIB_SAVE_URL", PAVE_LIB_URL.DIRECTORY_SEPARATOR.SAVE); //라이브러리|자동저장
define("PAVE_LIB_ADDR_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.ADDR); //라이브러리|주소찾기
define("PAVE_LIB_WORK_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.WORK); //라이브러리|작품
define("PAVE_LIB_SIGHT_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.SIGHT); //라이브러리|발견
define("PAVE_LIB_CERT_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.CERT); //라이브러리|인증
define("PAVE_LIB_FOLLOW_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.FOLLOW); //라이브러리|팔로우
define("PAVE_LIB_NOTIFY_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.NOTIFY); //라이브러리|알림
define("PAVE_LIB_CHARGE_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.CHARGE); //라이브러리|충전
define("PAVE_LIB_PAYMENT_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.PAYMENT); //라이브러리|결제
define("PAVE_LIB_SUBSCRIBE_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.SUBSCRIBE); //라이브러리|구독
define("PAVE_LIB_PAY_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.PAY); //라이브러리|구매
define("PAVE_LIB_SHARE_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.SHARE); //라이브러리|공유
define("PAVE_LIB_MODAL_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.MODAL); //라이브러리|모달
define("PAVE_LIB_PENALTY_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.PENALTY); //라이브러리|신고
define("PAVE_LIB_CREATION_URL",PAVE_LIB_URL.DIRECTORY_SEPARATOR.CREATION); //라이브러리|창작

/************************************************************************************************************************
   라이브러리 서버 경로 상수 선언
************************************************************************************************************************/
define("PAVE_LIB_SQL_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.SQL); // 라이브러리|데이터베이스
define("PAVE_LIB_COMMON_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.COMMON); // 라이브러리|공통
define("PAVE_LIB_SECURE_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.SECURE); // 라이브러리|보안
define("PAVE_LIB_EXP_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.EXP); // 라이브러리|경험치
define("PAVE_LIB_OBJECTS_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.OBJECTS); // 라이브러리|클래스
define("PAVE_LIB_URI_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.URI); // 라이브러리|URI
define("PAVE_LIB_CS_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.CS); // 라이브러리|고객센터
define("PAVE_LIB_USER_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.USER); // 라이브러리|회원
define("PAVE_LIB_MAIL_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.MAIL); // 라이브러리|메일
define("PAVE_LIB_ADM_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.ADM); // 라이브러리|관리자
define("PAVE_LIB_THM_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.THM); // 라이브러리|테마
define("PAVE_LIB_BOARD_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.BOARD); // 라이브러리|게시판
define("PAVE_LIB_CAPTCHA_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.CAPTCHA); //라이브러리|캡차
define("PAVE_LIB_LIKE_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.LIKE); //라이브러리|좋아요
define("PAVE_LIB_GRADE_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.GRADE); //라이브러리|등급
define("PAVE_LIB_LEVEL_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.LEVEL); //라이브러리|레벨
define("PAVE_LIB_AUTH_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.AUTH); //라이브러리|권한
define("PAVE_LIB_UPLOAD_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.UPLOAD); //라이브러리|업로드
define("PAVE_LIB_THUMBNAIL_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.THUMBNAIL); //라이브러리|썸네일
define("PAVE_LIB_MENU_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.MENU); //라이브러리|메뉴
define("PAVE_LIB_GROUP_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.GROUP); //라이브러리|그룹
define("PAVE_LIB_CATEGORY_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.CATEGORY); //라이브러리|카테고리
define("PAVE_LIB_FILE_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.FILE); //라이브러리|파일
define("PAVE_LIB_SAVE_PATH", PAVE_LIB_PATH.DIRECTORY_SEPARATOR.SAVE); //라이브러리|자동저장
define("PAVE_LIB_ADDR_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.ADDR); //라이브러리|주소찾기
define("PAVE_LIB_WORK_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.WORK); //라이브러리|작품
define("PAVE_LIB_SIGHT_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.SIGHT); //라이브러리|발견
define("PAVE_LIB_CERT_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.CERT); //라이브러리|인증
define("PAVE_LIB_FOLLOW_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.FOLLOW); //라이브러리|팔로우
define("PAVE_LIB_NOTIFY_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.NOTIFY); //라이브러리|알림
define("PAVE_LIB_CHARGE_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.CHARGE); //라이브러리|충전
define("PAVE_LIB_PAYMENT_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.PAYMENT); //라이브러리|결제
define("PAVE_LIB_SUBSCRIBE_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.SUBSCRIBE); //라이브러리|구독
define("PAVE_LIB_PAY_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.PAY); //라이브러리|구매
define("PAVE_LIB_SHARE_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.SHARE); //라이브러리|공유
define("PAVE_LIB_MODAL_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.MODAL); //라이브러리|모달
define("PAVE_LIB_PENALTY_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.PENALTY); //라이브러리|신고
define("PAVE_LIB_CREATION_PATH",PAVE_LIB_PATH.DIRECTORY_SEPARATOR.CREATION); //라이브러리|창작

/************************************************************************************************************************
   시간 상수 선언
************************************************************************************************************************/
define("PAVE_TIME", $_SERVER['REQUEST_TIME']);
define("PAVE_TIME_NULL", "0000-00-00 00:00:00");
define("PAVE_TIME_INFINITY", "9999-01-01 00:00:00");
define("PAVE_TIME_YMDHIS", date('Y-m-d H:i:s', PAVE_TIME));
define("PAVE_TIME_YMD", date('Y-m-d', PAVE_TIME));
define("PAVE_TIME_YM", date('Y-m', PAVE_TIME));
define("PAVE_TIME_Y", date('Y', PAVE_TIME));
define("PAVE_TIME_CERT_EXPIRE", date('Y-m-d H:i:s', PAVE_TIME+180)); // 인증만료 시간

/************************************************************************************************************************
   년, 월, 일, 요일, 시 상수 선언
************************************************************************************************************************/
define("PAVE_YEAR", date("Y", PAVE_TIME));
define("PAVE_MONTH", date("m", PAVE_TIME));
define("PAVE_DAY", date("d", PAVE_TIME));
define("PAVE_HOUR", date("H", PAVE_TIME));
define("PAVE_YOIL", array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일")[date("w", PAVE_TIME)]);
define("PAVE_SHORT_YOIL", array("일", "월", "화", "수", "목", "금", "토")[date("w", PAVE_TIME)]);

/************************************************************************************************************************
   IP 상수 선언
************************************************************************************************************************/
if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ // 프록시 접속 체크
	define("PAVE_USER_IP", $_SERVER['HTTP_X_FORWARDED_FOR']);
}else{
	define("PAVE_USER_IP", $_SERVER['REMOTE_ADDR']);
}
?>