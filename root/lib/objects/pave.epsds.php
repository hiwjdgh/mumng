<?php
if (!defined('_PAVE_')) exit;
class Epsds extends Objects{
    private static $epsd_cf;
    private $time = PAVE_TIME_YMDHIS;
    private $user = array();
    private $work_id;
    private $epsd_id;
    private $epsd_cate;
    private $epsd_state;
    private $epsd_display = 1;
    private $epsd_append = array();

    private $list_count = 10;
    private $nav_count = 5;
    private $page = 1;

    private $pay_info = array();

    function __construct() {
        global $pave_user;
        $this->user = $pave_user;
    }

    public static function epsd_cf_list($epsd_cate = ""){

        if(self::$epsd_cf){
            return self::$epsd_cf;
        }

        $sql = "SELECT * FROM pave_cf_epsd";
        if($epsd_cate){
            $sql .= " WHERE epsd_cate = '{$epsd_cate}'";
        }
        $result = pave_query($sql);

        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            if($row["epsd_cate"] == "epsd"){
                $row["epsd_cate_text"] = "연재";
            }else if($row["epsd_cate"] == "notice"){
                $row["epsd_cate_text"] = "공지";
            }else if($row["epsd_cate"] == "rest"){
                $row["epsd_cate_text"] = "휴재";
            }
            $row["epsd_no_type_list"] = pave_explode($row["epsd_no_type"], ",") ;
            self::$epsd_cf[] = $row;
        }
        return self::$epsd_cf;
    }

    public static function epsd_cf($epsd_cate = ""){
        return self::epsd_cf_list($epsd_cate)[0];
    }

    public static function get_latest_epsd_no($work_id){
        $sql = "SELECT epsd_no AS latest_no  FROM pave_epsd WHERE work_id = '{$work_id}' AND epsd_no <> -1 ORDER BY epsd_id DESC LIMIT 1";
        $row = pave_fetch($sql);

        return $row["latest_no"];
    }

    public function set_work_id($work_id = ""){
        $this->work_id = $work_id; 
    }

    public function set_epsd_id($epsd_id = 1){
        $this->epsd_id = $epsd_id;
    }

    public function set_epsd_cate($epsd_cate){
        $this->epsd_cate = $epsd_cate;
    }

    public function set_epsd_display($epsd_display){
        $this->epsd_display = $epsd_display;
    }

    public function set_epsd_state($epsd_state){
        $this->epsd_state = $epsd_state;
    }

    public function set_epsd_delay($epsd_delay){
        $this->epsd_delay = $epsd_delay;
    }
    
    public function set_epsd_page($page = 1){
        $this->page = $page;
    }

    public function set_epsd_order($epsd_order = ""){
        $this->epsd_order = $epsd_order;
    }

    public function set_epsd_append($epsd_append){
        $this->epsd_append[] = $epsd_append;
    }

    public function is_epsd_like($epsd_id){
        $sql = array();

        $sql[] = "SELECT EXISTS (SELECT 1 FROM pave_like WHERE user_id = '{$this->user["user_id"]}' AND cmt_id = 0 AND epsd_id = '{$epsd_id}') AS exist";
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        return $row["exist"];
    }
    

    public function is_epsd_hit($epsd_id){
        $sql = array();

        $sql[] = "SELECT EXISTS (SELECT 1 FROM pave_hit WHERE epsd_id = '{$epsd_id}' AND (user_id = '{$this->user["user_id"]}' OR hit_insert_ip = '".PAVE_USER_IP."')) AS exist";
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        return $row["exist"];
    }

    public function get_epsd_pay_info($epsd_id){
        $sql = array();

        $sql[] = "SELECT pay_id, pay_expire_dt, epsd_id, pay_type FROM pave_epsd_pay WHERE user_id = '{$this->user["user_id"]}' AND epsd_id = '{$epsd_id}' AND pay_expire_dt > '{$this->time}' ORDER BY pay_expire_dt DESC LIMIT 1";
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

    public function get_epsd($epsd_id){
        if(!$epsd_id){
            return false;
        }

        $this->set_epsd_id($epsd_id);
        $this->get_epsd_list();
        return $this->list[0];
    }

    
    public function get_share_link($epsd){
        if(!$epsd["epsd_id"]){
            return null;
        }

        try{
            if(!class_exists("Share")){
                throw new Exception("공유 라이브러리가 없습니다.");
            }
            $share_obj = new Share();
        }catch(Exception $e){
            return null;
        }

        return $share_obj->get_epsd_share_link($epsd);
    }

    public function get_epsd_user($user_id){
        $sql = array();
        $sql[] = "SELECT user.user_id, user.user_code, user.user_field, user.user_nick, user.user_img, user.user_commerce, user.user_grd, IF(ISNULL(follow.user_follow_no), false , true) AS is_follow";
        $sql[] = "FROM pave_user AS user";
        $sql[] = "LEFT JOIN pave_user_follow AS follow ON (follow.user_follow_from = '{$this->user["user_no"]}' AND user.user_no = follow.user_follow_to)";
        $sql[] = "WHERE user_id = '{$user_id}'";
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        //팔로우 노출 여부
        $row["is_follow_display"] = true;
        if($row["user_id"] == $this->user["user_id"]){
            $row["is_follow_display"] = false;
        }
        $row["user_page_url"] = get_url(PAVE_PAGE_URL, $row["user_code"]);
        return $row;
    }

    public function get_epsd_list_cnt(){
        return $this->list_cnt;
    }


    public function get_epsd_list(){
        $this->generate_sql_init();
         
        $this->sql_common[] = "SELECT epsd.* FROM pave_epsd AS epsd";
        $this->sql_where[] = "WHERE 1 = 1";
        
     
        if($this->work_id){
            $this->sql_where[] = "epsd.work_id = '{$this->work_id}'";
        }

        if($this->epsd_id){
            $this->sql_where[] = "epsd.epsd_id = '{$this->epsd_id}'";
        }

        if($this->epsd_cate){
            $this->sql_where[] = "epsd_cate IN ('".pave_implode($this->epsd_cate, "','")."')";
        }

        if($this->epsd_state){
            $this->sql_where[] = "epsd_state IN ('".pave_implode($this->epsd_state, "','")."')";
        }

        if($this->epsd_display !== null){
            $this->sql_where[] = "epsd.epsd_display = '{$this->epsd_display}'";
        }

        if($this->epsd_append){
            $this->sql_where[] = pave_implode($this->epsd_append, " AND ");
        }
        

        $this->sql_order = "ORDER BY epsd_id DESC";

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $this->sql_limit = "LIMIT {$from}, {$to}";
        }
        
        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result); $i++) {

            //회차 작가
            $row["epsd_user"] = $this->get_epsd_user($row["user_id"]);
            
            //회차구매 정보
            $row["epsd_pay_info"] = $this->get_epsd_pay_info($row["epsd_id"]);

            //회차 좋아요 여부
            $row["is_like"] = $this->is_epsd_like($row["epsd_id"]);

            //회차 조회 여부
            $row["is_hit"] = $this->is_epsd_hit($row["epsd_id"]);
            
            //회차 공유 링크  
            $row["epsd_share_link"] = $this->get_share_link($row);
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
            //text
            $row["epsd_insert_dt_text"] = Converter::display_time("Y-m-d", $row["epsd_insert_dt"]);
            $row["epsd_upload_dt_text"] = Converter::display_time("Y-m-d", $row["epsd_upload_dt"]);
            $this->list[] = $this->sanitize_epsd($row);
        }

        //total cnt
        $this->sql_cnt_common[] = "SELECT COUNT(*) AS cnt FROM pave_epsd AS epsd";
        $this->sql_cnt_where[] = $this->sql_where;
        $this->generate_cnt_sql();
        $this->list_cnt = pave_fetch($this->sql_cnt)["cnt"];


        return $this->list;
    }

    public function get_epsd_pagination(){
        $pagination = array();

        $total = $this->list_cnt;
     
        if(!$total){
            return null;
        }
    
        $total_page = ceil($total / $this->list_count);
        $total_block = ceil($total_page / $this->nav_count);
    
        if(!$this->page){
            $this->page = 1;
        }
    
        $block = ceil($this->page / $this->nav_count);
    
        $from_page = (($block - 1) * $this->nav_count) + 1; 
        $to_page = min($total_page, $block * $this->nav_count);
    
        $prev_page = $this->page - 1;
        $next_page = $this->page + 1;
    
        $prev_block = $block - 1;
        $next_block = $block + 1;
    
        if($prev_page < 1){
            $prev_page = 1;
        }
    
        if($next_page > $total_page){
            $next_page = $total_page;
        }
    
        $prev_block_page = $prev_block * $this->nav_count;
        $next_block_page = $next_block * $this->nav_count - ($this->nav_count - 1);
    
    
        if($prev_block  < 1){
            $prev_block  = 1;
        }
    
        if($prev_block_page < 1){
            $prev_block_page = 1;
        }

        if($next_block_page > $total_page){
            $next_block_page = $total_page;
        }
    
        $pagination = array(
            "total"             => $total,
            "total_page"        => $total_page,
            "from_page"         => $from_page,
            "to_page"           => $to_page,
            "prev_page"         => $prev_page,
            "prev_block_page"   => $prev_block_page,
            "next_page"         => $next_page,
            "next_block_page"   => $next_block_page,
            "page"              => $this->page
        );  
    
        return $pagination;
    }

    
    public function init_meta($work, $epsd){
        global $pave_meta;
        $pave_meta["title2"] = $epsd["epsd_name"];
        $pave_meta["url"] = $epsd["epsd_url"];
        $pave_meta["description"] = $work["work_description"]?:$pave_meta["description"];
        $pave_meta["img"] = $epsd["epsd_img"];
        $pave_meta["keyword"] = $work["work_full_hashtag"]?:$pave_meta["keyword"];
    }

    public function add_epsd_hit($epsd_id){
        $sql = "SELECT EXISTS (SELECT 1 FROM pave_hit WHERE (user_id = '{$this->user["user_id"]}' OR hit_insert_ip = '".PAVE_USER_IP."') AND DATE(hit_insert_dt) = '".PAVE_TIME_YMD."' AND work_id = '{$this->work_id}' AND epsd_id = '{$epsd_id}') AS exist";
        $row = pave_fetch($sql);
        if ($row["exist"]){
            return;
        }

        $hit = array(
            "user_id" =>  $this->user["user_id"],
            "work_id" => $this->work_id,
            "epsd_id" => $epsd_id,
            "hit_insert_dt" => PAVE_TIME_YMDHIS,
            "hit_insert_ip" => PAVE_USER_IP
        );

        pave_insert("pave_hit", $hit);

        pave_query("UPDATE pave_epsd SET epsd_hit = epsd_hit + 1 WHERE epsd_id = '{$epsd_id}'");
    }

    private function sanitize_epsd($epsd){
        unset($epsd["epsd_upload_ip"]);
        unset($epsd["epsd_update_ip"]);
        unset($epsd["epsd_insert_ip"]);
        return $epsd;
    }
}
?>