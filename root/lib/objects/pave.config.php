<?php
if (!defined('_PAVE_')) exit;
class Config{
   
    function __construct() {
    }
    function get_config(){
        $obj = new Objects2();
        $row = pave_fetch($obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf")->generate_sql());
    
        $row["pave_prohibit_word_list"] = pave_explode($row["pave_prohibit_word"], ",");
        $row["pave_slang_word_list"] = pave_explode($row["pave_slang_word"], ",");
        $row["pave_ip_list"] = pave_explode($row["pave_ip"], ",");
        return $row;
    }

     //홈페이지 사이트 설정 함수
     function get_site_list($site_group = "", $site_id = ""){
        $sql = "SELECT * FROM pave_cf_site";
    
        if($site_group){
            $sql .= " WHERE site_group = '{$site_group}'";
        }
        if($site_id){
            $sql .= " AND site_id = '{$site_id}'";
        }
    
        $sql .= " ORDER BY site_group, site_id";
    
        $result = pave_query($sql);
    
        $site = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $site[] = $row;
        }
        return $site;
    }
    
    function get_site($site_group = "", $site_id = ""){
        return $this->get_site_list($site_group, $site_id)[0];
    }

    public function get_user_config(){
        $obj = new Objects2();
        $row = pave_fetch($obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_user")->generate_sql());
        $row["user_field_list"] = pave_explode($row["user_field"], ",");
        $row["user_genre_list"] = pave_explode($row["user_genre"], ",");
        $row["user_bank_list"] = json_decode($row["user_bank"], true);
        $row["user_rel_list"] = pave_explode($row["user_rel"], ",");
        return $row;
    }
    
    
    public function get_sns_config(){
        $obj = new Objects2();
        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_sns ORDER BY sns_order");
    
        $result = pave_query($obj->generate_sql());
        $sns_config = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $row["sns_real_name"] = strtoupper(substr($row["sns_name"],0,1)).substr($row["sns_name"],1);
            $sns_config[] = $row;
        }
        return $sns_config;
    }
    

