<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", PAVE_URL);
}
$cert_max_cnt               = pave_input_sanitize($cert_max_cnt);
$cert_type                  = pave_input_sanitize($cert_type);
$cert_expire_day_no         = pave_input_sanitize($cert_expire_day_no);
$cert_expire_day_unit       = pave_input_sanitize($cert_expire_day_unit);
$cert_nice_product_code     = pave_input_sanitize($cert_nice_product_code);
$cert_nice_client_key       = pave_input_sanitize($cert_nice_client_key);
$cert_nice_secret_key       = pave_input_sanitize($cert_nice_secret_key);
$cert_nice_access_token     = pave_input_sanitize($cert_nice_access_token);
$cert_nice_renew_state      = pave_input_sanitize($cert_nice_renew_state);

$cert_nice_expired_dt       = $cert_cf["cert_nice_expired_dt"];
if($cert_nice_renew_state){
    $cert_nice_expired_dt = Converter::display_time("Y-m-d H:i:s", "{$cert_nice_expired_dt} + 1 year");
}

$update = array(
    "cert_max_cnt"              => $cert_max_cnt,
    "cert_type"                 => $cert_type,
    "cert_expire_day_no"        => $cert_expire_day_no,
    "cert_expire_day_unit"      => $cert_expire_day_unit,
    "cert_nice_product_code"    => $cert_nice_product_code,
    "cert_nice_client_key"      => $cert_nice_client_key,
    "cert_nice_secret_key"      => $cert_nice_secret_key,
    "cert_nice_access_token"    => $cert_nice_access_token,
    "cert_nice_expired_dt"      => $cert_nice_expired_dt
);

pave_update("pave_cf_cert", $update, "1");

url_move(get_url(PAVE_ADM_URL, "config/cert/form"));
?>