<?php
class Objects{
    protected $sql = array();
    protected $sql_common = array();
    protected $sql_where = array();
    protected $sql_group = "";
    protected $sql_order = "";
    protected $sql_limit = "";

    protected $sql_cnt = array();
    protected $sql_cnt_common = array();
    protected $sql_cnt_where = array();

    
    protected $list = array();
    protected $list_cnt = 0;

    public function generate_sql_init(){
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

    public function generate_sql(){
        $this->sql_common = pave_implode($this->sql_common, " ");
        $this->sql_where = pave_implode($this->sql_where, " AND ");
        $this->sql[] = $this->sql_common;
        $this->sql[] = $this->sql_where;
        $this->sql[] = $this->sql_group;
        $this->sql[] = $this->sql_order;
        $this->sql[] = $this->sql_limit;

        $this->sql = pave_implode($this->sql, " ");
    }

    public function generate_cnt_sql(){
        $this->sql_cnt_common = pave_implode($this->sql_cnt_common, " ");
        $this->sql_cnt_where = pave_implode($this->sql_cnt_where, " AND ");
        $this->sql_cnt[] = $this->sql_cnt_common;
        $this->sql_cnt[] = $this->sql_cnt_where;
        $this->sql_cnt = pave_implode($this->sql_cnt, " ");
    }

    public function set_sql_common($sql_common){
        $this->sql_common[] = $sql_common;
    }

    public function set_sql_where($sql_where){
        $this->sql_where[] = $sql_where;
    }

    public function set_sql_group($sql_group){
        $this->sql_group = $sql_group;
    }

    public function set_sql_order($sql_order){
        $this->sql_order = $sql_order;
    }

    public function set_sql_limit($sql_limit){
        $this->sql_limit = $sql_limit;
    }

    
    public function set_sql_cnt_common($sql_cnt_common){
        $this->sql_cnt_common[] = $sql_cnt_common;
    }

    public function set_sql_cnt_where($sql_cnt_where){
        $this->sql_cnt_where[] = $sql_cnt_where;
    }

    public function get_sql(){
        return $this->sql;
    }

    public function get_sql_cnt(){
        return $this->sql_cnt;
    }

    public function get_sql_where(){
        return $this->sql_where;
    }

    public function get_pagination($page = 1, $total_cnt, $list_cnt = 10, $nav_cnt = 5){
        $pagination = array();

        $total = $total_cnt;
     
        if(!$total){
            return null;
        }
    
        $total_page = ceil($total / $list_cnt);
        $total_block = ceil($total_page / $nav_cnt);
    
        if(!$page){
            $page = 1;
        }
    
        $block = ceil($page / $nav_cnt);
    
        $from_page = (($block - 1) * $nav_cnt) + 1; 
        $to_page = min($total_page, $block * $nav_cnt);
    
        $prev_page = $page - 1;
        $next_page = $page + 1;
    
        $prev_block = $block - 1;
        $next_block = $block + 1;
    
        if($prev_page < 1){
            $prev_page = 0;
        }
    
        if($next_page > $total_page){
            $next_page = 0;
        }
    
        $prev_block_page = $prev_block * $nav_cnt;
        $next_block_page = $next_block * $nav_cnt - ($nav_cnt - 1);
    
    
        if($prev_block  < 1){
            $prev_block  = 0;
        }
    
        if($next_block_page > $total_page){
            $next_block_page = 0;
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
            "page"              => $page
        );  
    
        return $pagination;
    }
}
?>