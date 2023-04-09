<?php
if (!defined('_PAVE_')) exit;
class User{
    private $user_no;
    private $user_code;
    private $user_share;
    private $user_id;
    private $user_di;
    private $user_email;
    private $user_nick;
    private $user_block_state;
    private $user_leave_state;
    private $user_sanitize = 1;
    private $user_search = false;
    private $user_search_keyword;

    private $page = 1;
    private $list_count = 10;

    function __construct() {
    }

    
    public static function generate_auto_login_key(){
        return md5(PAVE_USER_IP.PAVE_USER_AGENT);
    }

    public static function is_user_pwd($pass, $hash, $salt){
        return password_verify($salt.$pass, $hash);
    }

    public static function insert_user_login($user){
        $login = array(
            "user_no"   => $user["user_no"],
            "log_login_insert_dt"  => PAVE_TIME_YMDHIS,
            "log_login_insert_ip"  => PAVE_USER_IP
        );
        pave_insert("pave_log_login", $login);
    }

    
    public static function is_other_device_login($user){
        $obj = new Objects2();

        $obj
        ->generate_sql_init()
        ->set_sql_common("SELECT * FROM pave_log_login")
        ->set_sql_where("user_no = '{$user["user_no"]}'")
        ->set_sql_order("ORDER BY log_login_no DESC")
        ->set_sql_limit("LIMIT 1");

        $row = pave_fetch($obj->generate_sql());
    
        if(!$row["log_login_no"]){
            return false;
        }
    
        if($row["log_login_insert_ip"] == PAVE_USER_IP){
            return false;
        }
    
        return true;
    }

    public static function is_pwd_expired($user){
        if(Converter::display_time_elapse(PAVE_TIME, $user["user_pwd_dt"]) < 0){
            return false;
        }
    
        //마지막으로 보낸 변경 알림으로 부터 1개월 후 있는가?
        $from = Converter::display_time($user["user_pwd_dt"]);
        $to = PAVE_TIME_YMD;

        $obj = new Objects2();

        $obj
        ->generate_sql_init()
        ->set_sql_common("SELECT * FROM pave_notification")
        ->set_sql_where("notify_to = '{$user["user_id"]}'")
        ->set_sql_where("notify_type = 'notify_pwd_expire'")
        ->set_sql_where("date_format(notify_insert_dt, '%Y-%m-%d') BETWEEN '{$from}' and '{$to}'")
        ->set_sql_order("ORDER BY notify_no")
        ->set_sql_limit("LIMIT 1");

        $row = pave_fetch($obj->generate_sql());
    
        if(Converter::display_time_elapse(PAVE_TIME, $row["notify_insert_dt"]) < 30){
            return false;
        }

        return true;
    }

    public static function is_cert_expired($user){
        //인증 회원 인가?
        if(!$user["user_cp_cert_state"]){
            return false;
        }

        //인증 만료 기간을 넘어섰는가?
        if(Converter::display_time_elapse(PAVE_TIME, $user["user_cp_cert_dt"]) < 0){
            return false;
        }

        return true;
    }

    public static function is_follow_user($from, $to){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT * FROM pave_user_follow AS follow")
        ->set_sql_where("follow.user_follow_from = '{$from["user_no"]}'")
        ->set_sql_where("follow.user_follow_to = '{$to["user_no"]}'");

        $row = pave_fetch($obj->generate_sql());

        if(!$row["user_follow_no"]){
            return false;
        }

        return $row["user_follow_no"];
    }
    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    public function set_user_code($user_code){
        $this->user_code = $user_code;

        return $this;
    }

    public function set_user_share($user_share){
        $this->user_share = $user_share;

        return $this;
    }

    public function set_user_id($user_id){
        $this->user_id = $user_id;

        return $this;
    }

    public function set_user_di($user_di){
        $this->user_di = $user_di;

        return $this;
    }

    public function set_user_email($user_email){
        $this->user_email = $user_email;

        return $this;
    }

    public function set_user_nick($user_nick){
        $this->user_nick = $user_nick;

        return $this;
    }

    public function set_user_block($user_block_state){
        $this->user_block_state = $user_block_state;

        return $this;
    }

    public function set_user_leave($user_leave_state){
        $this->user_leave_state = $user_leave_state;

        return $this;
    }

    public function set_user_search($user_search){
        $this->user_search = $user_search;

        return $this;
    }

    public function set_user_search_keyword($user_search_keyword){
        $this->user_search_keyword = $user_search_keyword;

        return $this;
    }
  
    public function set_user_page($user_page = 1){
        $this->page = $user_page;

        return $this;
    }
  
    public function set_list_count($list_count = 1){
        $this->list_count = $list_count;

        return $this;
    }
    
    public function set_user_sanitize($user_sanitize){
        $this->user_sanitize = $user_sanitize;

        return $this;
    }

    public function get_user_bank($user){
        if(!$user["user_bank_state"]){
            return array();
        }

        $obj = new Objects2();
        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_user_bank");
        $obj->set_sql_where("user_no = '{$user["user_no"]}'");

        return pave_fetch($obj->generate_sql());
    }

    public function get_user_bsns($user){
        if(!$user["user_bsns_state"]){
            return array();
        }

        $obj = new Objects2();
        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_user_bsns");
        $obj->set_sql_where("user_no = '{$user["user_no"]}'");

        return pave_fetch($obj->generate_sql());
    }

    public function get_user_card($user){
        $obj = new Objects2();
        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_user_card");
        $obj->set_sql_where("user_no = '{$user["user_no"]}'");
        
        $user_card_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $user_card_list[] = $row;
        }
   

