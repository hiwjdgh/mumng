<?php
if (!defined('_PAVE_')) exit;
class Notification{
    private $notify_no;
    private $notify_from;
    private $notify_to;

    private $page = 1;
    private $list_count = 10;

    public static function send_notify($sender, $receiver, $type, $rel = ""){
        $user_obj = new User();
        $user = $user_obj->set_user_id($sender)->set_user_block(0)->set_user_leave(0)->get_user();

        $user_obj2 = new User();
        $user2 = $user_obj2->set_user_id($receiver)->set_user_block(0)->set_user_leave(0)->get_user();


        self::insert_notify($user, $user2, $type, $rel);

        
        if($user2["user_notify"]["notify_all"] && $user2["user_notify"][$type]){
            self::notify_fcm();
        }
    }

    public static function send_notify_with_email($sender, $receiver, $type, $rel = ""){
        self::send_notify($sender, $receiver, $type, $rel);

        self::notify_email();
    }

    public function set_notify_no($notify_no){
        $this->notify_no = $notify_no;

        return $this;
    }

    public function set_notify_from($notify_from){
        $this->notify_from = $notify_from;

        return $this;
    }

    public function set_notify_to($notify_to){
        $this->notify_to = $notify_to;

        return $this;
    }

    public function set_notify_page($notify_page){
        $this->page = $notify_page;

         return $this;
    }

    private function notify_fcm(){
    }

    private function notify_email(){
        //todo
    }

    private function insert_notify($sender, $receiver, $type, $rel = array()){
        $sql = "SELECT * FROM pave_cf_notify WHERE notify_id = '{$type}'";
        $row = pave_fetch($sql);
        $notify_content = $row["notify_content"];

        switch ($type) {
            case 'notify_user_comment': //회차 의견 (rel : work_id, epsd_id)
            case 'notify_user_like': //회차 좋아요 (rel : work_id, epsd_id)
                $sql = "SELECT work.work_name, epsd.epsd_name FROM pave_epsd AS epsd LEFT JOIN pave_work AS work ON epsd.work_id = work.work_id WHERE epsd.epsd_id = '{$rel["epsd_id"]}'";
                $row = pave_fetch($sql);
                $notify_content = str_replace("{회차명}", $row["work_name"]."-".$row["epsd_name"], $notify_content);
                break;
            case 'notify_user_mention': //회차 언급 (rel : work_id, epsd_id, cmt_id)
            case 'notify_user_follow': //팔로우 (no rel)
                //no-op
                break;
            case 'notify_work_reserve': //회차 예약 (rel : work_id, epsd_id)
            case 'notify_work_complete': //회차 업로드 (rel : work_id, epsd_id)
                $sql = "SELECT work.work_name, epsd.epsd_name FROM pave_epsd AS epsd LEFT JOIN pave_work AS work ON epsd.work_id = work.work_id WHERE epsd.epsd_id = '{$rel["epsd_id"]}'";
                $row = pave_fetch($sql);
                $notify_content = str_replace("{회차명}", $row["work_name"]."-".$row["epsd_name"], $notify_content);
                break;
            case 'notify_work_deadline': //회차 마감 1시간전 (rel : work_id)
            case 'notify_work_late': //회차 지각 (rel : work_id)
            case 'notify_work_subscribe': //작품 구독 (rel : work_id)
            case 'notify_work_with': //함께한작가 추가 (rel : work_id)
                $sql = "SELECT work.work_name FROM pave_work AS work WHERE work.work_id = '{$rel["work_id"]}'";
                $row = pave_fetch($sql);
                $notify_content = str_replace("{작품명}", $row["work_name"], $notify_content);
                break;
            case 'notify_work_rcmnd': //작품 기업 추천
                //todo
                break;
            case 'notify_subscribe_rest': //구독작품 휴재 (rel : work_id, rest_date)
            case 'notify_subscribe_epsd': //구독작품 새 회차 (rel : work_id)
            case 'notify_subscribe_notice': //구독작품 새 공지 (rel : work_id)
                $sql = "SELECT work.work_name FROM pave_work AS work WHERE work.work_id = '{$rel["work_id"]}'";
                $row = pave_fetch($sql);
                $notify_content = str_replace("{작품명}", $row["work_name"], $notify_content);

                if($rel["rest_date"]){
                    $notify_content = str_replace("{휴재일}", $row["rest_date"], $notify_content);
                }
                break;
            case 'notify_pay_complete': //회차 구매완료 (rel : work_id, epsd_id, exp, pay_type)
                $sql = "SELECT work.work_name, epsd.epsd_name FROM pave_epsd AS epsd LEFT JOIN pave_work AS work ON epsd.work_id = work.work_id WHERE epsd.epsd_id = '{$rel["epsd_id"]}'";
                $row = pave_fetch($sql);
                $notify_content = str_replace("{회차명}", $row["work_name"]."-".$row["epsd_name"], $notify_content);

                if($rel["pay_type"] == "keep" || $rel["pay_type"] == "keep2") {
                    $pay_type_text = "영구소장";
                }else if($rel["pay_type"] == "end" || $rel["pay_type"] == "end2"){
                    $pay_type_text = "완결소장";
                }else if($rel["pay_type"] == "rent"){
                    $pay_type_text = "대여";
                }else if($rel["pay_type"] == "preview" || $rel["pay_type"] == "preview2"){
                    $pay_type_text = "미리보기";
                }
        
                $notify_content = str_replace("{구매방식}", $pay_type_text, $notify_content);
                $notify_content = str_replace("{회차명}", $row["work_name"]."-".$row["epsd_name"], $notify_content);
                $notify_content = str_replace("{EXP}", Converter::display_number($rel["exp"]), $notify_content);
                break;
            case 'notify_pay_expire': //회차 만료 1일전 (rel : work_id, epsd_id)
                $sql = "SELECT work.work_name, epsd.epsd_name FROM pave_epsd AS epsd LEFT JOIN pave_work AS work ON epsd.work_id = work.work_id WHERE epsd.epsd_id = '{$rel["epsd_id"]}'";
                $row = pave_fetch($sql);
                $notify_content = str_replace("{회차명}", $row["work_name"]."-".$row["epsd_name"], $notify_content);
                break;
            case "notify_charge_complete": //충전 완료 (rel : rcpt_id)
            case "notify_charge_cancel": //충전 취소 (rel : rcpt_id)
                $receipt_obj = new Receipt();
                $receipt =  $receipt_obj->set_rcpt_id($rel["rcpt_id"])->set_user_no($receiver["user_no"])->get_receipt();
                $notify_content = str_replace("{EXP}", Converter::display_number($receipt["item"]["it_exp"], "EXP"), $notify_content);
                break;

            case "notify_commerce_calc_deposit": //커머스 정산 입금 완료
            case "notify_commerce_calc_period": //커머스 정산 기간
            case "notify_commerce_calc_request": //커머스 정산 신청
            case "notify_commerce_grade": //커머스 등급 변경
                //no-op
                break;
            case "notify_other_device": //다른기기 로그인 (no rel)
            case "notify_pwd_expire": // 비밀번호 변경 요청 (no rel)
                //no-op
                break;
        }
        
        $notify = array(
            "notify_from"       => $sender["user_id"],
            "notify_to"         => $receiver["user_id"],
            "notify_type"       => $type,
            "notify_rel"        => json_encode($rel),
            "notify_content"    => $notify_content,
            "notify_insert_ip"  => PAVE_USER_IP,
            "notify_insert_dt"  => PAVE_TIME_YMDHIS
        );
        pave_insert("pave_notification", $notify);
    }

       
    public function get_notify_user($user_no){
        $user_obj = new User();

        return $user_obj->set_user_no($user_no)->set_user_leave(0)->set_user_block(0)->get_user();
    }

