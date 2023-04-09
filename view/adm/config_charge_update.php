<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", PAVE_URL);
}
$charge_payment_expire_no         = pave_input_sanitize($charge_payment_expire_no);
$charge_payment_expire_unit       = pave_input_sanitize($charge_payment_expire_unit);

$update = array(
    "charge_payment_expire_no"              => $charge_payment_expire_no,
    "charge_payment_expire_unit"            => $charge_payment_expire_unit
);

pave_update("pave_cf_charge", $update, "1");

url_move(get_url(PAVE_ADM_URL, "config/charge/form"));
?>