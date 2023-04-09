<?php
//작품 라이브러리
$pave_html->add_js(get_url(PAVE_LIB_WORK_URL, "js/work.lib.js"));
$pave_html->add_css(get_url(PAVE_LIB_WORK_URL, "css/work.lib.min.css"));

//헤더 불러오기
get_header("미리보기", false);

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/preview.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/upload/preview.view.php");
}

//푸터 불러오기
get_footer(false);
?>