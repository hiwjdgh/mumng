<?php
$nice_data = create_nice_crypto_request();

if(!$nice_data){
    alert_close("잘못된 인증입니다.");
}

$value = trim($nice_data["request"]["dataBody"]["req_dtim"]).trim($nice_data["request"]["dataBody"]["req_no"]).trim($nice_data["response"]["dataBody"]["token_val"]);
$value = base64_encode(hash("sha256", $value, true));

$key = substr($value, 0, 16);
$iv = substr($value, -16);
$hmac_key = substr($value, 0, 32);

$request_data = array(
    "requestno" => "REQ".Converter::display_time(PAVE_TIME, "YmdHis"),
    "returnurl" => get_url(PAVE_CERT_URL,"success/",),
    "sitecode" => $nice_data["response"]["dataBody"]["site_code"],
    "methodtype" => "post",
    "authtype" => "M",
    "popupyn" => "Y",
    "receivedata" => $request[2]
);
$request_data = json_encode($request_data, JSON_UNESCAPED_SLASHES);

$encrypt_text  = encrypt_nice($request_data, $key, $iv);
$integrity_value = base64_encode(hash_hmac('sha256', $encrypt_text, $hmac_key, true));

set_session("nice_key", $key);
set_session("nice_iv", $iv);

//헤더 불러오기
get_header("본인인증");

//컨텐츠 불러오기
$theme_path = $pave_theme["thm_path"]."/form.view.php";
if(is_file($theme_path) && file_exists($theme_path)){
    include_once($theme_path);
}else{
    console($pave_title." 파일을 찾을 수 없어 기본테마로 대체합니다.");
    include_once($pave_theme["thm_default"]."/cert/form.view.php");
}

//푸터 불러오기
get_footer();
?>
