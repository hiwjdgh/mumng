<?php
$cert_type = pave_input_sanitize($cert_type);
$check_key = pave_input_sanitize($request[3]);

if($check_key == "cert_count"){
    if($msg = Certification::is_cert_max($pave_user, $cert_type)){
        die(return_json(null, "fail", $msg));
    }
}else{
    die(return_json(null, "fail", "잘못된 요청입니다."));
}

die(return_json(null, "success"));
?>