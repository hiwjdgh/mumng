<?php
if (!defined('_PAVE_')) exit;
class Page{

    function __construct() {
    }

    public function get_page_work_total($user){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT SUM(epsd_like) AS total_like, SUM(epsd_hit) AS total_hit, SUM(epsd_cmt) AS total_cmt, COUNT(*) AS total_upload FROM pave_epsd");


        $obj->set_sql_where("work_id IN (SELECT work_id FROM pave_work WHERE work_display = '1' AND work_epsd_cnt > '1' AND (user_id = '{$this->page_user["user_id"]}' OR FIND_IN_SET('{$this->page_user["user_id"]}', work_with)))");
        if($user["user_commerce"]){
            $obj->set_sql_where("epsd_cate = 'epsd' AND epsd_state IN ('reserve', 'success')");
        }else{
            $obj->set_sql_where("epsd_cate = 'epsd' AND epsd_state IN ('success')");
        }
        
        return pave_fetch($obj->generate_sql());
    }

    public function init_meta($user){
        global $pave_meta;

        $pave_meta["title2"] = $user["user_nick"];
        $pave_meta["url"] = $user["user_page_url"];
        $pave_meta["description"] = $user["user_introduce"]?:$pave_meta["description"];
        $pave_meta["img"] = $user["user_img"]?:$pave_meta["img"];
        $pave_meta["keyword"] = $user["user_full_hashtag"]?:$pave_meta["keyword"];
    }
}