<?php
if (!defined('_PAVE_')) exit;
class Guide extends Objects{
    private $user = array();

    private $guide_group_id;
    private $guide_group_display;
    private $guide_bo_id;
    private $guide_bo_display;
    private $guide_bd_id;
    private $guide_keyword;
    private $guide_bd_display;


    private $list_count = 10;
    private $nav_count = 5;
    private $page = 1;


    function __construct() {
        global $pave_user;
        $this->user = $pave_user;
    }

    public function set_guide_group_id($guide_group_id){
        $this->guide_group_id = $guide_group_id;
    }

    public function set_guide_group_display($guide_group_display){
        $this->guide_group_display = $guide_group_display;
    }
    
    public function set_guide_bo_id($guide_bo_id){
        $this->guide_bo_id = $guide_bo_id;
    }

    public function set_guide_bo_display($guide_bo_display){
        $this->guide_bo_display = $guide_bo_display;
    }

    public function set_guide_bd_id($guide_bd_id){
        $this->guide_bd_id = $guide_bd_id;
    }

    public function set_guide_keyword($guide_keyword){
        $this->guide_keyword = $guide_keyword;
    }
       
    public function set_guide_bd_display($guide_bd_display){
        $this->guide_bd_display = $guide_bd_display;
    }

    public function set_guide_page($guide_page){
        $this->page = $guide_page;
    }

    public function get_guide_list_cnt(){
        return $this->list_cnt;
    }


