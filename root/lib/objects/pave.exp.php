<?php
if (!defined('_PAVE_')) exit;
class Exp{
    private $exp_no;
    private $user_no;
    private $exp_type;
    private $exp_state;
    

    private $page = 1;
    private $list_count = 5;

    function __construct() {
    }

    public function set_exp_no($exp_no){
        $this->exp_no = $exp_no;

        return $this;
    }
    
    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    
    public function set_exp_type($exp_type){
        $this->exp_type = $exp_type;

        return $this;
    }

    
    public function set_exp_state($exp_state){
        $this->exp_state = $exp_state;

        return $this;
    }

    public function set_exp_page($exp_page){
        $this->page = $exp_page;

        return $this;
    }

    public function get_exp_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_exp AS exps");

        
        if($this->exp_no){
            $obj->set_sql_cnt_where("exps.exp_no = '{$this->exp_no}'");
        }
        
        if($this->user_no){
            $obj->set_sql_cnt_where("exps.user_no = '{$this->user_no}'");
        }
        
        if($this->exp_type){
            if(pave_is_array($this->exp_type)){
                $obj->set_sql_cnt_where("exps.exp_type IN ('".pave_implode($this->exp_type, "','")."')");
            }else{
                $obj->set_sql_cnt_where("exps.exp_type = '{$this->exp_type}'");
            }
        }
        
        if($this->exp_state){
            if(pave_is_array($this->exp_state)){
                $obj->set_sql_cnt_where("exps.exp_state IN ('".pave_implode($this->exp_state, "','")."')");
            }else{
                $obj->set_sql_cnt_where("exps.exp_state = '{$this->exp_state}'");
            }
        }
        
        $exp_list_cnt = pave_fetch($obj->generate_cnt_sql())["cnt"];

        return $exp_list_cnt;
    }

    public function get_exp_list(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT exps.* FROM pave_exp AS exps");

        
        if($this->exp_no){
            $obj->set_sql_where("exps.exp_no = '{$this->exp_no}'");
        }
        
        if($this->user_no){
            $obj->set_sql_where("exps.user_no = '{$this->user_no}'");
        }
        
        if($this->exp_type){
            if(pave_is_array($this->exp_type)){
                $obj->set_sql_where("exps.exp_type IN ('".pave_implode($this->exp_type, "','")."')");
            }else{
                $obj->set_sql_where("exps.exp_type = '{$this->exp_type}'");
            }
        }
        
        if($this->exp_state){
            if(pave_is_array($this->exp_state)){
                $obj->set_sql_where("exps.exp_state IN ('".pave_implode($this->exp_state, "','")."')");
            }else{
                $obj->set_sql_where("exps.exp_state = '{$this->exp_state}'");
            }
        }
        
        $obj->set_sql_order("ORDER BY exps.exp_no DESC");

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }
        
        
        
        $exp_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $row["is_exp_use"] = false;
            if($row["exp_use_amount"] > 0){
                $row["is_exp_use"] = true;
            }

            switch ($row["exp_type"]) {
                case 'payment':
                    $row["exp_type_text"] = "결제충전";
                    break;
                case 'event':
                    $row["exp_type_text"] = "이벤트충전";
                    break;
                case 'ad':
                    $row["exp_type_text"] = "광고충전";
                    break;
            }
            $exp_list[] = $row;
        }

        return $exp_list;

    }

    public function get_exp(){
        return $this->get_exp_list()[0];
    }

}
?>