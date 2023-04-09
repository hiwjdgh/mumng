<?php
if (!defined('_PAVE_')) exit;
class Receipt{
    private $rcpt_id;
    private $user_no;
    private $rcpt_type;    
    private $rcpt_status;
    private $rcpt_display;

    private $page = 1;
    private $list_count = 5;


    function __construct() {
    }

    public static function genrate_receipt_id($it_no = 0, $user) {
        pave_query("START TRANSACTION");
        while (1) {
            $key = date('YmdHis', time()) . str_pad((int)(microtime()*100), 2, "0", STR_PAD_LEFT);

            $receipt = array(
                "rcpt_id" => $key,
                "it_no" => $it_no,
                "user_no" => $user["user_no"],
                "rcpt_status" => "order",
                "rcpt_insert_dt" => PAVE_TIME_YMDHIS,
                "rcpt_insert_ip" => PAVE_USER_IP
            );
            $result = pave_insert("pave_receipt", $receipt);

            if ($result){
                pave_query("COMMIT");
                break;
            }else{
                pave_query("ROLLBACK");
                usleep(10000); // 100분의 1초를 쉰다
            }
        }
        return $key;
    }

    public function set_rcpt_id($rcpt_id){
        $this->rcpt_id = $rcpt_id;

        return $this;
    }

    public function set_user_no($user_no){
        $this->user_no = $user_no;

        return $this;
    }

    public function set_rcpt_type($rcpt_type){
        $this->rcpt_type = $rcpt_type;

        return $this;
    }

    public function set_rcpt_status($rcpt_status){
        $this->rcpt_status = $rcpt_status;

        return $this;
    }

    public function set_rcpt_display($rcpt_display){
        $this->rcpt_display = $rcpt_display;

        return $this;
    }

    public function set_rcpt_page($rcpt_page){
        $this->page = $rcpt_page;

        return $this;
    }

    public function get_receipt_item($receipt){
        $item_obj = new Item();
        $item = $item_obj->set_it_no($receipt["it_no"])->set_it_display(1)->get_item();
        return $item;
    }

    public function get_receipt_exp($receipt){
        $exp_obj = new Exp();
        $exp = $exp_obj->set_exp_no($receipt["exp_no"])->get_exp();

        return $exp;
    }

    public function get_receipt_list_cnt(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_cnt_common("SELECT COUNT(*) AS cnt FROM pave_receipt AS receipt");

        
        if($this->rcpt_id){
            $obj->set_sql_cnt_where("receipt.rcpt_id = '{$this->rcpt_id}'");
        }

        if($this->user_no){
            $obj->set_sql_cnt_where("receipt.user_no = '{$this->user_no}'");
        }

        if($this->rcpt_type){
            if(pave_is_array($this->rcpt_type)){
                $obj->set_sql_cnt_where("receipt.rcpt_type IN ('".pave_implode($this->rcpt_type, "','")."')");
            }else{
                $obj->set_sql_cnt_where("receipt.rcpt_type = '{$this->rcpt_type}'");
            }
        }

        if($this->rcpt_status){
            if(pave_is_array($this->rcpt_status)){
                $obj->set_sql_cnt_where("receipt.rcpt_status IN ('".pave_implode($this->rcpt_status, "','")."')");
            }else{
                $obj->set_sql_cnt_where("receipt.rcpt_status = '{$this->rcpt_status}'");
            }
        }

        if($this->rcpt_display !== null){
            $obj->set_sql_cnt_where("receipt.rcpt_display = '{$this->rcpt_display}'");
        }

        $receipt_list = pave_fetch($obj->generate_cnt_sql())["cnt"];

         return $receipt_list;
    }

    public function get_receipt_list(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT receipt.* FROM pave_receipt AS receipt");

        
        if($this->rcpt_id){
            $obj->set_sql_where("receipt.rcpt_id = '{$this->rcpt_id}'");
        }

        if($this->user_no){
            $obj->set_sql_where("receipt.user_no = '{$this->user_no}'");
        }

        if($this->rcpt_type){
            if(pave_is_array($this->rcpt_type)){
                $obj->set_sql_where("receipt.rcpt_type IN ('".pave_implode($this->rcpt_type, "','")."')");
            }else{
                $obj->set_sql_where("receipt.rcpt_type = '{$this->rcpt_type}'");
            }
        }

        if($this->rcpt_status){
            if(pave_is_array($this->rcpt_status)){
                $obj->set_sql_where("receipt.rcpt_status IN ('".pave_implode($this->rcpt_status, "','")."')");
            }else{
                $obj->set_sql_where("receipt.rcpt_status = '{$this->rcpt_status}'");
            }
        }

        if($this->rcpt_display !== null){
            $obj->set_sql_where("receipt.rcpt_display = '{$this->rcpt_display}'");
        }

        $obj->set_sql_order("ORDER BY receipt.rcpt_id DESC");

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }

        $receipt_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            //결제 상품 정보
            $row["item"] = $this->get_receipt_item($row);

            //결제 카드 정보
            if($row["rcpt_card"]){
                $row["rcpt_card"] = json_decode($row["rcpt_card"], true);
            }

            //결제 가상계좌 정보
            if($row["rcpt_virtual"]){
                $row["rcpt_virtual"] = json_decode($row["rcpt_virtual"], true);
            }

            //결제 현금영수증 정보
            if($row["rcpt_cash"]){
                $row["rcpt_cash"] = json_decode($row["rcpt_cash"], true);
            }

            //결제 휴대폰 정보
            if($row["rcpt_cp"]){
                $row["rcpt_cp"] = json_decode($row["rcpt_cp"], true);
            }

            //결제 취소 정보
            if($row["rcpt_cancel"]){
                $row["rcpt_cancel"] = json_decode($row["rcpt_cancel"], true);
            }

            //결제 충전 정보
            $row["rcpt_exp"] = $this->get_receipt_exp($row);

            //결제 취소가능 여부
            $row["is_cancelable"] = false;
            if($row["rcpt_status"] == "payment_complete" &&
                PAVE_TIME < strtotime($row["rcpt_success_dt"]." +1 week") &&
                $row["rcpt_exp"]["exp_type"] == "payment" &&
                !$row["rcpt_exp"]["is_exp_use"]){
                $row["is_cancelable"] = true;
            }

            //결제만료 여부
            $row["is_expired"] = false;
            if(PAVE_TIME > strtotime($row["rcpt_expire_dt"])){
                $row["is_expired"] = false;
            }

            //text
            switch ($row["rcpt_status"]) {
                case 'payment_wait':
                    $row["rcpt_status_text"] = "결제대기";
                    break;
                case 'payment_complete':
                    $row["rcpt_status_text"] = "결제완료";
                    break;
                case 'payment_fail':
                    $row["rcpt_status_text"] = "결제실패";
                    break;
                case 'cancel':
                    $row["rcpt_status_text"] = "결제취소";
                    break;
                case 'cancel_wait':
                    $row["rcpt_status_text"] = "결제취소대기";
                    break;
                case 'refund_wait':
                    $row["rcpt_status_text"] = "환불대기";
                    break;
                case 'refund_complete':
                    $row["rcpt_status_text"] = "환불완료";
                    break;
            }

            $receipt_list[] = $row;

        }

         return $receipt_list;
    }
    
    public function get_receipt(){
        return $this->get_receipt_list()[0];
    }
}
?>