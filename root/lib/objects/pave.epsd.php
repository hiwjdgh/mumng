<?php
if (!defined('_PAVE_')) exit;
class Epsd {
    private $time= PAVE_TIME_YMDHIS;
    private $epsd_id;
    private $work_id;
    private $user_no;
    private $epsd_no;
    private $epsd_no_type;
    private $epsd_cate;
    private $epsd_name;
    private $epsd_display;
    private $epsd_state;

    private $epsd_search = false;
    private $epsd_search_keyword;

    
    private $page = 1;
    private $list_count = 10;
    function __construct() {
    
    }
    
    public static function generate_epsd_no($work){
        $obj = new Objects2();
        $obj->generate_sql_init()
        ->set_sql_common("SELECT epsd_no FROM pave_epsd")
        ->set_sql_where("work_id = '{$work["work_id"]}'")
        ->set_sql_where("epsd_no <> -1")
        ->set_sql_order("ORDER BY epsd_id DESC")
        ->set_sql_limit("LIMIT 1");

        $epsd_no = pave_fetch($obj->generate_sql())["epsd_no"];

        return $epsd_no;
    }

    public static function add_hit($user, $epsd){
        $obj = new Objects2();
        $obj->generate_sql_init()
        ->set_sql_common("SELECT EXISTS (SELECT 1 FROM pave_hit WHERE (user_no = '{$user["user_no"]}' OR hit_insert_ip = '".PAVE_USER_IP."') AND DATE(hit_insert_dt) = '".PAVE_TIME_YMD."' AND work_id = '{$epsd["work_id"]}' AND epsd_id = '{$epsd["epsd_id"]}') AS exist");

        $row = pave_fetch($obj->generate_sql());
        if ($row["exist"]){
            return;
        }

        $hit = array(
            "user_no" =>  $user["user_no"],
            "work_id" => $epsd["work_id"],
            "epsd_id" => $epsd["epsd_id"],
            "hit_insert_dt" => PAVE_TIME_YMDHIS,
            "hit_insert_ip" => PAVE_USER_IP
        );

        pave_insert("pave_hit", $hit);

        pave_query("UPDATE pave_epsd SET epsd_hit = epsd_hit + 1 WHERE epsd_id = '{$epsd["epsd_id"]}'");
    }

    
    public static function is_epsd_like($user, $epsd){
        $obj = new Objects2();
        $obj->generate_sql_init()
        ->set_sql_common("SELECT like_no FROM pave_like WHERE user_no = '{$user["user_no"]}' AND comment_no = 0 AND epsd_id = '{$epsd["epsd_id"]}'");
        
        $row = pave_fetch($obj->generate_sql());
        return $row["like_no"];
    }
    

    public function set_epsd_id($epsd_id){
        $this->epsd_id = $epsd_id;

        return $this;
    }

    public function set_work_id($work_id){
        $this->work_id = $work_id; 

        return $this;
    }

    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    public function set_epsd_no($epsd_no){
        $this->epsd_no = $epsd_no;

        return $this;
    }

    public function set_epsd_no_type($epsd_no_type){
        $this->epsd_no_type = $epsd_no_type;

        return $this;
    }

    public function set_epsd_cate($epsd_cate){
        $this->epsd_cate = $epsd_cate;
        
        return $this;
    }

    public function set_epsd_name($epsd_name){
        $this->epsd_name = $epsd_name;
        
        return $this;
    }

    public function set_epsd_display($epsd_display){
        $this->epsd_display = $epsd_display;
             
        return $this;
    }

    public function set_epsd_state($epsd_state){
        $this->epsd_state = $epsd_state;
             
        return $this;
    }

    public function set_epsd_page($epsd_page = 1){
        $this->page = $epsd_page;

        return $this;
    }

    public function set_epsd_search($epsd_search){
        $this->epsd_search = $epsd_search;

        return $this;
    }

