<?php
$comment_no = pave_input_sanitize($comment_no);

$comment_obj = new Comment();
$comment_obj->set_comment_no($comment_no);
$comment = $comment_obj->get_comment($comment_no);

if(!$comment["comment_no"]){
    die(return_json(null, "fail", "의견을 찾을 수 없습니다."));
}

if($like_no = Comment::is_comment_like($pave_user, $comment)){
    pave_delete("pave_like", array("like_no" => $like_no));
    pave_query("UPDATE pave_comment SET comment_like = comment_like - 1 WHERE comment_no = '{$comment["comment_no"]}'");
}else{
    $like = array(
        "user_no"           => $pave_user["user_no"],
        "work_id"           => $comment["work_id"],
        "epsd_id"           => $comment["epsd_id"],
        "comment_no"        => $comment["comment_no"],
        "like_insert_dt"    => PAVE_TIME_YMDHIS,
        "like_insert_ip"    => PAVE_USER_IP
    );

    pave_insert("pave_like", $like);
    pave_query("UPDATE pave_comment SET comment_like = comment_like + 1 WHERE comment_no = '{$comment["comment_no"]}'");
}
die(return_json(null, "success"));
?>