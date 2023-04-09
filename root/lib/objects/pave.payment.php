<?php
if (!defined('_PAVE_')) exit;
class Payment{
    function __construct() {
    
    }

    public static function get_payment_config(){
        $sql = "SELECT * FROM pave_cf_payment";
        $row = pave_fetch($sql);

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

    public static function is_payment_allow_ip(){
        $allow_ip = PAVE_TOSS_IP;
        for ($i=0; $i < count($allow_ip); $i++) {
    
            if(!preg_match("/".$allow_ip[$i]."/", PAVE_USER_IP)) {
                return false;
            }
        }
    
        return true;
    }

    public static function get_payment($payment_id){
        global $payment_config;
        $curl = curl_init();

        if($payment_config["payment_toss_test"]){
            $credential = base64_encode($payment_config["payment_toss_test_secret_key"].':');
        }else{
            $credential = base64_encode($payment_config["payment_toss_secret_key"].':');
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.tosspayments.com/v1/payments/{$payment_id}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . $credential
            ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
    
        if($err) {
            return false;
        }

        return json_decode($response, true);
    }

    public static function ready_kakao_payment($receipt){
        global $payment_config;


        if($payment_config["payment_kakao_test"]){
            $payment_kakao_cid = $payment_config["payment_kakao_test_cid"];
        }else{
            $payment_kakao_cid = $payment_config["payment_kakao_cid"];
        }

        $url = 'https://kapi.kakao.com/v1/payment/ready';

        $data = array(
            "cid" => $payment_kakao_cid,
            "partner_order_id" => $receipt["rcpt_id"],
            "partner_user_id" => $receipt["user_no"],
            "item_name" => $receipt["item"]["it_name"],
            "quantity" => 1,
            "total_amount" => $receipt["item"]["it_real_price"],
            "tax_free_amount" => 0,
            "vat_amount" => $receipt["item"]["it_vat_price"],
            "approval_url" => get_url(PAVE_CHARGE_URL, "/kakaopay/success/{$receipt["rcpt_id"]}"),
            "cancel_url" => get_url(PAVE_CHARGE_URL, "/kakaopay/cancel/{$receipt["rcpt_id"]}"),
            "fail_url" => get_url(PAVE_CHARGE_URL, "/kakaopay/fail/{$receipt["rcpt_id"]}")
        );

        $curl = curl_init($url);

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                'Authorization: KakaoAK ' . $payment_config["payment_kakao_admin_key"],
                'Content-Type: application/x-www-form-urlencoded;charset=utf-8'
            ],
        ]);

