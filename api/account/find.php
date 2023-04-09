<?php
if($_SESSION['csrf_token'] != $csrf){
    die(return_json(null, "fail", "비정상적인 접근입니다.", get_url(PAVE_URL)));
}

if($is_user){
    die(return_json(null, "fail","", get_url(PAVE_URL)));
}

$find_type          = pave_input_sanitize($request[3]);
$user_id            = pave_input_sanitize($user_id);

//본인확인 결과값
$user_nice = get_session("nice_result")?:null;
set_session("nice_result" , "");


if($find_type == "id"){
    if($user_nice == null){
        die(return_json(null, "fail", "본인인증 후 진행해주세요.", get_url(PAVE_ACCOUNT_URL, "find/pwd/form")));
    }

    $sql = "SELECT user_no FROM pave_user WHERE user_di = '{$user_nice["di"]}'";
    $row = pave_fetch($sql);

    if(!$row["user_no"]){
        die(return_json(null, "fail", "등록된 회원님의 정보가 없습니다.", get_url(PAVE_ACCOUNT_URL, "login")));
    }

    set_session("find_user_no" , $row["user_no"]);


    die(return_json(null, "success", "", get_url(PAVE_ACCOUNT_URL, "find/id/result")));


}else if($find_type == "pwd"){
    if($user_nice == null){
        die(return_json(null, "fail", "본인인증 후 진행해주세요.", get_url(PAVE_ACCOUNT_URL, "find/pwd/form")));
    }

    $sql = "SELECT user_no FROM pave_user WHERE user_di = '{$user_nice["di"]}' AND user_id = '{$user_id}'";
    $row = pave_fetch($sql);
    if(!$row["user_no"]){
        die(return_json(null, "fail", "등록된 회원님의 정보가 없습니다.", get_url(PAVE_ACCOUNT_URL, "login")));
    }
    set_session("find_user_no" , $row["user_no"]);

    die(return_json(null, "success", "", get_url(PAVE_ACCOUNT_URL, "find/pwd/new")));

}else{
    die(return_json(null, "fail", "잘못된 요청입니다."));
}
?>