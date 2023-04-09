<?php
if (!defined('_PAVE_')) exit;
class Penalty extends Objects{
    private $user = array();

    private $list_count = 5;
    private $nav_count = 5;
    private $page = 1;


    function __construct() {
        global $pave_user;
        $this->user = $pave_user;
    }

    public static function get_penalty_cf(){
        $sql = "SELECT * FROM pave_cf_penalty";
        $row = pave_fetch($sql);

        $row["penalty_reason_list"] = json_decode($row["penalty_reason"], true);
        usort($row["penalty_reason_list"], function ($item1, $item2) {
            return $item1["reason_order"] <=> $item2["reason_order"];
        });

        return $row;
    }
}
?>