    public function get_file_config_list($file_id = ""){
        $obj = new Objects2();
        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_file");
    
        if($file_id){
            $obj->set_sql_where("file_id = '{$file_id}'");
        }

        $result = pave_query($obj->generate_sql());
    
        $file_config = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $row["is_multiple"] = $row["file_cnt"] > 0 ? true : false;
            $row["file_ext_list"] = pave_explode($row["file_ext"], ",");
            $row["file_type_list"] = pave_explode($row["file_type"], ",");
            if($row["file_id"] == "epsd_copy"){
                $row["file_id_text"] = "회차원고";
            }else if($row["file_id"] == "epsd_img"){
                $row["file_id_text"] = "회차 이미지";
            }else if($row["file_id"] == "user_img"){
                $row["file_id_text"] = "프로필 이미지";
            }else if($row["file_id"] == "work_img"){
                $row["file_id_text"] = "작품 이미지";
            }
            $file_config[] = $row;
        }
        return $file_config;
    }

    //파일 설정 함수
    public function get_file_config($file_id = ""){
        if(!$file_id){
            return array();
        }
        return $this->get_file_config_list($file_id)[0];
    }

     //본인인증 설정 함수
     public function get_cert_config(){
        $obj = new Objects2();
        $row = pave_fetch($obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_cert")->generate_sql());
        $row["cert_type_list"] = pave_explode($row["cert_type"], ",");

        return $row;
    }

    public function get_work_config_list($work_grp_id){
        $obj = new Objects2();

        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_work");
        
        if($work_grp_id){
            $obj->set_sql_where("work_grp_id = '{$work_grp_id}'");
        }

        $result = pave_query($obj->generate_sql());
    
        $work_config = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $row["work_genre_list"] = pave_explode($row["work_genre"], ",") ;
            $row["work_day_list"] = pave_explode($row["work_day"], ",") ;
            $row["work_time_list"] = pave_explode($row["work_time"], ",") ;
            $row["work_age_list"] = pave_explode($row["work_age"], ",") ;
            $work_config[] = $row;
        }
        return $work_config;
    }

    public function get_work_config($work_grp_id){
        if(!$work_grp_id){
            return array();
        }
        return $this->get_work_config_list($work_grp_id)[0];
    }

    public function get_epsd_config_list($epsd_cate){
        $obj = new Objects2();

        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_epsd");
        
        if($epsd_cate){
            $obj->set_sql_where("epsd_cate = '{$epsd_cate}'");
        }

        $result = pave_query($obj->generate_sql());
    
        $epsd_config = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            if($row["epsd_cate"] == "epsd"){
                $row["epsd_cate_text"] = "연재";
            }else if($row["epsd_cate"] == "notice"){
                $row["epsd_cate_text"] = "공지";
            }else if($row["epsd_cate"] == "rest"){
                $row["epsd_cate_text"] = "휴재";
            }
            $row["epsd_no_type_list"] = pave_explode($row["epsd_no_type"], ",") ;
            $epsd_config[] = $row;
        }
        return $epsd_config;
    }

    public function get_epsd_config($epsd_cate){
        return $this->get_epsd_config_list($epsd_cate)[0];
    }

    public function get_comment_config_list($comment_id){
        $obj = new Objects2();

        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_comment");
        
        if($comment_id){
            $obj->set_sql_where("comment_id = '{$comment_id}'");
        }

        $result = pave_query($obj->generate_sql());
    
        $epsd_config = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $epsd_config[] = $row;
        }
        return $epsd_config;
    }

    public function get_comment_config($comment_id){
        return $this->get_comment_config_list($comment_id)[0];
    }


    public function get_sight_config_list($sight_grp_id){
        $obj = new Objects2();

        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_sight");
        
        if($sight_grp_id){
            $obj->set_sql_where("sight_grp_id = '{$sight_grp_id}'");
        }

        $result = pave_query($obj->generate_sql());
    
        $sight_config = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $row["sight_genre_list"] = pave_explode($row["sight_genre"], ",") ;
            $row["sight_age_list"] = pave_explode($row["sight_age"], ",") ;
            $sight_config[] = $row;
        }
        return $sight_config;
    }

    public function get_sight_config($sight_grp_id){
        if(!$sight_grp_id){
            return array();
        }
        return $this->get_sight_config_list($sight_grp_id)[0];
    }

    public function get_pay_config(){
        $obj = new Objects2();

        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_pay");

        $row = pave_fetch($obj->generate_sql());

        $row["pay_rent_expire_dt"] = date('Y-m-d H:i:s', strtotime("+ {$row["pay_rent_expire_no"]} {$row["pay_rent_expire_unit"]}", PAVE_TIME));
        $row["pay_cancel_reason_list"] = json_decode($row["pay_cancel_reason"], true);
        usort($row["pay_cancel_reason_list"], function ($item1, $item2) {
            return $item1["cancel_order"] <=> $item2["cancel_order"];
        });

        return $row;
    }

    public function get_charge_config(){
        $obj = new Objects2();

        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_charge");
        $row = pave_fetch($obj->generate_sql());
        $row["charge_payment_expire_dt"] = date('Y-m-d H:i:s', strtotime("+{$row["charge_payment_expire_no"]} {$row["charge_payment_expire_unit"]}", PAVE_TIME));

        return $row;
    }

    public function get_payment_config(){
        $obj = new Objects2();

        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_payment");
        $row = pave_fetch($obj->generate_sql());
        $row["payment_virtual_expire_dt"] = date('Y-m-d\TH:i:s', strtotime("+ {$row["payment_virtual_expire_no"]} {$row["payment_virtual_expire_unit"]}", PAVE_TIME));
        $row["payment_bank_list"] = json_decode($row["payment_bank"], true);
        $row["payment_virtual_bank_list"] = json_decode($row["payment_virtual_bank"], true);
        $row["payment_card_list"] = json_decode($row["payment_card"], true);
        $row["payment_cancel_reason_list"] = json_decode($row["payment_cancel_reason"], true);
        usort($row["payment_cancel_reason_list"], function ($item1, $item2) {
            return $item1["cancel_order"] <=> $item2["cancel_order"];
        });
        $row["payment_settle_type_list"] = json_decode($row["payment_settle_type"], true);
        usort($row["payment_settle_type_list"], function ($item1, $item2) {
            return $item1["settle_order"] <=> $item2["settle_order"];
        });
        

        return $row;
    }

    public function get_commerce_config_list($commerce_id){
        $obj = new Objects2();

        $obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_commerce");
        if($commerce_id){
            $obj->set_sql_where("commerce_id = '{$commerce_id}'");
        }

        $result = pave_query($obj->generate_sql());
    
        $commerce_config = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            $commerce_config[] = $row;
        }
        return $commerce_config;
    }

    public function get_commerce_config($commerce_id){
        return $this->get_commerce_config_list($commerce_id)[0];
    }

    public function get_creation_config(){
        $obj = new Objects2();
        $row = pave_fetch($obj->generate_sql_init()->set_sql_common("SELECT * FROM pave_cf_creation")->generate_sql());
        $row["creation_ratio_list"] = pave_explode($row["creation_ratio"], ",") ;
        $row["creation_size_list"] = pave_explode($row["creation_size"], ",") ;

        return $row;
    }
}
?>