        return $curl;
    }

    public static function kakao_payment($receipt, $pg_token){
        global $payment_config;

        if($payment_config["payment_kakao_test"]){
            $payment_kakao_cid = $payment_config["payment_kakao_test_cid"];
        }else{
            $payment_kakao_cid = $payment_config["payment_kakao_cid"];
        }

        $url = 'https://kapi.kakao.com/v1/payment/approve';

        $data = array(
            "cid" => $payment_kakao_cid,
            "tid" => $receipt["rcpt_payment_id"],
            "partner_order_id" => $receipt["rcpt_id"],
            "partner_user_id" => $receipt["user_no"],
            "pg_token" => $pg_token
        );

        $curl = curl_init($url);

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                'Authorization: KakaoAK ' . $payment_config["payment_kakao_admin_key"],
                'Content-Type: application/x-www-form-urlencoded;charset=utf-8'
            ],
        ]);

        return $curl;
    }

    public static function kakao_payment_cancel($receipt){
        global $payment_config;

        if($payment_config["payment_kakao_test"]){
            $payment_kakao_cid = $payment_config["payment_kakao_test_cid"];
        }else{
            $payment_kakao_cid = $payment_config["payment_kakao_cid"];
        }

        $url = 'https://kapi.kakao.com/v1/payment/cancel';

        $data = array(
            "cid" => $payment_kakao_cid,
            "tid" => $receipt["rcpt_payment_id"],
            "cancel_amount" => $receipt["rcpt_cancel_price"],
            "cancel_tax_free_amount" => 0,
            "cancel_vat_amount" => $receipt["rcpt_vat_price"]
        );

        $curl = curl_init($url);

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                'Authorization: KakaoAK ' . $payment_config["payment_kakao_admin_key"],
                'Content-Type: application/x-www-form-urlencoded;charset=utf-8'
            ],
        ]);

        return $curl;
    }

    public static function toss_payment($paymentKey, $orderId, $amount){
        global $payment_config;

        $url = 'https://api.tosspayments.com/v1/payments/' . $paymentKey;

        $data = ['orderId' => $orderId, 'amount' => $amount];

        if($payment_config["payment_toss_test"]){
            $credential = base64_encode($payment_config["payment_toss_test_secret_key"].':');
        }else{
            $credential = base64_encode($payment_config["payment_toss_secret_key"].':');
        }

        $curl = curl_init($url);

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . $credential,
                'Content-Type: application/json'
            ],
        ]);

        return $curl;
    }

    public static function toss_payment_virtual($order_data){
        global $payment_config;

        if($payment_config["payment_toss_test"]){   
            $credential = base64_encode($payment_config["payment_toss_test_secret_key"].':');
        }else{
            $credential = base64_encode($payment_config["payment_toss_secret_key"].':');
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.tosspayments.com/v1/virtual-accounts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($order_data),
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . $credential,
                "Content-Type: application/json"
            ],
        ]);

        return $curl;
    }

    public static function toss_payment_cancel($receipt, $cancel_data){
        global $payment_config;
            
        $curl = curl_init();

        if($payment_config["payment_toss_test"]){
            $credential = base64_encode($payment_config["payment_toss_test_secret_key"].':');
        }else{
            $credential = base64_encode($payment_config["payment_toss_secret_key"].':');
        }

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.tosspayments.com/v1/payments/{$receipt["rcpt_payment_id"]}/cancel",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($cancel_data),
        CURLOPT_HTTPHEADER => [
            'Authorization: Basic ' . $credential,
            "Content-Type: application/json"
        ],
        ]);
     
        return $curl;
    }

    public static function request_billing_key($auth_key, $customer_key){
        global $payment_config;
        
        $billing_request_data = array(
            "customerKey" => $customer_key
        );

        $curl = curl_init();

        if($payment_config["payment_toss_test"]){
            $credential = base64_encode($payment_config["payment_toss_test_secret_key"].':');
        }else{
            $credential = base64_encode($payment_config["payment_toss_secret_key"].':');
        }
        
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.tosspayments.com/v1/billing/authorizations/{$auth_key}",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($billing_request_data),
          CURLOPT_HTTPHEADER => [
            "Authorization: Basic " . $credential,
            "Content-Type: application/json"
          ],
        ]);

        return $curl;
    }

    public static function billing_payment($billing_key, $order_data){
        global $payment_config;
        
        $curl = curl_init();

        if($payment_config["payment_toss_test"]){
            $credential = base64_encode($payment_config["payment_toss_test_secret_key"].':');
        }else{
            $credential = base64_encode($payment_config["payment_toss_secret_key"].':');
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.tosspayments.com/v1/billing/{$billing_key}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($order_data),
            CURLOPT_HTTPHEADER => [
              "Authorization: Basic " . $credential,
              "Content-Type: application/json"
            ],
        ]);

        return $curl;
    }

    public static function request_cash_receipt($order_data){
        global $payment_config;
        
        $curl = curl_init();


        if($payment_config["payment_toss_test"]){
            $credential = base64_encode($payment_config["payment_toss_test_secret_key"].':');
        }else{
            $credential = base64_encode($payment_config["payment_toss_secret_key"].':');
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.tosspayments.com/v1/cash-receipts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($order_data),
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic " . $credential,
                "Content-Type: application/json"
            ],
        ]);

        return $curl;
    }
}
?>