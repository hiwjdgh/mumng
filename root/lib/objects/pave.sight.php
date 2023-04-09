<?php
if (!defined('_PAVE_')) exit;
class Sight{
    private $sight_no;
    private $sight_grp_id;
    private $user_no;
    private $sight_name;
    private $sight_age;
    private $sight_type;
    private $sight_hashtag;
    private $sight_genre;
    private $sight_display;

    private $sight_search = false;
    private $sight_search_keyword;


    private $page = 1;
    private $list_count = 10;

    function __construct() {
    }

    public function set_sight_no($sight_no){
        $this->sight_no = $sight_no;
        
        return $this;
    }

    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    public function set_sight_grp_id($sight_grp_id){
        $this->sight_grp_id = $sight_grp_id;

        return $this;
    }

    public function set_sight_name($sight_name){
        $this->sight_name = $sight_name;

        return $this;
    }

    public function set_sight_age($sight_age){
        $this->sight_age = $sight_age;

        return $this;
    }

    public function set_sight_hashtag($sight_hashtag){
        $this->sight_hashtag = $sight_hashtag;

        return $this;
    }

    public function set_sight_genre($sight_genre){
        $this->sight_genre = $sight_genre;

        return $this;
    }

    public function set_sight_display($sight_display){
        $this->sight_display = $sight_display;

        return $this;
    }

    public function set_sight_type($sight_type){
        $this->sight_type = $sight_type;

        return $this;
    }

    public function set_sight_search($sight_search){
        $this->sight_search = $sight_search;

        return $this;
    }

    public function set_sight_search_keyword($sight_search_keyword){
        $this->sight_search_keyword = $sight_search_keyword;

        return $this;
    }

    public function set_sight_page($sight_page){
        $this->page = $sight_page;

        return $this;
    }
    
    public function get_sight_user($sight){
        $user_obj = new User();

        return $user_obj->set_user_no($sight["user_no"])->get_user();
    }
    

    public function get_sight_list_count(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT sight.* FROM pave_sight AS sight");
      
        if($this->sight_no){
            $obj->set_sql_cnt_where("sight.sight_no = '{$this->sight_no}'");
        }

        if($this->sight_grp_id){
            $obj->set_sql_cnt_where("sight.sight_grp_id = '{$this->sight_grp_id}'");
        }

        if($this->user_no){
            $obj->set_sql_cnt_where("sight.user_no = '{$this->user_no}'");
        }

        if($this->sight_name){
            $obj->set_sql_cnt_where("sight.sight_name = '{$this->sight_name}'");
        }

        if($this->sight_age){
            $obj->set_sql_cnt_where("sight.sight_age = '{$this->sight_age}'");
        }

        if($this->sight_hashtag){
            $obj->set_sql_cnt_where("sight.sight_hashtag = '{$this->sight_hashtag}'");
        }

        if($this->sight_genre){
            $obj->set_sql_cnt_where("sight.sight_genre = '{$this->sight_genre}'");
        }

        if($this->sight_display !== null){
            $obj->set_sql_cnt_where("sight.sight_display = '{$this->sight_display}'");
        }

        
        $sight_list_count = pave_fetch($obj->generate_cnt_sql())["cnt"];
        
        return $sight_list_count;
    }
    public function get_sight_list(){
        global $pave_user;

        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT sight.* FROM pave_sight AS sight");
      
        if($this->sight_no){
            $obj->set_sql_where("sight.sight_no = '{$this->sight_no}'");
        }

        if($this->sight_grp_id){
            $obj->set_sql_where("sight.sight_grp_id = '{$this->sight_grp_id}'");
        }

        if($this->sight_type){
            $obj->set_sql_where("sight.sight_grp_id = '{$this->sight_grp_id}'");
        }

        if($this->sight_type == "follow"){
            $obj2 = new Objects2();

            $obj2->generate_sql_init()
            ->set_sql_common("SELECT GROUP_CONCAT(QUOTE(sight_no)) AS sight_no FROM pave_sight")
            ->set_sql_where("user_no IN (SELECT user_follow_to FROM pave_user_follow WHERE user_follow_from = '{$pave_user["user_no"]}')");

            $row2 = pave_fetch($obj2->generate_sql());
            if($row2["sight_no"]){
                $obj->set_sql_where("sight.sight_no IN ({$row2["sight_no"]})");
            }
        }

        if($this->user_no){
            $obj->set_sql_where("sight.user_no = '{$this->user_no}'");
        }

        if($this->sight_name){
            $obj->set_sql_where("sight.sight_name = '{$this->sight_name}'");
        }

        if($this->sight_age){
            $obj->set_sql_where("sight.sight_age = '{$this->sight_age}'");
        }

        if($this->sight_hashtag){
            $obj->set_sql_where("sight.sight_hashtag = '{$this->sight_hashtag}'");
        }

        if($this->sight_genre){
            $obj->set_sql_where("sight.sight_genre = '{$this->sight_genre}'");
        }

        if($this->sight_display !== null){
            $obj->set_sql_where("sight.sight_display = '{$this->sight_display}'");
        }

        if($this->sight_search){
            $keyword_list = pave_explode($this->sight_search_keyword, " ");
            foreach ($keyword_list as $i => $keyword){
                if(mb_strlen($keyword, "UTF-8") < 2){
                    unset($keyword_list[$i]);
                }
            }

            if(pave_is_array($keyword_list)){
                $search_query = pave_implode($keyword_list, "* ");
                $obj->set_sql_order("ORDER BY MATCH(sight.sight_content) AGAINST('{$search_query}*' IN BOOLEAN MODE) DESC");
            }else{
                $obj->set_sql_order("ORDER BY sight.sight_name LIKE '{$this->sight_search_keyword}%' DESC,ifnull(nullif(instr(sight.sight_name, ' {$this->sight_search_keyword}'), 0), 99999), ifnull(nullif(instr(sight.sight_name, '{$this->sight_search_keyword}'), 0), 99999), sight.sight_name");
            }
        }else{
            $obj->set_sql_order("ORDER BY sight.sight_insert_dt DESC");
        }

        if($this->page !== null){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }
        
        $sight_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) {
            
            //대표 작가
            $row["sight_user"] = $this->get_sight_user($row);
            
               
            //소유 여부
            $row["is_own"] = false;
            if(($row["user_no"] == $pave_user["user_no"])){
                $row["is_own"] = true;
            }
            
            $row["sight_hashtag_list"] = pave_explode($row["sight_hashtag"], ",");
            $sight_list[] = $row;
        }

        
        return $sight_list;
    }

    public function get_sight(){
        if(!$this->sight_no){
            return array();
        }

        return $this->get_sight_list()[0];
    }
}
?>