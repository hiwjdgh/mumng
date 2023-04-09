<?php
//P3P 설정
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
//SESSION 설정
session_set_cookie_params(0, '/'); // 브라우저 닫으면 초기화
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

//설정 파일 선언
include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

/* ini_set("display_errors", 1);
error_reporting(E_ALL ^ E_NOTICE); */

//라이브러리 선언
require_once(PAVE_LIB_SECURE_PATH.'/secure.lib.php'); //  보안 파일
require_once(PAVE_LIB_SQL_PATH.'/sql.lib.php'); //  sql 파일

//디비 파일 선언
$db_conn = pave_connect();

//sql injection 방지
$_POST = array_map('pave_escape', $_POST);
$_POST = array_map("pave_trim", $_POST);
$_POST = pave_extract($_POST);
@extract($_POST, EXTR_SKIP);


$_GET = array_map('pave_escape', $_GET);
$_GET = array_map("pave_trim", $_GET);
$_GET = pave_extract($_GET);
@extract($_GET, EXTR_SKIP);


//공통 객체 선언
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.html.php'); // html 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.objects.php'); // 공통 객체(삭제 필요)
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.objects2.php'); // 기본 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.converter.php'); // 변환 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.config.php'); // 설정 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.visit.php'); // 방문 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.exception.php'); // 공통 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.u.php'); // 회원 객체(삭제 필요)
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.user.php'); // 회원2 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.certification.php'); // 인증 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.notification.php'); // 인증 객체



//공통 라이브러리 선언
require_once(PAVE_LIB_COMMON_PATH.'/common.lib.php'); // 공통 라이브러리
require_once(PAVE_LIB_URI_PATH.'/uri.lib.php'); // URI 라이브러리
require_once(PAVE_LIB_THM_PATH.'/theme.lib.php'); // 테마 라이브러리

//무명 객체 선언
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.work.php'); // 작품2 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.epsd.php'); // 회차2 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.comment.php'); // 댓글 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.w.php'); // 작품 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.sight.php'); // 발견 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.epsds.php'); // 회차 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.cmts.php'); // 댓글 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.page.php'); // 페이지 객체
require_once(PAVE_LIB_OBJECTS_PATH.'/pave.hashtags.php'); // 해시태그 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.item.php"); // 상품 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.receipt.php"); // 영수증 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.subscribe.php"); // 구독 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.follow.php"); // 팔로우 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.pay.php"); // 구매 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.like.php"); // 좋아요 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.charge.php"); // 충전 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.payment.php"); // 결제 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.exp.php"); // EXP 객체
require_once(PAVE_LIB_OBJECTS_PATH."/pave.commerce.php"); //커머스 객체 
require_once(PAVE_LIB_OBJECTS_PATH."/pave.creation.php"); //창작 객체 
$config_obj = new Config();
$pave_config = $config_obj->get_config();



$work_obj = new Work();

//테스트 여부 
define("PAVE_TEST", $pave_config["pave_test"]); 


//공통 js
$pave_html = new Html();
$pave_html->add_js(get_url(PAVE_JS_URL, "jquery-3.5.1.min.js"));
$pave_html->add_js(get_url(PAVE_JS_URL, "jquery-ui.min.js"));
$pave_html->add_js(get_url(PAVE_JS_URL, "component.js"));
$pave_html->add_js(get_url(PAVE_JS_URL, "dropdown.js"));
$pave_html->add_js(get_url(PAVE_JS_URL, "helper.js"));
$pave_html->add_js(get_url(PAVE_JS_URL, "config.js"));
$pave_html->add_js(get_url(PAVE_JS_URL, "converter.js"));
$pave_html->add_js(get_url(PAVE_LIB_COMMON_URL, "js/common.lib.js"));

//공통 css
$pave_html->add_css(get_url(PAVE_CSS_URL, "jquery-ui.min.css"));
$pave_html->add_css(get_url(PAVE_CSS_URL, "style.min.css"));
$pave_html->add_css(get_url(PAVE_ICON_URL, "icon.min.css"));

//공통 theme
$pave_theme = get_theme("index");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

//kakao 플러그인
$pave_html->add_js(get_url(PAVE_PLUGIN_KAKAO_URL, "kakao.min.js"));

