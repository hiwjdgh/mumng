<?php
/* //커머스 라이브러리
require_once(PAVE_LIB_OBJECTS_PATH."/pave.commerce.php");
$commerce_cf = Commerce::get_commerce_cf_list();

//알림 객체
$notify_obj = new Notify();

$demote_user = array();
$user_info = array();
$user_score = array();

//강등 작가 조회
$sql = "SELECT epsd.* FROM pave_epsd AS epsd JOIN (SELECT MAX(epsd_id) AS epsd_id FROM pave_epsd WHERE work_id IN (SELECT work_id FROM pave_work WHERE work_display = 1 AND work_state IN('publish', 'stop')) GROUP BY work_id) AS epsd2 ON epsd.epsd_id = epsd2.epsd_id";
$result = pave_query($sql);
for ($i=0; $row = pave_fetch_assoc($result); $i++) {
    if($demote_user[$row["user_id"]]){
        if(strtotime($demote_user[$row["user_id"]]["epsd_upload_dt"]) > strtotime($row["epsd_upload_dt"])){
            $demote_user[$row["user_id"]] = array(
                "epsd_cate" => $row["epsd_cate"],
                "epsd_upload_dt" => $row["epsd_upload_dt"]
            );
        }
    }else{
        $demote_user[$row["user_id"]] = array(
            "epsd_cate" => $row["epsd_cate"],
            "epsd_upload_dt" => $row["epsd_upload_dt"]
        );
    }
}

//작가 강등
foreach ($demote_user as $user_id => $demote) {
    if($demote["epsd_cate"] == "epsd"){
        if(PAVE_TIME >= strtotime($demote["epsd_upload_dt"]."+ 1 months")){
            $sql2 = "SELECT * FROM pave_user WHERE user_id = '{$user_id}'";
            $row2 = pave_fetch($sql2);
            
            //1차 강등
            if($row2["user_commerce_demote"]){
                //2차 강등
                if(PAVE_TIME >= strtotime($row2["user_commerce_demote_dt"]. "+ 1 months")){
                    pave_update(
                        "pave_user", 
                        array(
                            "user_commerce_demote" => 1,
                            "user_score" => 0,
                            "user_grd" => "C7"
                        ), 
                        "user_id = '{$row2["user_id"]}'"
                    );
                }
            }else{
                if($row2["user_grd"] == "C7"){
                    $demote_commerce_grd = "C7";
                }else{
                    $demote_commerce_grd = "C".(substr($row2["user_grd"], 1, 1) + 1);
                }
                pave_update(
                    "pave_user", 
                    array(
                        "user_commerce_demote" => 1,
                        "user_grd" => $demote_commerce_grd,
                        "user_commerce_demote_dt" => PAVE_TIME_YMDHIS
                    ), 
                    "user_id = '{$row2["user_id"]}'"
                );
            }
            
            //커머스등급변경 알림
            $notify_obj->send_notify("mumng", $row2["user_id"], "notify_commerce_grade");
        }else{
            unset($demote_user[$user_id]);
        }
    }else{
        if(PAVE_TIME >= strtotime($demote["epsd_upload_dt"]."+ 3 months")){

            $sql2 = "SELECT * FROM pave_user WHERE user_id = '{$user_id}'";
            $row2 = pave_fetch($sql2);
            
            //1차 강등
            if($row2["user_commerce_demote"]){
                //2차 강등
                if(PAVE_TIME >= strtotime($row2["user_commerce_demote_dt"]. "+ 1 months")){
                    pave_update(
                        "pave_user", 
                        array(
                            "user_commerce_demote" => 1,
                            "user_score" => 0,
                            "user_grd" => "C7"
                        ), 
                        "user_id = '{$row2["user_id"]}'"
                    );
                }
            }else{
                if($row2["user_grd"] == "C7"){
                    $demote_commerce_grd = "C7";
                }else{
                    $demote_commerce_grd = "C".(substr($row2["user_grd"], 1, 1) + 1);
                }
                pave_update(
                    "pave_user", 
                    array(
                        "user_commerce_demote" => 1,
                        "user_grd" => $demote_commerce_grd,
                        "user_commerce_demote_dt" => PAVE_TIME_YMDHIS
                    ), 
                    "user_id = '{$row2["user_id"]}'"
                );
            }
            
            //커머스등급변경 알림
            $notify_obj->send_notify("mumng", $user_id, "notify_commerce_grade");
        }else{
            unset($demote_user[$user_id]);
        }
    }
}

//회차 점수 환산
$sql = "SELECT epsd_id, work_id, user_id, epsd_like, epsd_hit, epsd_delay FROM pave_epsd WHERE work_id IN (SELECT work_id FROM pave_work WHERE work_display = 1) AND epsd_state = 'success' AND epsd_cate = 'epsd'";
$result = pave_query($sql);
for ($i=0; $row = pave_fetch_assoc($result); $i++) {
    //강등대상은 등급 조정 제외
    if($demote_user[$row["user_id"]]){
        continue;
    }

    if(!array_key_exists($row["user_id"] ,$user_info)){
        $sql2 = "SELECT user.user_id, user.user_grd, user.user_commerce_expire_dt, commerce.* FROM pave_user AS user LEFT JOIN pave_cf_commerce AS commerce ON user.user_grd = commerce.commerce_id WHERE user_id = '{$row["user_id"]}' AND user_commerce = '1'";
        $row2 = pave_fetch($sql2);
    
        if(!$row2["user_id"]){
            continue;
        }

        $user_info[$row["user_id"]] = $row2;
    }
    

    //좋아요 점수 환산
    $like_score = $row["epsd_like"] * $user_info[$row["user_id"]]["commerce_like_ratio"];

    //조회 점수 환산
    $hit_score = $row["epsd_hit"] * $user_info[$row["user_id"]]["commerce_hit_ratio"];

    $epsd_score = $like_score + $hit_score;

    //지각 페널티 환산
    if($row["epsd_delay"]){
        $epsd_score *= $user_info[$row["user_id"]]["commerce_delay_ratio"];
    }

    $user_score[$row["user_id"]][$row["work_id"]]["score"] += $epsd_score;

    $user_score[$row["user_id"]][$row["work_id"]]["epsd"][] = array(
        "delay" => $row["epsd_delay"],
        "like" => $row["epsd_like"],
        "hit" => $row["epsd_hit"],
        "score" => $epsd_score
    );
}

//작품 점수 환산
foreach ($user_score as $user_id => $score) {
    $work_id = key($score);
    $sql2 = "SELECT COUNT(*) AS work_subscribe FROM pave_subscribe WHERE work_id = '{$work_id}'";
    $row2 = pave_fetch($sql2);

    $user_score[$user_id][$work_id]["subscribe"] = $row2["work_subscribe"];
    $user_score[$user_id][$work_id]["score"] += ($row2["work_subscribe"] * $user_info[$user_id]["commerce_subscribe_ratio"]);
}

//커머스 등급 조정
foreach ($user_score as $user_id => $work) {
    $work_id = key($score);
    $new_commerce_score = $work[$work_id]["score"] + $user_info[$user_id]["commerce_base_score"];
    if($new_commerce_score >= $user_info[$user_id]["commerce_score"]){
        //커머스 등급 재검사
        foreach($commerce_cf as $i => $commerce){
            $new_commerce_score2 = 0;
            foreach ($work[$work_id]["epsd"] as $i => $epsd) {
                //좋아요 점수 환산
                $like_score = $epsd["like"] * $commerce["commerce_like_ratio"];
    
                //조회 점수 환산
                $hit_score = $epsd["hit"] * $commerce["commerce_hit_ratio"];
    
                $epsd_score = $like_score + $hit_score;
    
                //지각 페널티 환산
                if($epsd["delay"]){
                    $epsd_score *= $commerce["commerce_delay_ratio"];
                }

                $new_commerce_score2 += $epsd_score;
            }

            $new_commerce_score2 += ($work[$work_id]["subscribe"] * $commerce["commerce_subscribe_ratio"]);
    
            //커머스 점수 합산
            $new_commerce_score2 += $commerce["commerce_base_score"];
            if($new_commerce_score2 >= $commerce["commerce_score"]){
                if(!$new_commerce_grd){
                    $new_commerce_grd = $commerce["commerce_id"];
                }
                break;
            }else{
                $new_commerce_grd = $commerce["commerce_id"];
                continue;
            }
        }

        //기간제 커머스 등급인 경우
        if(strtotime($user_info[$user_id]["user_commerce_expire_dt"]) > PAVE_TIME){
            pave_update("pave_user", array("user_score" => $new_commerce_score2), "user_id = '{$user_id}'");
        }else{
            pave_update("pave_user", array("user_score" => $new_commerce_score2, "user_grd" => $new_commerce_grd), "user_id = '{$user_id}'");
            if($user_info[$user_id]["user_grd"] != $new_commerce_grd){
                //커머스등급변경 알림
                $notify_obj->send_notify("mumng", $user_id, "notify_commerce_grade");
            }
        }

    }else{
        pave_update("pave_user", array("user_score" => $new_commerce_score), "user_id = '{$user_id}'");
    }
} */
?>