<?php
$work_id = pave_input_sanitize($request[2]);
$epsd_id = pave_input_sanitize($request[3]);
/* 
$work_obj = new Work();
$work = $work_obj->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)->get_work();
if(!$work["work_id"]){
    alert("작품을 찾을 수 없습니다.");
}

$epsd_obj = new Epsd();
$epsd_obj->set_work_id($work["work_id"])
->set_epsd_id($epsd_id)
->set_epsd_cate(array("epsd", "notice"));
if($work["work_user"]["user_commerce"]){
    $epsd_obj->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj->set_epsd_state("success");
}
$epsd = $epsd_obj->get_epsd();
if(!$epsd["epsd_id"]){
    alert("작품을 찾을 수 없습니다.");
}

//다른 회차
$epsd_obj2 = new Epsd();
$epsd_obj2->set_work_id($work["work_id"])
->set_epsd_cate(array("epsd", "notice"));
if($work["work_user"]["user_commerce"]){
    $epsd_obj2->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj2->set_epsd_state("success");
}
$epsd_list = $epsd_obj2->get_epsd_list();

//조회수 증가
Epsd::add_hit($pave_user, $epsd);



//구매 필요 검사
$pay_obj = new Pay();
if($pay_obj->is_pay_need($work, $epsd)){
    alert("회차 구매후 이용가능합니다.", $work["work_url"]);
} */

//헤더 불러오기
get_header($epsd["epsd_name"]);
/* //컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/epsd_detail.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/work/epsd_detail.view.php");
} */
?>
<script>
$(function () {
    let work_id = "<?=$work_id?>",
        epsd_id = "<?=$epsd_id?>";
    pop_obj.url = "/work/epsd/"+work_id+"/"+ epsd_id;
    pop_obj.type = "epsd_detail";
    pop_obj.data = {
        work_id : work_id,
        epsd_id : epsd_id,
    }
   works_obj.check_epsd_pay(pop_obj);
});

    
</script>
<?php
//푸터 불러오기
get_footer(!$is_mobile);

?>
