<?php
if (!defined('_PAVE_')) exit;

//HTML 시작 불러오기
include_once(PAVE_PATH.'/top.php');

// 헤더
$header_theme_path = $pave_theme["thm_path"]."/header.view.php";
if(is_file($header_theme_path) && file_exists($header_theme_path)){
    include_once($header_theme_path);
}else{
    console("헤더 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/header.view.php");
}

//추가 헤더
$add_header_theme_path = $pave_theme["thm_path"]."/header.add.view.php";
if(is_file($add_header_theme_path) && file_exists($add_header_theme_path)){
    include_once($add_header_theme_path);
}
?>