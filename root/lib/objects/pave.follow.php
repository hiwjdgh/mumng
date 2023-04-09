<?php
if (!defined('_PAVE_')) exit;
class Follows{
    private $user_no;
    
    private $follow_search = false;
    private $follow_search_keyword;


    private $page = 1;
    private $list_count = 10;

    function __construct() {
    }

    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    public function set_follow_search($follow_search){
        $this->follow_search = $follow_search;

        return $this;
    }

    public function set_follow_search_keyword($follow_search_keyword){
        $this->follow_search_keyword = $follow_search_keyword;

        return $this;
    }
  
    public function set_follow_page($follow_page = 1){
        $this->page = $follow_page;

        return $this;
    }

    public function get_following_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_user_follow AS follow")
        ->set_sql_cnt_common("LEFT JOIN pave_user AS user ON (follow.user_follow_to = user.user_no)");

        if($this->user_no){
            $obj->set_sql_cnt_where("follow.user_follow_from = '{$this->user_no}'");
        }

        $user_list_count = pave_fetch($obj->generate_cnt_sql())["cnt"];
        return $user_list_count;
    }

    public function get_following_list(){
        global $pave_user;

        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT user.* FROM pave_user_follow AS follow")
        ->set_sql_common("LEFT JOIN pave_user AS user ON (follow.user_follow_to = user.user_no)");

        if($this->user_no){
            $obj->set_sql_where("follow.user_follow_from = '{$this->user_no}'");
        }

        if($this->follow_search){
            $keyword_list = pave_explode($this->follow_search_keyword, " ");

            $obj->set_sql_order("ORDER BY user.user_nick LIKE '{$keyword_list[0]}%' DESC,ifnull(nullif(instr(user.user_nick, ' {$keyword_list[0]}'), 0), 99999), ifnull(nullif(instr(user.user_nick, '{$keyword_list[0]}'), 0), 99999), user.user_nick");

        }else{
            $obj->set_sql_order("ORDER BY follow.user_follow_no DESC");
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
            $row["user_page_url"] = get_url(PAVE_PAGE_URL, "page", "user_code={$row["user_code"]}");
            $row["user_sns"] = json_decode($row["user_sns"], true);

            //회원 생일 리스트
            $row["user_birth_list"] = pave_explode($row["user_birth_date"], "-");


            //회원 미성년자 여부
            $kid_date = date("Ymd", strtotime("-14 years", PAVE_TIME));
            $row["user_kid"] = ((int)Converter::del_hyphen_date($row["user_birth_date"]) <= (int)$kid_date) ? 0 : 1;
            
            $row["is_follow_display"] = true;
            if($pave_user["user_no"] == $row["user_no"]){
                $row["is_follow_display"] = false;

            }
            $user_list[] = $row;
        }

        return $user_list;
    }

       
    public function get_follower_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_user_follow AS follow")
        ->set_sql_cnt_common("LEFT JOIN pave_user AS user ON (follow.user_follow_from = user.user_no)");

        if($this->user_no){
            $obj->set_sql_cnt_where("follow.user_follow_to = '{$this->user_no}'");
        }
        $user_list_count = pave_fetch($obj->generate_cnt_sql())["cnt"];
        return $user_list_count;
    }

    public function get_follower_list(){
        global $pave_user;
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT user.* FROM pave_user_follow AS follow")
        ->set_sql_common("LEFT JOIN pave_user AS user ON (follow.user_follow_from = user.user_no)");

        if($this->user_no){
            $obj->set_sql_where("follow.user_follow_to = '{$this->user_no}'");
        }

        if($this->follow_search){
            $keyword_list = pave_explode($this->follow_search_keyword, " ");

            $obj->set_sql_order("ORDER BY user.user_nick LIKE '{$keyword_list[0]}%' DESC,ifnull(nullif(instr(user.user_nick, ' {$keyword_list[0]}'), 0), 99999), ifnull(nullif(instr(user.user_nick, '{$keyword_list[0]}'), 0), 99999), user.user_nick");

        }else{
            $obj->set_sql_order("ORDER BY follow.user_follow_no DESC");
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
            $row["user_page_url"] = get_url(PAVE_PAGE_URL, "page", "user_code={$row["user_code"]}");
            $row["user_sns"] = json_decode($row["user_sns"], true);

            //회원 생일 리스트
            $row["user_birth_list"] = pave_explode($row["user_birth_date"], "-");


            //회원 미성년자 여부
            $kid_date = date("Ymd", strtotime("-14 years", PAVE_TIME));
            $row["user_kid"] = ((int)Converter::del_hyphen_date($row["user_birth_date"]) <= (int)$kid_date) ? 0 : 1;
            
            $row["is_follow_display"] = true;
            if($pave_user["user_no"] == $row["user_no"]){
                $row["is_follow_display"] = false;

            }
            $user_list[] = $row;
        }

        return $user_list;
    }
}
?>