    public function set_epsd_search_keyword($epsd_search_keyword){
        $this->epsd_search_keyword = $epsd_search_keyword;

        return $this;
    }
    
    
    public function get_next_upload_dt($work, $epsd){
        if(!$epsd["epsd_id"]){
            $epsd["epsd_upload_dt"] = $work["work_insert_dt"];
        }

        $yoil = array("일","월","화","수","목","금","토");
        $day_of_week = array();
        $work_days = pave_explode($work["work_day"], ",");
        foreach ($work_days as $day) {
            $day_of_week[] = array_search($day, $yoil);
        }
        sort($day_of_week);

        $day_of_week_length = count($day_of_week);

        $last_day_of_week = date("w", strtotime($epsd["epsd_upload_dt"]));
        $next_day_of_week_key = array_search($last_day_of_week, $day_of_week);
        $next_day_of_week_index = ($next_day_of_week_key + 1) % $day_of_week_length;
        $next_day_of_week = $day_of_week[$next_day_of_week_index];

        $day_cnt = 0;
        if($last_day_of_week >= $next_day_of_week){
            $day_cnt = 7 - ($last_day_of_week - $next_day_of_week);
        }else{
            $day_cnt = $next_day_of_week - $last_day_of_week;
        }

        if($epsd["epsd_state"] == "save"){
            return Converter::display_time($epsd["epsd_upload_dt"]);
        }else{
            return Converter::display_time($epsd["epsd_upload_dt"]." +{$day_cnt} days");
        }
    }

    public function get_epsd_user($epsd){
        $user_obj = new User();

        return $user_obj->set_user_no($epsd["user_no"])->set_user_leave(0)->set_user_block(0)->get_user();
    }

    public function get_epsd_pay_info($epsd){
        global $pave_user;

        $sql = array();

        $sql[] = "SELECT pay_id, pay_expire_dt, epsd_id, pay_type FROM pave_epsd_pay WHERE user_no = '{$pave_user["user_no"]}' AND epsd_id = '{$epsd["epsd_id"]}' AND pay_expire_dt > '{$this->time}' ORDER BY pay_expire_dt DESC LIMIT 1";
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        if($row["pay_type"] == "keep" || $row["pay_type"] == "keep2") {
            $row["is_expired"] = false;
            $row["is_keep"] = true;
            $row["pay_expire_text"] = "영구소장"; 
        }else if($row["pay_type"] == "end" || $row["pay_type"] == "end2"){
            $row["is_expired"] = false;
            $row["is_keep"] = true;
            $row["pay_expire_text"] = "완결소장"; 
        }else if($row["pay_type"] == "rent" || $row["pay_type"] == "preview" || $row["pay_type"] == "preview2"){
            $row["is_keep"] = false;
            $remain_time = strtotime($row["pay_expire_dt"]) - strtotime($this->time);
            if($remain_time < 0){
                $row["is_expired"] = true;
                $row["pay_expire_text"] = "만료";
            }else{
                $row["is_expired"] = false;

                $days = floor($remain_time / 86400);
                $hours = floor(($remain_time - ($days * 86400))/3600);
                $min = floor(($remain_time - ($days * 86400) - ($hours * 3600))/60);
                $row["pay_expire_text"] = "{$days}일 ".str_pad($hours,2,"0",STR_PAD_LEFT).":".str_pad($min,2,"0",STR_PAD_LEFT);

            }
        }

        return $row;
    }

    public function is_epsd_hit($epsd){
        global $pave_user;
        $sql = array();

        $sql[] = "SELECT EXISTS (SELECT 1 FROM pave_hit WHERE epsd_id = '{$epsd["epsd_id"]}' AND (user_no = '{$pave_user["user_no"]}' OR hit_insert_ip = '".PAVE_USER_IP."')) AS exist";
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        return $row["exist"];
    }

    public function get_epsd_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT COUNT(*) AS cnt FROM pave_epsd AS epsd");
           

        if($this->epsd_id){
            $obj->set_sql_where("epsd.epsd_id = '{$this->epsd_id}'");
        }

        if($this->work_id){
            $obj->set_sql_where("epsd.work_id = '{$this->work_id}'");
        }

        if($this->user_no){
            $obj->set_sql_where("epsd.user_no = '{$this->user_no}'");
        }

        if($this->epsd_no){
            $obj->set_sql_where("epsd.epsd_no = '{$this->epsd_no}'");
        }

        if($this->epsd_no_type){
            $obj->set_sql_where("epsd.epsd_no_type = '{$this->epsd_no_type}'");
        }

        if($this->epsd_cate){
            if(pave_is_array($this->epsd_cate)){
                $obj->set_sql_where("epsd.epsd_cate IN ('".pave_implode($this->epsd_cate, "','")."')");
            }else{
                $obj->set_sql_where("epsd.epsd_cate = '{$this->epsd_cate}'");
            }
        }

        if($this->epsd_name){
            $obj->set_sql_where("epsd.epsd_name = '{$this->epsd_name}'");
        }

