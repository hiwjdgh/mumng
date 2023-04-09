<?php
if (!defined('_PAVE_')) exit;
class U{
    private $user = array();
    private $user_id;
    private $user_code;
    private $user_nick;
    private $user_commerce;
    private $user_order;
    private $user_search = false;
    private $user_sanitize = true;

    private $sql = array();
    private $sql_common = array();
    private $sql_where = array();
    private $sql_group = "";
    private $sql_order = "";
    private $sql_limit = "";

    private $sql_cnt = array();
    private $sql_cnt_common = array();
    private $sql_cnt_where = array();

    private $list_count = 10;
    private $nav_count = 5;
    private $page = 1;

    private $list = array();
    private $list_cnt = 0;

    function __construct() {
        global $pave_user;
        $this->user = $pave_user;
    }

    public function set_user_id($user_id){
        $this->user_id = $user_id;
    }

    public function set_user_code($user_code){
        $this->user_code = $user_code;
    }

    public function set_user_nick($user_nick){
        $this->user_nick = $user_nick;
    }

    public function set_user_commerce($user_commerce){
        $this->user_commerce = $user_commerce;
    }

    public function set_user_order($user_order){
        // search_nick  필명찾기순
        // recommand 추천순
        $this->user_order = $user_order;
    }
  
    public function set_user_page($user_page = 1){
        $this->page = $user_page;
    }
    
    public function set_user_sanitize($user_sanitize){
        $this->user_sanitize = $user_sanitize;
    }

    public static function generate_auto_login_key(){
        return md5(PAVE_USER_IP.PAVE_USER_AGENT);
    }

    public static function is_user_pwd($pass, $hash, $salt){
        return password_verify($salt.$pass, $hash);
    }

    public static function insert_user_login($user_id){
        $login = array(
            "user_id"   => $user_id,
            "login_ip"  => PAVE_USER_IP,
            "login_dt"  => PAVE_TIME_YMDHIS
        );
        pave_insert("pave_user_login", $login);
    }

    public function is_other_device_login($user_id){
        $sql = "SELECT * FROM pave_user_login WHERE user_id = '{$user_id}' ORDER BY login_no DESC LIMIT 1";
        $row = pave_fetch($sql);
    
        if(!$row["login_no"]){
            return false;
        }
    
        if($row["login_ip"] == PAVE_USER_IP){
            return false;
        }
    
        return true;
    }

    public function is_pwd_expire($user){
        $time_ago = strtotime($user["user_pwd_dt"]);
        $time_elapsed = PAVE_TIME - $time_ago;
        $days = round($time_elapsed / 86400);
        
        if($days < 180){
            return false;
        }
    
        //마지막으로 보낸 변경 알림으로 부터 1개월 후 있는가?
        $from = date("Y-m-d", strtotime($user["user_pwd_dt"]));
        $to = PAVE_TIME_YMD;
        $sql = "SELECT * FROM pave_notify WHERE notify_receiver = '{$user["user_id"]}' AND notify_type = 'notify_pwd_expire' AND date_format(notify_insert_dt, '%Y-%m-%d') BETWEEN '{$from}' and '{$to}' ORDER BY notify_no LIMIT 1";
        $row = pave_fetch($sql);
    
        $time_ago2 = strtotime($row["notify_insert_dt"]);
        $time_elapsed2 = PAVE_TIME - $time_ago2;
        $days2 = round($time_elapsed2 / 86400);
    
        if($days2 < 30){
            return false;
        }
    
        return true;
    }
     

    public function get_user($user_id){
        if(!$user_id){
            return false;
        }
        $this->set_user_sanitize(false);
        $this->set_user_id($user_id);

        return $this->get_user_list()[0];
    }

    public function get_user_notify($user_id){
        if(!$user_id){
            return false;
        }

        $sql = array();

        $sql[] = "SELECT * FROM pave_user_notify";
        $sql[] = "WHERE user_id = '{$user_id}'";
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        
        
        if(!$row["user_id"]){
            return false;
        }
        return $row;
    }

