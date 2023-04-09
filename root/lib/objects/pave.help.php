<?php
if (!defined('_PAVE_')) exit;
class Help extends Objects{
    private $user = array();

    private $help_group_id;
    private $help_group_display;
    private $help_bo_id;
    private $help_bo_display;
    private $help_bd_id;
    private $help_keyword;
    private $help_bd_display;


    private $list_count = 10;
    private $nav_count = 5;
    private $page = 1;

    function __construct() {
        global $pave_user;
        $this->user = $pave_user;
    }

    function set_help_group_id($help_group_id){
        $this->help_group_id = $help_group_id;
    }

    function set_help_group_display($help_group_display){
        $this->help_group_display = $help_group_display;
    }
    
    function set_help_bo_id($help_bo_id){
        $this->help_bo_id = $help_bo_id;
    }

    function set_help_bo_display($help_bo_display){
        $this->help_bo_display = $help_bo_display;
    }
    
    function set_help_bd_id($help_bd_id){
        $this->help_bd_id = $help_bd_id;
    }
    
    function set_help_keyword($help_keyword){
        $this->help_keyword = $help_keyword;
    }
       
    function set_help_bd_display($help_bd_display){
        $this->help_bd_display = $help_bd_display;
    }
    
    public function set_help_page($help_page){
        $this->page = $help_page;
    }
    
    public function get_help_list_cnt(){
        return $this->list_cnt;
    }

