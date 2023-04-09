<?php
//가이드 노출
$is_guide_show = false;
$sql = "SELECT COUNT(*) AS cnt FROM pave_work WHERE user_no = '{$pave_user["user_no"]}'";
$row = pave_fetch($sql);

if($row["cnt"] == 0){
    if(get_session("guide_show")){
        $is_guide_show = false;
    }else{
        console("asd");
        $is_guide_show = true;
        set_session("guide_show", true);
    }
    
}

//헤더 불러오기
get_header("업로드");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/home.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/upload/home.view.php");
}

//푸터 불러오기
get_footer();
?>