    public function get_guide_group_list(){
        $this->generate_sql_init();
        $this->sql_common[] = "SELECT * FROM pave_guide_group AS grp";
        $this->sql_where[] = "WHERE 1=1";

        if($this->guide_group_display !== null){
            $this->sql_where[] = "grp.guide_group_display = '{$this->guide_group_display}'";
        }

        if($this->guide_group_id){
            $this->sql_where[] = "grp.guide_group_id = '{$this->guide_group_id}'";
        }

        $this->sql_order = "ORDER BY grp.guide_group_order";

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $this->sql_limit = "LIMIT {$from}, {$to} ";
        }

        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
            if($row["guide_group_display"]){
                $row["guide_group_display_text"] = "공개";
            }else{
                $row["guide_group_display_text"] = "미공개";
            }
            $this->list[] = $row;
        }

        //total cnt
        $this->sql_cnt_common[] = "SELECT COUNT(*) AS cnt FROM pave_guide_group AS grp";
        $this->sql_cnt_where[] = $this->sql_where;
        $this->generate_cnt_sql();
        $this->list_cnt = pave_fetch($this->sql_cnt)["cnt"];

        return $this->list;
    }

    public function get_guide_group($guide_group_id){
        if(!$guide_group_id){
            return false;
        }

        $this->set_guide_group_display(null);
        $this->set_guide_group_id($guide_group_id);
        return $this->get_guide_group_list()[0];
    }

    public function get_guide_bo_list(){
        $this->generate_sql_init();
        $this->sql_common[] = "SELECT bo.*, grp.guide_group_name, grp.guide_group_order FROM pave_guide_bo AS bo";
        $this->sql_common[] = "LEFT JOIN pave_guide_group AS grp ON(bo.guide_group_id = grp.guide_group_id)";
        $this->sql_where[] = "WHERE 1 = 1";


        if($this->guide_bo_display !== null){
            $this->sql_where[] = "bo.guide_bo_display = '{$this->guide_bo_display}'";
        }

        if($this->guide_group_id){
            $this->sql_where[] = "bo.guide_group_id = '{$this->guide_group_id}'";
        }
        
        if($this->guide_bo_id){
            $this->sql_where[] = "bo.guide_bo_id = '{$this->guide_bo_id}'";
        }

        $this->sql_order = "ORDER BY grp.guide_group_order, bo.guide_bo_order";

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $this->sql_limit = "LIMIT {$from}, {$to} ";
        }

        $this->generate_sql();

        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
            if($row["guide_bo_display"]){
                $row["guide_bo_display_text"] = "공개";
            }else{
                $row["guide_bo_display_text"] = "미공개";
            }
            $this->list[] = $row;
        }

         //total cnt
         $this->sql_cnt_common[] = "SELECT COUNT(*) AS cnt FROM pave_guide_bo AS bo";
         $this->sql_cnt_where[] = $this->sql_where;
         $this->generate_cnt_sql();
         $this->list_cnt = pave_fetch($this->sql_cnt)["cnt"];

         return $this->list;
    }

    
    public function get_guide_bo($guide_bo_id){
        if(!$guide_bo_id){
            return false;
        }

        $this->set_guide_bo_display(null);
        $this->set_guide_bo_id($guide_bo_id);
        return $this->get_guide_bo_list()[0];
    }

    public function get_guide_bd_list(){
        $this->generate_sql_init();
        $this->sql_common[] = "SELECT bd.*, grp.guide_group_name, grp.guide_group_order, bo.guide_bo_name, bo.guide_bo_order FROM pave_guide_bd AS bd";
        $this->sql_common[] = "LEFT JOIN pave_guide_group AS grp ON(bd.guide_group_id = grp.guide_group_id)";
        $this->sql_common[] = "LEFT JOIN pave_guide_bo AS bo ON(bd.guide_group_id = bo.guide_group_id AND bd.guide_bo_id = bo.guide_bo_id)";
        $this->sql_where[] = "WHERE 1 = 1";

        
        if($this->guide_bd_display !== null){
            $this->sql_where[] = "bd.guide_bd_display = '{$this->guide_bd_display}'";
        }

        if($this->guide_group_id){
            $this->sql_where[] = "bd.guide_group_id = '{$this->guide_group_id}'";
        }
        
        if($this->guide_bo_id){
            $this->sql_where[] = "bd.guide_bo_id = '{$this->guide_bo_id}'";
        }
        
        if($this->guide_bd_id){
            $this->sql_where[] = "bd.guide_bd_id = '{$this->guide_bd_id}'";
        }
        if($this->guide_keyword){
          /*   $where = array();
            $where[] = "(JSON_EXTRACT(guide_bd_content, '$[*].link.title') LIKE UPPER('%{$this->guide_keyword}%')"; 
            $where[] = "JSON_EXTRACT(guide_bd_content, '$[*].title') LIKE UPPER('%{$this->guide_keyword}%')"; 
            $where[] = "JSON_EXTRACT(guide_bd_content, '$[*].content[*].link.title') LIKE UPPER('%{$this->guide_keyword}%')"; 
            $where[] = "JSON_EXTRACT(guide_bd_content, '$[*].content[*].content') LIKE UPPER('%{$this->guide_keyword}%')"; 
            $where[] = "JSON_EXTRACT(guide_bd_content, '$[*].content[*].step[*].title') LIKE UPPER('%{$this->guide_keyword}%')";
            $where[] = "JSON_EXTRACT(guide_bd_content, '$[*].content[*].step[*].content') LIKE UPPER('%{$this->guide_keyword}%')";
            $where[] = "JSON_EXTRACT(guide_bd_content, '$[*].description') LIKE UPPER('%{$this->guide_keyword}%'))";
            
            $where = pave_implode($where, " OR ");
            $this->sql_where[] = $where; */
        }

        $this->sql_order = "ORDER BY grp.guide_group_order,bo.guide_bo_order, bd.guide_bd_order";

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $this->sql_limit = "LIMIT {$from}, {$to} ";
        }

        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result) ; $i++) {
            if($row["guide_bd_display"]){
                $row["guide_bd_display_text"] = "공개";
            }else{
                $row["guide_bd_display_text"] = "미공개";
            } 
            $row["guide_bd_content_list"] = json_decode($row["guide_bd_content"], true);
            $this->list[] = $row;
        }

         //total cnt
         $this->sql_cnt_common[] = "SELECT COUNT(*) AS cnt FROM pave_guide_bd AS bd";
         $this->sql_cnt_where[] = $this->sql_where;
         $this->generate_cnt_sql();
         $this->list_cnt = pave_fetch($this->sql_cnt)["cnt"];

         return $this->list;
    }

    public function get_guide_bd($guide_bd_id){
        if(!$guide_bd_id){
            return false;
        }

        $this->set_guide_bd_display(null);
        $this->set_guide_bd_id($guide_bd_id);
        return $this->get_guide_bd_list()[0];
    }

}
?>