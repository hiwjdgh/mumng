<?php
if (!defined('_PAVE_')) exit;

class Subscribe{
    private $subscribe_no;
    private $user_no;
    private $work_id;

    private $page = 1;
    private $list_count = 10;

    function __construct() {
    }


    public function set_subscribe_no($subscribe_no){
        $this->subscribe_no = $subscribe_no;

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

    public function set_subscribe_page($subscribe_page){
        $this->page = $subscribe_page;

        return $this;
    }

    
    public function is_subscribe($user, $work){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT * FROM pave_subscribe AS subscribe")
        ->set_sql_where("subscribe.user_no = '{$user["user_no"]}'")
        ->set_sql_where("subscribe.work_id = '{$work["work_id"]}'");

        $row = pave_fetch($obj->generate_sql());

        if(!$row["subscribe_no"]){
            return false;
        }

        return $row["subscribe_no"];
    }

    public function get_subscribe_work($subscribe){
        $work_obj = new Work();

        return $work_obj->set_work_id($subscribe["work_id"])->get_work();
    }

    public function get_subscribe_work_new_epsd_cnt($subscribe){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT COUNT(*) AS cnt FROM pave_epsd")
        ->set_sql_where("work_id = '{$subscribe["subscribe_work"]["work_id"]}'")
        ->set_sql_where("epsd_cate = 'epsd'")
        ->set_sql_where("work_id = '{$subscribe["subscribe_work"]["work_id"]}'");

        if($subscribe["subscribe_work"]["work_user"]["user_commerce"]){
            $obj->set_sql_where("epsd_state IN ('reserve', 'success')");
        }else{
            $obj->set_sql_where("epsd_state IN ('success')");
        }

        /* $sql[] = "epsd_upload_dt > (SELECT subscribe_insert_dt FROM pave_subscribe WHERE work_id = '{$work["work_id"]}' AND user_id = '{$this->subscribe_user_id}') AND";
        $sql[] = "epsd_id NOT IN (SELECT epsd_id FROM pave_hit WHERE user_id = '{$this->subscribe_user_id}' AND work_id = '{$work["work_id"]}')"; */
        $obj->set_sql_where("epsd_id > (SELECT IFNULL(MAX(epsd_id), 0) AS epsd_id FROM pave_hit WHERE user_no = '{$subscribe["user_no"]}' AND work_id = '{$subscribe["subscribe_work"]["work_id"]}')");

        $row = pave_fetch($obj->generate_sql());

        return $row["cnt"];
    }

    public function get_subscribe_lastest_epsd($subscribe){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT epsd_name, epsd_upload_dt FROM pave_epsd")
        ->set_sql_where("epsd_id IN (SELECT epsd_id FROM pave_hit WHERE user_no = '{$subscribe["user_no"]}' AND work_id = '{$subscribe["subscribe_work"]["work_id"]}' ORDER BY hit_no DESC)")
        ->set_sql_order("ORDER BY epsd_id DESC") ;

        $row = pave_fetch($obj->generate_sql());

        return $row;
    }

    public function get_subscribe_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_subscribe AS subscribe");
           
        if($this->subscribe_no){
            $obj->set_sql_cnt_where("subscribe.subscribe_no = '{$this->subscribe_no}'");
        }  
           
        if($this->user_no){
            $obj->set_sql_cnt_where("subscribe.user_no = '{$this->user_no}'");
        }  
           
        if($this->work_id){
            $obj->set_sql_cnt_where("subscribe.work_id = '{$this->work_id}'");
        }  
    
        $subscribe_list_count = pave_fetch($obj->generate_cnt_sql())["cnt"];

        
        return $subscribe_list_count;
    }

    public function get_subscribe_list(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT subscribe.* FROM pave_subscribe AS subscribe");
           
        if($this->subscribe_no){
            $obj->set_sql_where("subscribe.subscribe_no = '{$this->subscribe_no}'");
        }  
           
        if($this->user_no){
            $obj->set_sql_where("subscribe.user_no = '{$this->user_no}'");
        }  
           
        if($this->work_id){
            $obj->set_sql_where("subscribe.work_id = '{$this->work_id}'");
        }  
        $obj->set_sql_order("ORDER BY subscribe.subscribe_no DESC");
        
        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }

        $subscribe_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 

            //구독 작품 정보
            $row["subscribe_work"] = $this->get_subscribe_work($row);

            //구독 작품 새로운 회차 수
            $row["subscribe_work_new_epsd"] = $this->get_subscribe_work_new_epsd_cnt($row);
            
            //구독 작품 최근본 회차
            $row["subscribe_latest_epsd"] = $this->get_subscribe_lastest_epsd($row);
            $subscribe_list[] = $row;
        }

        return $subscribe_list;
    }

    public function get_subscribe(){
        return $this->get_subscribe_list()[0];
    }



}