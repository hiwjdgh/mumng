<?php
if (!defined('_PAVE_')) exit;

class W extends Objects{
    private $user = array();
    private static $webtoon_cf;
    private static $novel_cf;
    private $work_id;
    private $work_user_id;
    private $work_name;
    private $work_day;
    private $work_state;
    private $work_genre;
    private $work_hashtag;
    private $work_full_hashtag;
    private $work_age;
    private $work_type;
    private $work_order;
    private $work_grp_id;
    private $work_pay_type;
    private $work_display = 1;
    private $work_epsd_cnt = null;
    private $work_upload_cnt = null;
    private $work_rest_cnt = null;
    private $work_reserve_cnt = null;
    private $work_notice_cnt = null;
    private $work_delay_cnt = null;
    private $work_append = array();



    private $list_count = 10;
    private $nav_count = 5;
    private $page = 1;


    private $work_user;
    private $work_with_user;
    private $work_total;

    function __construct() {
        global $pave_user;
        $this->user = $pave_user;

        self::$webtoon_cf = self::work_cf("webtoon");
    }

    public static function get_work_cf_list($work_grp_id = ""){
        $sql = "SELECT * FROM pave_cf_work";

        if($work_grp_id){
            $sql .= " WHERE work_grp_id = '{$work_grp_id}'";
        }
        $result = pave_query($sql);

        $work_cf = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $row["work_genre_list"] = pave_explode($row["work_genre"], ",") ;
            $row["work_day_list"] = pave_explode($row["work_day"], ",") ;
            $row["work_time_list"] = pave_explode($row["work_time"], ",") ;
            $row["work_age_list"] = pave_explode($row["work_age"], ",") ;

            $work_cf[] = $row;
        }

