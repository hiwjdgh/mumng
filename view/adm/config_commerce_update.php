<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", PAVE_URL);
}

$commerce_list           = pave_input_sanitize($commerce);

foreach ((array)$commerce_list as $key => $commerce) {
    $update = array(
        "commerce_fee"              =>$commerce["commerce_fee"],
        "commerce_base_score"       =>$commerce["commerce_base_score"],
        "commerce_score"            =>$commerce["commerce_score"],
        "commerce_like_ratio"       =>$commerce["commerce_like_ratio"],
        "commerce_subscribe_ratio"  =>$commerce["commerce_subscribe_ratio"],
        "commerce_hit_ratio"        =>$commerce["commerce_hit_ratio"],
        "commerce_hit_ratio"        =>$commerce["commerce_hit_ratio"],
    );
    
    pave_update("pave_cf_commerce", $update, "commerce_id = '{$key}'");
}

url_move(get_url(PAVE_ADM_URL, "config/commerce/form"));
?>