        if($this->epsd_display !== null){
            $obj->set_sql_where("epsd.epsd_display = '{$this->epsd_display}'");
        }

        if($this->epsd_state){
            if(pave_is_array($this->epsd_state)){
                $obj->set_sql_where("epsd.epsd_state IN ('".pave_implode($this->epsd_state, "','")."')");
            }else{
                $obj->set_sql_where("epsd.epsd_state = '{$this->epsd_state}'");
            }
        }

        if($this->epsd_search){
            $keyword_list = pave_explode($this->epsd_search_keyword, " ");
            $obj->set_sql_order("ORDER BY epsd.epsd_name LIKE '{$keyword_list[0]}%' DESC,ifnull(nullif(instr(epsd.epsd_name, ' {$keyword_list[0]}'), 0), 99999), ifnull(nullif(instr(epsd.epsd_name, '{$keyword_list[0]}'), 0), 99999), epsd.epsd_name");
        }else{
            $this->sql_order = "ORDER BY epsd.epsd_id DESC";
        }

        $epsd_list_count = pave_fetch($obj->generate_sql())["cnt"];

        return $epsd_list_count;
    }

    public function get_epsd_list(){
        global $pave_user;
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT epsd.* FROM pave_epsd AS epsd");
           

        if($this->epsd_id){
            $obj->set_sql_where("epsd.epsd_id = '{$this->epsd_id}'");
        }

        if($this->work_id){
            $obj->set_sql_where("epsd.work_id = '{$this->work_id}'");
        }

        if($this->user_no){
            $obj->set_sql_where("epsd.user_no = '{$this->user_no}'");
        }

        if($this->epsd_no){
            $obj->set_sql_where("epsd.epsd_no = '{$this->epsd_no}'");
        }

        if($this->epsd_no_type){
            $obj->set_sql_where("epsd.epsd_no_type = '{$this->epsd_no_type}'");
        }

        if($this->epsd_cate){
            if(pave_is_array($this->epsd_cate)){
                $obj->set_sql_where("epsd.epsd_cate IN ('".pave_implode($this->epsd_cate, "','")."')");
            }else{
                $obj->set_sql_where("epsd.epsd_cate = '{$this->epsd_cate}'");
            }
        }

        if($this->epsd_name){
            $obj->set_sql_where("epsd.epsd_name = '{$this->epsd_name}'");
        }

        if($this->epsd_display !== null){
            $obj->set_sql_where("epsd.epsd_display = '{$this->epsd_display}'");
        }

        if($this->epsd_state){
            if(pave_is_array($this->epsd_state)){
                $obj->set_sql_where("epsd.epsd_state IN ('".pave_implode($this->epsd_state, "','")."')");
            }else{
                $obj->set_sql_where("epsd.epsd_state = '{$this->epsd_state}'");
            }
        }

        if($this->epsd_search){
            $keyword_list = pave_explode($this->epsd_search_keyword, " ");
            $obj->set_sql_order("ORDER BY epsd.epsd_name LIKE '{$keyword_list[0]}%' DESC,ifnull(nullif(instr(epsd.epsd_name, ' {$keyword_list[0]}'), 0), 99999), ifnull(nullif(instr(epsd.epsd_name, '{$keyword_list[0]}'), 0), 99999), epsd.epsd_name");
        }else{
            $obj->set_sql_order("ORDER BY epsd.epsd_id DESC");
        }

    
        if($this->page !== null){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }

        $epsd_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) {

            //회차 작가
            $row["epsd_user"] = $this->get_epsd_user($row);
            
            //회차구매 정보
            $row["epsd_pay_info"] = $this->get_epsd_pay_info($row);

            //회차 좋아요 여부
            $row["is_like"] = $this->is_epsd_like($pave_user, $row);

            //회차 조회 여부
            $row["is_hit"] = $this->is_epsd_hit($row);
            
            //회차 공유 링크  
            $row["epsd_url"] = get_url(PAVE_WORK_URL, "epsd/{$row["work_id"]}/{$row["epsd_id"]}");

            //회차 미리보기 여부
            $row["is_preview"] = false;
            if($row["epsd_state"] == "reserve"){
                $row["is_preview"] = true;
            }

            //회차 공지 여부
            $row["is_notice"] = false;
            if($row["epsd_cate"] == "notice"){
                $row["is_notice"] = true;
            }

            $epsd_list[] = $row;
        }

        return $epsd_list;
    }
   
    public function get_epsd(){
        return $this->get_epsd_list()[0];
    }

}
?>