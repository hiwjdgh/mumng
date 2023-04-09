<?php
include_once(PAVE_PLAN_PATH."/_common.php");

//헤더 불러오기
get_header("커머스 플랜");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/plan.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/plan/plan.view.php");
}

//푸터 불러오기
get_footer();
?>