        return $user_card_list;
    }

    public function get_user_notify($user){
        $obj = new Objects2();
        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_user_notify");
        $obj->set_sql_where("user_no = '{$user["user_no"]}'");
        
        $row = pave_fetch($obj->generate_sql());

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

    public function get_user_rel($user){
        if(!$user["user_no"]){
            return null;
        }

        $obj = new Objects2();
        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_user_rel");
    
        if($user["user_no"]){
            $obj->set_sql_where("user_no = '{$user["user_no"]}'");
        }
        $row = pave_fetch($obj->generate_sql());

        return $row;
    }

    public function get_user_commerce($user){
        if(!$user["user_commerce_state"]){
            return array();
        }

        $commerce_obj = new Commerce();
        $commerce = $commerce_obj->set_user_no($user["user_no"])->get_user_commerce();

        return $commerce;
    }

    public function get_user_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_user AS user");


        if($this->user_no){
            $obj->set_sql_cnt_where("user.user_no = '{$this->user_no}'");
        }

        if($this->user_code){
            $obj->set_sql_cnt_where("user.user_code = '{$this->user_code}'");
        }
        
        if($this->user_share){
            $obj->set_sql_cnt_where("user.user_share = '{$this->user_share}'");
        }

        if($this->user_id){
            $obj->set_sql_cnt_where("user.user_id = '{$this->user_id}'");
        }

        
        if($this->user_leave_state !== null){
            $obj->set_sql_cnt_where("user.user_leave_state = '{$this->user_leave_state}'");
        }

        if($this->user_block_state !== null){
            $obj->set_sql_cnt_where("user.user_block_state = '{$this->user_block_state}'");
        }


        if($this->user_di){
            $obj->set_sql_cnt_where("user.user_di = '{$this->user_di}'");
        }

        if($this->user_email){
            $obj->set_sql_cnt_where("user.user_email = '{$this->user_email}'");
        }

        if($this->user_nick){
            $obj->set_sql_cnt_where("(user.user_nick LIKE '{$this->user_nick}%' OR user.user_nick LIKE '%{$this->user_nick}%' OR user.user_nick LIKE '{$this->user_nick}%')");
        }

        $user_list_count = pave_fetch($obj->generate_cnt_sql())["cnt"];

        return $user_list_count;
    }

    public function get_user_list(){
        global $pave_user;
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT user.* FROM pave_user AS user");


        if($this->user_no){
            $obj->set_sql_where("user.user_no = '{$this->user_no}'");
        }

        if($this->user_code){
            $obj->set_sql_where("user.user_code = '{$this->user_code}'");
        }

        if($this->user_share){
            $obj->set_sql_where("user.user_share = '{$this->user_share}'");
        }

        if($this->user_id){
            $obj->set_sql_where("user.user_id = '{$this->user_id}'");
        }

        if($this->user_leave_state !== null){
            $obj->set_sql_where("user.user_leave_state = '{$this->user_leave_state}'");
        }

        if($this->user_block_state !== null){
            $obj->set_sql_where("user.user_block_state = '{$this->user_block_state}'");
        }

        if($this->user_di){
            $obj->set_sql_where("user.user_di = '{$this->user_di}'");
        }

        if($this->user_email){
            $obj->set_sql_where("user.user_email = '{$this->user_email}'");
        }

        if($this->user_nick){
            $obj->set_sql_where("user.user_nick = '{$this->user_nick}'");
        }

        if($this->user_search){
            $keyword_list = pave_explode($this->user_search_keyword, " ");

            $obj->set_sql_order("ORDER BY user.user_nick LIKE '{$keyword_list[0]}%' DESC,ifnull(nullif(instr(user.user_nick, ' {$keyword_list[0]}'), 0), 99999), ifnull(nullif(instr(user.user_nick, '{$keyword_list[0]}'), 0), 99999), user.user_nick");

        }else{
            $obj->set_sql_order("ORDER BY user.user_insert_dt DESC");
        }

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }

        $user_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            //회원 관심분야 리스트
            $row["user_field_list"] = pave_explode($row["user_field"], ",");

            //회원 관심장르 리스트
            $row["user_genre_list"] = pave_explode($row["user_genre"], ",");
            
            //회원 공유 링크
            $row["user_page_url"] = get_url(PAVE_PAGE_URL, "{$row["user_share"]}");
            $row["user_sns"] = json_decode($row["user_sns"], true);

            //회원 팔로우
            $row["user_follow"] = $this->get_user_follow($row);
            
            //회원 커머스 혜택
            $row["user_commerce"] = $this->get_user_commerce($row);

            //회원 알림
            $row["user_notify"] = $this->get_user_notify($row);

            //회원 생일 리스트
            $row["user_birth_list"] = pave_explode($row["user_birth_date"], "-");

            //회원 미성년자 여부
            $kid_date = date("Ymd", strtotime("-14 years", PAVE_TIME));
            $row["user_kid"] = ((int)Converter::del_hyphen_date($row["user_birth_date"]) <= (int)$kid_date) ? 0 : 1;
            
            //회원 간편결제 카드
            $row["user_card"] = $this->get_user_card($row);
            
            //회원 사업자
            $row["user_bsns"] = $this->get_user_bsns($row);
            
            //회원 은행
            $row["user_bank"] = $this->get_user_bank($row);

            $row["is_follow_display"] = true;
            if($pave_user["user_no"] == $row["user_no"]){
                $row["is_follow_display"] = false;

            }

            //회원 성별명
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

            $user_list[] = $this->sanitize_user($row);
        }

        
        return $user_list;
    }
    
    public function get_user(){
        return $this->get_user_list()[0];
    }

    private function sanitize_user($user){
        if($this->user_sanitize){
         
        }

        return $user;
    }
}
?>