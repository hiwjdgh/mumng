<?php
$work_id = pave_input_sanitize($work_id);
$epsd_id = pave_input_sanitize($epsd_id);
$comment_no = pave_input_sanitize($comment_no);


$work_obj = new Work();
$work = $work_obj->set_work_id($work_id)
->set_work_display(1)
->set_work_epsd_cnt(0)->get_work();
if(!$work["work_id"]){
    die(return_json(null, "fail", "의견 삭제에 실패했습니다."));
}

$epsd_obj = new Epsd();
$epsd_obj->set_work_id($work["work_id"])
->set_epsd_id($epsd_id)
->set_epsd_cate(array("epsd", "notice"));
if($work["work_user"]["user_commerce"]){
    $epsd_obj->set_epsd_state(array("reserve", "success"));
}else{
    $epsd_obj->set_epsd_state("success");
}
$epsd = $epsd_obj->get_epsd();
if(!$epsd["epsd_id"]){
    die(return_json(null, "fail", "의견 삭제 실패했습니다."));
}


$comment_obj = new Comment();
$comment = $comment_obj->set_work_id($work["work_id"])
->set_epsd_id($epsd["epsd_id"])
->set_comment_display(1)
->set_comment_no($comment_no)
->get_comment();

if(!$comment["comment_no"]){
    die(return_json(null, "fail", "이미 삭제된 의견입니다."));
}


//의견 작성자, 작품의 작가, 작품의 함께한 작가가 아닌 경우
if($pave_user["user_no"] != $comment["comment_user"]["user_no"]){
    if($work["work_user"]["user_no"] != $pave_user["user_no"] || !in_array($pave_user["user_id"], array_column($work["work_with_user"], "user_id"))){
        die(return_json(null, "fail", "비정상적인 접근입니다."));
    }
}


//의견 삭제
pave_delete("pave_comment", array("comment_no" => $comment["comment_no"]));

if($comment["comment_parent_no"]){
    //리플수 조정
    pave_query("UPDATE pave_comment SET comment_reply = comment_reply -1 WHERE comment_no = '{$comment["comment_parent_no"]}'");
    //의견수 조정
    pave_query("UPDATE pave_epsd SET epsd_cmt = epsd_cmt - 1 WHERE epsd_id = '{$epsd["epsd_id"]}'");

    //좋아요 삭제
    pave_delete("pave_like", array("work_id" => $work["work_id"], "epsd_id" => $epsd["epsd_id"], "comment_no" => $comment["comment_no"]));
}else{ 
    //의견수 조정
    pave_query("UPDATE pave_epsd SET epsd_cmt = epsd_cmt - ({$comment["comment_reply"]} + 1) WHERE epsd_id = '{$epsd["epsd_id"]}'");

    //좋아요 삭제
    pave_delete("pave_like", array("work_id" => $work["work_id"], "epsd_id" => $epsd["epsd_id"], "comment_no" => $comment["comment_no"]));


    //대댓글 삭제
    pave_delete("pave_comment",  array("comment_parent_no" => $comment["comment_no"]));

    //대댓글 좋아요 삭제
    $sql = "SELECT GROUP_CONCAT(QUOTE(comment_no)) AS comment_no FROM pave_comment WHERE comment_parent_no = '{$comment["comment_no"]}'";
    $row = pave_fetch($sql);

    if($row["comment_no"]){
        pave_query("DELETE FROM pave_like WHERE comment_no IN ('{$row["comment_no"]}')");
    }

}


die(return_json(null, "success"));
?>