<?php
if (!defined('_PAVE_')) exit;
class Pay {
    private $pay_id;
    private $user_no;
    private $work_id;
    private $epsd_id;
    private $pay_type;
    private $pay_status;
    private $pay_display;

    private $page = 1;
    private $list_count = 10;

    function __construct() {

    }

    
    public static function is_pay_need($user, $work, $epsd){
        //커머스 아님
        if(!$work["work_user"]["user_commerce_state"]){
            return false;
        }


        //무료 커머스 이면서 미리보기가 아닌경우
        if($work["work_free"] && !$epsd["is_preview"]){
            return false;
        }

        //대표 작가 
        if($work["work_user"]["user_no"] == $user["user_no"]){
            return false;
        }

        //함께한 작가 
        if(pave_is_array($work["work_with_user"]) && in_array($user["user_no"], array_column($work["work_with_user"], "user_no"))){
            return false;
        }

        //구매 여부
        if($epsd["epsd_pay_info"] && !$epsd["epsd_pay_info"]["is_expired"]){
            return false;
        }

        //공지인 경우
        if($epsd["is_notice"]){
            return false;
        }

        //무료 커머스 미리보기 금액이 0원인 경우
        if($work["work_free"] && $work["work_preview2_exp"] == 0 && $epsd["is_preview"]){
            return false;
        }

        //유료 커머스 미리보기 금액이 0원인 경우
        if(!$work["work_free"] && $work["work_preview_exp"] == 0 && $epsd["is_preview"]){
            return false;
        }

        //유료 커머스 회차기본 금액이 0원인 경우
        if(!$work["work_free"] && $work["work_rent_exp"] == 0){
            return false;
        }


        return true;
    }

    
    public static function pay_epsd($user, $work, $epsd, $pay_type){
        global $pay_config;
        if($pay_type == "keep" || $pay_type == "keep2") {
            if($work["work_free"]){
                $epsd_exp = $work["work_keep2_exp"];
                $pay_expire_dt = $pay_config["pay_keep_expire_dt"];
            }else{
                $epsd_exp = $work["work_keep_exp"];
                $pay_expire_dt = $pay_config["pay_keep_expire_dt"];
            }
        }else if($pay_type == "end" || $pay_type == "end2"){
            if($work["work_free"]){
                $epsd_exp = $work["work_end2_exp"];
                $pay_expire_dt = $pay_config["pay_keep_expire_dt"];
            }else{
                $epsd_exp = $work["work_end_exp"];
                $pay_expire_dt = $pay_config["pay_keep_expire_dt"];
            }
        }else if($pay_type == "rent" || $pay_type == "preview" || $pay_type == "preview2"){
            if($work["work_free"]){
                $epsd_exp = $work["work_preview2_exp"];
            }else{
                if($epsd["epsd_state"] == "reserve"){
                    $epsd_exp = $work["work_preview_exp"];
                }else{
                    $epsd_exp = $work["work_rent_exp"];
            
                }
            }
            $pay_expire_dt = $pay_config["pay_rent_expire_dt"];
        }

        //EXP 부족
        $calc_exp = $user["user_exp"] - $epsd_exp;
        if($calc_exp < 0){
            die(return_json(null, "fail", "EXP가 부족합니다. 충전페이지로 이동하시겠습니까?", get_url(PAVE_CHARGE_URL, "payment")));
        }
        
        //회차 구매
        $pay_id = self::genrate_pay_id();
        $epsd_pay = array(
            "user_no"               => $user["user_no"],
            "work_id"               => $work["work_id"],
            "epsd_id"               => $epsd["epsd_id"],
            "pay_exp"               => $epsd_exp,
            "pay_type"              => $pay_type,
            "pay_visit"             => 1,
            "pay_status"            => "success",
            "pay_cancel_reason"     => "",
            "pay_expire_dt"         => $pay_expire_dt,
            "pay_insert_dt"         => PAVE_TIME_YMDHIS,
            "pay_insert_ip"         => PAVE_USER_IP,
        );
        
        if(!pave_update("pave_epsd_pay", $epsd_pay, "pay_id = '{$pay_id}'")){
            die(return_json(null, "fail", "구매에 실패했습니다."));
        }

        //EXP 사용 기록
        $sql = "SELECT * FROM pave_exp WHERE user_no = '{$user["user_no"]}' AND exp_expire_dt > '".PAVE_TIME_YMDHIS."' AND exp_state = 'success' ";
        $sql .= "ORDER BY 
        CASE exp_type
            WHEN 'ad' THEN 1
            WHEN 'event' THEN 2
            ELSE 3
        END, exp_insert_dt";
        $result = pave_query($sql);
        $profit_exp_detail = array(
            "payment" => 0,
            "ad" => 0,
            "event" => 0
        );

        $exp = $epsd_exp;
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $exp2 = $row["exp_amount"];
            $exp3 = $row["exp_use_amount"];
            
            if(($exp2 - $exp3) > 0){
                $exp4 = $exp2 - $exp3;
                if($exp4 > $exp){
                    if($row["exp_type"] == "payment"){
                        $profit_exp_detail["payment"] += $exp;
                    }else if($row["exp_type"] == "ad"){
                        $profit_exp_detail["ad"] += $exp;
                    }else if($row["exp_type"] == "event"){
                        $profit_exp_detail["event"] += $exp;
                    }
                    
                    pave_query("UPDATE pave_exp SET exp_use_amount = exp_use_amount + {$exp} WHERE exp_no = '{$row["exp_no"]}'");
                    break;
                }else{
                    if($row["exp_type"] == "payment"){
                        $profit_exp_detail["payment"] += $exp4;
                    }else if($row["exp_type"] == "ad"){
                        $profit_exp_detail["ad"] += $exp4;
                    }else if($row["exp_type"] == "event"){
                        $profit_exp_detail["event"] += $exp4;
                    }
                    pave_query("UPDATE pave_exp SET exp_use_amount = exp_use_amount + {$exp4} WHERE exp_no = '{$row["exp_no"]}'");
                    $exp -= $exp4;
                }
            }
        }

