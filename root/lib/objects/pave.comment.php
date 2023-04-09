<?php
if (!defined('_PAVE_')) exit;
class Comment {
    private $comment_no;
    private $user_no;
    private $work_id;
    private $epsd_id;
    private $comment_parent_no;
    private $comment_display;
    private $comment_best;
    private $comment_order;
    
    private $page = 1;
    private $list_count = 10;
    function __construct() {
    
    }

    
    public static function is_comment_like($user, $comment){
        $obj = new Objects2();
        $obj->generate_sql_init()
        ->set_sql_common("SELECT like_no FROM pave_like WHERE user_no = '{$user["user_no"]}' AND comment_no = '{$comment["comment_no"]}' AND epsd_id = '{$comment["epsd_id"]}'");
        
        $row = pave_fetch($obj->generate_sql());
        return $row["like_no"];
    }

    public function set_comment_no($comment_no){
        $this->comment_no = $comment_no;

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

    public function set_comment_parent_no($comment_parent_no){
        $this->comment_parent_no = $comment_parent_no; 

        return $this;
    }

    public function set_comment_display($comment_display){
        $this->comment_display = $comment_display; 

        return $this;
    }

    public function set_comment_best($comment_best){
        $this->comment_best = $comment_best; 

        return $this;
    }

    public function set_comment_order($comment_order){
        $this->comment_order = $comment_order;

        return $this;
    }

    public function set_comment_page($comment_page){
        $this->page = $comment_page;

        return $this;
    }


    public function get_comment_user($comment){
        $user_obj = new User();

        return $user_obj->set_user_no($comment["user_no"])->set_user_leave(0)->set_user_block(0)->get_user();
    }

    public function get_comment_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT COUNT(*) AS cnt FROM pave_comment AS cmt")
        ->set_sql_common("LEFT JOIN pave_work AS work ON cmt.work_id = work.work_id")
        ->set_sql_common("LEFT JOIN pave_epsd AS epsd ON (cmt.epsd_id = epsd.epsd_id)")
        ->set_sql_common("LEFT JOIN (SELECT comment_no, ROW_NUMBER() OVER (PARTITION BY epsd_id ORDER BY comment_like DESC, comment_no ASC) AS comment_rank FROM pave_comment WHERE comment_parent_no = 0 AND comment_like > 0) AS best ON cmt.comment_no = best.comment_no");
           
        
        if($this->comment_no){
            $obj->set_sql_where("cmt.comment_no = '{$this->comment_no}'");
        }

        if($this->work_id){
            $obj->set_sql_where("cmt.work_id = '{$this->work_id}'");
        }

        if($this->user_no){
            $obj->set_sql_where("cmt.user_no = '{$this->user_no}'");
        }

        if($this->epsd_id){
            $obj->set_sql_where("cmt.epsd_id = '{$this->epsd_id}'");
        }

        if($this->comment_parent_no !== null){
            $obj->set_sql_where("cmt.comment_parent_no = '{$this->comment_parent_no}'");
        }

        if($this->comment_display !== null){
            $obj->set_sql_where("cmt.comment_display = '{$this->comment_display}'");
        }


        $comment_list_count = pave_fetch($obj->generate_sql())["cnt"];

        return $comment_list_count;
    }

    public function get_comment_list(){
        global $pave_user;
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT work.work_name, epsd.epsd_name, cmt.*, best.comment_rank, IF(best.comment_rank <= '10', true, false) AS is_best FROM pave_comment AS cmt")
        ->set_sql_common("LEFT JOIN pave_work AS work ON cmt.work_id = work.work_id")
        ->set_sql_common("LEFT JOIN pave_epsd AS epsd ON (cmt.epsd_id = epsd.epsd_id)")
        ->set_sql_common("LEFT JOIN (SELECT comment_no, ROW_NUMBER() OVER (PARTITION BY epsd_id ORDER BY comment_like DESC, comment_no ASC) AS comment_rank FROM pave_comment WHERE comment_parent_no = 0 AND comment_like > 0) AS best ON cmt.comment_no = best.comment_no");
           
        
        if($this->comment_no){
            $obj->set_sql_where("cmt.comment_no = '{$this->comment_no}'");
        }

        if($this->work_id){
            $obj->set_sql_where("cmt.work_id = '{$this->work_id}'");
        }

        if($this->user_no){
            $obj->set_sql_where("cmt.user_no = '{$this->user_no}'");
        }

        if($this->epsd_id){
            $obj->set_sql_where("cmt.epsd_id = '{$this->epsd_id}'");
        }

        if($this->comment_parent_no !== null){
            $obj->set_sql_where("cmt.comment_parent_no = '{$this->comment_parent_no}'");
        }

        if($this->comment_display !== null){
            $obj->set_sql_where("cmt.comment_display = '{$this->comment_display}'");
        }

        if($this->comment_best){
            $obj->set_sql_where("best.comment_rank <= '10'");
        }

        $obj->set_sql_order("ORDER BY comment_no DESC");

        if($this->page !== null){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }

        $comment_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) {
            //댓글 사용자
            $row["comment_user"] = $this->get_comment_user($row);

            //좋아요 여부
            $row["is_like"] = $this->is_comment_like($pave_user, $row);

            //대댓글 여부
            $row["is_reply"] = false;
            if($row["comment_parent_id"] > 0){
                $row["is_reply"] = true;
            }

            //소유 여부
            $row["is_own"] = false;
            if(($row["user_no"] == $pave_user["user_no"])){
                $row["is_own"] = true;
            }

            $comment_list[] = $row;
        }

        return $comment_list;
    }
   
    public function get_comment(){
        return $this->get_comment_list()[0];
    }

}
?>