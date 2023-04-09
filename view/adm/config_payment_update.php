<?php
$payment_settle_type = pave_input_sanitize($payment_settle_type);

$update = array(
    "payment_settle_type"   => json_encode($payment_settle_type, JSON_UNESCAPED_UNICODE)
);
pave_update("pave_cf_payment", $update);

url_move(get_url(PAVE_ADM_URL,"config/payment/form"));
?>