<?php
if(!$pave_user["user_commerce"]){
    url_move(get_url(PAVE_COMMERCE_URL, "home"));
}

$work_id = pave_input_sanitize($request[2]);

//보유 EXP 현황
$obj = new Objects2();
$obj->generate_sql_init()
->set_sql_common("SELECT IFNULL(SUM(profit.profit_exp), 0) AS total_exp, IFNULL(SUM(profit.profit_exp - profit.profit_use_exp), 0) AS hold_exp FROM pave_commerce_profit AS profit")
->set_sql_where("profit.user_no = '{$pave_user["user_no"]}'")
->set_sql_where("profit.profit_status = 'success'");
$profit_overview = pave_fetch($obj->generate_sql());


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

$work_list = $work_obj->get_work_list();

//대여 갯수
$rent_cnt = 0;
foreach ($work_list as $i => $work) {
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_epsd_pay AS pay")
    ->set_sql_cnt_where("pay.work_id = '{$work["work_id"]}'")
    ->set_sql_cnt_where("pay.pay_type IN ('rent', 'preview', 'preview2')")
    ->set_sql_cnt_where("pay.pay_status = 'success'");
    $work_rent_cnt = pave_fetch($obj->generate_cnt_sql())["cnt"];
    $work_list[$i]["work_rent_cnt"] = $work_rent_cnt;

    $rent_cnt += $work_rent_cnt;
}
//소장 갯수
$keep_cnt = 0;
foreach ($work_list as $i => $work) {
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_epsd_pay AS pay")
    ->set_sql_cnt_where("pay.work_id = '{$work["work_id"]}'")
    ->set_sql_cnt_where("pay.pay_type IN ('keep', 'keep2', 'end', 'end2')")
    ->set_sql_cnt_where("pay.pay_status = 'success'");

    $work_keep_cnt = pave_fetch($obj->generate_cnt_sql())["cnt"];
    $work_list[$i]["work_keep_cnt"] = $work_keep_cnt;

    $keep_cnt += $work_keep_cnt;
}

//획득 EXP
foreach ($work_list as $i => $work) {
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_common("SELECT SUM(profit.profit_exp) AS earn_exp FROM pave_commerce_profit AS profit")
    ->set_sql_where("profit.profit_rel_work_id = '{$work["work_id"]}'")
    ->set_sql_where("profit.profit_status = 'success'");

    $work_earn_exp = pave_fetch($obj->generate_sql())["earn_exp"];
    $work_list[$i]["work_earn_exp"] = $work_earn_exp;
}

//회차 불러오기
if($work_id){
    $epsd_obj = new Epsd();
    $epsd_list = $epsd_obj->set_user_no($pave_user["user_no"])
    ->set_work_id($work_id)
    ->set_epsd_cate("epsd")
    ->set_epsd_state(array("reserve", "success"))
    ->get_epsd_list();

    foreach ($epsd_list as $i => $epsd) {
        $obj = new Objects2();
        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_epsd_pay AS pay")
        ->set_sql_cnt_where("pay.work_id = '{$epsd["work_id"]}'")
        ->set_sql_cnt_where("pay.epsd_id = '{$epsd["epsd_id"]}'")
        ->set_sql_cnt_where("pay.pay_type IN ('keep', 'keep2', 'end', 'end2')")
        ->set_sql_cnt_where("pay.pay_status = 'success'");
    
        $epsd_keep_cnt = pave_fetch($obj->generate_cnt_sql())["cnt"];
        $epsd_list[$i]["epsd_keep_cnt"] = $epsd_keep_cnt;
    

        $obj = new Objects2();
        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_epsd_pay AS pay")
        ->set_sql_cnt_where("pay.work_id = '{$epsd["work_id"]}'")
        ->set_sql_cnt_where("pay.epsd_id = '{$epsd["epsd_id"]}'")
        ->set_sql_cnt_where("pay.pay_type IN ('rent', 'preview', 'preview2')")
        ->set_sql_cnt_where("pay.pay_status = 'success'");
    
        $epsd_rent_cnt = pave_fetch($obj->generate_cnt_sql())["cnt"];
        $epsd_list[$i]["epsd_rent_cnt"] = $epsd_rent_cnt;
    }

    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_common("SELECT SUM(profit.profit_exp) AS earn_exp FROM pave_commerce_profit AS profit")
    ->set_sql_where("profit.profit_rel_work_id = '{$epsd["work_id"]}'")
    ->set_sql_where("profit.profit_rel_epsd_id = '{$epsd["epsd_id"]}'")
    ->set_sql_where("profit.profit_status = 'success'");

    $epsd_earn_exp = pave_fetch($obj->generate_sql())["earn_exp"];
    $epsd_list[$i]["epsd_earn_exp"] = $epsd_earn_exp;
    
}

//헤더 불러오기
get_header("수익 - 커머스");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/profit.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/commerce/profit.view.php");
}

//푸터 불러오기
get_footer();
?>