        return $work_cf;
    }

    public static function work_cf($work_grp_id){
        return self::get_work_cf_list($work_grp_id)[0];
    }

    public function set_work_id($work_id){
        $this->work_id = $work_id;
    }

    public function set_work_user_id($work_user_id = ""){
        $this->work_user_id = $work_user_id; 
    }

    public function set_work_name($work_name = ""){
        $this->work_name = $work_name; 
    }

    public function set_work_day($work_day = PAVE_SHORT_YOIL){
        $this->work_day = $work_day;
    }

    public function set_work_state($work_state = array("publish", "stop")){
        $this->work_state = $work_state;
    }

    public function set_work_genre($work_genre = ""){
        $this->work_genre = $work_genre;
    }

    public function set_work_type($work_type = ""){
        $this->work_type = $work_type;
    }

    public function set_work_hashtag($work_hashtag = ""){
        $this->work_hashtag = $work_hashtag;
    }

    public function set_work_full_hashtag($work_full_hashtag = ""){
        $this->work_full_hashtag = $work_full_hashtag;
    }

    public function set_work_age($work_age = array("전체", "12세", "15세")){
        $this->work_age = $work_age;
    }

    public function set_work_display($work_display){
        $this->work_display = $work_display;
    }

    public function set_work_epsd_cnt($work_epsd_cnt){
        $this->work_epsd_cnt = $work_epsd_cnt;
    }

    public function set_work_upload_cnt($work_upload_cnt){
        $this->work_upload_cnt = $work_upload_cnt;
    }

    public function set_work_rest_cnt($work_rest_cnt){
        $this->work_rest_cnt = $work_rest_cnt;
    }

    public function set_work_reserve_cnt($work_reserve_cnt){
        $this->work_reserve_cnt = $work_reserve_cnt;
    }

    public function set_work_notice_cnt($work_notice_cnt){
        $this->work_notice_cnt = $work_notice_cnt;
    }

    public function set_work_delay_cnt($work_delay_cnt){
        $this->work_delay_cnt = $work_delay_cnt;
    }

    public function set_work_order($work_order = "update"){
        // update 업데이트순
        // like 좋아요순
        // hit 조회순
        // latest 신작순
        // search_name  이름찾기순
        // search_hashtag  해시태그찾기순
        // recommand 추천순
        $this->work_order = $work_order;
    }

    public function set_work_grp_id($work_grp_id = "webtoon"){
        $this->work_grp_id = $work_grp_id;

    }

    public function set_work_page($page = 1){
        $this->page = $page;
    }

    public function set_work_pay_type($work_pay_type = array("rent" , "preview" , "preview2")){
        $this->work_pay_type = $work_pay_type;
    }

    public function set_work_append($work_append){
        $this->work_append[] = $work_append;
    }

    public function set_work_list_count($list_count){
        $this->list_count = $list_count;
    }


    public function get_work_user($user_id){
        $sql = array();
        $sql[] = "SELECT user.user_id, user.user_code, user.user_field, user.user_nick, user.user_img, user.user_commerce, user.user_grd, IF(ISNULL(follow.user_follow_no), false , true) AS is_follow";
        $sql[] = "FROM pave_user AS user";
        $sql[] = "LEFT JOIN pave_user_follow AS follow ON (follow.user_follow_from = '{$this->user["user_no"]}' AND user.user_no = follow.user_follow_to)";
        $sql[] = "WHERE user_id = '{$user_id}'";
        $sql = pave_implode($sql, " ");
        $this->work_user = pave_fetch($sql);

        //팔로우 노출 여부
        $this->work_user["is_follow_display"] = true;
        if($this->work_user["user_id"] == $this->user["user_id"]){
            $this->work_user["is_follow_display"] = false;
        }
        $this->work_user["user_page_url"] = get_url(PAVE_PAGE_URL, $this->work_user["user_code"]);
        return $this->work_user;
    }

    public function get_work_with_user($work_with){
        if(!$work_with){
            return array();
        }

        $tmp_work_with = str_replace(",", "' , '", $work_with);

        $sql = array();
        $sql[] = "SELECT user.user_id, user.user_code, user.user_field, user.user_nick, user.user_img, user.user_commerce, user.user_grd, IF(ISNULL(follow.user_follow_no), false , true) AS is_follow";
        $sql[] = "FROM pave_user AS user";
        $sql[] = "LEFT JOIN pave_user_follow AS follow ON (follow.user_follow_from = '{$this->user["user_no"]}' AND user.user_no = follow.user_follow_to)";
        $sql[] = "WHERE user_id IN('{$tmp_work_with}')";
        $sql = pave_implode($sql, " ");

        $result = pave_query($sql);
        for ($j=0; $row = pave_fetch_assoc($result); $j++) { 
            //팔로우 노출 여부
            $row["is_follow_display"] = true;
            if($row["user_id"] == $this->user["user_id"]){
                $row["is_follow_display"] = false;
            }

            $row["user_page_url"] = get_url(PAVE_PAGE_URL, $row["user_code"]);

            $this->work_with_user[] = $row;
        }

        return $this->work_with_user;
    }

    public function get_work_total($work_id){
        $sql = array();
        $sql[] = "SELECT SUM(epsd_like) AS total_like, SUM(epsd_hit) AS total_hit, SUM(epsd_cmt) AS total_cmt, COUNT(*) AS total_upload FROM pave_epsd";

        if($this->work_user["user_commerce"]){
            $sql[] = "WHERE work_id = '{$work_id}' AND epsd_cate = 'epsd' AND epsd_state IN ('reserve', 'success')";
        }else{
            $sql[] = "WHERE work_id = '{$work_id}' AND epsd_cate = 'epsd' AND epsd_state IN ('success')";
        }
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        $sql2 = array();
        $sql2[] = "SELECT COUNT(*) AS total_subscribe FROM pave_subscribe WHERE work_id = '{$work_id}'";
        $sql2 = pave_implode($sql2, " ");
        $row2 = pave_fetch($sql2);

        $this->work_total = array_merge($row, $row2);

        return $this->work_total;
    }

    public function get_work_first_epsd($work_id){
        $sql = array();
        $sql[] = "SELECT epsd_id FROM pave_epsd";

        if($this->work_user["user_commerce"]){
            $sql[] = "WHERE work_id = '{$work_id}' AND epsd_cate = 'epsd' AND epsd_state IN ('reserve', 'success') LIMIT 1";
        }else{
            $sql[] = "WHERE work_id = '{$work_id}' AND epsd_cate = 'epsd' AND epsd_state IN ('success') LIMIT 1";
        }

        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        return $row["epsd_id"];
    }

    public function is_work_subscribe($work_id){
        $sql = array();
        $sql[] = "SELECT EXISTS (SELECT 1 FROM pave_subscribe WHERE user_no = '{$this->user["user_no"]}' AND work_id = '{$work_id}') AS exist";
        $sql = pave_implode($sql, " ");
        $row = pave_fetch($sql);

        return $row["exist"] ? true : false;
    }

    public function get_work_list_cnt(){
        return $this->list_cnt;
    }

    public function get_work($work_id){
        if(!$work_id){
            return false;
        }

        $this->set_work_id($work_id);
        $this->get_work_list();
        
        return $this->list[0];
    }

    public function get_share_link($work){
        if(!$work["work_id"]){
            return null;
        }

        try{
            if(!class_exists("Share")){
                throw new Exception("공유 라이브러리가 없습니다.");
            }
            $share_obj = new Share();
        }catch(Exception $e){
            return null;
        }

        return $share_obj->get_work_share_link($work);
    }

    function get_work_list(){
        $this->generate_sql_init();

        $this->sql_common[] = "SELECT work.* FROM pave_work AS work";
        $this->sql_where[] = "WHERE 1=1";

        if($this->work_display !== null){
            $this->sql_where[] = "work.work_display = '{$this->work_display}'";
        }

        if($this->work_epsd_cnt !== null){
            $this->sql_where[] = "work.work_epsd_cnt > '{$this->work_epsd_cnt}'";
        }

        if($this->work_upload_cnt !== null){
            $this->sql_where[] = "work.work_upload_cnt > '{$this->work_upload_cnt}'";
        }

        if($this->work_rest_cnt !== null){
            $this->sql_where[] = "work.work_rest_cnt > '{$this->work_rest_cnt}'";
        }

        if($this->work_reserve_cnt !== null){
            $this->sql_where[] = "work.work_reserve_cnt > '{$this->work_reserve_cnt}'";
        }

        if($this->work_notice_cnt !== null){
            $this->sql_where[] = "work.work_notice_cnt > '{$this->work_notice_cnt}'";
        }

        if($this->work_delay_cnt !== null){
            $this->sql_where[] = "work.work_delay_cnt > '{$this->work_delay_cnt}'";
        }
        
        if($this->work_id){
            $this->sql_where[] = "work.work_id= '{$this->work_id}'";
        }  

        if($this->work_type == ""){
            if($this->work_id){
                $this->sql_where[] = "work.work_id= '{$this->work_id}'";
            }
        }else{
            if($this->work_id){
                $this->sql_where[] = "work.work_id= '{$this->work_id}'";
            }else{
                if($this->work_type == "subscribe"){
                    $sql = "SELECT GROUP_CONCAT(QUOTE(work_id)) AS work_id FROM pave_subscribe WHERE user_no = '{$this->user["user_no"]}'";
                    $row = pave_fetch($sql);

                    if($row["work_id"]){
                        $this->sql_where[] = "work.work_id IN ({$row["work_id"]})";
                    }else{
                        $this->sql_where[] = "work.work_id= ''";
                    }
                }else if($this->work_type == "follow"){
                    $sql = "SELECT GROUP_CONCAT(QUOTE(work_id)) AS work_id FROM pave_work WHERE user_no IN (SELECT user_follow_to FROM pave_user_follow WHERE user_follow_from = '{$this->user["user_no"]}')";
                    $row = pave_fetch($sql);

                    if($row["work_id"]){
                        $this->sql_where[] = "work.work_id IN ({$row["work_id"]})";
                    }else{
                        $this->sql_where[] = "work.work_id= ''";
                    }
                }
            }
        }

        if($this->work_grp_id){
            $this->sql_where[] = "work.work_grp_id= '{$this->work_grp_id}'";
        }

        if($this->work_state){
            $this->sql_where[] = "work.work_state IN ('".pave_implode($this->work_state, "','")."')";
        }

        if($this->work_user_id){
            $this->sql_where[] = "(work.user_id = '{$this->work_user_id}' OR FIND_IN_SET('{$this->work_user_id}', work.work_with))";
        }

        if($this->work_day){
            $this->sql_where[] = "work.work_day LIKE '%{$this->work_day}%'";
        }

        if($this->work_genre){
            $this->sql_where[] = "work.work_genre LIKE '%{$this->work_genre}%'";
        }

        if($this->work_hashtag){
            $this->sql_where[] = "work.work_hashtag LIKE '%{$this->work_hashtag}%'";
        }

        if($this->work_full_hashtag){
            $this->sql_where[] = "CONCAT(work.work_genre, ',', work.work_hashtag) LIKE '%{$this->work_full_hashtag}%'";
        }

        if($this->work_age){
            $this->sql_where[] = "work.work_age IN ('".pave_implode($this->work_age, "','")."')";
        }

        if($this->work_name){
            $work_name_arr = pave_explode($this->work_name, " ");
            $tmp_work_name = pave_implode($work_name_arr, "%' OR work.work_name LIKE '%");
            $this->sql_where[] = "(work.work_name LIKE '%{$tmp_work_name}%')";
        }

        if($this->work_append){
            $this->sql_where[] = pave_implode($this->work_append, " AND ");
        }

        if($this->work_order == "update"){
            $this->sql_order = "ORDER BY DATE(work_update_dt) DESC,
            CASE 
            WHEN HOUR(work_update_dt) = HOUR(NOW()) AND MINUTE(work_update_dt) = 0 THEN 0 
            WHEN HOUR(work_update_dt) = HOUR(NOW()) AND MINUTE(work_update_dt) > 0 THEN 1
            WHEN HOUR(work_update_dt) < HOUR(NOW()) AND MINUTE(work_update_dt) = 0 THEN 2
            WHEN HOUR(work_update_dt) < HOUR(NOW()) AND MINUTE(work_update_dt) > 0 THEN 3
            ELSE 4
            END, HOUR(work_update_dt) DESC, MINUTE(work_update_dt), work.work_start_dt";
            //현재시간대 연재
            //현재시간대 지각
            //이전시간대 연재
            //이전시간대 지각
        }else if($this->work_order == "search_name"){
            $this->sql_order = "ORDER BY work.work_name LIKE '{$work_name_arr[0]}%' DESC,ifnull(nullif(instr(work.work_name, ' {$work_name_arr[0]}'), 0), 99999), ifnull(nullif(instr(work.work_name, '{$work_name_arr[0]}'), 0), 99999), work.work_name";
        }else if($this->work_order == "search_hashtag"){
            $this->sql_order = "ORDER BY work.work_full_hashtag LIKE '{$this->work_full_hashtag}%' DESC,ifnull(nullif(instr(work.work_full_hashtag, ' {$this->work_full_hashtag}'), 0), 99999), ifnull(nullif(instr(work.work_full_hashtag, '{$this->work_full_hashtag}'), 0), 99999), work.work_name";
        }else if($this->work_order == "recommand"){
            //todo
            $this->sql_order = "ORDER BY work.work_update_dt DESC, work.work_start_dt";
        }

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $this->sql_limit = "LIMIT {$from}, {$to} ";
        }

        $this->generate_sql();
        $result = pave_query($this->sql);
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            ///성인물 차단 여부
            $row["is_block"] = false;
            if($row["work_age"] == "19세"){
                if($this->user["user_adult_content"] || !$this->user["user_adult_cert_state"] || !$this->user["user_cp_cert_state"] ){
                    $row["is_block"] = true;
                }
            }

            //소유 여부
            $row["is_own"] = false;
            if(($row["user_id"] == $this->user["user_id"])){
                $row["is_own"] = true;
            }

            //함께한 작가 여부            
            $row["is_with"] = false;
            if(in_array($this->user["user_id"], pave_explode($row["work_with"], ","))){
                $row["is_with"] = true;
            }
          
            //업로드 여부
            $row["is_upload"] = false;
            if(date("W", PAVE_TIME) == date("W", strtotime($row["work_update_dt"]))){
                $row["is_upload"] = true;
            }

            //신작 여부
            if($row["work_grp_id"] == "webtoon"){
                $time_elapsed = strtotime($row["work_start_dt"]. " + ".self::$webtoon_cf["work_new_day_no"]." ".self::$webtoon_cf["work_new_day_unit"]) - PAVE_TIME;
            }else{
                $time_elapsed = -1;
            }
            $row["is_new"] = false;
            if($time_elapsed > 0){
                $row["is_new"] = true;
            }

            //구독 여부
            $row["is_subscribe"] = $this->is_work_subscribe($row["work_id"]);
            
            //대표 작가
            $row["work_user"] = $this->get_work_user($row["user_id"]);

            //함께한 작가
            $row["work_with_user"] = $this->get_work_with_user($row["work_with"]);

            //작품 통계
            $row["work_total"] = $this->get_work_total($row["work_id"]);

            //작품 첫 회차
            $row["work_first_epsd"] = $this->get_work_first_epsd($row["work_id"]);


            //작품 공유 링크
            $row["work_share_link"] = $this->get_share_link($row);
            $row["work_url"] = get_url(PAVE_WORK_URL, "detail/{$row["work_id"]}");

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
            
            //줄거리 더보기 여부
            $row["is_readmore"] = false;
            if (mb_strlen($row["work_description"], "UTF-8") > 50) {
                $row["is_readmore"] = true;
            }

            //text
            
            $row["work_description_text"] = mb_substr($row["work_description"], 0, 50, "UTF-8");
            $row["work_day_text"] = str_replace(",", " ",   $row["work_day"]);
            $row["work_day_list"] = pave_explode($row["work_day"], ",");
            $row["work_genre_list"] = pave_explode($row["work_genre"], ",");
            $row["work_hashtag_list"] = pave_explode($row["work_hashtag"], ",");
          
            $this->list[] = $this->sanitize_work($row);
        }

        //total cnt
        $this->sql_cnt_common[] = "SELECT COUNT(*) AS cnt FROM pave_work AS work";
        $this->sql_cnt_where[] = $this->sql_where;
        $this->generate_cnt_sql();
        $this->list_cnt = pave_fetch($this->sql_cnt)["cnt"];

        return $this->list;
    }

    public function init_meta($work){
        global $pave_meta;
        $pave_meta["title2"] = $work["work_name"];
        $pave_meta["url"] = $work["work_url"];
        $pave_meta["description"] = $work["work_description"]?:$pave_meta["description"];
        $pave_meta["img"] = $work["work_img"]?:$pave_meta["img"];
        $pave_meta["keyword"] = $work["work_full_hashtag"]?:$pave_meta["keyword"];
    }

    private function sanitize_work($work){
        unset($work["user_id"]);
        unset($work["work_with"]);
        unset($work["work_insert_ip"]);
        unset($work["work_update_ip"]);

        return $work;
    }
}