        //커머스 수익 기록
        $commerce_profit = array(
            "user_no"               => $work["work_user"]["user_no"],
            "pay_id"                => $pay_id,
            "profit_commerce"       => $work["work_user"]["user_commerce"]["user_commerce_grd"],
            "profit_exp"            => $profit_exp_detail["payment"],
            "profit_exp_detail"     => json_encode($profit_exp_detail),
            "profit_status"         => "success",
            "profit_rel_user_no"    => $user["user_no"],
            "profit_rel_work_id"    => $work["work_id"],
            "profit_rel_epsd_id"    => $epsd["epsd_id"],
            "profit_insert_dt"      => PAVE_TIME_YMDHIS,
            "profit_insert_ip"      => PAVE_USER_IP,
        );
        pave_insert("pave_commerce_profit", $commerce_profit);

        //회원 EXP 수정
        pave_update("pave_user", array("user_exp" => $calc_exp) , "user_no = '{$user["user_no"]}'");


        //회차 구매 알림
        $notify_obj = new Notification();
        $notify_obj->send_notify(
            "mumng", 
            $user["user_id"], 
            "notify_pay_complete", 
            array("work_id" => $work["work_id"], "epsd_id" => $epsd["epsd_id"], "exp" => $epsd_exp, "pay_type" => $pay_type)
        );
        return true;
    }

    public static function cancel_pay_epsd($user, $pay, $cancel_reason, $cancel_reason_text){
        $sql = "SELECT * FROM pave_commerce_profit WHERE pay_id = '{$pay["pay_id"]}'";
        $commerce_profit = pave_fetch($sql);

        //커머스 수익 수정
        pave_update("pave_commerce_profit", array("profit_status" => "cancel", "profit_cancel_dt" => PAVE_TIME_YMDHIS), "profit_no = '{$commerce_profit["profit_no"]}'");

        $pay_exp_detail = json_decode($commerce_profit["profit_exp_detail"], true);

        //EXP 사용 반환
        $cancel_exp = 0;
        foreach ($pay_exp_detail as $exp_type => $exp) {
            if($exp == 0){
                continue;
            }
            $exp1 = $exp;

            $sql = "SELECT * FROM pave_exp WHERE user_no = '{$user["user_no"]}' AND exp_use_amount > 0  AND exp_state = 'success' AND exp_type = '{$exp_type}' ORDER BY exp_insert_dt DESC";
            $result = pave_query($sql);

            for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
                $exp2 = $row["exp_use_amount"];

                if(strtotime($row['exp_expire_dt']) > PAVE_TIME){
                    $cancel_exp += $exp1;
                }

                if($exp2 > $exp1){
                    pave_query("UPDATE pave_exp SET exp_use_amount = exp_use_amount - {$exp1} WHERE exp_no = '{$row["exp_no"]}'");
                    break;
                }else{
                    pave_query("UPDATE pave_exp SET exp_use_amount = 0 WHERE exp_no = '{$row["exp_no"]}'");
                    $exp1 -= $exp2;
                }
            }
        }

        $update = array(
            "pay_cancel_exp" => $cancel_exp,
            "pay_status" => "cancel",
            "pay_cancel_reason" => $cancel_reason,
            "pay_cancel_reason_text" => $cancel_reason_text,
            "pay_cancel_dt" => PAVE_TIME_YMDHIS
        );
        
        //회차구매 취소
        pave_update("pave_epsd_pay", $update, "pay_id = '{$pay["pay_id"]}'");


        //회원 EXP 수정 (만료되지 않은 EXP 만 반환)
        $calc_exp = $user["user_exp"] + $cancel_exp;
        pave_update("pave_user", array("user_exp" => $calc_exp) , "user_no = '{$user["user_no"]}'");
    }


    public function set_pay_id($pay_id){
        $this->pay_id = $pay_id;

        return $this;
    }

    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    public function set_work_id($work_id){
        $this->work_id = $work_id;

        return $this;
    }

    public function set_epsd_id($epsd_id){
        $this->epsd_id = $epsd_id;

        return $this;
    }

    public function set_pay_type($pay_type){
        $this->pay_type = $pay_type;

        return $this;
    }

    public function set_pay_status($pay_status){
        $this->pay_status = $pay_status;

        return $this;
    }

    public function set_pay_display($pay_display){
        $this->pay_display = $pay_display;

        return $this;
    }

    public function set_pay_page($pay_page){
        $this->page = $pay_page;

        return $this;
    }


    public function get_pay_work_info($pay){
        $work_obj = new Work();
        return $work_obj->set_work_id($pay["work_id"])->get_work();
    }

    public function get_pay_epsd_info($pay){
        $epsd_obj = new Epsd();
        return $epsd_obj->set_epsd_id($pay["epsd_id"])->get_epsd();
    }

    
    public function get_pay_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_epsd_pay AS pay");


        if($this->pay_id){
            $obj->set_sql_cnt_where("pay.pay_id ='{$this->pay_id}'");
        }

        if($this->user_no){
            $obj->set_sql_cnt_where("pay.user_no ='{$this->user_no}'");
        }

        if($this->work_id){
            $obj->set_sql_cnt_where("pay.work_id ='{$this->work_id}'");
        }

        if($this->epsd_id){
            $obj->set_sql_cnt_where("pay.epsd_id ='{$this->epsd_id}'");
        }

        if($this->pay_type){
            if(pave_is_array($this->pay_type)){
                $obj->set_sql_cnt_where("pay.pay_type IN ('".pave_implode($this->pay_type, "','")."')");
            }else{
                $obj->set_sql_cnt_where("pay.pay_type = '{$this->pay_type}'");
            }
        }

        if($this->pay_status){
            if(pave_is_array($this->pay_status)){
                $obj->set_sql_cnt_where("pay.pay_status IN ('".pave_implode($this->pay_status, "','")."')");
            }else{
                $obj->set_sql_cnt_where("pay.pay_status = '{$this->pay_status}'");
            }
        }

        if($this->pay_display !== null){
            $obj->set_sql_cnt_where("pay.pay_display ='{$this->pay_display}'");
        }

        $pay_list_cnt = pave_fetch($obj->generate_cnt_sql())["cnt"];

        return $pay_list_cnt;
    }

    public function get_pay_list(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT pay.* FROM pave_epsd_pay AS pay");


        if($this->pay_id){
            $obj->set_sql_where("pay.pay_id ='{$this->pay_id}'");
        }

        if($this->user_no){
            $obj->set_sql_where("pay.user_no ='{$this->user_no}'");
        }

        if($this->work_id){
            $obj->set_sql_where("pay.work_id ='{$this->work_id}'");
        }

        if($this->epsd_id){
            $obj->set_sql_where("pay.epsd_id ='{$this->epsd_id}'");
        }

        if($this->pay_type){
            if(pave_is_array($this->pay_type)){
                $obj->set_sql_where("pay.pay_type IN ('".pave_implode($this->pay_type, "','")."')");
            }else{
                $obj->set_sql_where("pay.pay_type = '{$this->pay_type}'");
            }
        }

        if($this->pay_status){
            if(pave_is_array($this->pay_status)){
                $obj->set_sql_where("pay.pay_status IN ('".pave_implode($this->pay_status, "','")."')");
            }else{
                $obj->set_sql_where("pay.pay_status = '{$this->pay_status}'");
            }
        }

        if($this->pay_display !== null){
            $obj->set_sql_where("pay.pay_display ='{$this->pay_display}'");
        }

        $obj->set_sql_order("ORDER BY pay.pay_insert_dt DESC");

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;

            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }

        $pay_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            if($row["pay_type"] == "keep" || $row["pay_type"] == "keep2") {
                $row["is_expired"] = false;
                $row["is_keep"] = true;
                $row["pay_expire_text"] = "영구소장"; 
                $row["pay_type_text"] = "영구소장"; 
                $row["pay_remain_text"] = "영구소장"; 
            }else if($row["pay_type"] == "end" || $row["pay_type"] == "end2"){
                $row["is_expired"] = false;
                $row["is_keep"] = true;
                $row["pay_expire_text"] = "완결소장"; 
                $row["pay_type_text"] = "완결소장"; 
                $row["pay_remain_text"] = "영구소장"; 
            }else if($row["pay_type"] == "rent" || $row["pay_type"] == "preview" || $row["pay_type"] == "preview2"){
                $row["is_keep"] = false;
                $remain_time = strtotime($row["pay_expire_dt"]) - PAVE_TIME;
                if($remain_time < 0){
                    $row["is_expired"] = true;
                    $row["pay_expire_text"] = "만료";
                }else{
                    $row["is_expired"] = false;
                    $row["pay_expire_text"] = $row["pay_expire_dt"];

                    $days = floor($remain_time / 86400);
                    $hours = floor(($remain_time - ($days * 86400))/3600);
                    $min = floor(($remain_time - ($days * 86400) - ($hours * 3600))/60);
                    $seconds = floor(($remain_time - ($days * 86400) - ($hours * 3600)) - ($min * 60));
                    $row["pay_remain_text"] = "{$days}일 ".str_pad($hours,2,"0",STR_PAD_LEFT).":".str_pad($min,2,"0",STR_PAD_LEFT);
                }

                if($row["pay_type"] == "rent"){
                    $row["pay_type_text"] = "회차대여";
                }else{
                    $row["pay_type_text"] = "회차미리보기";
                }
            }

            //구매 작품 정보
            $row["pay_work"] = $this->get_pay_work_info($row);

            //구매 회차 정보
            $row["pay_epsd"] = $this->get_pay_epsd_info($row);

            //구매 취소가능 여부
            //조회 하지 않고(제외함), 만료되지 않고, 구매완료 상태이면, 구매한지 7일 이네
            $row["is_cancelable"] = false;
         /*    if(
                PAVE_TIME < strtotime($row["pay_expire_dt"]) &&
                $row["pay_status"] == "success" &&
                (PAVE_TIME - strtotime($row["pay_insert_dt"])) < (86400 * 7)){
                $row["is_cancelable"] = true;
            }
 */
            //text
            switch ($row["pay_status"]) {
                case 'success':
                    $row["pay_status_text"] = "구매완료";
                    break;
                case 'cancel':
                    $row["pay_status_text"] = "구매취소";
                    break;
            }

            $pay_list[] = $row;
        }


        return $pay_list;
    }

    public function get_pay(){
        return $this->get_pay_list()[0];
    }

    
    private function genrate_pay_id() {
        pave_query("START TRANSACTION");
        while (1) {
            $key = date('YmdHis', time()) . str_pad((int)(microtime()*100), 2, "0", STR_PAD_LEFT);

            $pay = array(
                "pay_id" => $key
            );
            $result = pave_insert("pave_epsd_pay", $pay);

            if ($result){
                pave_query("COMMIT");
                break;
            }else{
                pave_query("ROLLBACK");
                usleep(10000); // 100분의 1초를 쉰다
            }
        }
        return $key;
    }
}
?>