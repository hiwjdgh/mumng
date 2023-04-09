<?php
if (!defined('_PAVE_')) exit;

class Commerce{
    private $user_commerce_no;
    private $user_no;
    private $user_commerce_grd;


    private $page = 1;
    private $list_count = 10;

    function __construct() {
       
    }

    public static function is_calc_day(){
        $calc_start_day = mktime(0, 0, 0, PAVE_MONTH , 1, PAVE_YEAR);
        $calc_end_day = mktime(23, 59, 59, PAVE_MONTH , 7, PAVE_YEAR);
      
        if(PAVE_TIME > $calc_start_day && PAVE_TIME < $calc_end_day){
            return true;
        }
        
        return false;
    }

    
    public function set_user_commerce_no($user_commerce_no){
        $this->user_commerce_no = $user_commerce_no;

        return $this;
    }

    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    public function set_user_commerce_grd($user_commerce_grd){
        $this->user_commerce_grd = $user_commerce_grd;

        return $this;
    }

    public function set_page($page){
        $this->page = $page;

        return $this;
    }

    public function get_user_commerce_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_user_commerce AS commerce");
      
        if($this->user_commerce_no){
            $obj->set_sql_where("commerce.user_commerce_no = '{$this->user_commerce_no}'");
        }

        if($this->user_no){
            $obj->set_sql_where("commerce.user_no = '{$this->user_no}'");
        }
      
        if($this->user_commerce_grd){
            $obj->set_sql_where("commerce.user_commerce_grd = '{$this->user_commerce_grd}'");
        }

        $commerce_list_cnt = pave_fetch($obj->generate_cnt_sql())["cnt"];