    public function get_user_commerce_benefit($user_grd){
        if(!$user_grd){
            return null;
        }

        $sql = array();

        $sql[] = "SELECT * FROM pave_cf_commerce";
        $sql[] = "WHERE commerce_id = '{$user_grd}'";
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);
        
        if(!$row["commerce_id"]){
            return null;
        }

        return $row;
    }

    public function get_user_follow($user){
      

        $follow_obj = new Follows();

        $page_user_follow = array(
            "following_cnt" => $follow_obj->set_user_no($user["user_no"])->set_follow_page(0)->get_following_list_cnt(),
            "follower_cnt" => $follow_obj->set_user_no($user["user_no"])->set_follow_page(0)->get_follower_list_cnt()
        );

        return $page_user_follow;

    }

    public function get_user_major($work_id){
        if(!$work_id){
            return false;
        }

        $sql = array();

        $sql[] = "SELECT work_id, work_name, work_description, work_img, work_epsd_cnt FROM pave_work";
        $sql[] = "WHERE work_id = '{$work_id}'";
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);
        if(!$row["work_id"]){
            return false;
        }

        $row["work_url"] = get_url(PAVE_WORK_URL,"detail/{$row["work_id"]}");
        return $row;
    }

    public function get_user_list_cnt(){
        return $this->list_cnt;
    }

    public function get_user_list(){
        $this->generate_sql_init();

        $this->sql_common[] = "SELECT user.*, CONCAT(user.user_field, ',', user.user_genre) AS user_full_hashtag FROM pave_user AS user";
        $this->sql_where[] = "WHERE user.user_leave_state = 0";
        $this->sql_where[] = "user.user_block_state = 0";
        /* $this->sql_where[] = "user.user_grp = 'user'"; */

        if($this->user_id){
            $this->sql_where[] = "user.user_id = '{$this->user_id}'";
        }

        if($this->user_code){
            $this->sql_where[] = "user.user_code = '{$this->user_code}'";
        }

        if($this->user_nick){
            $this->sql_where[] = "(user.user_nick LIKE '{$this->user_nick}%' OR user.user_nick LIKE '%{$this->user_nick}%' OR user.user_nick LIKE '{$this->user_nick}%')";
        }
        if($this->user_commerce != null){
            $this->sql_where[] = "user.user_commerce = '{$this->user_commerce}'";
        }

        if($this->user_order == "search_nick"){
            $this->sql_order = "ORDER BY user.user_nick LIKE '{$this->user_nick}%' DESC,ifnull(nullif(instr(user.user_nick, ' {$this->user_nick}'), 0), 99999), ifnull(nullif(instr(user.user_nick, '{$this->user_nick}'), 0), 99999), user.user_nick";
        }else if($this->user_order == "recommand"){
            $this->sql_order = "ORDER BY user.user_insert_dt DESC";
        }

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $this->sql_limit = "LIMIT {$from}, {$to} ";
        }
        
        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            //회원 관심분야 리스트
            $row["user_field_list"] = pave_explode($row["user_field"], ",");

            //회원 관심장르 리스트
            $row["user_genre_list"] = pave_explode($row["user_genre"], ",");

            //회원 대표작품
            $row["user_major"] = $this->get_user_major($row["user_major"]);
           
            //회원 공유 링크
            $row["user_page_url"] = get_url(PAVE_PAGE_URL, "page", "user_code={$row["user_code"]}");
            $row["user_sns"] = json_decode($row["user_sns"], true);

            //회원 커머스 혜택
            $row["user_commerce_benefit"] = $this->get_user_commerce_benefit($row["user_grd"]);

            //회원 팔로우
            $row["user_follow"] = $this->get_user_follow($row);

            //회원 알림
            $row["user_notify"] = $this->get_user_notify($row["user_id"]);

            //회원 생일 리스트
            $row["user_birth_list"] = pave_explode($row["user_birth_date"], "-");

             //회원 미성년자 여부
            $kid_date = date("Ymd", strtotime("-14 years", PAVE_TIME));
            $row["user_kid"] = ((int)Converter::del_hyphen_date($row["user_birth_date"]) <= (int)$kid_date) ? 0 : 1;


            //text
            switch ($row["user_sex"]) {
                case "m":
                    $row["user_sex_text"] = "남";
                    break;
                case "f":
                    $row["user_sex_text"] = "여";
                    break;
                case "n":
                    $row["user_sex_text"] = "해당없음";
                    break;
                case "a":
                    $row["user_sex_text"] = "선택안함";
                    break;
            } 
            $this->list[] = $this->sanitize_user($row);
        }

        //total cnt
        $this->sql_cnt_common[] = "SELECT COUNT(*) AS cnt FROM pave_user AS user";
        $this->sql_cnt_where[] = $this->sql_where;
        $this->generate_cnt_sql();
        $this->list_cnt = pave_fetch($this->sql_cnt)["cnt"];
        
        return $this->list;
    }

    private function sanitize_user($user){
        if($this->user_sanitize){
            unset($user["user_adult_cert_state"]);
            unset($user["user_birth_date"]);
            unset($user["user_birth_list"]);
            unset($user["user_block_dt"]);
            unset($user["user_block_state"]);
            unset($user["user_bsns_state"]);
            unset($user["user_commerce_expire_dt"]);
            unset($user["user_commerce_start_dt"]);
            unset($user["user_cp"]);
            unset($user["user_cp_cert_state"]);
            unset($user["user_di"]);
            unset($user["user_email"]);
            unset($user["user_email_cert_state"]);
            unset($user["user_event_agree_state"]);
            unset($user["user_exp"]);
            unset($user["user_first_state"]);
            unset($user["user_grd"]);
            unset($user["user_hash"]);
            unset($user["user_info_agree_state"]);
            unset($user["user_insert_dt"]);
            unset($user["user_insert_ip"]);
            unset($user["user_leave_dt"]);
            unset($user["user_leave_state"]);
            unset($user["user_pwd_dt"]);
            unset($user["user_salt"]);
            unset($user["user_sex"]);
            unset($user["user_sex_text"]);
            unset($user["user_tel"]);
            unset($user["user_rel"]);
            unset($user["user_term_agree_state"]);
            unset($user["user_update_dt"]);
            unset($user["user_update_ip"]);
        }

        return $user;
    }


    private function generate_sql_init(){
        $this->sql = array();
        $this->sql_common = array();
        $this->sql_where = array();
        $this->sql_group = "";
        $this->sql_order = "";
        $this->sql_limit = "";
        $this->sql_cnt = array();
        $this->sql_cnt_common = array();
        $this->sql_cnt_where = array();
        $this->list = array();
        $this->list_cnt = 0;
    }

    private function generate_sql(){
        $this->sql_common = pave_implode($this->sql_common, " ");
        $this->sql_where = pave_implode($this->sql_where, " AND ");
        $this->sql[] = $this->sql_common;
        $this->sql[] = $this->sql_where;
        $this->sql[] = $this->sql_group;
        $this->sql[] = $this->sql_order;
        $this->sql[] = $this->sql_limit;
        $this->sql = pave_implode($this->sql, " ");
    }

    private function generate_cnt_sql(){
        $this->sql_cnt_common = pave_implode($this->sql_cnt_common, " ");
        $this->sql_cnt_where = pave_implode($this->sql_cnt_where, " AND ");
        $this->sql_cnt[] = $this->sql_cnt_common;
        $this->sql_cnt[] = $this->sql_cnt_where;
        $this->sql_cnt = pave_implode($this->sql_cnt, " ");
    }
}
?>