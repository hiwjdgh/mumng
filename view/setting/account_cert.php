<?php
//본인인증 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_CERT_URL, "js/cert.lib.js"));

$setting_title = "본인인증 설정";
//헤더 불러오기
get_header("본인인증 - 계정");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/account_cert_form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/setting/account_cert_form.view.php");
}

//푸터 불러오기
get_footer();
?>