    public function get_help_group_list(){
        $this->generate_sql_init();
        $this->sql_common[] = "SELECT * FROM pave_help_group AS grp";
        $this->sql_where[] = "WHERE 1=1";

        if($this->help_group_display !== null){
            $this->sql_where[] = "grp.help_group_display = '{$this->help_group_display}'";
        }

        if($this->help_group_id){
            $this->sql_where[] = "grp.help_group_id = '{$this->help_group_id}'";
        }

        $this->sql_order = "ORDER BY grp.help_group_order";

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $this->sql_limit = "LIMIT {$from}, {$to} ";
        }

        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
            if($row["help_group_display"]){
                $row["help_group_display_text"] = "공개";
            }else{
                $row["help_group_display_text"] = "미공개";
            }
            $this->list[] = $row;
        }

        //total cnt
        $this->sql_cnt_common[] = "SELECT COUNT(*) AS cnt FROM pave_help_group AS grp";
        $this->sql_cnt_where[] = $this->sql_where;
        $this->generate_cnt_sql();
        $this->list_cnt = pave_fetch($this->sql_cnt)["cnt"];

        return $this->list;
    }

    public function get_help_group($help_group_id){
        if(!$help_group_id){
            return false;
        }

        $this->set_help_group_display(null);
        $this->set_help_group_id($help_group_id);
        return $this->get_help_group_list()[0];
    }


    public function get_help_bo_list(){
        $this->generate_sql_init();
        $this->sql_common[] = "SELECT bo.*, grp.help_group_name, grp.help_group_order FROM pave_help_bo AS bo";
        $this->sql_common[] = "LEFT JOIN pave_help_group AS grp ON(bo.help_group_id = grp.help_group_id)";
        $this->sql_where[] = "WHERE 1 = 1";


        if($this->help_bo_display !== null){
            $this->sql_where[] = "bo.help_bo_display = '{$this->help_bo_display}'";
        }

        if($this->help_group_id){
            $this->sql_where[] = "bo.help_group_id = '{$this->help_group_id}'";
        }
        
        if($this->help_bo_id){
            $this->sql_where[] = "bo.help_bo_id = '{$this->help_bo_id}'";
        }

        $this->sql_order = "ORDER BY grp.help_group_order, bo.help_bo_order";

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $this->sql_limit = "LIMIT {$from}, {$to} ";
        }

        $this->generate_sql();

        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
            if($row["help_bo_display"]){
                $row["help_bo_display_text"] = "공개";
            }else{
                $row["help_bo_display_text"] = "미공개";
            }
            $this->list[] = $row;
        }

         //total cnt
         $this->sql_cnt_common[] = "SELECT COUNT(*) AS cnt FROM pave_help_bo AS bo";
         $this->sql_cnt_where[] = $this->sql_where;
         $this->generate_cnt_sql();
         $this->list_cnt = pave_fetch($this->sql_cnt)["cnt"];

         return $this->list;
    }

    public function get_help_bo($help_bo_id){
        if(!$help_bo_id){
            return false;
        }

        $this->set_help_bo_display(null);
        $this->set_help_bo_id($help_bo_id);
        return $this->get_help_bo_list()[0];
    }

    public function get_help_bd_list(){
        $this->generate_sql_init();
        $this->sql_common[] = "SELECT bd.*, grp.help_group_name, grp.help_group_order, bo.help_bo_name, bo.help_bo_order FROM pave_help_bd AS bd";
        $this->sql_common[] = "LEFT JOIN pave_help_group AS grp ON(bd.help_group_id = grp.help_group_id)";
        $this->sql_common[] = "LEFT JOIN pave_help_bo AS bo ON(bd.help_group_id = bo.help_group_id AND bd.help_bo_id = bo.help_bo_id)";
        $this->sql_where[] = "WHERE 1 = 1";

        
        if($this->help_bd_display !== null){
            $this->sql_where[] = "bd.help_bd_display = '{$this->help_bd_display}'";
        }

        if($this->help_group_id){
            $this->sql_where[] = "bd.help_group_id = '{$this->help_group_id}'";
        }
        
        if($this->help_bo_id){
            $this->sql_where[] = "bd.help_bo_id = '{$this->help_bo_id}'";
        }
        
        if($this->help_bd_id){
            $this->sql_where[] = "bd.help_bd_id = '{$this->help_bd_id}'";
        }
        if($this->help_keyword){
            $where = array();
            $where[] = "(JSON_EXTRACT(help_bd_content, '$[*].link.title') LIKE UPPER('%{$this->help_keyword}%')"; 
            $where[] = "JSON_EXTRACT(help_bd_content, '$[*].title') LIKE UPPER('%{$this->help_keyword}%')"; 
            $where[] = "JSON_EXTRACT(help_bd_content, '$[*].content[*].link.title') LIKE UPPER('%{$this->help_keyword}%')"; 
            $where[] = "JSON_EXTRACT(help_bd_content, '$[*].content[*].content') LIKE UPPER('%{$this->help_keyword}%')"; 
            $where[] = "JSON_EXTRACT(help_bd_content, '$[*].content[*].step[*].title') LIKE UPPER('%{$this->help_keyword}%')";
            $where[] = "JSON_EXTRACT(help_bd_content, '$[*].content[*].step[*].content') LIKE UPPER('%{$this->help_keyword}%')";
            $where[] = "JSON_EXTRACT(help_bd_content, '$[*].description') LIKE UPPER('%{$this->help_keyword}%'))";
            
            $where = pave_implode($where, " OR ");
            $this->sql_where[] = $where;
        }

        $this->sql_order = "ORDER BY grp.help_group_order,bo.help_bo_order, bd.help_bd_order";

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $this->sql_limit = "LIMIT {$from}, {$to} ";
        }

        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result) ; $i++) {
            if($row["help_bd_display"]){
                $row["help_bd_display_text"] = "공개";
            }else{
                $row["help_bd_display_text"] = "미공개";
            } 
            $row["help_bd_content_list"] = json_decode($row["help_bd_content"], true);
            $this->list[] = $row;
        }

         //total cnt
         $this->sql_cnt_common[] = "SELECT COUNT(*) AS cnt FROM pave_help_bd AS bd";
         $this->sql_cnt_where[] = $this->sql_where;
         $this->generate_cnt_sql();
         $this->list_cnt = pave_fetch($this->sql_cnt)["cnt"];

         return $this->list;
    }

    public function get_help_bd($help_bd_id){
        if(!$help_bd_id){
            return false;
        }

        $this->set_help_bd_display(null);
        $this->set_help_bd_id($help_bd_id);
        return $this->get_help_bd_list()[0];
    }

}
?>