<?php
if (!defined('_PAVE_')) exit;
class Item{
    private $it_no;
    private $user_no;
    private $it_type;
    private $it_display;
    private $it_order;

    private $page = 1;
    private $list_count = 10;


    function __construct() {
    }

    public function set_it_no($it_no){
        $this->it_no = $it_no;

        return $this;
    }
    public function set_it_type($it_type){
        $this->it_type = $it_type;

        return $this;
    }

    public function set_user_no($user_no){
        $this->user_no = $user_no;  

        return $this;
    }

    public function set_it_display($it_display){
        $this->it_display = $it_display;
          
        return $this;
    }

    public function set_it_order($it_order){
        $this->it_order = $it_order;
          
        return $this;
    }


    public function set_item_page($item_page){
        $this->page = $item_page;
          
        return $this;
    }

    public function get_item_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_item AS item");

        if($this->it_no){
            $obj->set_sql_cnt_where("item.it_no = '{$this->it_no}'");
        }

        if($this->user_no){
            $obj->set_sql_cnt_where("item.user_no = '{$this->user_no}'");
        }

        if($this->it_type){
            if(pave_is_array($this->it_type)){
                $obj->set_sql_cnt_where("item.it_type IN ('".pave_implode($this->it_type, "','")."')");
            }else{
                $obj->set_sql_cnt_where("item.it_type = '{$this->it_type}'");
            }
        }

        if($this->it_display !== null){
            $obj->set_sql_cnt_where("item.it_display = '{$this->it_display}'");
        }

        $item_list_cnt = pave_fetch($obj->generate_cnt_sql())["cnt"];

        return $item_list_cnt;
    }

    public function get_item_list(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT item.* FROM pave_item AS item");

        if($this->it_no){
            $obj->set_sql_where("item.it_no = '{$this->it_no}'");
        }

        if($this->user_no){
            $obj->set_sql_where("item.user_no = '{$this->user_no}'");
        }

        if($this->it_type){
            $obj->set_sql_where("item.it_type = '{$this->it_type}'");
        }

        if($this->it_display !== null){
            $obj->set_sql_where("item.it_display = '{$this->it_display}'");
        }

        if($this->it_order){
            if($this->it_order == "price_asc"){
                $obj->set_sql_order("ORDER BY item.it_price");
            }else if($this->it_order == "price_desc"){
                $obj->set_sql_order("ORDER BY item.it_price DESC");
            }else{
                $obj->set_sql_order("ORDER BY item.it_no DESC");
            }
        }

        if($this->page !== null){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }


        $item_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $item_list[] = $row;
        }

        return $item_list;
    }

    public function get_item(){
        return $this->get_item_list()[0];
    }
}