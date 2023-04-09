<?php
if (!defined('_PAVE_')) exit;
class Work{
    private $work_id;
    private $user_no;
    private $work_grp_id;
    private $work_type;
    private $work_day;
    private $work_display;
    private $work_name;
    private $work_age;
    private $work_genre;
    private $work_free;
    private $work_hashtag;
    private $work_state;
    private $work_epsd_cnt;
    private $work_notice_cnt;
    private $work_rest_cnt;
    private $work_upload_cnt;
    private $work_reserve_cnt;
    private $work_delay_cnt;


    private $work_search = false;
    private $work_search_keyword;


    private $page = 1;
    private $list_count = 10;

    function __construct() {
    }

    
    public static function is_work_subscribe($user, $work){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT * FROM pave_subscribe AS subscribe")
        ->set_sql_where("subscribe.user_no = '{$user["user_no"]}'")
        ->set_sql_where("subscribe.work_id = '{$work["work_id"]}'");

        $row = pave_fetch($obj->generate_sql());

        if(!$row["subscribe_no"]){
            return false;
        }

        return $row["subscribe_no"];
    }

    public function set_work_id($work_id){
        $this->work_id = $work_id;
        
        return $this;
    }

    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    public function set_work_grp_id($work_grp_id){
        $this->work_grp_id = $work_grp_id;

        return $this;
    }

    public function set_work_type($work_type){
        $this->work_type = $work_type;

        return $this;
    }

    public function set_work_display($work_display){
        $this->work_display = $work_display;

        return $this;
    }

    public function set_work_name($work_name){
        $this->work_name = $work_name;

        return $this;
    }

    public function set_work_day($work_day){
        $this->work_day = $work_day;

        return $this;
    }

    public function set_work_state($work_state){
        $this->work_state = $work_state;

        return $this;
    }

    public function set_work_age($work_age){
        $this->work_age = $work_age;

        return $this;
    }

    public function set_work_genre($work_genre){
        $this->work_genre = $work_genre;

        return $this;
    }

    public function set_work_free($work_free){
        $this->work_free = $work_free;

        return $this;
    }

    public function set_work_epsd_cnt($work_epsd_cnt){
        $this->work_epsd_cnt = $work_epsd_cnt;

        return $this;
    }

    public function set_work_notice_cnt($work_notice_cnt){
        $this->work_notice_cnt = $work_notice_cnt;

        return $this;
    }

    public function set_work_rest_cnt($work_rest_cnt){
        $this->work_rest_cnt = $work_rest_cnt;

        return $this;
    }

    public function set_work_upload_cnt($work_upload_cnt){
        $this->work_upload_cnt = $work_upload_cnt;

        return $this;
    }

    public function set_work_reserve_cnt($work_reserve_cnt){
        $this->work_reserve_cnt = $work_reserve_cnt;

        return $this;
    }

    public function set_work_delay_cnt($work_delay_cnt){
        $this->work_delay_cnt = $work_delay_cnt;

        return $this;
    }

    public function set_work_search($work_search){
        $this->work_search = $work_search;

        return $this;
    }

    public function set_work_search_keyword($work_search_keyword){
        $this->work_search_keyword = $work_search_keyword;

        return $this;
    }

    public function set_work_page($work_page){
        $this->page = $work_page;

        return $this;
    }

    public function get_page_work_total($user){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT SUM(epsd_like) AS total_like, SUM(epsd_hit) AS total_hit, SUM(epsd_cmt) AS total_cmt, COUNT(*) AS total_upload FROM pave_epsd");


        $obj->set_sql_where("work_id IN (SELECT work_id FROM pave_work WHERE work_display = '1' AND work_epsd_cnt > '0' AND (user_no = '{$this->page_user["user_no"]}' OR FIND_IN_SET('{$this->page_user["user_id"]}', work_with)))");
        if($user["user_commerce"]){
            $obj->set_sql_where("epsd_cate = 'epsd' AND epsd_state IN ('reserve', 'success')");
        }else{
            $obj->set_sql_where("epsd_cate = 'epsd' AND epsd_state IN ('success')");
        }
        
        return pave_fetch($obj->generate_sql());
    }

