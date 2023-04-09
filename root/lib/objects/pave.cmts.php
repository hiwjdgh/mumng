<?php
if (!defined('_PAVE_')) exit;
class Cmts extends Objects{
    private $user = array();
    private $cmt_user_id;
    private $work_id;
    private $epsd_id;
    private $cmt_id;
    private $cmt_parent_id = 0;
    private $cmt_best;
    private $cmt_order;

    private $list_count = 5;
    private $nav_count = 5;
    private $page = 1;

    function __construct() {
        global $pave_user;
        $this->user = $pave_user;
    }

    public function set_cmt_user_id($cmt_user_id){
        $this->cmt_user_id = $cmt_user_id; 
    }

    public function set_work_id($work_id){
        $this->work_id = $work_id; 
    }

    public function set_epsd_id($epsd_id){
        $this->epsd_id = $epsd_id;
    }

    public function set_cmt_id($cmt_id){
        $this->cmt_id = $cmt_id;
    }

    public function set_cmt_best($cmt_best){
        $this->cmt_best = $cmt_best;
    }

    public function set_cmt_parent_id($cmt_parent_id){
        $this->cmt_parent_id = $cmt_parent_id;
    }

    public function set_cmt_page($page = 1){
        $this->page = $page;
    }

    public function set_cmt_order($cmt_order){
        $this->cmt_order = $cmt_order;
    }

    public function is_cmt_like($cmt_id){
        $sql = array();

        $sql[] = "SELECT EXISTS (SELECT 1 FROM pave_like WHERE user_id = '{$this->user["user_id"]}' AND cmt_id = '{$cmt_id}') AS exist";
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        return $row["exist"];
    }

    public function get_cmt_user($user_id){
        $sql = array();
        $sql[] = "SELECT user.user_id, user.user_code, user.user_field, user.user_nick, user.user_img, user.user_commerce, user.user_grd, IF(ISNULL(follow.user_follow_no), false , true) AS is_follow";
        $sql[] = "FROM pave_user AS user";
        $sql[] = "LEFT JOIN pave_user_follow AS follow ON (follow.user_follow_from = '{$this->user["user_no"]}' AND user.user_no = follow.user_follow_to)";
        $sql[] = "WHERE user_id = '{$user_id}'";
        $sql = pave_implode($sql, " ");
        $this->cmt_user = pave_fetch($sql);

        //팔로우 노출 여부
        $this->cmt_user["is_follow_display"] = true;
        if($this->cmt_user["user_id"] == $this->user["user_id"]){
            $this->cmt_user["is_follow_display"] = false;
        }
        $this->cmt_user["user_page_url"] = get_url(PAVE_PAGE_URL, $this->cmt_user["user_code"]);
        return $this->cmt_user;
    }

    public function get_cmt($cmt_id){
        if(!$cmt_id){
            return false;
        }

        $this->set_cmt_id($cmt_id);
        $this->get_cmt_list();

        return $this->list[0];
    }

    public function get_cmt_list_cnt(){
        return $this->list_cnt;
    }

    public function get_cmt_list(){
        $this->generate_sql_init();
         
        $this->sql_common[] = "SELECT work.work_name, epsd.epsd_name, cmt.*, best.cmt_rank, IF(best.cmt_rank <= '10', true, false) AS is_best FROM pave_epsd_cmt AS cmt";
        $this->sql_common[] = "LEFT JOIN pave_work AS work ON cmt.work_id = work.work_id";
        $this->sql_common[] = "LEFT JOIN pave_epsd AS epsd ON (cmt.epsd_id = epsd.epsd_id)";
        $this->sql_common[] = "LEFT JOIN (SELECT cmt_id, ROW_NUMBER() OVER (PARTITION BY epsd_id ORDER BY cmt_like DESC, cmt_id ASC) AS cmt_rank FROM pave_epsd_cmt WHERE cmt_parent_id = 0 AND cmt_like > 0) AS best ON cmt.cmt_id = best.cmt_id";
        $this->sql_where[] = "WHERE cmt.cmt_display = '1'";

        if($this->cmt_user_id){
            $this->sql_where[] = "cmt.user_id = '{$this->cmt_user_id}'";
        }

        if($this->work_id){
            $this->sql_where[] = "cmt.work_id = '{$this->work_id}'";
        }

        if($this->epsd_id){
            $this->sql_where[] = "cmt.epsd_id = '{$this->epsd_id}'";
        }

        if($this->cmt_parent_id !== null){
            $this->sql_where[] = "cmt.cmt_parent_id = '{$this->cmt_parent_id}'";
        }

        if($this->cmt_best){
            $this->sql_where[] = "best.cmt_rank <= '10'";
        }

        if($this->cmt_id){
            $this->sql_where[] = "cmt.cmt_id = '{$this->cmt_id}'";
        }
    
        $this->sql_order = "ORDER BY cmt.cmt_id DESC";

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $this->sql_limit = "LIMIT {$from}, {$to} ";
        }
        
        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            //댓글 사용자
            $row["cmt_user"] = $this->get_cmt_user($row["user_id"]);

            //좋아요 여부
            $row["is_like"] = $this->is_cmt_like($row["cmt_id"]);

            //대댓글 여부
            $row["is_reply"] = false;
            if($row["cmt_parent_id"] > 0){
                $row["is_reply"] = true;
            }

            //소유 여부
            $row["is_own"] = false;
            if(($row["user_id"] == $this->user["user_id"])){
                $row["is_own"] = true;
            }
            
            //text
            $row["cmt_insert_dt_text"] = Converter::display_time_ago($row["cmt_insert_dt"], "Y-m-d")."전";

            $this->list[] = $this->sanitize_comment($row);
        }

        //total cnt
        $this->sql_cnt_common[] = "SELECT COUNT(*) AS cnt FROM pave_epsd_cmt AS cmt";
        $this->sql_cnt_common[] = "LEFT JOIN (SELECT cmt_id, ROW_NUMBER() OVER (PARTITION BY epsd_id ORDER BY cmt_like DESC, cmt_id ASC) AS cmt_rank FROM pave_epsd_cmt WHERE cmt_parent_id = 0 AND cmt_like > 0) AS best ON cmt.cmt_id = best.cmt_id";

        $this->sql_cnt_where[] = $this->sql_where;
        $this->generate_cnt_sql();
        $this->list_cnt = pave_fetch($this->sql_cnt)["cnt"];

        return $this->list;
    }
    
    private function sanitize_comment($comment){
        unset($comment["cmt_update_ip"]);
        unset($comment["cmt_insert_ip"]);
        return $comment;
    }
}