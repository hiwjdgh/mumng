<?php
if (!defined('_PAVE_')) exit;

//추가 푸터
$add_footer_theme_path = $pave_theme["thm_path"]."/footer.add.view.php";
if(is_file($add_footer_theme_path) && file_exists($add_footer_theme_path)){
    include_once($add_footer_theme_path);
}

// 푸터
$footer_theme_path = $pave_theme["thm_path"]."/footer.view.php";
if(is_file($footer_theme_path) && file_exists($footer_theme_path)){
    include_once($footer_theme_path);
}else{
    console("푸터 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/footer.view.php");
}

?>