    public function get_work_total($work){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT SUM(epsd_like) AS total_like, SUM(epsd_hit) AS total_hit, SUM(epsd_cmt) AS total_cmt, COUNT(*) AS total_upload FROM pave_epsd");

        if($work["work_user"]["user_commerce"]){
            $obj->set_sql_where("work_id = '{$work["work_id"]}' AND epsd_cate = 'epsd' AND epsd_state IN ('reserve', 'success')");
        }else{
            $obj->set_sql_where("work_id = '{$work["work_id"]}' AND epsd_cate = 'epsd' AND epsd_state IN ('success')");
        }
        
        return pave_fetch($obj->generate_sql());
    }

    public function get_work_first_epsd($work){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT epsd_id FROM pave_epsd");

        if($work["work_user"]["user_commerce"]){
            $obj->set_sql_where("work_id = '{$work["work_id"]}' AND epsd_cate = 'epsd' AND epsd_state IN ('reserve', 'success')");
        }else{
            $obj->set_sql_where("work_id = '{$work["work_id"]}' AND epsd_cate = 'epsd' AND epsd_state IN ('success')");
        }
        
        return pave_fetch($obj->generate_sql())["epsd_id"];
    }

    public function get_share_link($work){
        $facebook_base_url = "http://www.facebook.com/sharer/sharer.php?u={url}";
        $twitter_base_url = "http://twitter.com/share?url={url}&text={title}";
        $naver_base_url = "https://share.naver.com/web/shareView?url={url}&title={title}";
        $kakao_base_url = "https://story.kakao.com/s/share?url={url}";

        
        $share_url = get_url(PAVE_WORK_URL, "/detail/{$work["work_id"]}");
        $share_title = $work["work_name"];
    
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
 

    public function get_work_fullhashtag($work){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT * FROM pave_hashtag")
        ->set_sql_where("work_id = '{$work["work_id"]}'");
        $hashtag_list = array();
        $result = pave_query($obj->generate_sql());

        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $hashtag_list[] = $row;
        }

        return $hashtag_list;
    }

    public function get_work_user($work){
        $user_obj = new User();

        return $user_obj->set_user_no($work["user_no"])->get_user();
    }
    
    public function get_work_with_user($work){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT * FROM pave_work_with")
        ->set_sql_where("work_id = '{$work["work_id"]}'");
        $with_list = array();
        $result = pave_query($obj->generate_sql());

        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $user_obj = new User();
            $with_list[] = $user_obj->set_user_no($row["user_no"])->get_user();
        }