    public function get_notify_list(){
        $obj = new Objects2();

        $obj->generate_sql_init()
        ->set_sql_common("SELECT notify.*, notify_cf.notify_group, notify_cf.notify_template FROM pave_notification AS notify")
        ->set_sql_common("LEFT JOIN pave_cf_notify AS notify_cf ON (notify.notify_type = notify_cf.notify_id)");

        if($this->notify_no){
            $obj->set_sql_where("notify.notify_no = '{$this->notify_no}'");
        }

        if($this->notify_from){
            $obj->set_sql_where("notify.notify_from = '{$this->notify_from}'");
        }

        if($this->notify_to){
            $obj->set_sql_where("notify.notify_to = '{$this->notify_to}'");
        }

        
        $this->sql_order = "ORDER BY notify.notify_no DESC";

        if($this->page){
            $from = ($this->page - 1) * $this->list_count;
            $to = $this->list_count;
            $obj->set_sql_limit("LIMIT {$from}, {$to}");
        }

        $notify_list = array();
        $result = pave_query($obj->generate_sql());
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            //보낸 회원
            $row["sender"] = $this->get_notify_user($row["notify_sender"]);

            //받은 회원
            $row["receiver"] = $this->get_notify_user($row["notify_receiver"]);

            switch ($row["notify_type"]) {
                case 'notify_user_comment': //회차 의견 (rel : work_id, epsd_id)
                case 'notify_user_like': //회차 좋아요 (rel : work_id, epsd_id)
                case 'notify_user_mention': //회차 언급 (rel : work_id, epsd_id, cmt_id)
                    $notify_rel = json_decode($row["notify_rel"], true);
                    $sql = "SELECT epsd_img FROM pave_epsd WHERE epsd_id = '{$notify_rel["epsd_id"]}'";
                    $row2 = pave_fetch($sql);
                    $row["notify_img"] = $row2["epsd_img"];
                    $row["notify_url"] = get_url(PAVE_WORK_URL, "epsd/{$notify_rel["work_id"]}/{$notify_rel["epsd_id"]}");
                    break;
                case 'notify_user_follow': //팔로우 (no rel)
                    //no-op
                    break;
                case 'notify_work_reserve': //회차 예약 (rel : work_id, epsd_id)
                case 'notify_work_complete': //회차 업로드 (rel : work_id, epsd_id)
                case 'notify_work_deadline': //회차 마감 1시간전 (rel : work_id)
                case 'notify_work_late': //회차 지각 (rel : work_id)
                    $notify_rel = json_decode($row["notify_rel"], true);
                    $sql = "SELECT work_img FROM pave_work WHERE work_id = '{$notify_rel["work_id"]}'";
                    $row2 = pave_fetch($sql);
                    $row["sender"]["user_img"] = get_url(PAVE_IMG_URL, "icon_mumng_notice_34px.png");
                    $row["notify_img"] = $row2["work_img"];
                    $row["notify_url"] = get_url(PAVE_WORK_URL, "detail/{$notify_rel["work_id"]}");
                    break;
                case 'notify_work_subscribe': //작품 구독 (rel : work_id)
                case 'notify_work_with': //함께한작가 추가 (rel : work_id)
                    $notify_rel = json_decode($row["notify_rel"], true);
                    $sql = "SELECT work_img FROM pave_work WHERE work_id = '{$notify_rel["work_id"]}'";
                    $row2 = pave_fetch($sql);
                    $row["notify_img"] = $row2["work_img"];
                    $row["notify_url"] = get_url(PAVE_WORK_URL, "detail/{$notify_rel["work_id"]}");
                    break;
                case 'notify_work_rcmnd': //작품 기업 추천
                    //todo
                    break;
                case 'notify_subscribe_rest': //구독작품 휴재 (rel : work_id, rest_date)
                case 'notify_subscribe_epsd': //구독작품 새 회차 (rel : work_id)
                case 'notify_subscribe_notice': //구독작품 새 공지 (rel : work_id)
                    $notify_rel = json_decode($row["notify_rel"], true);
                    $sql = "SELECT work_img FROM pave_work WHERE work_id = '{$notify_rel["work_id"]}'";
                    $row2 = pave_fetch($sql);
                    $row["notify_img"] = $row2["work_img"];
                    $row["notify_url"] = get_url(PAVE_WORK_URL, "detail/{$notify_rel["work_id"]}");
                    break;
                case 'notify_pay_complete': //회차 구매완료 (rel : work_id, epsd_id, exp, pay_type)
                case 'notify_pay_expire': //회차 만료 1일전 (rel : work_id, epsd_id)
                    $notify_rel = json_decode($row["notify_rel"], true);
                    $sql = "SELECT epsd_img FROM pave_epsd WHERE epsd_id = '{$notify_rel["epsd_id"]}'";
                    $row2 = pave_fetch($sql);
                    $row["sender"]["user_img"] = get_url(PAVE_IMG_URL, "icon_mumng_notice_34px.png");
                    $row["notify_img"] = $row2["epsd_img"];
                    $row["notify_url"] = get_url(PAVE_WORK_URL, "epsd/{$notify_rel["work_id"]}/{$notify_rel["epsd_id"]}");
                    break;
                case "notify_charge_complete": //충전 완료 (rel : rcpt_id)
                case "notify_charge_cancel": //충전 취소 (rel : rcpt_id)
                    $row["sender"]["user_img"] = get_url(PAVE_IMG_URL, "icon_exp_65px.png");
                    break;
                case "notify_commerce_calc_deposit": //커머스 정산 입금 완료
                case "notify_commerce_calc_period": //커머스 정산 기간
                case "notify_commerce_calc_request": //커머스 정산 신청
                case "notify_commerce_grade": //커머스 등급 변경
                    $row["sender"]["user_img"] = get_url(PAVE_IMG_URL, "icon_mumng_notice_34px.png");
                    break;
                case "notify_other_device": //다른기기 로그인 (no rel)
                case "notify_pwd_expire": // 비밀번호 변경 요청 (no rel)
                    $row["sender"]["user_img"] = get_url(PAVE_IMG_URL, "icon_mumng_notice_34px.png");
                    break;
            }
            $notify_list[] = $row;
        }

        return $notify_list;
    }
}
?>