<?php
//헤더 불러오기
switch ($request[2]) {
    case "rent":
        get_header("회차대여 - 내서재");
        break;
    case "keep":
        get_header("회차소장 - 내서재");
        break;
    case "end":
        get_header("완결소장 - 내서재");
        break;
}

//컨텐츠 불러오기
$form_theme_path = $pave_theme["thm_path"]."/pay_sst.view.php";
if(is_file($form_theme_path) && file_exists($form_theme_path)){
    include_once($form_theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/library/pay_list.view.php");
}

//푸터 불러오기
get_footer();
?>