        return $with_list;
    }

    public function get_work_list_cnt(){
        global $pave_user;

        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_work AS works");
           
        if($this->work_id){
            $obj->set_sql_cnt_where("works.work_id = '{$this->work_id}'");
        }  
        
        if($this->work_grp_id){
            $obj->set_sql_cnt_where("works.work_grp_id = '{$this->work_grp_id}'");
        }
        
        if($this->work_type == "subscribe"){
            $obj2 = new Objects2();

            $obj2->generate_sql_init()
            ->set_sql_common("SELECT GROUP_CONCAT(QUOTE(work_id)) AS work_id FROM pave_subscribe")
            ->set_sql_where("user_no = '{$pave_user["user_no"]}'");

            $row2 = pave_fetch($obj2->generate_sql());

            $obj->set_sql_cnt_where("works.work_id IN ({$row2["work_id"]})");

        }else if($this->work_type == "follow"){
            $obj2 = new Objects2();

            $obj2->generate_sql_init()
            ->set_sql_common("SELECT GROUP_CONCAT(QUOTE(work_id)) AS work_id FROM pave_work")
            ->set_sql_where("user_no IN (SELECT following_id FROM pave_user_follow WHERE user_follow_from = '{$pave_user["user_no"]}')");

            $row2 = pave_fetch($obj2->generate_sql());

            $obj->set_sql_cnt_where("works.work_id IN ({$row2["work_id"]})");
        }

        if($this->user_no){
            $obj->set_sql_cnt_where("works.user_no = '{$this->user_no}'");
        }

        if($this->work_name){
            $obj->set_sql_cnt_where("works.work_name = '{$this->work_name}'");
        }
        
        if($this->work_day){
            $obj->set_sql_cnt_where("works.work_day LIKE '%{$this->work_day}%'");
        }

        if($this->work_genre){
            $obj->set_sql_cnt_where("works.work_genre LIKE '%{$this->work_genre}%'");
        }

        if($this->work_hashtag){
            $obj->set_sql_cnt_where("works.work_hashtag LIKE '%{$this->work_hashtag}%'");
        }

        if($this->work_age){
            if(pave_is_array($this->work_age)){
                $obj->set_sql_cnt_where("works.work_age IN ('".pave_implode($this->work_age, "','")."')");
            }else{
                $obj->set_sql_cnt_where("works.work_age = '{$this->work_age}'");
            }
        }

        if($this->work_state){
            if(pave_is_array($this->work_state)){
                $obj->set_sql_cnt_where("works.work_state IN ('".pave_implode($this->work_state, "','")."')");
            }else{
                $obj->set_sql_cnt_where("works.work_state = '{$this->work_state}'");
            }
        }

        if($this->work_free !== null){
            $obj->set_sql_cnt_where("works.work_free = '{$this->work_free}'");
        }

        if($this->work_display !== null){
            $obj->set_sql_cnt_where("works.work_display = '{$this->work_display}'");
        }

        if($this->work_epsd_cnt !== null){
            $obj->set_sql_cnt_where("works.work_epsd_cnt > '{$this->work_epsd_cnt}'");
        }
        
        if($this->work_notice_cnt !== null){
            $obj->set_sql_cnt_where("works.work_notice_cnt > '{$this->work_notice_cnt}'");
        }

        if($this->work_rest_cnt !== null){
            $obj->set_sql_cnt_where("works.work_rest_cnt > '{$this->work_rest_cnt}'");
        }

        if($this->work_upload_cnt !== null){
            $obj->set_sql_cnt_where("works.work_upload_cnt > '{$this->work_upload_cnt}'");
        }

        if($this->work_reserve_cnt !== null){
            $obj->set_sql_cnt_where("works.work_reserve_cnt > '{$this->work_reserve_cnt}'");
        }

        if($this->work_delay_cnt !== null){
            $obj->set_sql_cnt_where("works.work_delay_cnt > '{$this->work_delay_cnt}'");
        }
        
        $user_list_count = pave_fetch($obj->generate_cnt_sql())["cnt"];

        
        return $user_list_count;
    }

    public function get_work_list(){
        global $pave_user, $webtoon_config;
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT works.* FROM pave_work AS works");
           
        if($this->work_id){
            $obj->set_sql_where("works.work_id = '{$this->work_id}'");
        }  
        
        if($this->work_grp_id){
            $obj->set_sql_where("works.work_grp_id = '{$this->work_grp_id}'");
        }
        
        if($this->work_type == "subscribe"){
            $obj2 = new Objects2();

            $obj2->generate_sql_init()
            ->set_sql_common("SELECT GROUP_CONCAT(QUOTE(work_id)) AS work_id FROM pave_subscribe")
            ->set_sql_where("user_no = '{$pave_user["user_no"]}'");

            $row2 = pave_fetch($obj2->generate_sql());

            if($row2["work_id"]){
                $obj->set_sql_where("works.work_id IN ({$row2["work_id"]})");
            }

        }else if($this->work_type == "follow"){
            $obj2 = new Objects2();

            $obj2->generate_sql_init()
            ->set_sql_common("SELECT GROUP_CONCAT(QUOTE(work_id)) AS work_id FROM pave_work")
            ->set_sql_where("user_no IN (SELECT user_follow_to FROM pave_user_follow WHERE user_follow_from = '{$pave_user["user_no"]}')");

            $row2 = pave_fetch($obj2->generate_sql());
            
            if($row2["work_id"]){
                $obj->set_sql_where("works.work_id IN ({$row2["work_id"]})");
            }
        }

        if($this->user_no){
            $obj->set_sql_where("works.user_no = '{$this->user_no}'");
        }

        if($this->work_name){
            $obj->set_sql_where("works.work_name = '{$this->work_name}'");
        }
        
        if($this->work_day){
            $obj->set_sql_where("works.work_day LIKE '%{$this->work_day}%'");
        }

        if($this->work_genre){
            $obj->set_sql_where("works.work_genre LIKE '%{$this->work_genre}%'");
        }

        if($this->work_hashtag){
            $obj->set_sql_where("works.work_hashtag LIKE '%{$this->work_hashtag}%'");
        }

        if($this->work_age){
            if(pave_is_array($this->work_age)){
                $obj->set_sql_where("works.work_age IN ('".pave_implode($this->work_age, "','")."')");
            }else{
                $obj->set_sql_where("works.work_age = '{$this->work_age}'");
            }
        }

        if($this->work_state){
            if(pave_is_array($this->work_state)){
                $obj->set_sql_where("works.work_state IN ('".pave_implode($this->work_state, "','")."')");
            }else{
                $obj->set_sql_where("works.work_state = '{$this->work_state}'");
            }
        }

        if($this->work_free !== null){
            $obj->set_sql_where("works.work_free = '{$this->work_free}'");
        }

        if($this->work_display !== null){
            $obj->set_sql_where("works.work_display = '{$this->work_display}'");
        }

        if($this->work_epsd_cnt !== null){
            $obj->set_sql_where("works.work_epsd_cnt > '{$this->work_epsd_cnt}'");
        }
        
        if($this->work_notice_cnt !== null){
            $obj->set_sql_where("works.work_notice_cnt > '{$this->work_notice_cnt}'");
        }

        if($this->work_rest_cnt !== null){
            $obj->set_sql_where("works.work_rest_cnt > '{$this->work_rest_cnt}'");
        }

        if($this->work_upload_cnt !== null){
            $obj->set_sql_where("works.work_upload_cnt > '{$this->work_upload_cnt}'");
        }

        if($this->work_reserve_cnt !== null){
            $obj->set_sql_where("works.work_reserve_cnt > '{$this->work_reserve_cnt}'");
        }

        if($this->work_delay_cnt !== null){
            $obj->set_sql_where("works.work_delay_cnt > '{$this->work_delay_cnt}'");
        }

        if($this->page !== null){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }
      
     

        if($this->work_search){
            $keyword_list = pave_explode($this->work_search_keyword, " ");

            if($this->work_search == "name"){
                $obj->set_sql_order("ORDER BY works.work_name LIKE '{$keyword_list[0]}%' DESC,ifnull(nullif(instr(works.work_name, ' {$keyword_list[0]}'), 0), 99999), ifnull(nullif(instr(works.work_name, '{$keyword_list[0]}'), 0), 99999), works.work_name");
            }else if($this->work_search == "tag"){
                $obj->set_sql_order("ORDER BY works.work_full_hashtag LIKE '{$keyword_list[0]}%' DESC,ifnull(nullif(instr(works.work_full_hashtag, ' {$keyword_list[0]}'), 0), 99999), ifnull(nullif(instr(works.work_full_hashtag, '{$keyword_list[0]}'), 0), 99999), works.work_full_hashtag");
            }
            
        }else{
            $obj->set_sql_order(
            "ORDER BY DATE(work_update_dt) DESC,
            CASE 
            WHEN HOUR(work_update_dt) = HOUR(NOW()) AND MINUTE(work_update_dt) = 0 THEN 0 
            WHEN HOUR(work_update_dt) = HOUR(NOW()) AND MINUTE(work_update_dt) > 0 THEN 1
            WHEN HOUR(work_update_dt) < HOUR(NOW()) AND MINUTE(work_update_dt) = 0 THEN 2
            WHEN HOUR(work_update_dt) < HOUR(NOW()) AND MINUTE(work_update_dt) > 0 THEN 3
            ELSE 4
            END, HOUR(work_update_dt) DESC, MINUTE(work_update_dt), works.work_start_dt");
        }

        $work_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 

            ///성인물 차단 여부
            $row["is_block"] = false;
            if($row["work_age"] == "19세"){
                if($pave_user["user_adult_content"] || !$pave_user["user_adult_cert_state"] || !$pave_user["user_cp_cert_state"] ){
                    $row["is_block"] = true;
                }
            }

             //연령 이미지
            if($row["work_age"] == "전체"){
                $row["work_age_img"] = get_url(PAVE_IMG_URL,"img_age_all_960px.png");
            }else if($row["work_age"] == "12세"){
                $row["work_age_img"] = get_url(PAVE_IMG_URL,"img_age_12_960px.png");
            }else if($row["work_age"] == "15세"){
                $row["work_age_img"] = get_url(PAVE_IMG_URL,"img_age_15_960px.png");
            }else if($row["work_age"] == "19세"){
                $row["work_age_img"] = get_url(PAVE_IMG_URL,"img_age_19_960px.png");
            }
            
            
            //소유 여부
            $row["is_own"] = false;
            if(($row["user_no"] == $pave_user["user_no"])){
                $row["is_own"] = true;
            }

            //함께한 작가 여부            
            $row["is_with"] = false;
            if(in_array($pave_user["user_id"], pave_explode($row["work_with"], ","))){
                $row["is_with"] = true;
            }

             //업로드 여부
             $row["is_upload"] = false;
             if(date("W", PAVE_TIME) == date("W", strtotime($row["work_update_dt"]))){
                 $row["is_upload"] = true;
             }

              //신작 여부
            if($row["work_grp_id"] == "webtoon"){
                $time_elapsed = Converter::display_time_elapse($row["work_start_dt"]. " + ".$webtoon_config["work_new_day_no"]." ".$webtoon_config["work_new_day_unit"], PAVE_TIME_YMDHIS);
            }else{
                $time_elapsed = -1;
            }
            $row["is_new"] = false;
            if($time_elapsed > 0){
                $row["is_new"] = true;
            }
         
            
            //작품 첫 회차
            $row["work_first_epsd"] = $this->get_work_first_epsd($row);


            //작품 공유 링크
            $row["work_share_link"] = $this->get_share_link($row);
            $row["work_url"] = get_url(PAVE_WORK_URL, "detail/{$row["work_id"]}");
            //대표 작가
            $row["work_user"] = $this->get_work_user($row);

            //함께한 작가
            $row["work_with_user"] = $this->get_work_with_user($row);

            //작품 통계
            $row["work_total"] = $this->get_work_total($row);

            //구독 여부
            $row["is_subscribe"] = $this->is_work_subscribe($pave_user, $row);

            $row["work_full_hashtag_list"] = $this->get_work_fullhashtag($row);
            $row["work_day_list"] = pave_explode($row["work_day"], ",");
            $row["work_genre_list"] = pave_explode($row["work_genre"], ",");
            $row["work_hashtag_list"] = pave_explode($row["work_hashtag"], ",");

            $work_list[] = $row;
        }

        
        return $work_list;
    }

    public function get_work(){
        return $this->get_work_list()[0];
    }
}
?>