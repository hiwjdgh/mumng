<?php
//보유 EXP 현황
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT IFNULL(SUM(profit.profit_exp), 0) AS total_exp, IFNULL(SUM(profit.profit_exp - profit.profit_use_exp), 0) AS hold_exp FROM pave_commerce_profit AS profit")
->set_sql_where("profit.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("profit.profit_status = 'success'");
$profit_overview = pave_fetch($obj->generate_sql());

//정산 현황
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT IFNULL(SUM(calc.calc_real_price), 0) AS total_calc FROM pave_commerce_calc AS calc")
->set_sql_where("calc.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("calc.calc_status = 'calc_complete'");
$calc_overview = pave_fetch($obj->generate_sql());


//최근 정산 현황
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT calc.* FROM pave_commerce_calc AS calc")
->set_sql_where("calc.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("calc.calc_status IN ('calc_ready', 'calc_wait', 'calc_complete')")
->set_sql_order("ORDER BY calc.calc_no DESC")
->set_sql_limit("LIMIT 3");
$result = pave_query($obj->generate_sql());
$calc_latest_overview = array();
for ($i=0; $row = pave_fetch_assoc($result); $i++) {
    if($row["calc_status"] == "calc_ready"){
        $row["calc_status_text"] = "신청대기";
    }else if($row["calc_status"] == "calc_wait"){
        $row["calc_status_text"] = "정산대기";
    }else if($row["calc_status"] == "calc_complete"){
        $row["calc_status_text"] = "정산완료";
    }else if($row["calc_status"] == "calc_cancel"){
        $row["calc_status_text"] = "신청취소";
    }

    $calc_latest_overview[] = $row;
}


//작품 갯수
$work_obj = new Work();
$work_obj->set_user_no($pave_user["user_no"])
->set_work_epsd_cnt(0)
->set_work_display(1);
$work_cnt = $work_obj->get_work_list_cnt();

//회차 갯수
$epsd_obj = new Epsd();
$epsd_obj->set_user_no($pave_user["user_no"])
->set_epsd_cate("epsd_cate");
if($pave_user["user_commerce"]){
    $epsd_obj->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj->set_epsd_state("success");
}
$epsd_cnt = $epsd_obj->get_epsd_list_cnt();

//대여 갯수
$work_list = $work_obj->get_work_list();
$rent_cnt = 0;
foreach ($work_list as $i => $work) {
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_epsd_pay AS pay")
    ->set_sql_cnt_where("pay.work_id = '{$work["work_id"]}'")
    ->set_sql_cnt_where("pay.pay_type IN ('rent', 'preview', 'preview2')")
    ->set_sql_cnt_where("pay.pay_status = 'success'")
    ->set_sql_cnt_where("pay.pay_expire_dt > '".PAVE_TIME_YMDHIS."'");

    $rent_cnt += pave_fetch($obj->generate_cnt_sql())["cnt"];
}

//소장 갯수
$work_list = $work_obj->get_work_list();
$keep_cnt = 0;
foreach ($work_list as $i => $work) {
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_epsd_pay AS pay")
    ->set_sql_cnt_where("pay.work_id = '{$work["work_id"]}'")
    ->set_sql_cnt_where("pay.pay_type IN ('keep', 'keep2', 'end', 'end2')")
    ->set_sql_cnt_where("pay.pay_status = 'success'")
    ->set_sql_cnt_where("pay.pay_expire_dt > '".PAVE_TIME_YMDHIS."'");

    $keep_cnt += pave_fetch($obj->generate_cnt_sql())["cnt"];
}

//헤더 불러오기
get_header("홈 - 커머스");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/home.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/commerce/home.view.php");
}

//푸터 불러오기
get_footer();
?>
