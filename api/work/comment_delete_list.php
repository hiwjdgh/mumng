<?php
$cmt_id_list = pave_input_sanitize($cmt_id_list);
$cmt_id_list = pave_explode($cmt_id_list, ",");

$work_obj = new W();
$epsd_obj = new Epsds();
$cmt_obj = new Cmts();
foreach ($cmt_id_list as $i => $cmt_id) {
    $cmt = $cmt_obj->get_cmt($cmt_id);
    if(!$cmt["cmt_id"]){
        continue;
    }

    $work = $work_obj->get_work($cmt["work_id"]);
    $epsd = $epsd_obj->get_epsd($cmt["epsd_id"]);



    //의견 작성자, 작품의 작가, 작품의 함께한 작가가 아닌 경우
    if($pave_user["user_id"] != $cmt["cmt_user"]["user_id"]){
        if($work["work_user"]["user_id"] != $pave_user["user_id"] || !in_array($pave_user["user_id"], array_column($work["work_with_user"], "user_id"))){
            continue;
        }
    }

    //의견 삭제
    pave_delete("pave_epsd_cmt", array("cmt_id" => $cmt["cmt_id"]));

    if($cmt["cmt_parent_id"]){ // 대댓글인 경우
        //리플수 조정
        pave_query("UPDATE pave_epsd_cmt SET cmt_reply = cmt_reply -1 WHERE cmt_id = '{$cmt["cmt_parent_id"]}'");
        //의견수 조정
        pave_query("UPDATE pave_epsd SET epsd_cmt = epsd_cmt - 1 WHERE epsd_id = '{$epsd["epsd_id"]}'");

        //좋아요 삭제
        pave_delete("pave_like", array("work_id" => $work["work_id"], "epsd_id" => $epsd["epsd_id"], "cmt_id" => $cmt["cmt_id"]));
    }else{ //댓글인 경우
        //의견수 조정
        pave_query("UPDATE pave_epsd SET epsd_cmt = epsd_cmt - ({$cmt["cmt_reply"]} + 1) WHERE epsd_id = '{$epsd["epsd_id"]}'");

        //좋아요 삭제
        pave_delete("pave_like", array("work_id" => $work["work_id"], "epsd_id" => $epsd["epsd_id"], "cmt_id" => $cmt["cmt_id"]));


        //대댓글 삭제
        pave_delete("pave_epsd_cmt",  array("cmt_parent_id" => $cmt["cmt_id"]));

        //대댓글 좋아요 삭제
        $sql = "SELECT GROUP_CONCAT(QUOTE(cmt_id)) AS cmt_id FROM pave_epsd_cmt WHERE cmt_parent_id = '{$cmt["cmt_id"]}'";
        $row = pave_fetch($sql);

        pave_query("DELETE FROM pave_like WHERE cmt_id IN ('{$row["cmt_id"]}')");
    }
   
}
die(return_json());
?>