<?php
if (!defined('_PAVE_')) exit;
class Charge {
    function __construct() {
       
    }

    public static function charge_payment_exp($receipt){
        $update = array(
            "rcpt_status" => "payment_complete",
            "rcpt_charge_dt" => PAVE_TIME_YMDHIS
        );
        $user_obj = new User();
        $user = $user_obj->set_user_no($receipt["user_no"])->get_user();

        //영수증 상태 변경
        pave_update("pave_receipt", $update, "rcpt_id = '{$receipt["rcpt_id"]}'");

        //EXP 상태 변경
        pave_update("pave_exp", array("exp_state" => "success"), "exp_no = '{$receipt["rcpt_exp"]["exp_no"]}'");

        //회원 EXP 변경
        pave_query("UPDATE pave_user SET user_exp = user_exp + {$receipt["item"]["it_exp"]} WHERE user_no = '{$receipt["user_no"]}'");

        //충전 알림
        $notify_obj = new Notification();
        $notify_obj->send_notify("mumng", $user["user_id"], "notify_charge_complete", array("rcpt_id" => $receipt["rcpt_id"]));
    }

    public static function cancel_payment_exp($receipt){
        $update = array(
            "rcpt_status" => "cancel",
            "rcpt_cancel_price" => 0,
            "rcpt_cancel_dt" => PAVE_TIME_YMDHIS
        );
        $user_obj = new User();
        $user = $user_obj->set_user_no($receipt["user_no"])->get_user();

        //영수증 상태 변경
        pave_update("pave_receipt", $update, "rcpt_id = '{$receipt["rcpt_id"]}'");
        //EXP 변경
        pave_update("pave_exp", array("exp_state" => "cancel", "exp_cancel_dt" => PAVE_TIME_YMDHIS), "exp_no = '{$receipt["rcpt_exp"]["exp_no"]}'");
        
        //회원 EXP 변경
        pave_query("UPDATE pave_user SET user_exp = user_exp - {$receipt["item"]["it_exp"]} WHERE user_no = '{$receipt["user_no"]}'");

        //충전 취소 알림
        $notify_obj = new Notification();
        $notify_obj->send_notify("mumng", $user["user_id"], "notify_charge_cancel", array("rcpt_id" => $receipt["rcpt_id"]));
    }
}
?>