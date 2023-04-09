<?php
if (!defined('_PAVE_')) exit;
/* class Upload{
    private $user;
    private $day_list = array("일요일","월요일","화요일","수요일","목요일","금요일","토요일");
    private $day_short_list = array("일","월","화","수","목","금","토");
    private $cal_start = "";
    private $cal_end = "";

    function __construct() {
        global $pave_user;
        $this->user = $pave_user;
    }

    function set_calendar_date($cal_start, $cal_end){
        $this->cal_start = Converter::display_time("Y-m-d", $cal_start);
        $this->cal_end = Converter::display_time("Y-m-d", $cal_end);
    }
    
    function get_calendar_detail(){
        $sql = array();
        $sql_where = array();
        $sql_common = array();

        $sql_common[] = "SELECT work.*, user_img, user.user_nick, user.user_code, user.user_commerce, epsd.epsd_id, epsd.epsd_name, epsd.epsd_cate, epsd.epsd_state, epsd.epsd_insert_dt, epsd.epsd_upload_dt FROM pave_work AS work";
        $sql_common[] = "LEFT JOIN pave_user AS user ON user.user_id = work.user_id";
        $sql_common[] = "LEFT JOIN pave_epsd AS epsd ON (epsd.work_id = work.work_id AND date_format(epsd.epsd_upload_dt, '%Y-%m-%d') = '{$cal_date}')";
        $sql_where[] = "WHERE (work.user_id = '{$this->user["user_id"]}' OR work.work_with LIKE '%{$this->user["user_id"]}%')";
        $sql_where[] = "date_format(work.work_insert_dt, '%Y-%m-%d') <= '{$cal_date}'";
        $sql_where[] = "work.work_day LIKE '%{$work_day_short}%'";
    }

    function get_calendar_event_list(){

    }

    function is_uplodable(){

    }
} */
?>