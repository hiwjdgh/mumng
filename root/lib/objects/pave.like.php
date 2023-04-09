<?php
if (!defined('_PAVE_')) exit;

class Like{
    private $like_no;
    private $user_no;
    private $work_id;
    private $epsd_id;
    private $comment_no;
    
    private $page = 1;
    private $list_count = 10;

    function __construct() {
        global $pave_user;
        $this->user = $pave_user;
    }

    public function set_like_no($like_no){
        $this->like_no = $like_no;

        return $this;
    }

    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    public function set_like_work_id($work_id){
        $this->work_id = $work_id;

        return $this;
    }

    public function set_like_epsd_id($epsd_id){
        $this->epsd_id = $epsd_id;

        return $this;
    }

    public function set_like_comment_no($comment_no){
        $this->comment_no = $comment_no;

        return $this;
    }

    public function set_like_page($like_page){
        $this->page = $like_page;

        return $this;
    }

    public function get_like_work_info($like){
        $work_obj = new Work();
        return $work_obj->set_work_id($like["work_id"])->get_work();
    }

    public function get_like_epsd_info($like){
        $epsd_obj = new Epsd();
        return $epsd_obj->set_epsd_id($like["epsd_id"])->get_epsd();
    }

    public function get_like_epsd_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_like AS likes");
           
        if($this->like_no){
            $obj->set_sql_cnt_where("likes.like_no = '{$this->like_no}'");
        }  
           
        if($this->user_no){
            $obj->set_sql_cnt_where("likes.user_no = '{$this->user_no}'");
        }  
           
        if($this->work_id){
            $obj->set_sql_cnt_where("likes.work_id = '{$this->work_id}'");
        }  
           
        if($this->epsd_id){
            $obj->set_sql_cnt_where("likes.epsd_id = '{$this->epsd_id}'");
        }  
           
        if($this->comment_no !== null){
            $obj->set_sql_cnt_where("likes.comment_no = '{$this->comment_no}'");
        }  

        $like_list_cnt = pave_fetch($obj->generate_cnt_sql())["cnt"];
        return $like_list_cnt;
    }

    public function get_like_epsd_list(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT likes.* FROM pave_like AS likes");
           
        if($this->like_no){
            $obj->set_sql_where("likes.like_no = '{$this->like_no}'");
        }  
           
        if($this->user_no){
            $obj->set_sql_where("likes.user_no = '{$this->user_no}'");
        }  
           
        if($this->work_id){
            $obj->set_sql_where("likes.work_id = '{$this->work_id}'");
        }  
           
        if($this->epsd_id){
            $obj->set_sql_where("likes.epsd_id = '{$this->epsd_id}'");
        }  
           
        if($this->comment_no !== null){
            $obj->set_sql_where("likes.comment_no = '{$this->comment_no}'");
        }  

        $obj->set_sql_order("ORDER BY likes.like_no DESC");

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }
        
        $like_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 

            //좋아요 작품 정보
            $row["like_work"] = $this->get_like_work_info($row);
            //좋아요 회차 정보
            $row["like_epsd"] = $this->get_like_epsd_info($row);

            $like_list[] = $row;
        }

        return $like_list;
    }

}
?>