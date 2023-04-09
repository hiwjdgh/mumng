<?php
if (!defined('_PAVE_')) exit;
class Hashtag{
    private $hashtag_no;
    private $work_id;
    private $hashtag_name;

    private $hash_search = false;
    private $hash_search_keyword;


    private $page = 1;
    private $list_count = 10;


    function __construct() {

    }

    public function set_hashtag_no($hashtag_no){
        $this->hashtag_no = $hashtag_no;

        return $this;
    }

    public function set_work_id($work_id){
        $this->work_id = $work_id;

        return $this;
    }

    public function set_hashtag_name($hashtag_name){
        $this->hashtag_name = $hashtag_name;

        return $this;
    }

    public function set_hashtag_search($hash_search){
        $this->hash_search = $hash_search;

        return $this;
    }

    public function set_hashtag_search_keyword($hash_search_keyword){
        $this->hash_search_keyword = $hash_search_keyword;

        return $this;
    }

    public function set_hashtag_page($hashtag_page){
        $this->page = $hashtag_page;

        return $this;
    }

    public function get_hashtag_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT COUNT(*) AS cnt FROM pave_hashtag AS hashtag");


        if($this->hashtag_no){
           $obj->set_sql_where("hashtag.hashtag_no = '{$this->hashtag_no}'");
        }

        if($this->work_id){
           $obj->set_sql_where("hashtag.work_id = '{$this->work_id}'");
        }

        if($this->hashtag_name){
           $obj->set_sql_where("hashtag.hashtag_name = '{$this->hashtag_name}'");
        }
      

        $hashtag_list_count = pave_fetch($obj->generate_sql())["cnt"];

        return $hashtag_list_count;
    }

    public function get_hashtag_list(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT hashtag.*, COUNT(*) AS hashtag_cnt FROM pave_hashtag AS hashtag");


        if($this->hashtag_no){
           $obj->set_sql_where("hashtag.hashtag_no = '{$this->hashtag_no}'");
        }

        if($this->work_id){
           $obj->set_sql_where("hashtag.work_id = '{$this->work_id}'");
        }

        if($this->hashtag_name){
           $obj->set_sql_where("hashtag.hashtag_name = '{$this->hashtag_name}'");
        }

        $obj->set_sql_group("GROUP BY hashtag.hashtag_name");
        
        if($this->hash_search && $this->hashtag_search_keyword){
            $keyword_list = pave_explode($this->hash_search_keyword, " ");

            $obj->set_sql_order("ORDER BY hashtag.hashtag_name LIKE '{$keyword_list[0]}%' DESC,ifnull(nullif(instr(hashtag.hashtag_name, ' {$keyword_list[0]}'), 0), 99999), ifnull(nullif(instr(hashtag.hashtag_name, '{$keyword_list[0]}'), 0), 99999), hashtag.hashtag_name");

        }else{
            $obj->set_sql_order("ORDER BY COUNT(*) DESC, hashtag.hashtag_name");
        }

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }

        $hashtag_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) {  
            $row["hashtag_url"] = get_url(PAVE_SEARCH_URL, "hashtag/{$row["hashtag_name"]}");
            $row["tags_url"] = get_url(PAVE_SEARCH_URL, "tags/{$row["hashtag_name"]}");

            $hashtag_list[] = $row;
        }
            
        return $hashtag_list;
        
    }
}
?>