        return $commerce_list_cnt;
    }

    public function get_user_commerce_list(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT commerce.* FROM pave_user_commerce AS commerce");
      
        if($this->user_commerce_no){
            $obj->set_sql_where("commerce.user_commerce_no = '{$this->user_commerce_no}'");
        }

        if($this->user_no){
            $obj->set_sql_where("commerce.user_no = '{$this->user_no}'");
        }
      
        if($this->user_commerce_grd){
            $obj->set_sql_where("commerce.user_commerce_grd = '{$this->user_commerce_grd}'");
        }

        $obj->set_sql_order("ORDER BY user_commerce_no DESC");

        if($this->page !== null){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }

        $commerce_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) {
            $commerce_list[] = $row;
        }

        return $commerce_list;
    }

    public function get_user_commerce(){
        return $this->get_user_commerce_list()[0];
    }

  
    function get_work_count(){
        $sql = "SELECT COUNT(*) AS work_cnt FROM pave_work WHERE user_no = '{$this->user["user_no"]}' AND work_display = 1";
        $row = pave_fetch($sql);

        return $row["work_cnt"];
    }

    function get_epsd_count(){
        $sql = array();
        $sql[] = "SELECT COUNT(*) AS epsd_cnt FROM pave_epsd";
        $sql[] = "WHERE work_id IN(SELECT work_id FROM pave_work WHERE user_no = '{$this->user["user_no"]}' AND work_display = 1)";
        $sql[] = "AND epsd_display = 1";
        if($this->user["user_commerce"]){
            $sql[] = "AND epsd_state IN('reserve', 'success')";
        }else{
            $sql[] = "AND epsd_state IN('success')";
        }
        $sql[] = "AND epsd_cate = 'epsd'";
      

        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        return $row["epsd_cnt"];
    }

    function get_epsd_pay_count($pay_type, $work_id = "", $epsd_id = ""){
        $sql = array();

        $sql[] = "SELECT COUNT(*) AS cnt FROM pave_epsd_pay";
        $sql[] = "WHERE pay_type IN('".pave_implode($pay_type, "','")."') AND work_id IN(SELECT work_id FROM pave_work WHERE user_no = '{$this->user["user_no"]}' AND work_display = 1)";
        $sql[] = " AND pay_status = 'success'";
        $sql[] = " AND pay_expire_dt > '".PAVE_TIME_YMDHIS."'";
        if($work_id){
            $sql[] = " AND work_id = '{$work_id}'";
        }
        if($epsd_id){
            $sql[] = " AND epsd_id = '{$epsd_id}'";
        }

        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);
        return $row["cnt"];
    }

    function get_latest_three_calc(){
        $sql = "SELECT * FROM pave_commerce_calc WHERE user_id = '{$this->user["user_id"]}' LIMIT 3";
        $result = pave_query($sql);

        $calc_list = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $row["calc_ready_dt_text"] = date("Y-m-d", strtotime($row["calc_ready_dt"]));
            switch ($row["calc_status"]) {
                case "calc_ready":
                    $row["calc_status_text"] = "신청대기";
                    break;
                case "calc_wait":
                    $row["calc_status_text"] = "신청완료";
                    break;
                case "calc_complete":
                    $row["calc_status_text"] = "입금완료";
                    break;
                case "calc_cancel":
                    $row["calc_status_text"] = "신청취소";
                    break;
            }
            $calc_list[] = $row;
        }

        return $calc_list;
    }

    public function get_work_total($work_id){
        $sql = array();
        $sql[] = "SELECT SUM(epsd_like) AS total_like, SUM(epsd_hit) AS total_hit, SUM(epsd_cmt) AS total_cmt, COUNT(*) AS total_upload FROM pave_epsd";
        $sql[] = "WHERE user_id = '{$this->user["user_id"]}'";
        $sql[] = "AND work_id = '{$work_id}'";
        $sql[] = "AND epsd_cate = 'epsd'";
        $sql[] = "AND epsd_state IN ('reserve', 'success')";

        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        $sql2 = array();
        $sql2[] = "SELECT COUNT(*) AS total_subscribe FROM pave_subscribe WHERE work_id = '{$work_id}'";
        $sql2 = pave_implode($sql2, " ");
        $row2 = pave_fetch($sql2);

        return array_merge($row, $row2);
    }

    public function get_epsd_total($work_id, $epsd_id){
        $sql = array();
        $sql[] = "SELECT SUM(epsd_like) AS total_like, SUM(epsd_hit) AS total_hit, SUM(epsd_cmt) AS total_cmt, COUNT(*) AS total_upload FROM pave_epsd";
        $sql[] = "WHERE user_id = '{$this->user["user_id"]}'";
        $sql[] = "AND work_id = '{$work_id}'";
        if($epsd_id){
            $sql[] = "AND epsd_id = '{$epsd_id}'";
        }
        $sql[] = "AND epsd_cate = 'epsd'";
        $sql[] = "AND epsd_state IN ('reserve', 'success')";

        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        return $row;
    }

    public function get_work_pay_total($work_id){
        $pay_total = array(
            "total_rent" => $this->get_epsd_pay_count(array("rent"), $work_id),
            "total_preview" => $this->get_epsd_pay_count(array("preview", "preview2"), $work_id),
            "total_keep" => $this->get_epsd_pay_count(array("keep", "keep2"), $work_id),
            "total_end" => $this->get_epsd_pay_count(array("end", "end2"), $work_id)
        );
        
        return $pay_total;
    }

    public function get_epsd_pay_total($work_id, $epsd_id){
        $pay_total = array(
            "total_rent" => $this->get_epsd_pay_count(array("rent"), $work_id, $epsd_id),
            "total_preview" => $this->get_epsd_pay_count(array("preview", "preview2"), $work_id, $epsd_id),
            "total_keep" => $this->get_epsd_pay_count(array("keep", "keep2"), $work_id, $epsd_id),
            "total_end" => $this->get_epsd_pay_count(array("end", "end2"), $work_id, $epsd_id)
        );
        
        return $pay_total;
    }
   
  /*   public function get_commerce_work_list(){
        $this->generate_sql_init();

        $this->sql_common[] = "SELECT work.* FROM pave_work AS work";
        $this->sql_where[] = "WHERE work.user_id = '{$this->user["user_id"]}'";
        $this->sql_order = "ORDER BY work.work_update_dt DESC";

        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 

            //작품 수익
            $row["work_profit"] = $this->get_total_exp($row["work_id"]);
            
            //작품 통계
            $row["work_total"] = $this->get_work_total($row["work_id"]);

            //작품 구매
            $row["work_pay_total"] = $this->get_work_pay_total($row["work_id"]);

            //text
            if($row["work_free"]){
                $row["work_free_text"] = "무료";
            }else{
                $row["work_free_text"] = "유료";
            }

            $row["work_insert_dt_text"] = date("Y-m-d", strtotime($row["work_insert_dt"]));
            $row["work_update_dt_text"] = date("Y-m-d", strtotime($row["work_update_dt"]));
            if($row["work_state"] == "end"){
                $row["work_state_text"] = "완결";
            }else{
                $row["work_state_text"] = "연재중";
            }

            if($row["work_display"]){
                $row["work_display_text"] = "공개";
            }else{
                $row["work_display_text"] = "비공개";
            }



            $this->list[] = $row;
        }

        return $this->list;
    }

    public function get_commerce_epsd_list($work_id){
        $this->generate_sql_init();

        $this->sql_common[] = "SELECT epsd.* FROM pave_epsd AS epsd";
        $this->sql_where[] = "WHERE epsd.user_id = '{$this->user["user_id"]}'";
        $this->sql_where[] = "epsd.work_id = '{$work_id}'";
        $this->sql_where[] = "epsd_state IN ('reserve', 'success')";
        $this->sql_where[] = "epsd_cate = 'epsd'";
        $this->sql_order = "ORDER BY epsd.epsd_upload_dt DESC";

        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            //회차 수익
            $row["epsd_profit"] = $this->get_total_exp($row["work_id"], $row["epsd_id"]);

            //회차 통계
            $row["epsd_total"]  = $this->get_epsd_total($row["work_id"], $row["epsd_id"]);

            //작품 구매
            $row["epsd_pay_total"] = $this->get_epsd_pay_total($row["work_id"], $row["epsd_id"]);

            //text
            $row["epsd_insert_dt_text"] = date("Y-m-d", strtotime($row["epsd_insert_dt"]));
            $row["epsd_upload_dt_text"] = date("Y-m-d", strtotime($row["epsd_upload_dt"]));

            if($row["epsd_state"] == "reserve"){
                if($this->user["user_commerce"]){
                    $row["epsd_state_text"] = "미리보기";
                }else{
                    $row["epsd_state_text"] = "예약";
                }
            }else{
                $row["epsd_state_text"] = "연재중";
            }

          

            $this->list[] = $row;
        }

        return $this->list;

    }

    function get_commerce_calc_list(){
        $this->generate_sql_init();

        $this->sql_common[] = "SELECT calc.* FROM pave_commerce_calc AS calc";
        $this->sql_where[] = "WHERE user_id = '{$this->user["user_id"]}'";

        if($this->calc_id){
            $this->sql_where[] = "calc_id = '{$this->calc_id}'";
        }
        $this->sql_order = "ORDER BY calc.calc_id DESC";

        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result) ; $i++) {
            $row["calc_ready_dt_text"] = date("Y-m-d", strtotime($row["calc_ready_dt"]));
            switch ($row["calc_status"]) {
                case "calc_ready":
                    $row["calc_status_text"] = "신청대기";
                    break;
                case "calc_wait":
                    $row["calc_status_text"] = "신청완료";
                    break;
                case "calc_complete":
                    $row["calc_status_text"] = "입금완료";
                    break;
                case "calc_cancel":
                    $row["calc_status_text"] = "신청취소";
                    break;
            } 
            $this->list[] = $row;
        }

        return $this->list;
    }

    public function get_commerce_calc_profit_list($calc_id){
        $this->generate_sql_init();

        $this->sql_common[] = "SELECT profit.* FROM pave_commerce_profit AS profit";
        $this->sql_where[] = "WHERE profit.user_id = '{$this->user["user_id"]}'";
        $this->sql_where[] = "profit.calc_id = '{$calc_id}'";
        $this->sql_order = "ORDER BY profit.profit_id DESC";

        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result) ; $i++) {
            $row["profit_exp_list"] = json_decode($row["profit_exp_detail"], true);
            $row["profit_commerce_fee"] = ($row["profit_exp_list"]["payment"] * $this->user["user_commerce_benefit"]["commerce_fee"])/100;
            $row["profit_price"] = $row["profit_exp_list"]["payment"] - $row["profit_commerce_fee"];
            
            $this->list[] = $row;
        }
        return $this->list;
    }

    public function get_last_calc(){
        $this->generate_sql_init();

        $this->sql_common[] = "SELECT calc.* FROM pave_commerce_calc AS calc";
        $this->sql_where[] = "WHERE calc.user_id = '{$this->user["user_id"]}'";
        $this->sql_where[] = "date_format(calc.calc_insert_dt, '%Y-%m') = '".PAVE_TIME_YM."'";
        $this->sql_where[] = "calc.calc_status IN ('calc_ready', 'calc_wait', 'calc_complete')";
        $this->generate_sql();

        $row = pave_fetch($this->sql);
        return $row;
    } */
}