//모달 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_MODAL_URL, "js/modal.lib.js"));
$pave_html->add_css(get_url(PAVE_LIB_MODAL_URL, "css/modal.lib.min.css"));

//회원 라이브러리
require_once(PAVE_LIB_USER_PATH.'/user.lib.php');
$pave_html->add_js(get_url(PAVE_LIB_USER_URL, "js/user.lib.js"));
$user_config = $config_obj->get_user_config();

//신고 라이브러리
require_once(PAVE_LIB_PENALTY_PATH.'/penalty.lib.php');
$pave_html->add_js(get_url(PAVE_LIB_PENALTY_URL, "js/penalty.lib.js"));

//팔로우 라이브러리
require_once(PAVE_LIB_FOLLOW_PATH.'/follow.lib.php');
$pave_html->add_js(get_url(PAVE_LIB_FOLLOW_URL, "js/follow.lib.js"));
$pave_html->add_css(get_url(PAVE_LIB_FOLLOW_URL, "css/follow.lib.min.css"));

//구독 라이브러리
require_once(PAVE_LIB_SUBSCRIBE_PATH.'/subscribe.lib.php');
$pave_html->add_js(get_url(PAVE_LIB_SUBSCRIBE_URL, "js/subscribe.lib.js"));

//좋아요 라이브러리
require_once(PAVE_LIB_LIKE_PATH.'/like.lib.php');
$pave_html->add_js(get_url(PAVE_LIB_LIKE_URL, "js/like.lib.js"));

//공유 라이브러리
require_once(PAVE_LIB_SHARE_PATH.'/share.lib.php');
$pave_html->add_js(get_url(PAVE_LIB_SHARE_URL, "js/share.lib.js"));

//알림 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_NOTIFY_URL, "js/notify.lib.js"));
$pave_html->add_css(get_url(PAVE_LIB_NOTIFY_URL, "css/notify.lib.min.css"));

//구매 라이브러리
require_once(PAVE_LIB_PAY_PATH.'/pay.lib.php');
$pave_html->add_js(get_url(PAVE_LIB_PAY_URL, "js/pay.lib.js"));


//스와이퍼 플러그인
$pave_html->add_css(get_url(PAVE_PLUGIN_SWIPER_URL, "swiper-bundle.min.css"));
$pave_html->add_css(get_url(PAVE_PLUGIN_SWIPER_URL, "swiper-custom.min.css"));
$pave_html->add_js(get_url(PAVE_PLUGIN_SWIPER_URL, "swiper-bundle.min.js"));

//무명 메타데이터
$pave_meta = array(
    "title" => $pave_config["pave_tit"],
    "title2" => $pave_config["pave_tit"],
    "author" => $pave_config["pave_adm"],
    "description" => $pave_config["pave_description"],
    "keyword" => $pave_config['pave_keyword'],
    "url" => PAVE_URL,
    "img" => get_url(PAVE_IMG_URL, "img_mumng_1200px.png")
);


//익스플로러 사용제한
if(Visit::is_explorer()){
    die("이용 불가 브라우저 입니다.");
}

//회원 정보
$user_obj = new User();
$pave_user = array();
if(get_session("user_no")){ 
    //세션 로그인
    $pave_user = $user_obj->set_user_no(get_session("user_no"))->get_user();
}else{ 
    //자동로그인
    if(get_cookie("user_no")){
        if(get_cookie("user_auto_login") == User::generate_auto_login_key()){
            $pave_user = $user_obj->set_user_no(get_session("user_no"))->get_user();
            set_session("user_no", $pave_user["user_no"]);
        }else{
            //비회원
            $pave_user["user_no"] = ""; 
        }
    }else{ //비회원
        $pave_user["user_no"] = ""; 
    }
}



//모바일 여부
$is_mobile = false;
if(Visit::is_mobile()){
    $is_mobile = true;
}

//회원 구분
$is_super = false;
$is_admin = false;
$is_user = false;
if($pave_user["user_no"]){
    $is_user = true;
}

if($pave_user["user_grp"] == "admin" || $pave_user["user_grp"] == "super"){
    $is_admin = true;
}

if($pave_user["user_grp"] == "super"){
    $is_super = true;
}

//작품 설정값
$webtoon_config = $config_obj->get_work_config("webtoon");
?>