<?php
if (!defined('_PAVE_')) exit;
class Certification{

    public static function insert_cert_log($user, $cert_type, $cert_module_name){
        $cert = array(
            "user_no"                   => $user["user_no"],
            "log_cert_type"             => $cert_type,
            "log_cert_module_name"      => $cert_module_name,
            "log_cert_insert_ip"        => PAVE_USER_IP,
            "log_cert_insert_dt"        => PAVE_TIME_YMDHIS
        );
    
        pave_insert("pave_log_cert", $cert);
    }

    public static function is_cert_max($user, $cert_type){
        global $cert_config;
    
        
        $obj = new Objects2();
        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_log_cert");

        if($user["user_no"]) {
            $obj->set_sql_cnt_where("user_no = '{$user["user_no"]}'");
        } else {
            $obj->set_sql_cnt_where("log_cert_insert_ip = '".PAVE_USER_IP."'");
        }

        $obj->set_sql_cnt_where("log_cert_type = '{$cert_type}'");

        $obj->set_sql_cnt_where("date_format(log_cert_insert_dt, '%Y-%m-%d') = '".PAVE_TIME_YMD."'");

        $row = pave_fetch($obj->generate_cnt_sql());
    
        if($row["cnt"] >= $cert_config["cert_max_cnt"]){
            return "하루 최대 본인확인 횟수를 초과 하여 더 이상 이용할 수 없습니다.";
        }
    
        return "";
    }
}
?>