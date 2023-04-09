<?php
if (!defined('_PAVE_')) exit;
class Creation{
    private $creation_no;
    private $user_no;
    private $creation_field;
    private $creation_ratio;
    private $creation_size;
    private $creation_exp;
    private $creation_state;
    private $creation_order;

    
    private $page = 1;
    private $list_count = 10;

    function __construct() {
       
    }

    public function set_creation_no($creation_no){
        $this->creation_no = $creation_no;

        return $this;
    }

    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    public function set_creation_field($creation_field){
        $this->creation_field = $creation_field;

        return $this;
    }

    public function set_creation_ratio($creation_ratio){
        $this->creation_ratio = $creation_ratio;

        return $this;
    }

    public function set_creation_size($creation_size){
        $this->creation_size = $creation_size;

        return $this;
    }

    public function set_creation_exp($creation_exp){
        $this->creation_exp = $creation_exp;

        return $this;
    }

    public function set_creation_state($creation_state){
        $this->creation_state = $creation_state;

        return $this;
    }

    public function set_creation_order($creation_order){
        $this->creation_order = $creation_order;

        return $this;
    }

    public function set_creation_page($creation_page){
        $this->page = $creation_page;

        return $this;
    }

    public function get_share_url($creation){
        $facebook_base_url = "http://www.facebook.com/sharer/sharer.php?u={url}";
        $twitter_base_url = "http://twitter.com/share?url={url}&text={title}";
        $naver_base_url = "https://share.naver.com/web/shareView?url={url}&title={title}";
        $kakao_base_url = "https://story.kakao.com/s/share?url={url}";

        
        $share_url = get_url(PAVE_CREATION_URL, "/detail/{$creation["creation_no"]}");
        $share_title = $creation["creation_name"];
    
        $facebook_url = str_replace("{url}", rawurlencode($share_url)  , $facebook_base_url);
        
        $twitter_url = str_replace("{url}", rawurlencode($share_url) , $twitter_base_url);
        $twitter_url = str_replace("{title}", rawurlencode($share_title) , $twitter_url);
    
        $naverblog_url = str_replace("{url}", rawurlencode($share_url) , $naver_base_url);
        $naverblog_url = str_replace("{title}", rawurlencode($share_title) , $naverblog_url);
    
        $kakaostory_url = str_replace("{url}", rawurlencode($share_url) , $kakao_base_url);

        
        return array(
            "facebook" => $facebook_url,
            "twitter" => $twitter_url,
            "naverblog" => $naverblog_url,
            "kakaostory" => $kakaostory_url,
        );
    }

    public function get_creation_user($creation){
        $user_obj = new User();

        return $user_obj->set_user_no($creation["user_no"])->get_user();
    }

    public function get_creation_request_list($creation){
        $obj = new Objects2();
        $obj->generate_sql_init()
        ->set_sql_common("SELECT request.* FROM pave_creation_request AS request")
        ->set_sql_where("creation_no = '{$creation["creation_no"]}'");

        $request_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) {
            $user_obj = new User();
            
            $row["request_user"] = $user_obj->set_user_no($row["user_no"])->get_user();
            $request_list[] = $row;
        }

        return $request_list;
    }

    public function get_creation_list(){
        global $pave_user;

        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT creation.* FROM pave_creation AS creation");
           
        if($this->creation_no){
            $obj->set_sql_where("creation.creation_no = '{$this->creation_no}'");
        }

        if($this->user_no){
            $obj->set_sql_where("creation.user_no = '{$this->user_no}'");
        }

        if($this->creation_field){
            if(pave_is_array($this->creation_field)){
                $obj->set_sql_where("creation.creation_field IN ('".pave_implode($this->creation_field, "','")."')");
            }else{
                $obj->set_sql_where("creation.creation_field = '{$this->creation_field}'");
            }
        }

        if($this->creation_ratio){
            if(pave_is_array($this->creation_ratio)){
                $obj->set_sql_where("creation.creation_ratio IN ('".pave_implode($this->creation_ratio, "','")."')");
            }else{
                $obj->set_sql_where("creation.creation_ratio = '{$this->creation_ratio}'");
            }
        }

        if($this->creation_size){
            if(pave_is_array($this->creation_size)){
                $obj->set_sql_where("creation.creation_size IN ('".pave_implode($this->creation_size, "','")."')");
            }else{
                $obj->set_sql_where("creation.creation_size = '{$this->creation_size}'");
            }
        }

        if($this->creation_exp){
            if(pave_is_array($this->creation_exp)){
                $obj->set_sql_where("creation.creation_exp > '{$this->creation_exp[0]}' && creation.creation_exp <= '{$this->creation_exp[1]}'");
            }else{
                $obj->set_sql_where("creation.creation_exp = '{$this->creation_exp}'");
            }
        }

        if($this->creation_state){
            if(pave_is_array($this->creation_state)){
                $obj->set_sql_where("creation.creation_state IN ('".pave_implode($this->creation_state, "','")."')");
            }else{
                $obj->set_sql_where("creation.creation_state = '{$this->creation_state}'");
            }
        }

        
        if($this->page !== null){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }
        
        if($this->creation_order){
            if($this->creation_order[0] == "update"){
                $obj->set_sql_order("ORDER BY creation.creation_no DESC");
            }else if($this->creation_order[0] == "end"){
                $obj->set_sql_order("ORDER BY TIMEDIFF(creation.creation_end_dt, curdate()) {$this->creation_order[1]}");
            }else if($this->creation_order[0] == "exp"){
                $obj->set_sql_order("ORDER BY creation.creation_exp {$this->creation_order[1]}");
            }else if($this->creation_order[0] == "temp"){
                $obj->set_sql_order("ORDER BY creation.creation_update_dt {$this->creation_order[1]}");
            }else{
                $obj->set_sql_order("ORDER BY creation.creation_no DESC");
            }
        }else{
            $obj->set_sql_order("ORDER BY creation.creation_no DESC");
            
        }


        $creation_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) {

            //소유 여부
            $row["is_own"] = false;
            if(($row["user_no"] == $pave_user["user_no"])){
                $row["is_own"] = true;
            }
            
            //마감 여부
            $row["is_end"] = false;
            if(strtotime($row["creation_end_dt"]) < PAVE_TIME){
                $row["is_end"] = true;
            }

            //공유 링크
            $row["creation_share_url"] = $this->get_share_url($row);
            $row["creation_url"] = get_url(PAVE_CREATION_URL, "detail/{$row["creation_no"]}");

            //대표 작가
            $row["creation_user"] = $this->get_creation_user($row);

            $creation_list[] = $row;
        }

        return $creation_list;
    }

    public function get_creation(){
        return $this->get_creation_list()[0];
    }

}
?>